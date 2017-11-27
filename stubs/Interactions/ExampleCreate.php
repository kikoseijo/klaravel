<?php

namespace App\Interactions%subfolder%;

use App\Contracts\Interactions%subfolder%\%model%Create as Contract;
use App\Contracts\Repositories%subfolder%\%model%Repository;
use %model_path%;
use Illuminate\Support\Facades\Validator;
use Ksoft\Klaravel\Larapp;

class %model%Create implements Contract
{
    /**
     * {@inheritdoc}
     */
    public function validator(array $data)
    {
        return Validator::make($data, %model%::$rules);
    }

    /**
     * {@inheritdoc}
     */
    public function handle(array $data)
    {
        $data['slug'] = str_slug(array_get($data, 'name'));

        return Larapp::interact(
            %model%Repository::class.'@create',
            [$data]
        );
    }
}
