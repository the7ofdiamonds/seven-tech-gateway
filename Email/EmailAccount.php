<?php

namespace SEVEN_TECH\Gateway\Email;

use Exception;

use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Validator\Validator;

class EmailAccount
{
    private $validator;
    private $exists;
    private $body;

    public function __construct()
    {
        $this->validator = new Validator;
        $this->exists = new DatabaseExists;
        $this->body = SEVEN_TECH_GATEWAY . 'Templates/TemplatesEmailGatewayLink.php';
    }

    function accountCreated()
    {
    }

    function accountLocked()
    {
    }

    function accountUnlocked()
    {
    }

    function accountDisabled()
    {
    }

    function accountEnabled()
    {
    }

    function accountDeleted()
    {
    }
}
