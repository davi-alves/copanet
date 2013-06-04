<?php

namespace Services\Validators;

/**
 * @package Services
 * @subpackage Validators
 */
abstract class Validator
{
    /**
     * Html attributes passed through \Input facade
     * @var array
     */
    protected $attributes;
    /**
     * Errors messages
     * @var array
     */
    public $errors;

    function __construct($attributes = null) {
        $this->attributes = $attributes ?: \Input::all();
    }

    /**
     * Run validation
     * @return bool
     */
    public function passes()
    {
        $validation = \Validator::make($this->attributes, static::$rules);
        if($validation->passes()){
            return true;
        }

        $this->errors = $validation->messages();
        return false;
    }
}
