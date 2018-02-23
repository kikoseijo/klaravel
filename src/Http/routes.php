<?php

$router->group(['middleware' => 'web'], function ($router) {
    $router->get('swap-page-limit', 'CrudController@swapPerPage')->name('swap-per-page');
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
