<?php

namespace App\Http\Controllers%subfolder%;

use App\Contracts\Interactions%subfolder%\%model%Create;
use App\Contracts\Interactions%subfolder%\%model%Update;
use App\Contracts\Repositories%subfolder%\%model%Repository;
use App\Http\Controllers\BaseKrudController;
// Additionals
// use Ksoft\Klaravel\Traits\CanUploadMedia;
// use Ksoft\Klaravel\Traits\CanChangeStatuses;


/**
 * Class %model%Controller
 * @package App\Http\Controllers%subfolder%\%model%Controller
 */
class %model%Controller extends BaseKrudController
{
    // use CanUploadMedia, CanChangeStatuses;
    /**
     * Used to change status with a single click in table rows attrs.
     * field => values
     */
    // protected $changeableStatus = [
    //     'active' => 'bool',
    //     'status' => ['State1', 'State2', 'State3'], // enums
    // ];
    /**
     * Enable middleware here or in your routes.
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
        $this->path              = '%model_name_url%';
    }

    /**
     * You already got full workin krud!
     *
     * Add here any extra methods you need or overwrite existings from BaseKrudController.
     *
     * just need write tables and fields.
     */

}


%SwaggerAnnotations%
