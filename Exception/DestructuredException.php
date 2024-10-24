<?php

namespace SEVEN_TECH\Gateway\Exception;

use SEVEN_TECH\Communications\Exception\DestructuredException as CommunicationsException;

use Exception;
use WP_Error;
use TypeError;

class DestructuredException extends Exception
{
    private $exception;

    public function __construct(Exception | WP_Error | TypeError | CommunicationsException $e)
    {
        $this->exception = $e;
    }

    function getErrorMessage()
    {

        if ($this->exception instanceof DestructuredException) {
            return $this->exception->getErrorMessage();
        }

        if ($this->exception instanceof CommunicationsException) {
            return $this->exception->getErrorMessage();
        }

        return $this->exception->getMessage();
    }

    function getStatusCode()
    {
        
        if ($this->exception instanceof DestructuredException) {
            return $this->exception->getStatusCode();
        }

        if ($this->exception instanceof CommunicationsException) {
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
