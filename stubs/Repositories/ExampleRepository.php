<?php

namespace App\Repositories%subfolder%;

use App\Models\%modelSingular%;
use App\Contracts\Repositories%subfolder%\%model%Repository as Contract;
use Kevupton\Ethereal\Repositories\Repository;

class %model%Repository extends Repository implements Contract
{
    public function model()
    {
        return %modelSingular%::class;
    }

    public function withRelationships($paginate = 0, $searchQ = '')
    {
        $query = $this->model; // ->with('relation');

        if ($searchQ != '') {
            $query->where('name', 'LIKE', '%'.$searchQ.'%');
            //$query->orWhere('description', 'LIKE', '%'.$searchQ.'%');
        }

        $query->orderBy('id', 'desc');

        if ($paginate>0) {
            return $query->paginate($paginate);
        } else {
            return $query->get();
        }
    }

}
