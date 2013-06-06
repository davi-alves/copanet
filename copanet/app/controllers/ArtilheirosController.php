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
            'times' => $this->getTimesSelect(),
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

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(!Time::find(Input::get('departamento_id'))) {
            return Response::json(array(
                'success' => false,
                'messages' => 'Departamento não encontrado'
            ));
        }
        $entity = new Time(Input::all());
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
            foreach (Artilheiro::all() as $time) {
                $html .= View::make('artilheiros._partials.table_row')->with('entity', $time);
            }
        } else {
            $departamento = Time::has('times')->find($id);
            if($departamento) {
                foreach ($departamento->times()->get() as $time) {
                    $html .= View::make('artilheiros._partials.table_row')->with('entity', $time);
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
            App::abort('Time não encontrado', 404);
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
        if(!Time::find(Input::get('departamento_id'))) {
            return Response::json(array(
                'success' => false,
                'messages' => 'Departamento não encontrado'
            ));
        }
        $entity = Artilheiro::find($id);
        if (!$entity) {
            return Response::json(array(
                'success' => false,
                'messages' => 'Time não encontrado'
            ));
        }

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
                    'message' => 'Time não encontrado',
            ));
        }

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
    protected function getTimesSelect()
    {
        $times = Time::has('artilheiros')->get();
        $select = array(0 => 'Todos');
        foreach ($times as $time) {
            $select[$time->id] = $time->nome;
        }

        return $select;
    }

}
