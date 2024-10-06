<?php

namespace SEVEN_TECH\Gateway\Model\Response;

class ResponseCreateUser {
    public String $id;
    public String $providergivenID;

    public function __construct(String $id, String $providergivenID)
    {
        $this->id = $id;
        $this->providergivenID = $providergivenID;
    }
}