<?php

return [
    'version' => '2.0.2',
    'models_path' => 'Models/', // defaults "Models/"
    'backend_dashboard_route_name' => '',

    // Klaravel user guide + scaffold
    'klaravel_enabled' => true,
    'klaravel_visible_for' => [], // show menu only to user id`s in this array-
    'klaravel_route_name' => 'klaravel',
    'klaravel_middleware' => ['web','auth'],

    /**
     * Simple way to have key value items using config files as default values
     * But persists on database using https://github.com/oriceon/laravel-settings
     */
    'menu_settings_config_location' => 'klara.settings', // key value settings. (folder in config containing simple)

    /**
     * Main menu in admin panel, must follow the pattern: 'route_name' => 'Menu label'
     */
    'menu_admin_config_location' => 'ksoft.admin_menu', // it defaults to the item bellow
    'admin_menu' => [
        'kLara.index' => 'Scaffold',
        'ksoft.plugins.index' => 'Plugins'
    ],

    /**
     * Swagger Builder configuration
     */
    'swagger' => [
        'enabled' => false,
        'constants' => [ // Dynamic constants implementations.
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
         * TODO: implement this feature.
         */
        'excluded_models' => [
            'Notification', 'TokenGuard',
        ],
    ],

    'style' => [
        'crud_container_wrapper' => 'container -body-block pb-5',
        'table_style' => 'table table-hover table-striped table-bordered table-sm',
        'thead' => 'thead-dark',
    ],

    'module' => [
        'backup' => [ // https://github.com/spatie/laravel-backup
            'enabled' => true,
            'route_name' => 'backup',
            // 'can_see_full_backups' => true, // activate only when got paid by client..
            'middleware' => ['web','auth'],
            'extra_arguments' => [
                '--only-db' => 'true',
            ],
        ],
        'activity_log' => [ // https://github.com/spatie/laravel-activitylog
            'enabled' => true,
            'route_name' => 'activity-logs',
            'middleware' => ['web','auth'],
        ],
        'sessions' => [ // Laravel sessions when stored on Database-
            'enabled' => true,
            'route_name' => 'sessions',
            'middleware' => ['web','auth'],
        ],
        'caches' => [ // Laravel sessions when stored on Database-
            'enabled' => true,
            'route_name' => 'caches',
            'middleware' => ['web','auth'],
        ],
        'crud' => [
            'enabled' => true,
            // @includeIf() views to include from your proyect
            'header' => 'klaravel::_parts.header',
            'footer' => 'klaravel::_parts.footer',
            'errors' => 'klaravel::ui.errors',
            // the "." should be included at the end of the path. as a join the model name "folder"
            'views_base_path' => 'back.',
            // will append this params in pagination links. merge on url.-
            'pagination_query_params' => ['q', 'query', 'search'],
            // special Vue component that will persist using the session.
            'session_range_from' => 'FROM_DATE',
            'session_range_to' => 'TO_DATE',
            'assets' => [
                // 'css/font-awesome.css',
            ]
        ],
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
        'force_rewrite' => false, // got git?... commit.
        'use_contracts' => false, // facades, when enabled uncomment contracts paths bellow.

        /**
         * Paths to save generated CRUD files
         * Will only generate enabled files here, will skype if does not find-
         * TIP: remove what you dont want to be generated.
         *
         **/
        'paths' => [
            'controller' => 'Http/Controllers/',
            // 'contract' => 'Contracts/Repositories/',
            'repo' => 'Repositories/',
            // 'update_contract' => 'Contracts/Interactions/',
            // 'create_contract' => 'Contracts/Interactions/',
            'update_interaction' => 'Interactions/',
            'create_interaction' => 'Interactions/',
        ],

        /**
         * THis option will write the routes to routes/api.php
         * You can override this value from command line using option --R
         */
        'write_routes' => false,
        'upgrade_value' => true, // Only for development.
    ],

];
