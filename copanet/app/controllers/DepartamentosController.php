<?php

class DepartamentosController extends BaseController
{

    protected $title = 'Departamentos';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('departamentos.index')->with(array(
            'entities' => Departamento::all(),
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
        return View::make('departamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $entity = new Departamento(Input::all());
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $entity = Departamento::find($id);
        if (!$entity) {
            App::abort('Departamento não encontrado', 404);
        }
        return View::make('departamentos.edit')->with('entity', $entity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $entity = Departamento::find($id);
        if (!$entity) {
            return Response::json(array(
                'success' => false,
                'messages' => 'Departamento não encontrado'
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
        $entity = Departamento::find($id);
        if(!$entity) {
            return Response::json(array(
                    'success' => false,
                    'message' => 'Departamento não encontrado',
            ));
        }
        if($entity->times()->count() > 0) {
            return Response::json(array(
                    'success' => false,
                    'message' => 'Departamento não pode ser removido, pois possui times.',
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
        $entity = Departamento::find($id);
        if (!$entity) {
            App::abort('Departamento não encontrado', 404);
        }

        return View::make('gols.form')->with(array(
            'entity' => $entity,
            'route' => array('admin.departamento.gols.save', $entity->id)
        ));
    }

    public function golsSave($id)
    {
        $entity = Departamento::find($id);
        if (!$entity) {
            App::abort('Departamento não encontrado', 404);
        }

        $entity->gols = Input::get('gols', (int) $entity->gols);
        $entity->save();

        return Response::json(array(
            'success' => true
        ));
    }

}
