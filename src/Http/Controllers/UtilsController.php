<?php
namespace Ksoft\Klaravel\Http\Controllers;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Ksoft\Klaravel\Models\Cache;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\Str;

class UtilsController extends Controller
{

    public function flushSettings()
    {
        if (auth()->id() == 1) {
            \Settings::clean(['flush' => true]);
        }

        return back()->with('flash_message', 'Settings succesfully flushed.');
    }

    public function listRoutes(Router $router)
    {

        $this->router = $router;
        $this->routes = $router->getRoutes();
        if (count($this->routes) == 0) {
            return back()->with('flash_error', "Your application doesn't have any routes.");
        }
        $routes = $this->getRoutes();
        return view('klaravel::admin.routes', compact('routes'));
    }

    protected function getRoutes()
    {
        $routes = collect($this->routes)->map(function ($route) {
            return $this->getRouteInformation($route);
        })->all();

        return array_filter($routes);
    }

    protected function getRouteInformation(Route $route)
    {
        return $this->filterRoute([
            'host'   => $route->domain(),
            'method' => implode('|', $route->methods()),
            'uri'    => $route->uri(),
            'name'   => $route->getName(),
            'action' => ltrim($route->getActionName(), '\\'),
            'middleware' => $this->getTheMiddleware($route),
        ]);
    }

    protected function getTheMiddleware($route)
    {
        return collect($route->gatherMiddleware())->map(function ($middleware) {
            return $middleware instanceof Closure ? 'Closure' : $middleware;
        })->implode(',');
    }

    protected function filterRoute(array $route)
    {
        $searchKey = request()->get('q');

        if ($searchKey != '' && (Str::contains($route['name'], $searchKey) ||
             Str::contains($route['uri'], $searchKey) ||
             Str::contains($route['method'], strtoupper($searchKey)))) {
            return $route;
        } else {
            if (!$searchKey) {
                return $route;
            }
        }


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
