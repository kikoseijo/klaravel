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

if (!function_exists('lumen_resource')) {
    /**
     * Creates a bunch of resource routes which link to the specified controller.
     *
     * @param $app Laravel\Lumen\Application application instance to run the methods on.
     * @param $prefix string the prefix of the application URL.
     * @param $group string the id of the base route
     * @param $controller string the controller class location to use.
     * @param array $list the list of resources to use
     * @param array $except the list of resources not to use
     * @param bool $require_id
     */
    function lumen_resource($app, $prefix, $group, $controller, array $list = [], array $except = [], $require_id = true) {
        $id = $require_id? '{id}': '';
        $available = array(
            'index' => ['get', ''],
            'create' => ['get', 'create'],
            'store' => ['post', ''],
            'show' => ['get', $id],
            'edit' => ['get', $id . (!$require_id? "": "/") . "edit"],
            'update' => ['put', $id],
            'destroy' => ['delete', '{id}']
        );
        if (empty($list)) $list = array_keys($available);
        foreach ($except as &$val) {
            $val = strtolower($val);
        }
        $keys = array_keys($available);
        foreach ($list as $item) {
            $func = null;
            if (is_array($item)) {
                $val =  $item[0];
                $func = $item[1];
                $uri =  $item[2];
            } else {
                $val = strtolower($item);
                if (in_array($val,$keys) && !in_array($val, $except)) {
                    $func = $available[$val][0];
                    $uri = $available[$val][1];
                }
            }
            if (!is_null($func))
                $app->$func("$prefix/$uri", ['as' => "$group.$val", 'uses' => "$controller@$val"]);
        }
    }
}
