<?php

namespace Ksoft\Klaravel\Traits;

use Ksoft\Klaravel\Utils\Json;

trait JsonTrait {
    /** @var  Json */
    protected $response = null;
    protected $status_code = 200;
    public function newJson() {
        return ($this->response = new Json());
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
