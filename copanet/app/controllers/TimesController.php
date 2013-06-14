<?php

class TimesController extends BaseController
{

    protected $title = 'Times';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('times.index')->with(array(
            'entities' => Time::all(),
            'departamentos' => $this->getDepartamentoSelect(true),
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
        return View::make('times.create')->with('departamentos', $this->getDepartamentoSelect());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(!Departamento::find(Input::get('departamento_id'))) {
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
    public function departamento($id)
    {
        $html = '';
        if($id <= 0) {
            foreach (Time::all() as $time) {
                $html .= View::make('times._partials.table_row')->with('entity', $time);
            }
        } else {
            $departamento = Departamento::has('times')->find($id);
            if($departamento) {
                foreach ($departamento->times()->get() as $time) {
                    $html .= View::make('times._partials.table_row')->with('entity', $time);
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
        $entity = Time::find($id);
        if (!$entity) {
            App::abort('Time não encontrado', 404);
        }
        return View::make('times.edit')->with(array('entity' => $entity, 'departamentos' => $this->getDepartamentoSelect()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        if(!Departamento::find(Input::get('departamento_id'))) {
            return Response::json(array(
                'success' => false,
                'messages' => 'Departamento não encontrado'
            ));
        }
        $entity = Time::find($id);
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
        $entity = Time::find($id);
        if(!$entity) {
            return Response::json(array(
                    'success' => false,
                    'message' => 'Time não encontrado',
            ));
        }
        if($entity->artilheiros()->count() > 0) {
            return Response::json(array(
                    'success' => false,
                    'message' => 'Time não pode ser removido, pois possui artilheiros.',
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

    public function gols($id)
    {
        $entity = Time::find($id);
        if (!$entity) {
            App::abort('Time não encontrado', 404);
        }

        return View::make('gols.form')->with(array(
            'entity' => $entity,
            'route' => array('admin.time.gols.save', $entity->id)
        ));
    }

    public function golsSave($id)
    {
        $entity = Time::find($id);
        if (!$entity) {
            App::abort('Time não encontrado', 404);
        }

        $entity->gols = Input::get('gols', (int) $entity->gols);
        $entity->save();

        return Response::json(array(
            'success' => true
        ));
    }

    /**
     * Get departamentos select array
     * @param bool $filtered
     * @return array
     */
    protected function getDepartamentoSelect($filtered = false)
    {
        if (!$filtered) {
            $departamentos = Departamento::all();
        } else {
            $departamentos = Departamento::has('times')->get();
        }
        $select = array(0 => 'Todos');
        foreach ($departamentos as $departamento) {
            $select[$departamento->id] = $departamento->nome;
        }

        return $select;
    }

}
