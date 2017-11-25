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
    protected $repo;
    protected $createInteraction;
    protected $updateInteraction;

    public static $tag                  = "%model% controller";
    public static $summary              = "This endpoints to serve all %model% related endpoints.";
    public static $responseDefinition   = "#/definitions/Response";

    /**
     * @param CategoryRepository $repo
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

    /**
     * Funs before destroy.
     * DELETE /%model_name_url%/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    protected function beforeDestroy(Request $request, $id) {
       //runs here
    }




}
