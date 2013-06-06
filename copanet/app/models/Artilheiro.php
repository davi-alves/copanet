<?php

class Artilheiro extends Base
{
    protected $fillable = array('nome', 'foto', 'time_id');

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
}
