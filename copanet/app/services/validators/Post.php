<?php

namespace Services\Validators;

/**
 * @package Services
 * @subpackage Validators
 */
class Post extends Validator
{
    public static $rules = array(
        'titulo' => 'required',
        'resenha' => 'required',
    );
}
