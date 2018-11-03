# The Header

This is level 1 of the header component, will allow you to customize header style and responsive classes and icons.

To take full control over the component you should overwrite the file, start by changing the configuration
to a location of your choice, the default parameter its `ksoft.module.krud.header` it defaults to `klaravel::_parts.header`, you can change it to `parts.header` and create following file:

#### Header local customization example (Advanced)

```php
// resources/views/parts/header.blade.php
@php
    // logo click behavior.
    $d_route = config('ksoft.backend_dashboard_route_name');
    $dashboard_url = $d_route != '' ? route($d_route) : url('/').'" target="_blank';

    // Prepare main admin menu
    if ($admin_menu_location = config('ksoft.menu_admin_config_location')) {
        $admin_menu = config($admin_menu_location);

        if (isRoot()) {
            $rootMenuViews = [
                'apps.index'=>'Apps',
                'user.index'=>'Admins',
                'device.index'=>'Devices',
                'page.index'=>'Pages',
            ];

            $admin_menu = is_array($admin_menu) ? array_merge($rootMenuViews, $admin_menu) : $rootMenuViews;
        }
    }

    // Prepare 1 ?? more, icon dropdown menu.
    if ($settings_menu_location = config('ksoft.menu_settings_config_location')) {
        $settings_menu = config($settings_menu_location);
    }

@endphp
<nav class="navbar navbar-expand-sm navbar-dark bg-dark box-shadow larappHead">
  <div class="d-flex justify-content-between container">
    <a href="{!!$dashboard_url!!}" class="my-auto mr-4 brand-margin navbar-brand">
        <img src="{{array_get($site_settings,'icon')}}" class="headerNavLogo" alt="{{ array_get($site_settings,'name') }}" title="{{ array_get($site_settings,'name') }}">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon" />
    </button>
    @component('klaravel::_parts.header_menu', [
        'croute' => Route::currentRouteName(),
        'admin_menu' => $admin_menu ?: [],
        'settings_menu_enabled' => isset($settings_menu) && count($settings_menu)>0,
        'settings_menu' => [
            '<i class="fas fa-cog fa-fw mr-2"></i>' => $settings_menu ?? [],
            '<i class="fas fa-users fa-fw mr-2"></i>' => 'log-viewer::logs.list' ,
        ],
    ])
        // add extra menu item at end of left menu as $slot
        <li class="nav-item">
          <a href="#" class="nav-link mx-3 mt-1">Extra menu</a>
        </li>
    @endcomponent
  </div>
</nav>

@push('scripts')
    <style media="screen">
    .headerNavLogo {
      width: 36px;
      box-shadow: 2px 2px;
      border-radius: 5px;
      /* margin-right: 8px; */
      height: auto;
      vertical-align: middle;
    }
    </style>
@endpush
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
