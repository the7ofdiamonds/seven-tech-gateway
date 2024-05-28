<?php

namespace SEVEN_TECH\Gateway\Exception;

use Exception;
use WP_Error;

class DestructuredException extends Exception
{
    private $exception;

    public function __construct(Exception | WP_Error $e)
    {
        $this->exception = $e;
    }

    function getErrorMessage()
    {
        if ($this->exception instanceof DestructuredException) {
            return $this->exception->getErrorMessage();
        }

        return $this->exception->getMessage();
    }

    function getStatusCode()
    {
        if ($this->exception instanceof DestructuredException) {
            return $this->exception->getStatusCode();
        }

        return $this->exception->getCode();
    }

    public function rest_ensure_response_error()
    {
        $statusCode = $this->getStatusCode();
        $response_data = [
            'errorMessage' => $this->getErrorMessage(),
            'statusCode' => $statusCode
        ];
        $response = rest_ensure_response($response_data);
        $response->set_status($statusCode);

        return $response;
    }
}
