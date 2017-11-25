<?php

namespace Ksoft\Klaravel\Traits;

use Illuminate\Http\Request;

/**
 * Crud controller functions using interactions
 *
 * Use this trait to handle all APIResource routes and work on Interacions only.
 */
trait KrudController
{
    /**
     * Gets the current objects class
     *
     * @return string the Ethereal class name
     */
    public function getClass()
    {
        // We can retrieve directly from parent class repo.
        return $this->repo->getClass();
    }


    /**
     * Execute the given interaction.
     *
     * This performs the common validate and handle methods for common interactions.
     *
     * @param  string  $interaction
     * @param  array  $parameters
     * @return mixed
     */
    protected function interaction($interaction, array $parameters)
    {
        $this->call($interaction.'@validator', $parameters)->validate();

        return $this->call($interaction, $parameters);
    }


    /**
     * Will call interacion handle function if no other method its defined.
     *
     * @param  string $interaction
     * @param  array  $parameters
     * @return mixed
     */
    protected function call($interaction, array $parameters = [])
    {
        if (!str_contains($interaction, '@')) {
            $interaction = $interaction.'@handle';
        }

        list($class, $method) = explode('@', $interaction);

        $base = class_basename($class);

        return call_user_func_array([app($class), $method], $parameters);
    }
}
