<?php

namespace App\Http\Controllers;

use Ksoft\Klaravel\Traits\ResponsesTrait;
use Ksoft\Klaravel\Traits\KrudControllerTrait;

class BaseKrudController extends Controller
{
    use ResponsesTrait, KrudControllerTrait;

    /**
     * @var ModelRespository
     */
    protected $repo;

    /**
     * @var ModelCreateIteracion
     */
    protected $createInteraction;

    /**
     * @var ModelUpdateInteraction
     */
    protected $updateInteraction;

}
