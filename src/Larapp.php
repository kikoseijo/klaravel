<?php

namespace Ksoft\Klaravel;

class Larapp
{
    use Traits\CallsInteractions,
          Traits\UserModelOptions;

    /**
     * The Klaravel version.
     * Make this yours.. by setting it up on bootstrap.
     * Larapp::$version = '1.2.3';
     */
    public static $version = '0.0.0';


    /**
     * Get a new user model instance.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public static function user()
    {
        return new static::$userModel;
    }

    /**
     * Returns true if app version its Lumen
     *
     * @return boolean
     */
    public static function isLumen()
    {
        return str_contains(app()->version(), 'Lumen');
    }
}
