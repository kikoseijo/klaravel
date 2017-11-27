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

// Copy this model parts to yoru model page.
//  * @SWG\Definition(required={"name"}, definition="New%model%")

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
  *   @SWG\Parameter(ref="#/parameters/New%model%_in_body"),
  *   @SWG\Response(response="default", ref="#/definitions/JsonResponse"),
  *   @SWG\Response(response=422, ref="#/responses/validation_error")
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
*   @SWG\Parameter(ref="#/parameters/sort"),
*   @SWG\Parameter(ref="#/parameters/columns"),
*   @SWG\Parameter(ref="#/parameters/take"),
*   @SWG\Parameter(ref="#/parameters/page"),
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
*   @SWG\Parameter(ref="#/parameters/id_in_path"),
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
*      @SWG\Parameter(#/parameters/id_in_path),
*      @SWG\Parameter(ref="#/parameters/%model%_in_body"),
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

/*
 *   @SWG\Parameter(
 *      parameter="New%model%_in_body"
 *   	name="params",
 *   	description="Parameters to pass (in body)",
 *   	@SWG\Schema(ref="#/definitions/New%model%"),
 *   	required=false,
 *   	in="body"
 *   ),
 */

/*
 *   @SWG\Parameter(
 *      parameter="%model%_in_body"
 *   	name="params",
 *   	description="Parameters to pass (in body)",
 *   	@SWG\Schema(ref="#/definitions/New%model%"),
 *   	required=false,
 *   	in="body"
 *   ),
 */
