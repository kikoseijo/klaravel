<?php

namespace App\Http\Controllers;

use Kevupton\Ethereal\Traits\Controller\JsonTrait;
use Kevupton\Ethereal\Traits\Controller\ResourceTrait;
use Kevupton\LaravelSwagger\DynamicMethod;
use Ksoft\Klaravel\Traits\KrudController;
use Swagger\Annotations\Parameter;
use Swagger\Annotations\Response;

class BaseKrudController extends Controller
{
    use JsonTrait,
        ResourceTrait,
        KrudController;

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
       * Store a newly created genre in storage.
       * POST /genres
       *
       * @param Illuminate\Http\Request $request
       *
       * @return Response
       */
      protected function storeMain(Request $request)
      {
          return $this->interaction($this->createInteraction, [$request->all()]);
      }

      /**
       * Update the specified record in storage.
       * This substitute full logic from Kevupton\Ethereal\Traits\Controller\ResourceTrait
       * PUT/PATCH /genres/{id}
       *
       * @param  int $id
       * @param Illuminate\Http\Request $request
       *
       * @return Response
       */
      protected function updateMain(Request $request, $id)
      {
          return $this->interaction($this->updateInteraction, [$id, $request->all()]);
      }


}
