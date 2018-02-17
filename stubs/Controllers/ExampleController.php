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

    /**
     * Return the given record by the $id.
     * GET|HEAD /records
     *
     * @param int $id
     * @return Model
     */
    public function show($id)
    {
        return $this->repo->find($id);
    }
}


%SwaggerAnnotations%
