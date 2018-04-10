<?php
/**
 * REGEX
 * , '(.*?)'\)\->name\('(.*?)'\)
 * , ['as' => '$2', 'uses' => '$1'])
 */

$router->group(['middleware' => 'web'], function ($router) {
    $router->get('swap-page-limit', [
        'as' => 'swap-per-page', 'uses' => 'CrudController@swapPerPage'
    ]);
});


if (config('ksoft.module.backup.enabled'))
{
    $backupWare = config('ksoft.module.backup.middleware');
    $router->group(['middleware' => $backupWare], function ($router) {
        $backupPath = config('ksoft.module.backup.route_name', 'web-backup');
        $router->get($backupPath, ['as' => 'kBackup.index', 'uses' => 'BackupController@index']);
        $router->get($backupPath.'/create-db', ['as' => 'kBackup.create_db', 'uses' => 'BackupController@dbBackup']);
        $router->get($backupPath.'/create-full', ['as' => 'kBackup.create_full', 'uses' => 'BackupController@create']);
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
        $router->get($klPath, ['as' => 'kLara.index', 'uses' => 'KlaravelController@index']);
        // Krud
        $router->get($klPath.'/wiki/{section?}', ['as' => 'kLara.wiki', 'uses' => 'KlaravelController@wiki']);
        $router->post($klPath . '/krud-make', ['as' => 'kLara.krud.gen', 'uses' => 'KlaravelController@makeKrud']);
        // Menu manager
        $router->get($klPath.'/menu-manager', ['as' => 'kLara.menu', 'uses' => 'KlaravelController@menues']);
        // Config
        $router->get($klPath . '/publish', ['as' => 'kLara.publish', 'uses' => 'KlaravelController@publishConfig']);
        // Utils
        $router->get($klPath . '/settings-clean', ['as' => 'kLara.settings.clean', 'uses' => 'UtilsController@cleanSettings']);
        $router->get($klPath . '/clean-test-data', ['as' => 'kLara.purge.tests', 'uses' => 'UtilsController@purgeTests']);
        $router->get($klPath . '/testBugsnag', ['as' => 'kLara.bugsnag.test', 'uses' => 'UtilsController@testBugsnag']);
        $router->get($klPath . '/cache-flush', ['as' => 'kLara.cache.flush', 'uses' => 'UtilsController@flushCache']);
        $router->get($klPath . '/schedule-info', ['as' => 'kLara.schedule.info', 'uses' => 'UtilsController@getScheduleCommands']);
        $router->get($klPath . '/routes', ['as' => 'kLara.routes.index', 'uses' => 'UtilsController@listRoutes']);

        // $router->get($klPath.'/create-db', ['as' => 'kBackup.create_db', 'uses' => 'BackupController@dbBackup']);
        // $router->get($klPath.'/create-full', ['as' => 'kBackup.create_full', 'uses' => 'BackupController@create']);
        // $router->get($klPath.'/download/{file_name}', 'BackupController@download');
        // $router->get($klPath.'/delete/{file_name}', 'BackupController@delete');

        if (config('ksoft.enable_plugins_menu'))
        {
            $router->get($klPath .'/plugins', ['as' => 'ksoft.plugins.index', 'uses' => 'PluginsController@index']);
            $router->get($klPath .'/plugin-install/{plugin_name}', ['as' => 'ksoft.plugins.install', 'uses' => 'PluginsController@installPlugin']);
            $router->get($klPath .'/plugin-uninstall/{plugin_name}', ['as' => 'ksoft.plugins.uninstall', 'uses' => 'PluginsController@uninstallPlugin']);
        }

    });

}

if (config('ksoft.module.activity_log.enabled'))
{
    $aLogsWare = config('ksoft.module.activity_log.middleware');
    $router->group(['middleware' => $aLogsWare], function ($router) {
        $aLogsPath = config('ksoft.module.activity_log.route_name', 'db-activity-logs');
        $router->get($aLogsPath, ['as' => 'kLogs.index', 'uses' => 'ActivitylogController@index']);
        $router->get($aLogsPath.'/delete/{activity}', ['as' => 'kLogs.delete', 'uses' => 'ActivitylogController@destroy']);
        $router->post($aLogsPath.'/mass-delete', ['as' => 'kLogs.mass_delete', 'uses' => 'ActivitylogController@massDestroy']);
    });
}


// Session logs
if (config('ksoft.module.sessions.enabled'))
{
    $aLogsWare = config('ksoft.module.sessions.middleware');
    $router->group(['middleware' => $aLogsWare], function ($router) {
        $aLogsPath = config('ksoft.module.sessions.route_name', 'db-sessions');
        $router->get($aLogsPath, ['as' => 'kSessions.index', 'uses' => 'SessionController@index']);
        $router->get($aLogsPath.'/{session}', ['as' => 'kSessions.delete', 'uses' => 'SessionController@delete']);
    });
}

// Cache logs
if (config('ksoft.module.caches.enabled'))
{
    $aLogsWare = config('ksoft.module.caches.middleware');
    $router->group(['middleware' => $aLogsWare], function ($router) {
        $aLogsPath = config('ksoft.module.caches.route_name', 'db-cache');
        $router->get($aLogsPath, ['as' => 'kCache.index', 'uses' => 'CacheController@index']);
        $router->get($aLogsPath.'/{cache}', ['as' => 'kCache.delete', 'uses' => 'CacheController@delete']);
    });
}
