# The Header

This is level 1 of the header component, will allow you to customize header style and responsive classes and icons.

To take full control over the component you should overwrite the file, start by changing the configuration
to a location of your choice, the default parameter its `ksoft.module.krud.header` it defaults to `klaravel::_parts.header`, you can change it to `parts.header` and create following file:

#### Basic implementation

```php
// resources/views/parts/header.blade.php
@php
    // logo click behavior.
    $d_route = config('ksoft.backend_dashboard_route_name');
    $dashboard_url = $d_route != '' ? route($d_route) : url('/').'" target="_blank';

    // Prepare main admin menu
    if ($admin_menu_location = config('ksoft.menu_admin_config_location')) {
        $admin_menu = config($admin_menu_location);
    }

    // Prepare 1 or more, icon dropdown menu.
    if ($settings_menu_location = config('ksoft.menu_settings_config_location')) {
        $settings_menu = config($settings_menu_location);
    }

@endphp
<nav class="navbar navbar-expand-sm navbar-dark bg-dark box-shadow">
  <div class="d-flex justify-content-between container">
    <a href="{!!$dashboard_url!!}" class="my-auto mr-4 brand-margin navbar-brand">
      <span>{{ config('app.name', 'Klaravel by Sunnyface.com')}}</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon" />
    </button>
    @include('klaravel::_parts.header_menu', [
        'croute' => Route::currentRouteName(),
        'admin_menu' => $admin_menu ?: [],
        'settings_menu_enabled' => isset($settings_menu) && count($settings_menu)>0,
        'settings_menu' => [
            '<i class="fas fa-cog"></i>' => $settings_menu ?? [],
        ],
    ])
  </div>
</nav>
```

#### Menu from configuration

All menu should be declared using the **ROUTE NAME** as a the key.

```php
return [
    'front' => [
        'front.index' => 'Home',
        'front.listing' => 'Listing',
        'front.featured' => 'Featured',
        'front.contact' => 'Contact',
    ],
    'settings' => [
        'testimonial.index' => 'Manage Google reviews',
        'car-model.index' => 'Manage models',
        'car-make.index' => 'Manage manufacturers',
        'recipient.index' => 'Manage EMAIL recipients',
    ],
    'back' => [
        'form-response.index' => 'Contactos',
        'aviso.index' => 'Avisos',
        'car.index' => 'Vehículos',
        'slider.index' => 'Sliders',
    ],
    'config' => [
        'settings.contact' => 'Contact info',
        'settings.social' => 'Social media urls',
        'settings.forms' => 'Contact form settings',
        'settings.maps' => 'Google maps settings',
    ],
];
```

#### Build route names dynamically

If you need to build your routes dynamically you can do things like this on your route files:

```php
// Configuration settings
Route::post('settings/{config_name}', 'ConfigController@save')->name('settings.save');
foreach (config('app.menu.config') as $configKey => $configValue) {
    $settKey = last(explode('.', $configKey));
    Route::get('settings-edit/'.$settKey.'/', 'ConfigController@index')->name('settings.'.$settKey)->where('key',$settKey);
}
```
