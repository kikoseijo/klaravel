# Db configuration

Further information can be found here: [https://github.com/oriceon/laravel-settings](https://github.com/oriceon/laravel-settings)

<br />

### Install

```
composer require oriceon/laravel-settings
php artisan vendor:publish --provider="Oriceon\Settings\SettingsServiceProvider" --force
php artisan migrate
```

<br />

This library does a Db copy of the config, and persist user preferences on database with a file cache.

Ill guide you thought a simple `key=>value` implementation, files will be located at `config/kapp/settings`, files inside this folder will be the default for this package and we have to setup in the `config/settings.php` configuration by changing preferences value:

```
'primary_config_file' => 'kapp.settings',
```

Prepare configurarion settings to include new references into the Backend settings menu, ill add this settings inside config/kapp/menu.php.

```
'config' => [
  // 'seo' => 'SEO - Main settins',
  'settings.contact' => 'Contact information',
  'settings.social' => 'Social networks',
  'settings.forms' => 'Contact form',
  'settings.maps' => 'Google maps',
],
```

Update Klravel configuration in config/ksoft.php

```
'menu_settings_config_location' => 'kapp.menu.config',
```

<br />

### Backend routes

```php
Route::post('settings/{config_name}', 'ConfigController@save')->name('settings.save');
foreach (config('kapp.menu.config') as $configKkey => $configVvalue) {
    $settKey = last(explode('.', $configKkey));
    Route::get('settings-edit/'.$settKey.'/', 'ConfigController@index')->name('settings.'.$settKey)->where('key',$settKey);
}
```

<br />

### Controller

```php
namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $config_name = $request->route()->wheres['key'];
        $res = [
            'setting_name' => $config_name,
            'settings' => \Settings::get($config_name)
        ];
        return view('back.settings', $res);
    }

    public function save(Request $request, $config_name)
    {
        \Settings::set($config_name, $request->except(['_token']));

        return back()->with('flash_message', 'Settings saved successfully');
    }
}
```

<br />

### Main Blade file settings.blade.php

```php
@extends('klaravel::layouts.app')

@section('content')
<div class="container">
    @card(['title' => 'Edit configuration - '.$setting_name])

    @isset($settings)

        {!! Former::horizontal_open()
            ->route('settings.save', $setting_name  )
            ->populate($settings)
            ->id('settings-form')
        !!}
            <div class="pt-3">
                    @foreach ($settings as $key => $value)
                        @if (is_array($value))
                            @foreach ($value as $key => $value)
                                @if (is_array($value))
                                    @foreach ($value as $key => $value)
                                        @include('back._parts.settings')
                                    @endforeach
                                @else
                                    @include('back._parts.settings')
                                @endif
                            @endforeach
                        @else
                            @include('back._parts.settings')
                        @endif
                    @endforeach

            </div>

            <div class="text-center py-3">
                <input type="submit" value="Save settings" class="btn-lg btn-primary btn">

            </div>

        {!! Former::close() !!}
    @endisset


    @endcard
</div>
@endsection
```

### back/\_parts/settings.blade.php

```php
@if (strlen($value)>100)
    @include('klaravel::ui.forms.textarea',[
        'name' => $key,
        'label' => title_case($key),
        'rows' => 4
    ])
@else
    {!! Former::text($key) !!}
@endif
```

<br />

### Reference usage

```php
Settings::set('key', 'value');
Settings::set('key1.key2', 'value');


$value = Settings::get('key');
$value = Settings::get('key1.key2');

$value = Settings::get('key', 'Default Value');
```

```php
$values = Settings::getAll();
$values = Settings::getAll($cache = false);

$value = Settings::has('key');
$value = Settings::has('key1.key2');

Settings::forget('key');
Settings::forget('key1.key2');

// Clean and update settings from config file
Settings::clean();
Settings::clean(['flush' => true]);
// Forget all values
Settings::flush();

// Helper
$value = settings('key');
$value = settings('key', 'default value');
```
