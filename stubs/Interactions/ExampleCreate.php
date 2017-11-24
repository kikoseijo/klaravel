<?php

namespace App\Interactions%subfolder%;

use App\Contracts\Interactions%subfolder%\%model%Create as Contract;
use App\Contracts\Repositories%subfolder%\%model%Repository;
use Illuminate\Support\Facades\Validator;
use Ksoft\Klaravel\Larapp;

class %model%Create implements Contract
{
    /**
     * {@inheritdoc}
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
        ]);
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
