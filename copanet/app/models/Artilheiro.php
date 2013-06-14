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

    /**
     * Get the artilhero from a departament
     * @param  int $departamento
     * @return [type]               [description]
     */
    public static function getArtilheiroFromDepartamento($departamento)
    {
        $artilhero = DB::table('artilheiros')
            ->select('artilheiros.*')
            ->join('times', 'times.id', '=', 'artilheiros.time_id')
            ->where('times.departamento_id', $departamento)
            ->where('artilheiros.gols', '>', '0')
            ->groupBy('artilheiros.id')
            ->orderBy('artilheiros.gols', 'DESC')
            ->orderBy('artilheiros.nome', 'ASC')->first();

        return $artilhero;
    }
}
