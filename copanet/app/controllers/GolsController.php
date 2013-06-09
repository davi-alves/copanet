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
        return View::make('gols.create')->with('departamentos', Departamento::has('times')->get());
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

        return View::make('gols.edit')->with('artilheiro', $artilheiro);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function save()
    {
        $this->saveProcedure();
    }

    public function times($id)
    {
        $departamento = Departamento::has('times')->find($id);
        if(!$departamento) {
            return '';
        }
        $times = $departamento->times()->has('artilheiros')->get();

        return View::make('gols._partials.select_options')->with(array('entities' => $times, 'route' => 'admin.gol.artilheiros'));
    }

    public function artilheiros($id)
    {
        $time = Time::has('artilheiros')->find($id);
        if(!$time) {
            return '';
        }
        return View::make('gols._partials.select_options')->with(array('entities' => $time->artilheiros, 'route' => 'admin.gol.total'));
    }

    public function gols($id)
    {
        $gols = Gol::getGols($id);
        $totalGols = ($gols) ? $gols->gols : 0;

        return $totalGols;
    }

    protected function saveProcedure($artilheiro = 0)
    {
        $gols = Input::get('gols', 0);

        $artilheiro = $artilheiro ? $artilheiro : Input::get('artilheiro_id');
        $golsArtilheiro = Gol::getGols($artilheiro);
        if(!$golsArtilheiro) {
            $golsArtilheiro = new Gol(array('artilheiro_id' => $artilheiro, 'gols' => 0));
        }
        $golsArtilheiro->gols += $gols;
        if($golsArtilheiro->gols < 0) {
            $golsArtilheiro->gols = 0;
        }
        $golsArtilheiro->save();

        $golsTime = Gol::getGols(null, $golsArtilheiro->artilheiro->time->id);
        if(!$golsTime) {
            $golsTime = new Gol(array('time_id' => $golsArtilheiro->artilheiro->time->id, 'gols' => 0));
        }
        $golsTime->gols += $gols;
        if($golsTime->gols < 0) {
            $golsTime->gols = 0;
        }
        $golsTime->save();

        $golsDepartamento = Gol::getGols(null, null, $golsTime->time->departamento->id);
        if(!$golsDepartamento) {
            $golsDepartamento = new Gol(array('departamento_id' => $golsTime->time->departamento->id, 'gols' => 0));
        }
        $golsDepartamento->gols += $gols;
        if($golsDepartamento->gols < 0) {
            $golsDepartamento->gols = 0;
        }
        $golsDepartamento->save();
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
