<?php

class GolsController extends BaseController
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function add()
    {
        return View::make('gols.create')->with('departamentos', Departamento::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $artilheiro = Artilheiro::find($id);
        if(!$artilheiro){
            return null;
        }
        $this->saveProcedure($id);

        return View::make('gols.edit')->with(array_merge(
            array(
                'gols' => $artilheiro->gols,
                'artilheiro' => $artilheiro,
            ),
            $this->getSelects()
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function save($id)
    {
        $this->saveProcedure($id);
    }

    public function times($id)
    {
        $departamento = Departamento::find($id);
        if(!$departamento) {
            return '';
        }

        return View::make('gols._partials.select_options')->with('entities', $departamento->times);
    }

    public function artilheiros($id)
    {
        $time = Time::find($id);
        if(!$time) {
            return '';
        }
        return View::make('gols._partials.select_options')->with('entities', $time->artilheiros);
    }

    protected function saveProcedure($id)
    {
        $gols = Input::get('gols', 0);
        $golsArtilheiro = $this->getGols($id);
        if(!$golsArtilheiro) {
            $golsArtilheiro = new Gol(array('artilheiro_id' => $id, 'gols' => 0));
            $golsArtilheiro->save();
        }
        $golsArtilheiro->gols += $gols;
        $golsArtilheiro->save();

        $golsTime = $this->getGols(null, $golsArtilheiro->artilheiro->time->id);
        if(!$golsTime) {
            $golsTime = new Gol(array('time_id' => $golsArtilheiro->artilheiro->time->id, 'gols' => 0));
            $golsTime->save();
        }
        $golsTime->gols += $gols;
        $golsTime->save();

        $golsDepartamento = $this->getGols(null, null, $golsTime->time->departamento->id);
        if(!$golsDepartamento) {
            $golsDepartamento = new Gol(array('departamento_id' => $golsTime->time->departamento->id, 'gols' => 0));
            $golsDepartamento->save();
        }
        $golsDepartamento->gols += $gols;
        $golsDepartamento->save();
    }

    protected function getGols($artilheiro = null, $time = null, $departamento = null)
    {
        return Gol::where('artilheiro_id', $artilheiro)->where('time_id', $time)->where('departamento_id', $departamento)->first();
    }

    protected function getSelects()
    {
        $selects = array();
        $departamentos = Departamento::has('times')->get();
        foreach ($departamentos as $departamento) {
            $selects['departamentos'][$departamento->id] = $departamento->nome;
        }
        $times = Time::has('artilheiros')->get();
        foreach ($times as $time) {
            $selects['times'][$time->id] = $time->nome;
        }
        $artilheiros = Artilheiro::all();
        foreach ($artilheiros as $artilheiro) {
            $selects['artilheiros'][$artilheiro->id] = $artilheiro->nome;
        }

        return $selects;
    }

}
