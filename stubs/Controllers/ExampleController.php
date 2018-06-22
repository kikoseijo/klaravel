<?php

namespace App\Http\Controllers%subfolder%;

use App\Contracts\Interactions%subfolder%\%model%Create;
use App\Contracts\Interactions%subfolder%\%model%Update;
use App\Contracts\Repositories%subfolder%\%model%Repository;
use App\Http\Controllers\BaseCtrl;

/**
 * Class %model%Controller
 * @package App\Http\Controllers%subfolder%\%model%Controller
 */
class %model%Controller extends BaseCtrl
{
    public function __construct(%model%Repository $repo)
    {
        $this->createInteraction = %model%Create::class;
        $this->updateInteraction = %model%Update::class;

        parent::__construct('%model_name_url%', $repo);
    }

}
