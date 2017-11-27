This pacakage just reads Swagger-php annotations. its a wrapper over that library, but its handy to have it all in a single package.

You don't need commands on production, you can just use on local and upload generated JSON

```php
if ($app->environment() == 'local') {
  $app->register(Ksoft\Klaravel\ServiceProvider::class);
```

### Configuration

set the configuration as per your need, but the default should work well.

```php
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

```

### Json Generation

Run the following command in the console on your project root folder:

```bash
php artisan ksoft:swagger
```

### Errors

If there is any errors will show you on screen, more details on the logs.