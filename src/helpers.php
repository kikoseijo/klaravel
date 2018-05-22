<?php

use Carbon\Carbon;
use Jenssegers\Date\Date as JenssDate;
use League\CommonMark\CommonMarkConverter;
use Spatie\Image\Image;
use Illuminate\Support\Facades\Route;

define('SESSION_TIME_LIMIT_CACHE', 'ks_session_limit');

if (!function_exists('normalizeString')) {
    function normalizeString($text, $limit = 0): string
    {
        if (!$text) {
            return '';
        }
        $res = '';
        if ($limit > 0) {
            $res = str_limit($text, $limit);
        } else {
            $res = $text;
        }
        return ucfirst(mb_strtolower($res));
    }
}

if (!function_exists('route_has')) {
    function route_has($route_name, $params, $absolute=true): string
    {
        if (!Route::has($route_name)) {
            return '#mustdefine:route:>>'.$route_name;
        }


        return route($route_name, $params, $absolute);
    }
}

if (!function_exists('get_img_sizes')) {
    function get_img_sizes($image): array
    {
        $res = [0, 0];
        try {
            $spatiImage = Image::load($image);
            $res[0] = $spatiImage->getWidth();
            $res[1] = $spatiImage->getHeight();
        } catch (\Exception $e) {

        }
        return $res;

    }
}

if (!function_exists('number')) {
    function number($number): string
    {
        if (app()->getLocale() == 'es') {
            return number_format(floatval($number), 0, ',', '.');
        } else {
            return number_format(floatval($number), 0, '.', ',');
        }

    }
}

if (!function_exists('do_markdown')) {
    function do_markdown($markdown): string
    {
        $converter = new CommonMarkConverter();
        return '<div class="markdown-wrapper">' . $converter->convertToHtml($markdown) . '</div>';
    }
}

if (!function_exists('model_title')) {
    function model_title($modelName): string
    {
        if (str_contains($modelName, '\\')) {
            $modelName = last(explode('\\', $modelName));
        }
        return title_case(implode(' ', explode('_', snake_case($modelName))));
    }
}

if (!function_exists('pretty_print_array')) {
    function pretty_print_array(array $array_data)
    {
        print("<pre>" . print_r($array_data, true) . "</pre>");
    }
}

if (!function_exists('diff_date_for_humans')) {
    function diff_date_for_humans(Carbon $date): string
    {
        return (new JenssDate($date->timestamp))->ago();
    }
}

if (!function_exists('diff_string_for_humans')) {
    function diff_string_for_humans($stringDate, $format = 'Y-m-d H:i:s'): string
    {
        if (!$stringDate) {
            return '';
        }
        $date = JenssDate::createFromFormat($format, $stringDate);
        return (new JenssDate($date))->ago();
    }
}

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
    trigger_error('resource function already exists', E_USER_WARNING);
}

if (!function_exists('humanReadableSize')) {
    function humanReadableSize($bites): string
    {
        return Spatie\Backup\Helpers\Format::humanReadableSize($bites);
    }
}

if (!function_exists('createFromTimestamp')) {
    function createFromTimestamp($timestamp): string
    {
        return Carbon::createFromTimestamp($timestamp);
    }
}

if (!function_exists('dbDump')) {

    /**
     * @param $simple
     */
    function dbDump($simple = true)
    {
        if ($simple) {
            \DB::listen(function ($sql) {
                logi(json_encode($sql));
            });
        } else {
            \DB::listen(function ($sql, $bindings, $time) {
                logi($sql);
                logi($bindings);
                logi($time);
            });
        }
    }
}

if (!function_exists('config_path')) {
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}

if (!function_exists('app_path')) {
    function app_path($path = '')
    {
        return app()->basePath() . '/app' . ($path ? '/' . $path : $path);
    }
}

if (!function_exists('public_path')) {
    function public_path($path = '')
    {
        return app()->basePath() . '/public' . ($path ? '/' . $path : $path);
    }
}

if (!function_exists('logi')) {
    function logi($data)
    {

        \Log::info(transform_log($data));
    }
}

if (!function_exists('loge')) {
    function loge($data)
    {
        \Log::error(transform_log($data));
    }
}

if (!function_exists('logc')) {
    function logc($data)
    {
        \Log::critical(transform_log($data));
    }
}

if (!function_exists('transform_log')) {
    function transform_log($data)
    {
        if (is_array($data)) {
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
    function lumen_resource($app, $prefix, $group, $controller, array $list = [], array $except = [], $require_id = true)
    {
        $id = $require_id ? '{id}' : '';
        $available = array(
            'index' => ['get', ''],
            'create' => ['get', 'create'],
            'store' => ['post', ''],
            'show' => ['get', $id],
            'edit' => ['get', $id . (!$require_id ? "" : "/") . "edit"],
            'update' => ['put', $id],
            'destroy' => ['delete', '{id}'],
        );
        if (empty($list)) {
            $list = array_keys($available);
        }

        foreach ($except as &$val) {
            $val = strtolower($val);
        }
        $keys = array_keys($available);
        foreach ($list as $item) {
            $func = null;
            if (is_array($item)) {
                $val = $item[0];
                $func = $item[1];
                $uri = $item[2];
            } else {
                $val = strtolower($item);
                if (in_array($val, $keys) && !in_array($val, $except)) {
                    $func = $available[$val][0];
                    $uri = $available[$val][1];
                }
            }
            if (!is_null($func)) {
                $app->$func("$prefix/$uri", ['as' => "$group.$val", 'uses' => "$controller@$val"]);
            }

        }
    }
}
