<?php

namespace Ksoft\Klaravel;

class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return Larapp::class;
    }
}
