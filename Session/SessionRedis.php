<?php

namespace SEVEN_TECH\Gateway\Session;

use Predis\Client;

class SessionRedis
{
    private $redis;

    public function __construct()
    {
        $this->redis = new Client();
        // get parameters from env file
        error_log(print_r($this->redis, true));
    }

    function findAll()
    {
    }

    function findByAccessToken()
    {
    }

    function findByRefreshToken()
    {
    }

    function findByUsername()
    {
    }

    function findByRevokedTrue()
    {
    }

    function deleteById()
    {
    }
}
