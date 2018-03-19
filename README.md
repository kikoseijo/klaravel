# Klaravel - developer control panel

This package provides functionalities and structures definitions that are able to speed up your development process up to 80%, by generating out of the box several classes and repositories that allows you implement advanced techniques used in the development process of large projects where maintainability its key.

For a better understanding of the capabilities of this package you should go and
visit the [Wiki](https://github.com/kikoseijo/kLaravel/wiki/Wiki-Credits-&-thanks), where you can find each component specs and examples.

## Install instructions

Install using composer.

```
composer require ksoft/klaravel
```

For version of Laravel prior to 5.5 you will have to enable the service provider in your `config/app.php` file on the providers section.

```php
Ksoft\Klaravel\ServiceProvider::class,
```

Now open http://localhost:8000/klaravel and start building great applications.

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

Visit the embed documentation included in the library by visiting the `/klaravel` url on your application.

## Credits

Special thanks to supporters and clients that provide me with enough time to work on contributing to develop this packages for the WWW.

[DevOps](https://sunnyface.com 'Programador ios málaga Marbella') Web development  
[AppDev](https://gestorapp.com 'Gestor de aplicaciones moviles en málaga, mijas, marbella') Mobile aplications  
[SocialApp](https://sosvecinos.com 'Plataforma móvil para la gestion de comunidades') Residents mobile application  
[KikoSeijo.com](https://kikoseijo.com 'Programador freelance movil y Laravel') Freelance senior programmer

---

<div dir=rtl markdown=1>Created by <b>Kiko Seijo</b></div>
