# Klaravel - for lazy developers

This library provides you with some key tools to structure Laravel applications, Scaffold CRUD control panels fast.

_Documentation its embedded_ right on your control panel, isn't this cool?

> Not tested with Laravel prior to 5.6 (Should work just fine)

```
composer require ksoft/klaravel
```

Navigate to `[/klaravel](http://localhost:8000/klaravel)`,

enjoy.

![Developer Dashboard](/imgs/v2-dashboard.png?raw=true 'Klaravel Developer dashboard')

##### Laravel version < 5.5 (not recomended)

Enable the service provider in your `config/app.php` file on the providers section.

```php
Ksoft\Klaravel\ServiceProvider::class,
```

Now open http://localhost:8000/klaravel and start building great applications.

##### Lumen configuration

If you need all features this package provides you will have to enable the following on your project `boostrap/app.php` file.

```php
$app->withFacades();
$app->withEloquent();

$app->configure('ksoft');
...
$app->register(Ksoft\Klaravel\ServiceProvider::class);
```

> New 2.0 version not tested in Lumen, report any errors on the issues section.

## Scaffold - C.R.U.D generator

Pim, pam, pum, makes your views, your repository, controller and interactions. _Easy peasy_

![Scaffold - crud generator](/imgs/v2-scaffold.png?raw=true 'Scaffold - crud generator')

## Components

Tired of looking for everyday components, want to save some typings, this are here for you.

![Blade components](/imgs/v2-components.png?raw=true 'Blade components')

## Traits

Them make our life easier. Dont you think?

![Available traits](/imgs/v2-traits.png?raw=true 'Available traits')

## Prebuilt functionalities

Database session, Database cache, Database Logs, Backups ready, all this features are ready to use,
from installation.

![Scaffold Control Panel](/imgs/v2-logs.png?raw=true 'Klaravel Scaffold Control Panel')

## Credits

Special thanks to supporters and clients that provide me with enough time to work on contributing to develop this packages for the WWW.

[DevOps](https://sunnyface.com 'Programador ios málaga Marbella') Web development  
[AppDev](https://gestorapp.com 'Gestor de aplicaciones moviles en málaga, mijas, marbella') Mobile aplications  
[SocialApp](https://sosvecinos.com 'Plataforma móvil para la gestion de comunidades') Residents mobile application  
[KikoSeijo.com](https://kikoseijo.com 'Programador freelance movil y Laravel') Freelance senior programmer

---

<div dir=rtl markdown=1>Created by <b>Kiko Seijo</b></div>
