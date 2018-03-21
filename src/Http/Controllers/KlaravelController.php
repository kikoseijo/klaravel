<?php
namespace Ksoft\Klaravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class KlaravelController extends Controller
{

    public function index()
    {
        return view('klaravel::_kLara.dashboard');
    }

    public function menues()
    {
        return view('klaravel::_kLara.comming-soon');
    }

    public function wiki($section='scaffold')
    {
        return view('klaravel::_kLara.wiki', compact('section'));
    }

    public function makeKrud(Request $request)
    {
        if (!$request->filled('model_name')) {

            return back()
                ->with(
                    'flash_error',
                    'Error, required field model not provided'
                )
                ->withInput();
        }

        // if ($request->filled('publish_base_krud') && $request->publish_base_krud == 'yes' ) {
        //     Artisan::call('ksoft:publish', ['--base-krud' => 'true']);
        // }

        $params = [
            'model' => $request->model_name,
        ];

        if ($request->filled('base_path')) {
            $params['--folder'] = $request->base_path;
        }

        Artisan::call('ksoft:krud', $params);

        return back()->with('flash_message', 'Congrats, Krud generated with no errors.');
    }

    public function publishConfig(Request $request)
    {
        if ($request->file == 'table') { // --force
            if ($request->table=='session') {
                $route = route('kSessions.index');
            } elseif ($request->table=='cache') {
                $route = route('kCache.index');
            } else {
                return back()->with('flash_error', 'Sorry wrong parameters.');
            }

            Artisan::call($request->table.':table');
            Artisan::call('migrate');

            return redirect($route)->with(
                'flash_message',
                'Database table created succesfully, update your settings to make sure tables being used.'
            );

        } elseif ($request->file == 'settings') {
            Artisan::call('vendor:publish', [
                '--provider' => 'Oriceon\Settings\SettingsServiceProvider',
                '--tag' => 'migrations'
            ]);
            Artisan::call('migrate');
        } elseif ($request->file == 'formers') {
            Artisan::call('vendor:publish', [
                '--provider' => 'Former\FormerServiceProvider',
            ]);
        } elseif ($request->file == 'activity_log') {
            // php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="migrations"
            Artisan::call('vendor:publish', [
                '--provider' => 'Spatie\Activitylog\ActivitylogServiceProvider',
                '--tag' => 'migrations'
            ]);
            Artisan::call('migrate');
            return redirect( route('kLogs.index'))->with(
                'flash_message',
                'Activity log table created succesfully, update your settings'
            );
        } elseif ($request->file == 'config') {
            Artisan::call('ksoft:publish', ['--config' => 'true']);
        } elseif ($request->file == 'base_controller') {
            Artisan::call('ksoft:publish', ['--base-krud' => 'true']);
        }

        return back()->with(
            'flash_message',
            '<strong>Congrats</strong>, File published succesfully.'
        );
    }

}
