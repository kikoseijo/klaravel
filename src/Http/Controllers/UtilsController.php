<?php
namespace Ksoft\Klaravel\Http\Controllers;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Ksoft\Klaravel\Models\Cache;

class UtilsController extends Controller
{

    public function flushSettings()
    {
        if (auth()->id() == 1) {
            \Settings::clean(['flush' => true]);
        }

        return back()->with('flash_message', 'Settings succesfully flushed.');
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
                    'next-execution' => $expression->getNextRunDate(),
                ];
            });

        return back()->with('flash_message', 'Settings ' . $scheduledCommands . ' succesfully flushed.');
    }

    public function cleanSettings()
    {
        if (auth()->id() == 1) {
            \Settings::clean();
        }
        return back()->with('flash_message', 'Settings succesfully cleared.');
    }

    public function flushCache($key = '')
    {
        cache()->flush($key);
        return back()->with('flash_message', 'Cache <strong>' . $key . '</strong> succesfully flushed.');
    }


    public function testBugsnag()
    {
        Bugsnag::notifyException(new \RuntimeException("Testing {config('app.url')} error"));

        return back()->with('flash_message', 'Bugsnag Error notifiaction succesfully sent.');
    }
}
