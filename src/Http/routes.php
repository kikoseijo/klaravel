<?php

$router->group(['middleware' => 'web'], function ($router) {
    $router->get('swap-page-limit', 'CrudController@swapPerPage')->name('swap-per-page');
});

$router->group(['middleware' => ['web','auth']], function ($router) {
    $router->get('ksoft/plugins', 'PluginsController@index')->name('ksoft.plugins.index');
    $router->get('ksoft/plugin-install/{plugin_name}', 'PluginsController@installPlugin')->name('ksoft.plugins.install');
    $router->get('ksoft/plugin-uninstall/{plugin_name}', 'PluginsController@uninstallPlugin')->name('ksoft.plugins.uninstall');
});

if (config('ksoft.modules.backup.enabled'))
{
    $backupWare = config('ksoft.modules.backup.middleware');
    $router->group(['middleware' => $backupWare], function ($router) {
        $backupPath = config('ksoft.modules.backup.route_name', 'backup');
        $router->get($backupPath, 'BackupController@index')->name('kBackup.index');
        $router->get($backupPath.'/create-db', 'BackupController@dbBackup')->name('kBackup.create_db');
        $router->get($backupPath.'/create-full', 'BackupController@create')->name('kBackup.create_full');
        $router->get($backupPath.'/download/{file_name}', 'BackupController@download');
        $router->get($backupPath.'/delete/{file_name}', 'BackupController@delete');
    });
}

if (config('ksoft.klaravel_enabled'))
{
    $klWare = config('ksoft.klaravel_middleware', ['web', 'auth']);
    $router->group(['middleware' => $klWare], function ($router) {
        $klPath = config('ksoft.klaravel_route_name', 'klaravel');
        // Dashboard
        $router->get($klPath, 'KlaravelController@index')->name('kLara.index');
        // Krud
        $router->get($klPath.'/wiki/{section}', 'KlaravelController@wiki')->name('kLara.wiki');
        $router->post($klPath . '/krud-make', 'KlaravelController@makeKrud')->name('kLara.krud.gen');
        // Menu manager
        $router->get($klPath.'/menu-manager', 'KlaravelController@menues')->name('kLara.menu');
        // Config
        $router->get($klPath . '/publish-config', 'KlaravelController@publishConfig')->name('kLara.config.publish');
        // Utils
        $router->get($klPath . '/settings-clean', 'UtilsController@cleanSettings')->name('kLara.settings.clean');
        $router->get($klPath . '/clean-test-data', 'UtilsController@purgeTests')->name('kLara.purge.tests');
        $router->get($klPath . '/multiuse', 'UtilsController@multiuse')->name('kLara.multiuse');
        $router->get($klPath . '/testBugsnag', 'UtilsController@testBugsnag')->name('kLara.bugsnag.test');
        $router->get($klPath . '/cache-flush', 'UtilsController@flushCache')->name('kLara.cache.flush');
        $router->get($klPath . '/schedule-info', 'UtilsController@getScheduleCommands')->name('kLara.schedule.info');

        // $router->get($klPath.'/create-db', 'BackupController@dbBackup')->name('kBackup.create_db');
        // $router->get($klPath.'/create-full', 'BackupController@create')->name('kBackup.create_full');
        // $router->get($klPath.'/download/{file_name}', 'BackupController@download');
        // $router->get($klPath.'/delete/{file_name}', 'BackupController@delete');

    });

}

if (config('ksoft.modules.activity_log.enabled'))
{
    $aLogsWare = config('ksoft.modules.activity_log.middleware');
    $router->group(['middleware' => $aLogsWare], function ($router) {
        $aLogsPath = config('ksoft.modules.activity_log.route_name', 'activity-logs');
        $router->get($aLogsPath, 'ActivitylogController@index')->name('kLogs.index');
        $router->get($aLogsPath.'/delete/{activity}', 'ActivitylogController@destroy')->name('kLogs.delete');
        $router->post($aLogsPath.'/mass-delete', 'ActivitylogController@massDestroy')->name('kLogs.mass_delete');
    });
}


// Session logs
if (config('ksoft.modules.sessions.enabled'))
{
    $aLogsWare = config('ksoft.modules.sessions.middleware');
    $router->group(['middleware' => $aLogsWare], function ($router) {
        $aLogsPath = config('ksoft.modules.sessions.route_name', 'sessions');
        $router->get($aLogsPath, 'SessionController@index')->name('kSessions.index');
        $router->get($aLogsPath.'/{session}', 'SessionController@delete')->name('kSessions.delete');
    });
}

// Cache logs
if (config('ksoft.modules.caches.enabled'))
{
    $aLogsWare = config('ksoft.modules.caches.middleware');
    $router->group(['middleware' => $aLogsWare], function ($router) {
        $aLogsPath = config('ksoft.modules.caches.route_name', 'cache');
        $router->get($aLogsPath, 'CacheController@index')->name('kCache.index');
        $router->get($aLogsPath.'/{cache}', 'CacheController@delete')->name('kCache.delete');
    });
}
