<?php

$router->group(['middleware' => 'web'], function ($router) {
    $router->get('swap-page-limit', 'CrudController@swapPerPage')->name('swap-per-page');
});

if (config('klaravel.modules.backup.enabled'))
{
    $backupPath = config('klaravel.modules.backup.route_name', 'backup');
    $backupWare = config('klaravel.modules.backup.middleware');

    $router->group(['middleware' => $backupWare], function ($router) {
        $router->get($backupPath, 'BackupController@index');
        $router->get($backupPath.'/create', 'BackupController@create');
        $router->get($backupPath.'/download/{file_name}', 'BackupController@download');
        $router->get($backupPath.'/delete/{file_name}', 'BackupController@delete');
    });
}

if (config('klaravel.modules.activity_log.enabled'))
{
    $aLogsPath = config('klaravel.modules.activity_log.route_name', 'activity-logs');
    $aLogsWare = config('klaravel.modules.activity_log.middleware');

    $router->group(['middleware' => $aLogsWare], function ($router) {
        $router->get($aLogsPath, 'ActivitylogController@index');
    });
}
