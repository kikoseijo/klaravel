<?php

namespace App\Repositories%subfolder%;

use %model_path%;
use App\Contracts\Repositories%subfolder%\%model%Repository as Contract;
use Kevupton\Ethereal\Repositories\Repository;

class %model%Repository extends Repository implements Contract
{
    public function getClass()
    {
        return %modelSingular%::class;
    }

}
