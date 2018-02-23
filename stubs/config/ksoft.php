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

    'style' => [
        'crud_container_wrapper' => 'container -body-block pb-5',
        'table_style' => 'table table-hover table-striped table-bordered table-sm',
        'thead' => 'thead-dark',
    ],

    'modules' => [
        'backup' => [
            'enabled' => true,
            'route_name' => 'backup',
            'middlewares' => 'web,auth',
            'extra_arguments' => [ // extra arguments for spatie backup.
                '--only-db' => 'true'
            ],
        ],
        'activity_log' => [
            'enabled' => true,
            'route_name' => 'activity-logs',
            'middleware' => 'web,auth',
        ],
        'crud' => [
            'enabled' => true,
            'views_base_path' => 'backoffice',
            'pagination_query_params' => ['q','query','search'], // will append this params in pagination links.
            'session_range_from' => 'FROM_DATE',
            'session_range_to' => 'TO_DATE',
        ]
    ],
    /**
     * This constants are being used to define same session keys you might be using to record
     * certain common structures like remembering limits, queries, etc..
     */
    'CONSTANTS' => [
        'take' => 'PER_PAGE',
    ],

    /**
     * CRUD builder configuration
     *
     */
    'krud' => [
      'force_rewrite' => false, // watch out,, this is a killer....
      'use_contracts' => true, // will add contracts when creating repos and interactions.

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
