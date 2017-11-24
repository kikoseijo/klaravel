<?php

$route->get(config('ksoft.swagger.docs_route'), [
    'as' => 'swagger.docs',
    'middleware' => config('ksoft.swagger.docs_middleware', []),
    'uses' => 'Http\Controllers\SwaggerLumeController@docs',
]);

$route->get(config('ksoft.swagger.api_route'), [
    'as' => 'swagger.api',
    'middleware' => config('ksoft.swagger.middleware.api', []),
    'uses' => 'Http\Controllers\SwaggerLumeController@api',
]);

$route->get(config('ksoft.swagger.assets').'/{asset}', [
    'as' => 'swagger.asset',
    'middleware' => config('ksoft.swagger.middleware.asset', []),
    'uses' => 'Http\Controllers\SwaggerLumeAssetController@index',
]);
