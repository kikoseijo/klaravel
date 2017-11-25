<?php
if (!function_exists('resource')) {
    /**
     * Create a rest resource route
     *
     * @param $path
     * @param $controller
     * @param $name
     * @param array $exclude
     */
    function resource($path, $controller, $name, $exclude = [])
    {
        global $app;
        if (!(in_array('index', $exclude))) {
            $app->get($path, ['as' => $name . '.index', 'uses' => $controller . '@index']);
        }
        if (!(in_array('show', $exclude))) {
            $app->get($path . '/{id}', ['as' => $name . '.show', 'uses' => $controller . '@show']);
        }
        if (!(in_array('store', $exclude))) {
            $app->post($path, ['as' => $name . '.store', 'uses' => $controller . '@store']);
        }
        if (!(in_array('update', $exclude))) {
            $app->put($path . '/{id}', ['as' => $name . '.update', 'uses' => $controller . '@update']);
        }
        if (!(in_array('destroy', $exclude))) {
            $app->delete($path . '/{id}', ['as' => $name . '.destroy', 'uses' => $controller . '@destroy']);
        }
    }
} else {
    trigger_error("resource function already exists", E_USER_WARNING);
}
