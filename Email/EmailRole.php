<?php

namespace SEVEN_TECH\Gateway\Email;

use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Validator\Validator;

class EmailRole
{
    private $validator;
    private $exists;

    public function __construct()
    {
        $this->validator = new Validator;
        $this->exists = new DatabaseExists;
    }

    function roleAdded(){}

    function roleRemoved(){}
}
