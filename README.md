# Laravel + Lumen - CRUD Generator and more...

This package provides functionalities and structures definitions that are able to speed up your development process up to 80%, by generating out of the box several classes and repositories that allows you implement advanced techniques used in the development process of large projects where maintainability its key.

For a better understanding of the capabilities of this package you should go and
visit the [Wiki](https://github.com/kikoseijo/kLaravel/wiki/Wiki-Credits-&-thanks), where you can find each component specs and examples.

## Install instructions

Install using composer.

```
composer require ksoft/klaravel
```

For version of Laravel < 5.5 you will have to enable the service provider in your `config/app.php` file on the providers section.

```php
Ksoft\Klaravel\ServiceProvider::class,
```

You are ready to go! For a full list of functionalities visit [Wiki Index](https://github.com/kikoseijo/kLaravel/wiki/Wiki-Credits-&-thanks).

### Lumen configuration

If you need all features this package provides you will have to enable the following on your project `boostrap/app.php` file.

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

## Views available (Bootstrap4)

You can make use of any of this views, use the publish command to take full control or simply `@include('klaravel::ui.card-deck-media')` the views and components as you require.

/  
├── admin  
│   ├── activitylog-table.blade.php  
│   ├── activitylog.blade.php  
│   ├── backups-table.blade.php  
│   └── backups.blade.php  
├── crud create your `form.blade.php` & `table.blade.php`, to have it working.  
│   ├── create.blade.php  
│   ├── edit.blade.php  
│   └── index.blade.php  
├── layouts // create a `parts/header.blade.php` & `parts/footer.blade.php`  
│   └── crud.blade.php  
└── ui // laravel components for bootstrap.  
├── card-deck-media.blade.php  
├── card.blade.php  
├── dropdown.blade.php  
├── errors.blade.php  
├── forms // single fields components to reuse.  
│   ├── buttons.blade.php  
│   ├── radios.blade.php  
│   └── textarea.blade.php  
├── menu-nav.blade.php  
├── modal.blade.php  
└── tables // to help you complete your table views.  
├── actions-menu.blade.php // i use it to add filters and search.  
├── actions.blade.php // table buttons (edit + delete) Fontawesome needed.  
├── booble.blade.php // simple on - off / green - red indicator for booleans.  
├── count.blade.php // records found total and currently viewing.  
└── pagination.blade.php // Bootstrap4 pagination renderer, add params to merge on links using config file.

## Traits available

├── ActiveScope.php // on models ->active('active') will return only enabled items.  
├── CallsInteractions.php  
├── HasLogs.php // Ads spatie laravel-logs traits to any model.  
├── JsonTrait.php // for responses-  
├── KrudControllerTrait.php // Its a copy of the published on a clean version for lumen.  
├── LumenResponsesTrait.php // Lumen for Responses-  
├── RepoQueryFiltersTrait.php // Ad it to your repository to have several query methods for more complex filters.  
├── UserModelOptions.php  
└── ValidateInteraction.php

## Traits available

Continue visiting the Wiki to find more information about possibilities this package will give you [Wiki Index](https://github.com/kikoseijo/kLaravel/wiki).

## Credits

Special thanks to supporters and clients that provide me with enough time to work on contributing to develop this packages for the WWW.

[DevOps](https://sunnyface.com 'Programador ios málaga Marbella') Web development  
[AppDev](https://gestorapp.com 'Gestor de aplicaciones moviles en málaga, mijas, marbella') Mobile aplications  
[SocialApp](https://sosvecinos.com 'Plataforma móvil para la gestion de comunidades') Residents mobile application  
[KikoSeijo.com](https://kikoseijo.com 'Programador freelance movil y Laravel') Freelance senior programmer

---

<div dir=rtl markdown=1>Created by <b>Kiko Seijo</b></div>
