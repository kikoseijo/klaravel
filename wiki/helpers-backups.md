# Backups

Backups are integrated into kLaravel thanks to [**Spatie laravel-backup**](https://docs.spatie.be/laravel-backup)

### Publish configuration

```php
php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
```

now you can configure the email where to send notifications when backups are done and also remove unneccesary folders on backups.

```php
'exclude' => [
    base_path('vendor'),
    base_path('node_modules'),
    base_path('tests'),
    base_path('storage/debugbar'),
    base_path('storage/logs'),
    base_path('.git'),
    base_path('.gtm'),
    base_path('storage/app/APPP-NAME-BACKUPS'),
    base_path('Envoy.blade.php'),
    base_path('.ftpconfig'),
    base_path('.env'),
],
```

### Scheduling

```php
// app/Console/Kernel.php

protected function schedule(Schedule $schedule)
{
   $schedule->command('backup:clean')->daily()->at('01:00');
   $schedule->command('backup:run')->daily()->at('02:00');
}
```

### Klaravel

This is a typical setting for a full access to backups module integrated in kLaravel.

```php
// config/ksoft.php
'module' => [
    'backup' => [ // https://github.com/spatie/laravel-backup route('kBackup.index')
        'enabled' => true,
        'route_name' => 'back/backup',
        'can_see_full_backups' => true, // activate only when full access
        'middleware' => ['web','auth', 'role:superadmin'],
        'extra_arguments' => [
            // '--only-db' => 'true',  // comment this line to allow file backups.
        ],
    ],
```
