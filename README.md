
This package provide several commands that will help you develop a large maintainable
structure from your Laravel + Lumen projects.  

For a better understanting of the posibilities of this package i recomend you to
visit the [Wiki](https://github.com/kikoseijo/kLaravel/wiki/Wiki-Credits-&-thanks), there you will find all posible components.

## Install instructions

```
composer require ksoft/klaravel
```

For version of laravel below 5.5 you might have to enable the service provider on your `app.php` file.

```php
Ksoft\Klaravel\ServiceProvider::class,
```


You are now ready to go! Go see [Wiki Index](https://github.com/kikoseijo/kLaravel/wiki/Wiki-Credits-&-thanks).

### Lumen configuration

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

Should start by publishing the configuration file, otherwise will be harder to setup your own settings.

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

Continue visiting the Wiki to find more information about posibilities this package will give you [Wiki Index](https://github.com/kikoseijo/kLaravel/wiki).


## Thanks

Some packages serve for inspiration, others take off time on development, to all of them: a big thank you!

[Kevupton Ethereal](https://github.com/kevupton/ethereal) for extending model functionality and inteligence.  
[Laravel Swagger](https://github.com/kevupton/laravel-swagger) excellent dynamic Swagger generation system.  
[OzanKurt Repoist](https://github.com/OzanKurt/Repoist) Clean and extended Models functionality.


## Credits

Special thanks to supporters and clients that provide me with enough time to work on contributing to develop this packages for the WWW.

[DevOps](https://sunnyface.com "Programador ios málaga Marbella") Web development  
[AppDev](https://gestorapp.com "Gestor de aplicaciones moviles en málaga, mijas, marbella") Mobile aplications  
[SocialApp](https://sosvecinos.com "Plataforma móvil para la gestion de comunidades") Residents mobile application  
[KikoSeijo.com](https://kikoseijo.com "Programador freelance movil y Laravel") Freelance senior programmer

---
<div dir=rtl markdown=1>Created by <b>Kiko Seijo</b></div>
