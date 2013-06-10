<?php

class ArtilheirosController extends BaseController
{

    protected $title = 'Artilheiros';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('artilheiros.index')->with(array(
            'entities' => Artilheiro::all(),
            'times' => $this->getTimesSelect(true),
            'title' => $this->title
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('artilheiros.create')->with('times', $this->getTimesSelect());
    }

    public function foto()
    {
        if(!Input::get('ajaxAction')) {
            //@TODO fail
        }

        switch (Input::get('ajaxAction')) {
            case 'upload':
                return $this->uploadFoto();
                break;
            case 'cropForm':
                return $this->getCropForm();
                break;
            case 'crop':
                return $this->cropFoto();
                break;

            default:
                # code...
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(!Time::find(Input::get('time_id'))) {
            return Response::json(array(
                'success' => false,
                'messages' => 'Time não encontrado'
            ));
        }
        $entity = new Artilheiro(Input::all());
        if(!$entity->save()){
            return Response::json(array(
                'success' => false,
                'messages' => $entity->errors()->all()
            ));
        }

        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function time($id)
    {
        $html = '';
        if($id <= 0) {
            foreach (Artilheiro::all() as $entity) {
                $html .= View::make('artilheiros._partials.table_row')->with('entity', $entity);
            }
        } else {
            $time = Time::has('artilheiros')->find($id);
            if($time) {
                foreach ($time->artilheiros()->get() as $entity) {
                    $html .= View::make('artilheiros._partials.table_row')->with('entity', $entity);
                }
            }
        }
        return $html;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $entity = Artilheiro::find($id);
        if (!$entity) {
            App::abort('Artilheiro não encontrado', 404);
        }
        return View::make('artilheiros.edit')->with(array('entity' => $entity, 'times' => $this->getTimesSelect()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $time = Time::find(Input::get('time_id'));
        if(!$time) {
            return Response::json(array(
                'success' => false,
                'messages' => 'Time não encontrado'
            ));
        }
        $entity = Artilheiro::find($id);
        if (!$entity) {
            return Response::json(array(
                'success' => false,
                'messages' => 'Artilheiro não encontrado'
            ));
        }

        $this->updateGols($entity, $time);
        $entity->fill(Input::all());
        if(!$entity->save()){
            return Response::json(array(
                'success' => false,
                'messages' => $entity->errors()->all()
            ));
        }

        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $entity = Artilheiro::find($id);
        if(!$entity) {
            return Response::json(array(
                    'success' => false,
                    'message' => 'Artilheiro não encontrado',
            ));
        }

        $this->updateGols($entity, null, true);
        if(!$entity->delete()) {
            return Response::json(array(
                    'success' => false,
                    'message' => 'Não foi possível remover o item',
            ));
        }

        return Response::json(array(
                'success' => true,
        ));
    }

    /**
     * Get times select array
     * @return array
     */
    protected function getTimesSelect($filtered = false)
    {
        $departamentos = Departamento::has('times')->get();
        $select = array();
        foreach ($departamentos as $departamento) {
            foreach ($departamento->times as $time) {
                if($filtered && $time->hasMany('artilheiro')->count() == 0) {
                    continue;
                }
                $select[$departamento->nome][$time->id] = $time->nome;
            }
        }

        return $select;
    }

    /**
     * Handle foto upload
     * @return Response
     */
    protected function uploadFoto()
    {
        $foto = Input::file('image');
        try {
            $result = Upload::save($foto);
        } catch ( Exception $ex) {
            return Response::json(array(
                'success' => false,
                'messages' => $ex->getMessage()
            ));
        }

        $image = $this->loadFoto($result['path']);
        ob_start();
        print View::make('util.crop_form')->with(array_merge(array('image' => $image), $result));
        $form = ob_get_clean();
        return Response::json(array(
            'success' => true,
            'url' => url($result['url']),
            'form' => $form
        ));
    }

    protected function cropFoto()
    {
        $imageResource = $this->loadFoto();
        $width = ceil(Input::get('w_sel'));
        $height = ceil(Input::get('h_sel'));
        $destX = Input::get('x_d', 0);
        $destY = Input::get('y_d', 0);
        $maxWidth = Input::get('max_width', 0);
        $maxHeight = Input::get('max_height', 0);
        $imageResource->crop($width, $height, $destX, $destY);
        $path = $imageResource->dirname . '/' . $imageResource->filename . "-{$width}x{$height}." . $imageResource->extension;
        if($maxWidth && $maxHeight) {
            $imageResource->resize($maxWidth, $maxHeight);
        }
        $imageResource->save($path, 100);

        $url = Upload::getUrlFromPath($path);
        return Response::json(array(
            'success' => true,
            'url' => $url,
            'image' => url($url),
        ));
    }

    protected function loadFoto($path = '')
    {
        $image = ($path) ? $path : Input::get('image');
        if(!$image) {
            throw new Exception('Imagem não encontrada', 500);
        }
        $imageResource = Image::make($image);
        if(!$imageResource) {
            throw new Exception('Erro ao abrir imagem', 500);
        }

        return $imageResource;
    }

    /**
     * Atualiza o saldo de gols do time e departamento durante a
     *     atualização ou remoção do artilheiro
     * @param  Artilheiro $artilheiro
     * @param  Time $newTime
     * @return null|void
     */
    public function updateGols($artilheiro, $newTime = null)
    {
        // se o artilheiro não tiver time e nem for passado um novo time retorna
        if (!$artilheiro->time && !$newTime) {
            return;
        }

        // se o artilheiro não tiver gols retorna
        $gols = $artilheiro->gols->gols;
        if ($gols == 0) {
            return;
        }

        // se o artilheiro tiver time, remove os gols do time antigo
        if ($artilheiro->time) {
            $golsOldTime = Gol::getGols(null, $artilheiro->time_id);
            if($golsOldTime) {
                $golsOldTime->gols -= $gols;
                if($golsOldTime->gols < 0) {
                    $golsOldTime->gols = 0;
                }
                $golsOldTime->save();
            }

            // se o time tiver departamento, remove os gols do departamento
            if ($artilheiro->time->departamento) {
                $golsOldDepartamento = Gol::getGols(null, null, $artilheiro->time->departamento_id);
                if($golsOldDepartamento) {
                    $golsOldDepartamento->gols -= $gols;
                    if($golsOldDepartamento->gols < 0) {
                        $golsOldDepartamento->gols = 0;
                    }
                    $golsOldDepartamento->save();
                }
            }
        }

        // se o novo time não for informado ou o novo tive form o mesmo do anterior retorna
        if (!$newTime || ($artilheiro->time && $artilheiro->time_id == $newTime->id)) {
            return;
        }

        // adiciona os gols do artilheiro ao novo time
        $golsNewTime = Gol::getGols(null, $newTime->id);
        if (!$golsNewTime) {
            $golsNewTime = new Gol(array('time_id' => $newTime->id, 'gols' => 0));
        }
        $golsNewTime->gols += $gols;
        $golsNewTime->save();

        // se o novo departamento for o mesmo do anterior retorna
        if ($artilheiro->time->departamento_id == $newTime->departamento_id) {
            return;
        }

        $golsNewDepartamento = Gol::getGols(null, null, $newTime->departamento_id);
        if (!$golsNewDepartamento) {
            $golsNewDepartamento = new Gol(array('departamento_id' => $newTime->departamento_id, 'gols' => 0));
        }
        $golsNewDepartamento->gols += $gols;
        $golsNewDepartamento->save();
    }

}
