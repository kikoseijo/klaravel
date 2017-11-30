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

Continue visiting the Wiki to find more information about posibilities this package will give you [Wiki Index](https://github.com/kikoseijo/kLaravel/wiki).

### Todo list

- [ ] Generate Model file out of table
- [ ] Generate Swagger annotations from Model
- [ ] Make Laravel Responses Trait version
- [ ] Write wiki for Traits and other important files
- [ ] Help wanted


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
