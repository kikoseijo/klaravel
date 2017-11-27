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

/**
 *  @SWG\Definition(definition="listParams",
 *   @SWG\Parameter(parameter="id_in_path", name="id", description="Record's ID", type="integer", required=true,in="path"),
 *   @SWG\Parameter(parameter="sort", name="sort", description="To sort desc need to put the character - before the field.", type="string", required=false, in="query"),
 *   @SWG\Parameter(parameter="columns", name="columns", description="To limit columns", type="string", required=false, in="query"),
 *   @SWG\Parameter(parameter="take", name="take", default="10", description="Number of records per page, 0 will return all records", type="integer", required=false, in="query"),
 *   @SWG\Parameter(parameter="page", name="page", default="1", description="Page number to show.", type="integer", required=false, in="query"),
 *  )
*/

/**
 *  @SWG\Definition(definition="ValidationError",
 *      @SWG\Property(property="field_name", type="array", @SWG\Items(type="string", example="This field its required"))
 *  )
 */

/**
 *   @SWG\Response(
 *      response="ValidationResponse",
 *      description="Validation errors",
 *      @SWG\Schema(
 *        @SWG\Property(property="success", type="boolean", default=false),
 *        @SWG\Property(property="errors", ref="#/definitions/ValidationError"),
 *        @SWG\Property(property="status_code", type="integer", format="int32", example=422)
 *        )
 *    )
 */

 /**
  * @SWG\Response(
  *      response="JsonResponse",
  *      description="Default response",
  *      @SWG\Schema(
  *        @SWG\Property(property="success", type="boolean", default=true),
  *        @SWG\Property(property="data"),
  *        @SWG\Property(property="status_code", type="integer", format="int32", example=200)
  *      )
  * )
 */
