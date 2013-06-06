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
}
