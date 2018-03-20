<?php

namespace Ksoft\Klaravel\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Ksoft\Klaravel\Utils\InstPlugins;

class PluginsController extends Controller
{

    public function index()
    {
        return view('klaravel::admin.plugins', ['plugins' => InstPlugins::$plugins]);
    }

    public function installPlugin($plugin_name)
    {
        $script_name = array_get(InstPlugins::$plugins, $plugin_name);
        if (!$script_name) {
            return back()
                ->with('flash_error', 'Unable to find plugin "' . $plugin_name . '" to install');
        }

        $exitCode = Artisan::call('ksoft:plugin', ['name' => $plugin_name]);

        return redirect(route('ksoft.plugins.index'))->with(
            'flash_message',
            $exitCode . implode("<br />", InstPlugins::$postInstall[$plugin_name])
        );
    }

    public function uninstallPlugin($plugin_name)
    {
        $script_name = array_get(InstPlugins::$plugins, $plugin_name);
        if (!$script_name) {
            return back()
                ->with('flash_error', 'Unable to find plugin "' . $plugin_name . '" to install');
        }
        $deletePack = explode(':', $script_name['composer']);
        $exitCode = exec("cd ../ && composer remove {$deletePack[0]} --no-interaction");
        return back()->with(
            'flash_message', $exitCode . '::: composer remove "' . $deletePack[0] . '"'
        );
    }
}

// 'Unable to find plugin "'.$plugin_name.'" to install'
