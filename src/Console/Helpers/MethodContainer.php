<?php namespace Ksoft\Klaravel\Console\Helpers;

use Ksoft\Klaravel\Exceptions\DynamicMethodException;
use Ksoft\Klaravel\Exceptions\MethodContainerException;

abstract class MethodContainer {

    const CONTAINER = "swagger_container";
    const METHODS = 'getSwaggerMethods';
    const ROUTES = 'getSwaggerRoutes';
    const HANDLER = 'getSwaggerHandler';


    /**
     * Gets
     * @return DynamicMethod[]
     */
    public abstract function getSwaggerMethods();

    /**
     * Gets the Routes for the container
     *
     * @return DynamicMethod[]
     */
    public abstract function getSwaggerRoutes();

    /**
     * Gets the default Handler class
     *
     * @return string the Class Name of the DynamicHandler instance
     */
    public abstract function getSwaggerHandler();


    /**
     * Gets the Routes for a particular Controller and Route
     *
     * @param $controller
     * @param array $actions
     * @return DynamicMethod[]
     * @throws MethodContainerException
     */
    public static function getRoutes($controller, $actions = []) {
        $value = self::_get($controller, $actions, self::ROUTES);
        if (is_null($value)) $value = [];
        if (!is_array($value))
            throw new MethodContainerException("Invalid return value for MethodContainer");
        return $value;
    }

    /**
     * Gets the Methods for a particular Controller and Route
     *
     * @param $controller
     * @param array $actions
     * @return DynamicMethod[]
     * @throws MethodContainerException
     */
    public static function getMethods($controller, $actions = []) {
        $value = self::_get($controller, $actions, self::METHODS);
        if (is_null($value)) $value = [];
        if (!is_array($value))
            throw new MethodContainerException("Invalid return value for MethodContainer");
        return $value;
    }

    /**
     * @param $controller
     * @param $actions
     * @return string the DynamicHandler class name
     * @throws MethodContainerException
     */
    private static function getDefaultHandler($controller, $actions)
    {
        $value = self::_get($controller, $actions, self::HANDLER);
        if (is_string($value)) return $value;
        else if (empty($value) || is_null($value)) $value = DynamicHandler::class;
        else throw new MethodContainerException("Invalid Swagger Handler");

        return $value;
    }

    /**
     * Loads all the data into an array
     *
     * @param $controller
     * @param array $actions
     * @return array
     */
    public static function loadData($controller, $actions = []) {
        return  [
            self::getMethods($controller, $actions),
            self::getRoutes($controller, $actions),
            self::getDefaultHandler($controller, $actions)
        ];
    }

    /**
     * Gets the data of a controller.
     *
     * @param $controller
     * @param $actions
     * @param $method
     * @return DynamicMethod[]
     */
    private static function _get($controller, $actions, $method) {
        $cont_name = self::CONTAINER;

        if (isset($actions[$method])) {
            return $actions[$method];
        } else if (isset($actions[$cont_name]) && is_string($actions[$cont_name])) {
            return (new $actions[$cont_name])->$method();
        } else if (isset($controller::$$cont_name) && is_string($controller::$$cont_name)) {
            $class = $controller::$$cont_name;
            return (new $class())->$method();
        } else if (method_exists($controller, $method)) { //check if swagger methods exist on controller
            return $controller::$method();
        }

        return [];
    }

}
