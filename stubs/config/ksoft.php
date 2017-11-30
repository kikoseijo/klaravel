<?php


return [
    'runtime_console' => true, // true: enables commands being runned by php.
    'models_path' => 'Models/', // defaults "Models/"

    /**
     * Swagger Builder configuration
     */
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

      'excluded_models' => [
        'Notification', 'TokenGuard'
      ],
    ],

    /**
     * CRUD builder configuration
     *
     */
    'krud' => [
      'force_rewrite' => false, // watch out,, this is a killer....
      /**
       * Paths to save generated CRUD files
       * Will only generate enabled files here, will skype if does not find-
       * TIP: remove what you dont want to be generated.
       *
       **/
      'paths' => [
          'controller'         => 'Http/Controllers/',
          'contract'           => 'Contracts/Repositories/',
          'repo'               => 'Repositories/',
          'update_contract'    => 'Contracts/Interactions/',
          'create_contract'    => 'Contracts/Interactions/',
          'update_interaction' => 'Interactions/',
          'create_interaction' => 'Interactions/',
      ],

      /**
       * THis option will write the routes to routes/api.php
       * You can override this value from command line using option --R
       */
      'write_routes' => true,
      'upgrade_value' => true, // Only for development.
    ]

];
