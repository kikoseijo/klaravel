<?php

namespace Ksoft\Klaravel\Utils;

/**
 * @SWG\Response(response="JsonResponse"}, description="Basic api response",)
 */
class JsonResponse
{

    /**
     * @SWG\Property();
     * @var array
     */
    private $data = [];


    /**
     * @SWG\Property();
     * @var array
     */
    private $errors = [];


    /**
     * @SWG\Property();
     * @var string
     */
    private $token = null;


    /**
     * @SWG\Property(format="int32");
     * @var int
     */
    private $status_code = 200;


    /**
     * @SWG\Property();
     * @var string
     */
    public $message;

    public function __construct($data = null, $status = null){
        $this->status_code = $status ?? $this->status_code;
        if (!is_null($data)) {
            if (is_array($data)) {
                return $this->addData('record', $data);
            } else {
                $this->data = $data;
                return $this;
            }
        }
    }


    /**
     * Sets the error messages of the json request.
     *
     * @param $key
     * @param null $val
     * @return $this
     */
    public function addError($key, $val = null) {
        if (is_array($key)) {
            $this->errors = array_merge($this->errors, $key);
        } else {
            if (!is_null($val)) {
                $this->errors[$key] = $val;
            } else {
                $this->errors[] = $key;
            }
        }
        return $this;
    }

    /**
     * Sets the status code of the request.
     *
     * @param $code
     * @return $this
     */
    public function setStatusCode($code) {
        $this->status_code = $code;
        return $this;
    }

    /**
     * Gets the status code of the request.
     *
     * @return int
     */
    public function getStatusCode() {
        return $this->status_code;
    }

    /**
     * Adds data to the existing json request.
     *
     * @param $key
     * @param null $val
     * @param bool $use_null
     * @return $this
     */
    public function addData($key, $val = null, $use_null = false) {
        if (is_array($key)) {
            $this->data = array_merge($this->data, $key);
        } else {
            if (!is_null($val) || $use_null) {
                $this->data[$key] = $val;
            } else {
                $this->data[] = $key;
            }
        }
        return $this;
    }

    /**
     * Removes an error from the error list.
     *
     * @param $key
     */
    public function removeError($key) {
        unset($this->errors[$key]);
    }

    /**
     * Removes some data from the json data.
     *
     * @param $key
     */
    public function removeData($key) {
        unset($this->data[$key]);
    }

    /**
     * Returns the JSON encoded array of the object
     *
     * @return string
     */
    public function out() {
        return json_encode($this->toArray());
    }

    /**
     * Converts the object into the readable array.
     *
     * @return array
     */
    public function toArray() {
        $data =  [
            'data' => $this->data,
            'errors' => $this->errors,
            'message' => config('status_codes.'.$this->status_code),
            'success' => $this->isSuccess(),
            'status_code' => $this->status_code
        ];
        if (!is_null($this->token)) $data['token'] = $this->token;

        return $data;
    }

    /**
     * Returns the object as a JSON encoded string.
     *
     * @return string
     */
    public function __toString() {
        return $this->out();
    }

    /**
     * Checks if the object is successful .
     *
     * @return bool
     */
    public function isSuccess() {
        return count($this->errors) == 0  && $this->status_code < 300;
    }

    /**
     * Checks if the response has errors.
     *
     * @return bool
     */
    public function hasErrors() {
        return count($this->errors) > 0;
    }

    /**
     * Sets the token of the JSON request.
     *
     * @param $token
     */
    public function setToken($token) {
        $this->token = $token;
    }

    public function getToken() {
        return $this->token;
    }
}
