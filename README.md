# Pim, Pam, Pum for Laravel + Lumen

 This repo its under heavy development, could change completely tomorrow,
if you like it and want to use for production go ahead and clone it.


`composer require ksoft/klaravel`


Suggestions are welcome, free feedback on return!

## Install

Add service provider to configuration in Laravel to be able to run the commands.

```php
Ksoft\Klaravel\ServiceProvider::class,
```

#### for Lumen

Enable facades, eloquent, configuration handler and service provider.

```php
$app->withFacades();
$app->withEloquent();

$app->configure('ksoft');
...
/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
 */
...
$app->register(Ksoft\Klaravel\ServiceProvider::class);
...


```

## Use it

Publish configuration, and start by generating your crud classes.

```bash
➜  Lumen-boxx-api git:(master) ✗ php artisan ksoft:publish
Publish config files

 What whould you like to publish? [all]:
  [0] all
  [1] Configuration
  [2] BaseKrudController
```
#### Configuration

```php
return [
    'runtime_console' => false, // true: enables commands being runned by php.
    'swagger' => [
      'constants' => [  // Dynamic constants for lumen generation.
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

```


## What this package provides

The main purpose of this package its to generate on the fly several classes inside your projects,
on a clean an easy way will provide by default with full CRUD with Swagger generation on a clever and simple
way.

#### Example:

We are going to create a full CRUD for the models *Role* inside a Subfolder
called *Admin* and route prefix *v1* crud using the console

```bash
$ php artisan make:krud Roles --folder=Admin --prefix=v1
```

We could do it even more dynamic adding this to your route file and visiting `/krud`, because will generate it from an array at once.

```php
// routes/web.php
use Illuminate\Support\Facades\Artisan;

$prefix = 'v1';
$theKruds = [
  'ChatMessages' => 'User',
  'ChatUsers' => 'User',
  'Chats' => 'User',
  'Settings' => 'User',
  'Users' => 'User',
  'PrivateMessages' => 'User',
  'Roles' => 'Admin',
];

Route::get('krud', function () use ($theKruds){
  foreach ($theKruds as $kKey => $kVal){
    echo 'Creating CRUD for ' . kKey . "\n";
    Artisan::call('ksoft:krud', [
      'model' => $kKey, '--folder' => $kVal, '--prefix' => $prefix
    ]);
  }
  echo 'All jobs done done.';
});
```

### What will produce

Will give you following structure from each given model: replacing 'Example' with your model name.

| Functionality | FilePath
| --- | ---
| controller | /controllers/ExampleController.php
| contract | /Contracts/ExampleRepository.php
| repo | /Repositories/ExampleRepository.php
| update_contract | /Contracts/ExampleUpdate.php
| create_contract | /Contracts/ExampleCreate.php
| update_interaction | /Interactions/ExampleUpdate.php
| create_interaction | /Interactions/ExampleCreate.php
```

### Notes

Generating model its on the oven, right now could be done with couple packages, both are disabled right now.

```php
\\ Ksoft\Klaravel\Console\Commands\MakeKrud
protected function setupModelName()
{
    $model           = $this->appNamespace.$this->argument('model');
    $this->model     = str_replace('/', '\\', $model);
    $modelParts      = explode('\\', $this->model);
    $this->modelName = array_pop($modelParts);
    if ($this->force || !class_exists($this->model)) {
        // $this->call('code:models', ['--table' => snake_case($this->modelName)]);
        // $this->call('infyom:model', ['model' => str_singular($this->modelName), '--fromTable' => 'yes']);
    }
}
```


### Classes

```php
use Ksoft\Klaravel\Larapp;
```

### Repositories

```php
use Ksoft\Klaravel\Repositories\EloquentRepo;
```

that extends from `Kevupton\Ethereal\Repositories\Repository`

### Traits

```php
use Ksoft\Klaravel\Traits\Krud;
use Ksoft\Klaravel\Traits\CallsInteractions;
```




***Thanks:***  
[Ethereal](https://github.com/kevupton/ethereal) for providing an excellent implementation on dynamic methods and inteligence.
[Laravel Swagger](https://github.com/kevupton/laravel-swagger) excellent dynamic Swagger generation system.

***Credits:***   
[DevOps](https://sunnyface.com "Programador ios málaga Marbella") Web development  
[AppDev](https://gestorapp.com "Gestor de aplicaciones moviles en málaga, mijas, marbella") Mobile aplications  
[SocialApp](https://sosvecinos.com "Plataforma móvil para la gestion de comunidades") Residents mobile application  
[KikoSeijo.com](https://kikoseijo.com "Programador freelance movil y Laravel") Freelance senior programmer

---
<div dir=rtl markdown=1>***!Happy Days***</div>
