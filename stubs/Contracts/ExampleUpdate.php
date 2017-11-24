<?php

namespace App\Contracts\Interactions%subfolder%;

interface %model%Update
{
    /**
     * Get a validator instance for the given data.
     *
     * @param  int  $id
     * @param  array  $data
     * @return \Illuminate\Validation\Validator
     */
    public function validator($id, array $data);

    /**
     * Update the user's contact information.
     *
     * @param  int $id
     * @param  array  $data
     * @return array
     */
    public function handle($id, array $data);
}
