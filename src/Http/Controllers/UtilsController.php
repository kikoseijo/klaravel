<?php
namespace Ksoft\Klaravel\Http\Controllers;

use Ksoft\Klaravel\Models\Cache;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;


class UtilsController extends Controller
{

    public function flushSettings()
    {
        if (auth()->id() == 1) {
            \Settings::clean(['flush' => true]);
        }

        return back()->with('flash_message', 'Settings flushed succesfully');
    }

    public function getScheduleCommands()
    {
        $schedule = app(Schedule::class);

        // $this->registerCommands($schedule);

        $scheduledCommands = collect($schedule->events())
            ->map(function ($event) {
                $expression = CronExpression::factory($event->expression);

                return [
                    'command' => $event->command,
                    'expression' => $event->expression,
                    'next-execution' => $expression->getNextRunDate()
                ];
            });

        return back()->with('flash_message', 'Settings '.$scheduledCommands.' flushed succesfully');
    }



    public function cleanSettings()
    {
        if (auth()->id() == 1) {
            \Settings::clean();
        }
        return back()->with('flash_message', 'Settings cleaned succesfully');
    }


    public function flushCache($key = '')
    {
        cache()->flush($key);
        return back()->with('flash_message', 'Cache <strong>'.$key.'</strong> flushed succesfully');
    }

    public function multiuse()
    {
        auth()->user()->notify(new AdminNotification('Test email subjet.'));

        return back()->with('flash_message', 'Trabajo hecho.');
    }

    public function testBugsnag()
    {
        Bugsnag::notifyException(new RuntimeException("Testing {config('app.url')} error"));

        return back()->with('flash_message', 'Notificación Bugsnag enviada.');
    }
}
