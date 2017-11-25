<?php

namespace App\Http\Controllers;

use Kevupton\LaravelSwagger\DynamicMethod;

use Swagger\Annotations\Parameter;
use Swagger\Annotations\Response;
use Kevupton\Ethereal\Traits\Controller\JsonTrait;
use Kevupton\Ethereal\Traits\Controller\ResourceTrait;

class BaseKrudController extends Controller
{
    use JsonTrait,
      ResourceTrait;

    //Define the function that returns the dynamic methods
    public static function getSwaggerRoutes()
    {
        return [
            'index' => DynamicMethod::GET([
                'tags'       => ['{{tag}}'],
                'summary'    => '{{summary}}',
                'parameters' => [
                    new Parameter([
                        'in'          => 'query',
                        'name'        => 'page',
                        'description' => 'the page number',
                        'required'    => false,
                        'type'        => 'string',
                    ]),
                ],
                'value'      => new Response([
                    'response'    => 200,
                    'description' => 'test',
                    'ref'         => '{{responseDef}}',
                ]),
            ]),
        ];
    }

    /**
     * Gets the current objects class
     *
     * @return string the Ethereal class name
     */
    function getClass()
    {
        return $this->repo->model();
    }
}
