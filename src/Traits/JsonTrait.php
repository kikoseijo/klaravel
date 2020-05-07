<?php

namespace Ksoft\Klaravel\Traits;

use Ksoft\Klaravel\Utils\JsonResponse;

/**
 * @SWG\Definition(required={"status_code"}, type="object")
 */
trait JsonTrait {
    /**
     * @SWG\Property(ref="#/definitions/JsonResponse");
     * @var JsonResponse
     */
    protected $response = null;

    /**
     * @SWG\Property(format="int32");
     * @var int
     */
    protected $status_code = 200;

    public function newJson() {
        return ($this->response = new JsonResponse());
    }

    public function json() {
        return (is_null($this->response))? $this->newJson(): $this->response;
    }

    public function hasErrors() {
        return $this->json()->hasErrors();
    }

    public function isSuccess() {
        return $this->json()->isSuccess();
    }

}
