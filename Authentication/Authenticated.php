<?php

namespace SEVEN_TECH\Gateway\Authentication;

class Authenticated
{
    public $id;
    public $email;
    public $accessToken;
    public $refreshToken;

    public function __construct($id, $email, $accessToken, $refreshToken)
    {
        $this->id = $id;
        $this->email = $email;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function getRefreshToken()
    {
        return $this->refreshToken;
    }
}
