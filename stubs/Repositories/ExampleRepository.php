<?php

namespace App\Repositories%subfolder%;

use %model_path%;
use Ksoft\Klaravel\Repositories\EloquentRepo;
use Ksoft\Klaravel\Traits\QueryFiltersTrait;

class %model%Repository extends EloquentRepo
{
    // use QueryFiltersTrait; // helpfull methods to search many fields.
    protected $query;
    protected $attrsFilter = ['email'];

    public function model()
    {
        return %modelSingular%::class;
    }

    public function withPagination($perPage, $request)
    {
        $query = $this->model::orderBy('id', 'desc');
        $qTerm = $request->filled('q') ? $request->get('q') : null;

        if ($qTerm) {
            $query->where('name', 'like', '%' . $qTerm . '%');
            foreach ($this->attrsFilter as $key) {
                $query->orWhere($key, 'like', '%' . $qTerm . '%');
            }
        }
        // logi($query->toSql());

        return $query->paginate($perPage);
    }
}
