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


/**
 *  this are the params refrences to match the generated in the Controller.
 *  Adjust to your needs once generated.
 */

/*
 *   @SWG\Parameter(parameter="id_in_path", name="id", description="Record's ID", type="integer", required=true,in="path"),
 *   @SWG\Parameter(parameter="sort", name="sort", description="To sort desc need to put the character - before the field.", type="string", required=false, in="query"),
 *   @SWG\Parameter(parameter="columns", name="columns", description="To limit columns", type="string", required=false, in="query"),
 *   @SWG\Parameter(parameter="take", name="take", default="10", description="Number of records per page, 0 will return all records", type="integer", required=false, in="query"),
 *   @SWG\Parameter(parameter="page", name="page", default="1", description="Page number to show.", type="integer", required=false, in="query"),
*/

/**
  *   @SWG\Response(
  *     response="validation_error",
  *     description="Validation error",
  *     @SWG\Schema(ref="#/definitions/ValidationError")
  *    )
 */
