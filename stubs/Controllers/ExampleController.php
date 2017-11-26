<?php

namespace App\Http\Controllers%subfolder%;

use App\Contracts\Interactions%subfolder%\%model%Create;
use App\Contracts\Interactions%subfolder%\%model%Update;
use App\Contracts\Repositories%subfolder%\%model%Repository;
use App\Http\Controllers\BaseKrudController;

/**
 * Class %model%Controller
 * @package App\Http\Controllers%subfolder%\%model%Controller
 */
class %model%Controller extends BaseKrudController
{
    /**
     * @param %model%Repository $repo
     */
    public function __construct(%model%Repository $repo)
    {
        // $this->middleware('auth');
        // $this->middleware('admin');
        // $this->middleware('cors');
        $this->createInteraction    = %model%Create::class;
        $this->updateInteraction    = %model%Update::class;
        $this->repo                 = $repo;
    }
}


/**
 * @SWG\Definition(
 *     definition="%model%",
 *     allOf = {
 *          { "$ref": "#/definitions/New%model%" },
 *          { "$ref": "#/definitions/Timestamps" },
 *          { "required": {"id"} }
 *     }
 * )
 * @SWG\Definition(
 *     definition="Detail%model%",
 *     allOf = {
 *          { "$ref": "#/definitions/%model%" },
 *     }
 * )
 */


 /**
  * @SWG\Post(
  *   path="/%model_name_url%",
  *   summary="Create a new %model%",
  *   tags={"%folder%"},
  *   operationId="create",
  *   @SWG\Parameter(
  *   	name="params",
  *   	description="Parameters to pass (in body)",
  *   	@SWG\Schema(ref="#/definitions/New%model%"),
  *   	required=false,
  *   	in="body"
  *   ),
  *   @SWG\Response(response="default", ref="#/definitions/JsonResponse"),
  *   @SWG\Response(
  *     response=422,
  *     description="Validation error",
  *     @SWG\Schema(ref="#/definitions/ValidationError")
  *    )
  * )
  *
  */

  /**
   * @SWG\Get(
   *   path="/%model_name_url%",
   *   summary="List all %model%",
  *   tags={"%folder%"},
   *   operationId="index",
   *   produces={"application/json"},
   *   @SWG\Parameter(name="q", description="Search term", type="string", required=false, in="query"),
   *   @SWG\Parameter(name="page", description="Page number", type="integer", required=false, in="query"),
   *   @SWG\Parameter(name="take", description="Number of records per page", type="integer", required=false, in="query"),
   *   @SWG\Response(response="default", ref="#/definitions/JsonResponse")
   * )
   *
   */

// Detail- GET

   /**
    * @SWG\Get(
    *   path="/%model_name_url%/{id}",
    *   summary="Get a %model% by its ID",
    *   tags={"%folder%"},
    *   operationId="show",
    *   @SWG\Parameter(name="id", description="%model%'s ID", type="integer", required=true,in="path"),
    *   @SWG\Response(response="default", ref="#/definitions/JsonResponse")
    * )
    *
    */


/**
* @param int $id
* @param Request $request
* @return Response
*
* @SWG\Put(
*      path="/%model_name_url%/{id}",
*      summary="Update",
  *   tags={"%folder%"},
*      description="Update %model%",
*      produces={"application/json"},
*      @SWG\Parameter(
*          name="id",
*          description="id of %model%",
*          type="integer",
*          required=true,
*          in="path"
*      ),
*      @SWG\Parameter(
*          name="body",
*          in="body",
*          description="%model% that should be updated",
*          required=false,
*          @SWG\Schema(ref="#/definitions/%model%")
*      ),
 *   @SWG\Response(response="default", ref="#/definitions/JsonResponse")
* )
*/



/**
 * @SWG\Delete(
 *   tags={"%folder%"},
 *   path="/%model_name_url%/{id}",
 *   @SWG\Response(response="default", ref="#/definitions/JsonResponse")
 * )
 */
