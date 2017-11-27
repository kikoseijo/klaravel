<?php

namespace Ksoft\Klaravel\Traits;
use Ksoft\Klaravel\Utils\JsonResponse;
/**
 * Trait ResponsesTrait.
 */
trait LumenResponsesTrait
{

    protected function successResponse($data)
    {
        return response()->json(
          (new JsonResponse($data))->toArray(),
          200
        );
    }

    protected function createdResponse($data)
    {
        return response()->json(
          (new JsonResponse($data, 201))->toArray(),
          201
        );
    }

    protected function notFoundResponse()
    {
        return response()->json(
          (new JsonResponse('Resource Not Found', 201))->toArray(),
          201
        );
    }

    protected function deletedResponse()
    {
        return response()->json(
          (new JsonResponse('Resource deleted succesfully', 204))->toArray(),
          204
        );
    }

    protected function clientErrorResponse($data)
    {
        return response()->json(
          (new JsonResponse($data, 422))->toArray(),
          422
        );
    }
}
