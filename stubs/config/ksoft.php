<?php

return [
    'runtime_console' => false, // true: enables commands being runned by php.
    'swagger' => [
      'constants' => [  // Dynamic constants implementations.
          'API_HOST' => env('APP_URL', 'http://example.dev'),
      ],
      /**
       * Where and how?
       */
      'docs_route' => '/docs',
      'api_route' => '/api/documentation',
      'json_path' => storage_path('api-docs'), // defautl "Models/"
      'json_name' => 'api-docs.json',
      /**
       * Eventualy will generate crud from all models in a given path.
       * Off right now...
       */
      'models_path' => 'Models/', // defaults "Models/"
      'excluded_models' => [
        'Notification', 'TokenGuard'
      ],
    ],

];
