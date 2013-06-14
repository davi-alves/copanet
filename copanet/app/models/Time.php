<?php

class Time extends Base
{
    #protected $fillable  = array('id', 'nome', 'departamento_id');
    protected $guarded = array();

    public static $rules = array('nome' => 'required', 'departamento_id' => 'required');
    public $timestamps = false;

    /**
     * Get times's departamento
     * @return Departamento
     */
    public function departamento()
    {
        return $this->belongsTo('Departamento');
    }

    /**
     * Get artilheiros collection
     * @return Collection
     */
    public function artilheiros()
    {
        return $this->hasMany('Artilheiro');
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
     * Get all times from a departamento
     * @param  int $departamento
     * @return array
     */
    public static function getTimesByDepartamento($departamento)
    {
        $times = DB::table('times')
            ->select('times.*')
            ->where('times.departamento_id', $departamento)
            ->orderBy('gols', 'DESC')->get();

        return $times ? $times : array();
    }

    /**
     * Invoked before a model is saved. Return false to abort the operation.
     *
     * @param bool    $forced Indicates whether the model is being saved forcefully
     * @return bool
     */
    protected function beforeSave( $forced = false )
    {
        $slug = $this->_createAlias($this->nome);
        if($slug != $this->slug && Time::where('slug', $slug)->first()) {
            throw new Exception("Time já existe");
        }
        $this->slug = $slug;

        return true;
    }
}
