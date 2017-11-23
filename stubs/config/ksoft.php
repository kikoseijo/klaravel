<?php

return [

    'swagger' => [
      'constants' => [
          'API_HOST' => env('APP_URL', 'http://example.dev'),
      ],
      'docs_route' => '/docs',
      'api_route' => '/api/documentation',
      'json_path' => storage_path('api-docs'), // defautl "Models/"
      'json_name' => 'api-docs.json',
      'models_path' => 'Models/', // defautl "Models/"
      'excluded_models' => [
        'Notification', 'TokenGuard'
      ],
    ],

];
