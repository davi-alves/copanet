<?php

class Gol extends Base
{
    protected $guarded = array();

    public static $rules = array();
    public $timestamps = false;

    /**
     * Get artilheiro's time
     * @return Time
     */
    public function departamento()
    {
        return $this->belongsTo('Departamento');
    }

    /**
     * Get artilheiro's time
     * @return Time
     */
    public function time()
    {
        return $this->belongsTo('Time');
    }

    /**
     * Get artilheiro's time
     * @return Time
     */
    public function artilheiro()
    {
        return $this->belongsTo('Artilheiro');
    }

    /**
     * Get gols by artilheiro/time/departamento
     * @param  int $artilheiro
     * @param  int $time
     * @param  int $departamento
     * @return Gol|null
     */
    public static function getGols($artilheiro = null, $time = null, $departamento = null)
    {
        $instance = new static;
        if (!$artilheiro && !$time && !$departamento) {
            return null;
        }

        return $instance->newQuery()->where('artilheiro_id', $artilheiro)->where('time_id', $time)->where('departamento_id', $departamento)->first();
    }
}
