Install using composer.

```
composer require ksoft/klaravel
```

For version of laravel < 5.5 you will have to enable this package service provider to `config/app.php` file in the service providers section.

```php
Ksoft\Klaravel\ServiceProvider::class,
```


You are ready to go! For a full list of functionalities visit [Wiki Index](https://github.com/kikoseijo/kLaravel/wiki/Wiki-Credits-&-thanks).

### Lumen configuration

If you need all features this package provides you will have to enable the following in your projects `boostrap/app.php` file:

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

You are now ready to go! Go see [Wiki Index](https://github.com/kikoseijo/kLaravel/wiki/Wiki-Credits-&-thanks).

## Initial steps

Start by publishing the configuration file, will allow you to have more control over the functionality.

```
php artisan ksoft:publish
```

Will give you diferent options, just start by choosing option `1` Configuration only.

```bash
Publish config files

 What whould you like to publish? [all]:
  [0] all
  [1] Configuration
  [2] BaseKrudController
 > 1

Publish configuration file: ✔
```
