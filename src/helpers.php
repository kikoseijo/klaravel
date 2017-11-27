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
            $app->get($path, ['as' => $name.'.index', 'uses' => $controller.'@index']);
        }
        if (!(in_array('show', $exclude))) {
            $app->get($path.'/{id}', ['as' => $name.'.show', 'uses' => $controller.'@show']);
        }
        if (!(in_array('store', $exclude))) {
            $app->post($path, ['as' => $name.'.store', 'uses' => $controller.'@store']);
        }
        if (!(in_array('update', $exclude))) {
            $app->put($path.'/{id}', ['as' => $name.'.update', 'uses' => $controller.'@update']);
        }
        if (!(in_array('destroy', $exclude))) {
            $app->delete($path.'/{id}', ['as' => $name.'.destroy', 'uses' => $controller.'@destroy']);
        }
    }
} else {
    trigger_error('resource function already exists', E_USER_WARNING);
}

if (!function_exists('dbDump')) {

    /**
     * @param $simple
     */
    function dbDump($simple = true)
    {
        if ($simple) {
            \DB::listen(function($sql) {
                var_dump($sql);
            });
        } else {
            \DB::listen(function ($sql, $bindings, $time) {
                var_dump($sql);
                var_dump($bindings);
                var_dump($time);
            });
        }
    }
}


if ( ! function_exists('config_path'))
{
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}

if ( ! function_exists('app_path'))
{
    function app_path($path = '')
    {
        return app()->basePath() . '/app' . ($path ? '/' . $path : $path);
    }
}

if ( ! function_exists('public_path'))
{
    function public_path($path = '')
    {
        return app()->basePath() . '/public' . ($path ? '/' . $path : $path);
    }
}

if ( ! function_exists('logi'))
{
  function logi($data)
  {

      \Log::info(transform_log($data));
  }
}

if ( ! function_exists('loge'))
{
  function loge($data)
  {
      \Log::error(transform_log($data));
  }
}

if ( ! function_exists('logc'))
{
  function logc($data)
  {
      \Log::critical(transform_log($data));
  }
}

if ( ! function_exists('transform_log'))
{
  function transform_log($data)
  {
      if (is_array($data)){
        return json_encode($data);
      } else {
        return $data;
      }
  }
}
