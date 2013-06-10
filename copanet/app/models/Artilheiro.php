<?php

class Artilheiro extends Base
{
    // protected $fillable = array('nome', 'foto', 'time_id');
    protected $guarded = array();

    public static $rules = array('nome' => 'required');
    public $timestamps = false;

    /**
     * Get artilheiro's time
     * @return Time
     */
    public function time()
    {
        return $this->belongsTo('Time');
    }

    /**
     * Get times collection
     * @return Collection
     */
    public function gols()
    {
        return $this->hasOne('Gol');
    }

    public static function getArtilheiroFromDepartamento($departamento)
    {
        $times = DB::table('artilheiros')
            ->select('artilheiros.*', 'gols.gols')
            ->join('times', 'times.id', '=', 'artilheiros.time_id')
            ->join('gols', 'gols.artilheiro_id', '=', 'artilheiros.id')
            ->where('times.departamento_id', $departamento)
            ->where('gols.gols', '>', '0')
            ->groupBy('artilheiros.id')
            ->orderBy('gols.gols', 'DESC')
            ->orderBy('artilheiros.nome', 'ASC')->first();

        return $times ? $times : array();
    }
}
