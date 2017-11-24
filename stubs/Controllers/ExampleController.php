<?php

namespace App\Http\Controllers%subfolder%;

use App\Contracts\Interactions%subfolder%\%model%Create;
use App\Contracts\Interactions%subfolder%\%model%Update;
use App\Contracts\Repositories%subfolder%\%model%Repository;
use App\Http\Controllers\Controller;
use Ksoft\Klaravel\Traits\Krud;

/**
 * Class %model%Controller
 * @package App\Http\Controllers%subfolder%\%model%Controller
 */
class %model%Controller extends Controller
{
    use Krud;

    protected $repo;
    protected $createInteraction;
    protected $updateInteraction;

    /**
     * @param CategoryRepository $repo
     */
    public function __construct(%model%Repository $repo)
    {
        // $this->middleware('auth');
        // $this->middleware('admin');
        // $this->middleware('cors');
        $this->createInteraction = %model%Create::class;
        $this->updateInteraction = %model%Update::class;
        $this->repo = $repo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/%model_name_camel%",
     *      summary="Get a listing of the %model%.",
     *      tags={"%model%"},
     *      description="Get all %model%",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/%modelSingular%")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */

    /**
      * @param Create%model%APIRequest $request
      * @return Response
      *
      * @SWG\Post(
      *      path="/%model_name_camel%",
      *      summary="Store a newly created %model% in storage",
      *      tags={"%model%"},
      *      description="Store %model%",
      *      produces={"application/json"},
      *      @SWG\Parameter(
      *          name="body",
      *          in="body",
      *          description="%model% that should be stored",
      *          required=false,
      *          @SWG\Schema(ref="#/definitions/%modelSingular%")
      *      ),
      *      @SWG\Response(
      *          response=200,
      *          description="successful operation",
      *          @SWG\Schema(
      *              type="object",
      *              @SWG\Property(
      *                  property="success",
      *                  type="boolean"
      *              ),
      *              @SWG\Property(
      *                  property="data",
      *                  ref="#/definitions/%modelSingular%"
      *              ),
      *              @SWG\Property(
      *                  property="message",
      *                  type="string"
      *              )
      *          )
      *      )
      * )
      */

      /**
       * @param int $id
       * @param Update%model%APIRequest $request
       * @return Response
       *
       * @SWG\Put(
       *      path="/%model_name_camel%/{id}",
       *      summary="Update the specified %model% in storage",
       *      tags={"%model%"},
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
       *          @SWG\Schema(ref="#/definitions/%modelSingular%")
       *      ),
       *      @SWG\Response(
       *          response=200,
       *          description="successful operation",
       *          @SWG\Schema(
       *              type="object",
       *              @SWG\Property(
       *                  property="success",
       *                  type="boolean"
       *              ),
       *              @SWG\Property(
       *                  property="data",
       *                  ref="#/definitions/%modelSingular%"
       *              ),
       *              @SWG\Property(
       *                  property="message",
       *                  type="string"
       *              )
       *          )
       *      )
       * )
       */

        /**
        * @param int $id
        * @return Response
        *
        * @SWG\Delete(
        *      path="/%model_name_camel%/{id}",
        *      summary="Remove the specified %model% from storage",
        *      tags={"%model%"},
        *      description="Delete %model%",
        *      produces={"application/json"},
        *      @SWG\Parameter(
        *          name="id",
        *          description="id of %model%",
        *          type="integer",
        *          required=true,
        *          in="path"
        *      ),
        *      @SWG\Response(
        *          response=200,
        *          description="successful operation",
        *          @SWG\Schema(
        *              type="object",
        *              @SWG\Property(
        *                  property="success",
        *                  type="boolean"
        *              ),
        *              @SWG\Property(
        *                  property="data",
        *                  type="string"
        *              ),
        *              @SWG\Property(
        *                  property="message",
        *                  type="string"
        *              )
        *          )
        *      )
        * )
        */
}
