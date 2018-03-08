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
        $router->get($backupPath, 'BackupController@index');
        $router->get($backupPath.'/create', 'BackupController@create');
        $router->get($backupPath.'/download/{file_name}', 'BackupController@download');
        $router->get($backupPath.'/delete/{file_name}', 'BackupController@delete');
    });
}

if (config('ksoft.modules.activity_log.enabled'))
{
    $aLogsWare = config('ksoft.modules.activity_log.middleware');
    $router->group(['middleware' => $aLogsWare], function ($router) {
        $aLogsPath = config('ksoft.modules.activity_log.route_name', 'activity-logs');
        $router->get($aLogsPath, 'ActivitylogController@index');
    });
}


// Session logs
if (config('ksoft.modules.sessions.enabled'))
{
    $aLogsWare = config('ksoft.modules.sessions.middleware');
    $router->group(['middleware' => $aLogsWare], function ($router) {
        $aLogsPath = config('ksoft.modules.sessions.route_name', 'sessions');
        $router->get($aLogsPath, 'SessionController@index')->name('kSessions');
        $router->get($aLogsPath.'/{session}', 'SessionController@delete')->name('kSessions.delete');
    });
}

// Cache logs
if (config('ksoft.modules.caches.enabled'))
{
    $aLogsWare = config('ksoft.modules.caches.middleware');
    $router->group(['middleware' => $aLogsWare], function ($router) {
        $aLogsPath = config('ksoft.modules.caches.route_name', 'cache');
        $router->get($aLogsPath, 'CacheController@index')->name('kCache');
        $router->get($aLogsPath.'/{cache}', 'CacheController@delete')->name('kCache.delete');
    });
}
