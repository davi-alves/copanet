<?php

use Illuminate\Database\Eloquent\Collection;

class Departamento extends Base
{
    protected $fillable = array('nome');

    public static $rules = array('nome' => 'required');
    public $timestamps = false;

    /**
     * Get times collection
     * @return Collection
     */
    public function times()
    {
        return $this->hasMany('Time');
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
     * Invoked before a model is saved. Return false to abort the operation.
     *
     * @param bool    $forced Indicates whether the model is being saved forcefully
     * @return bool
     */
    protected function beforeSave( $forced = false )
    {
        $slug = $this->_createAlias($this->nome);
        if($slug != $this->slug && Departamento::where('slug', $slug)->first()) {
            throw new Exception("Departamento já existe");
        }
        $this->slug = $slug;

        return true;
    }
}
