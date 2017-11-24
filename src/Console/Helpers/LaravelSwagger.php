<?php namespace Ksoft\Klaravel\Console\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Route;
use Ksoft\Klaravel\Exceptions\DynamicMethodException;
use Laravel\Lumen\Application;
use ReflectionClass;
use Swagger\Analysis;
use Schema;
use Swagger\Annotations\Definition;
use Swagger\Annotations\Property;
use Swagger\Annotations\Swagger;
use Swagger\Context;
use DB;

class LaravelSwagger
{

    /** @var array The list of model classes */
    private $models = [];

    /**
     * LaravelSwagger constructor.
     *
     * @param array $models
     */
    public function __construct ($models = [])
    {
        $this->models = $models;
    }

    /**
     * The handler which is called on process
     *
     * @param Analysis $analysis
     */
    public function __invoke (Analysis $analysis)
    {
        $this->load_models($analysis);
        $this->load_controllers($analysis);
        $this->add_host($analysis);
    }

    /**
     * Adds the Host to the Swagger annotation
     *
     * @param Analysis $analysis
     */
    private function add_host (Analysis $analysis)
    {
        /** @var Swagger[] $annotation */
        $annotation = $analysis->getAnnotationsOfType(Swagger::class);

        if (isset($annotation[0])) {
            $annotation[0]->host = preg_replace("(^https?://)", "", url('/'));
        }
    }

    /**
     * Loads the Controllers into the Swagger JSON
     *
     * @param Analysis $analysis
     */
    private function load_controllers (Analysis $analysis)
    {

        foreach ($this->getRoutes() as $route) {
            //gets the controller
            if (isset($route['action']['uses']) && is_string($route['action']['uses'])) {
                $controller = explode('@', $route['action']['uses']);
                $controller = $controller[0];

                list($methods, $routes, $default_handler) = MethodContainer::loadData($controller, $route['action']);

                $name = isset($route['action']['as']) ? $route['action']['as'] : null;

                //Calculate the direct route first
                $handler = $this->get_route_val($routes, $name, $default_handler);

                if (!is_null($handler)) {
                    $handler->handle($controller, $this);

                    $handler->method()->data('path', $route['uri']);

                    $context = new Context(['class' => $controller]);

                    $analysis->addAnnotation($handler->method()->make($context), $context);
                }
            }
        }
    }

    /**
     * Gets all the routes that are registered
     *
     * @return array
     */
    private function getRoutes ()
    {

        if ($this->isLumen()) {
            /** @var Application $app */
            $app = app();

            return $app->router->getRoutes();

        } else {
            $routes = \Route::getRoutes();

            $array = [];

            /** @var Route $route */
            foreach ($routes as $route) {
                $array[] = [
                    'method' => $route->methods,
                    'uri' => $route->uri,
                    'action' => $route->action
                ];
            }

            return $array;
        }

    }

    /**
     * Checks whether or not the application is Laravel
     *
     * @return bool
     */
    private function isLaravel ()
    {
        return !$this->isLumen();
    }

    /**
     * Checks whether or not the application is Lumen
     *
     * @return bool
     */
    private function isLumen ()
    {
        return class_exists('Laravel\Lumen\Application');
    }

    /**
     * Gets the DynamicMethod for the specific route value.
     *
     * @param DynamicMethod[] $routes
     * @param string $name
     * @param string $handler
     * @return DynamicHandler|null
     * @throws DynamicMethodException
     */
    private function get_route_val ($routes, $name, $handler)
    {

        if (!is_string($name)) return null;

        /**
         * @var string $route
         * @var DynamicMethod|DynamicHandler $dynamic_method
         */
        foreach ($routes as $route => $value) {
            if (preg_match("/" . preg_quote($route, '/') . "$/", $name)) {
                if ($value instanceof DynamicMethod) {
                    return new $handler($value);
                } else if ($value instanceof DynamicHandler) {
                    return $value;
                } else {
                    throw new DynamicMethodException("Invalid Value for $route in $name");
                }
            }
        }

        return null;
    }


    /**
     * Loads the Laravel Models into the Swagger JSON
     *
     * @param Analysis $analysis
     */
    private function load_models (Analysis $analysis)
    {

        foreach ($this->models as $model) {
            /** @var Model $model */
            $obj = new $model();

            if ($obj instanceof Model) { //check to make sure it is a model

                $reflection = new ReflectionClass($obj);
                $with = $reflection->getProperty('with');
                $with->setAccessible(true);

                $list = Schema::getColumnListing($obj->getTable());
                $list = array_diff($list, $obj->getHidden());

                $properties = [];

                foreach ($list as $item) {

                    $data = [
                        'property' => $item,
                        'type' => $this->get_type($obj->getTable(), $item)
                    ];

                    $default = $this->get_default($obj->getTable(), $item);
                    if (!is_null($default)) $data['default'] = $default;

                    $properties[] = new Property($data);
                }

                foreach ($with->getValue($obj) as $item) {
                    $class = get_class($obj->{$item}()->getModel());
                    $properties[] = new Property([
                        'property' => $item,
                        'ref' => '#/definitions/' . $class
                    ]);
                }

                $definition = new Definition([
                    'definition' => $model,
                    'properties' => $properties
                ]);

                $analysis->addAnnotation($definition, new Context(['-', $model]));
            }
        }
    }

    /**
     * Gets the type of the column from the database.
     *
     * @param $table
     * @param $column
     * @return string
     */
    private function get_type ($table, $column)
    {
        return DB::connection()->getDoctrineColumn($table, $column)->getType()->getName();
    }

    /**
     * Gets the default value for a column.
     *
     * @param $table
     * @param $column
     * @return null|string
     */
    private function get_default ($table, $column)
    {
        return DB::connection()->getDoctrineColumn($table, $column)->getDefault();
    }

    /**
     * Gets the models name of the last model.
     *
     * @param $model
     * @return string
     */
    private function getModelName ($model)
    {
        return last(explode("\\", $model));
    }

    /**
     * Checks if the model exists in the array.
     *
     * @param $model
     * @return bool
     */
    public function hasModel ($model)
    {
        return in_array($model, $this->models);
    }
}
