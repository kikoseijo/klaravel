<?php

namespace Ksoft\Klaravel;

/**
* Larapp is an static class for providing calls interactions
*
* you can use calls to functions and have a app version to call
*
* Examples usages:
*
* // if no '@callHandler' defaults to '@handle'
* Larapp::interact(CustomRepository::class.'@callHandler',[$params]);
*
* // will call '@validator' and return '@handle'
* Larapp::interaction(CustomRepository::class,[$params]);
*
* // App version
* Larapp::$version = '1.2.3';
* echo Larapp::$version
*
*
* @package  Ksoft\Klaravel
* @author   Kiko Seijo <kiko@sunnyface.com>
* @version  $Revision: 1.3 $
* @access   public
* @see      https://github.com/kikoseijo/klaravel/blob/master/src/Larapp.php
*/
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
