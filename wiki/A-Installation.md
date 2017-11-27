
Add service provider to configuration in Laravel to be able to run the commands.


```php
Ksoft\Klaravel\ServiceProvider::class,
```

## Lumen

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

```


This package service provider its not necessary on production, there is no need to have call it unless you need any extra functionality that comes with.

Call it only when environment its local

```php
if ($app->environment() == 'local') {
  $app->register(Ksoft\Klaravel\ServiceProvider::class);
```
