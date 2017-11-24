<?php

namespace App\Contracts\Interactions%subfolder%;

use Illuminate\Http\Request;

interface %model%Create
{
    /**
     * Get a validator instance for the request.
     *
     * @param  array $data
     * @return \Illuminate\Validation\Validator
     */
    public function validator(array $data);

    /**
     * Create a new user instance in the database.
     *
     * @param  array $data
     * @return array
     */
    public function handle(array $data);
}
