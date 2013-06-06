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
}
