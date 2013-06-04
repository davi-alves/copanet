<?php

use Illuminate\Auth\UserInterface;

class User extends Base implements UserInterface
{
    protected $guarded = array();
    protected $hidden = array('password');

    public static $rules = array();

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
}
