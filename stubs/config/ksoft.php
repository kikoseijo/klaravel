<?php

/*
|  Klaravel user guide + scaffold generator
|
|  Local URL: http://localhost:8000/klaravel/wiki/scaffold
|  Local Markdown: open vendor/ksoft/klaravel/wiki
|
|  Online Markdown: https://github.com/kikoseijo/klaravel/tree/master/wiki
|  _______________________________________
*/
return [

    'version' => '2.0.28',
    'models_path' => 'Models/', // defaults "Models/...."
    'backend_dashboard_route_name' => '',
    'klaravel_enabled' => true, // klaravel section route('kLara.index') + route('kLara.wiki')
    'klaravel_visible_for' => [], // show menu only to users id`s (all by default)
    'klaravel_route_name' => 'klaravel',
    'klaravel_middleware' => ['web','auth'],
    'show_integration_hints' => true, // points to wiki links.
    'enable_plugins_menu' => false, // TODO: find a way to install plugins from UI.

    /*
     |  Header menu customization
     |
     |  url: /klaravel/wiki/layouts for documentation
     |  Markdown: vendor/ksoft/klaravel/wiki/layouts-header.md
     |
     |  kLaravel menus structure 'route.name' => 'Menu title'
     |      Laravel: ->name('route.name')
     |      Lumen: ['as' => 'route.name', 'use' => 'Controller@method']
     |  _______________________________________
     */
    'menu_settings_config_location' => 'kapp.settings',
    'menu_admin_config_location' => 'ksoft.admin_menu',
    'admin_menu' => [
        'kLara.index' => 'Dev. Dashboard',
        'kLara.wiki' => 'Scaffold',
        // 'ksoft.plugins.index' => 'Plugins'
    ],

    /**
     * Swagger Builder configuration
     * DEPRECATED---> in favor of GraphQL
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
    // Styles for base crud layouts.
    'style' => [
        'crud_container_wrapper' => 'container -body-block pb-5',
        'table_style' => 'table table-hover table-striped table-bordered table-sm',
        'thead' => 'thead-dark',
    ],
    // Custom modules configuration
    'module' => [
        'backup' => [ // https://github.com/spatie/laravel-backup route('kBackup.index')
            'enabled' => true,
            'route_name' => 'backup',
            // 'can_see_full_backups' => true, // activate only when got paid by client..
            'middleware' => ['web','auth'],
            'extra_arguments' => [
                '--only-db' => 'true',
            ],
        ],
        'activity_log' => [ // https://github.com/spatie/laravel-activitylog route('kLogs.index')
            'enabled' => true,
            'route_name' => 'activity-logs',
            'middleware' => ['web','auth'],
        ],
        'sessions' => [ // Laravel sessions when Database used- route('kSessions.index')
            'enabled' => true,
            'route_name' => 'sessions',
            'middleware' => ['web','auth'],
        ],
        'caches' => [ // Laravel sessions when Database used- route('kCache.index')
            'enabled' => true,
            'route_name' => 'caches',
            'middleware' => ['web','auth'],
        ],
        'crud' => [ // Scaffold generator route('kLara.krud.gen')
            'enabled' => true,
            'header' => 'klaravel::_parts.header', // @includeIf()
            'footer' => 'klaravel::_parts.footer',
            'errors' => 'klaravel::ui.errors',
            'views_base_path' => 'back.', // might need the . at the end.
            'pagination_query_params' => ['q', 'query', 'search'], // append to pagination loop.
            'session_range_from' => 'FROM_DATE', // persisted filter using session.
            'session_range_to' => 'TO_DATE',
            'assets' => [
                'css/app.css', // laravel defaults works, (using Bootstrap4)
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
