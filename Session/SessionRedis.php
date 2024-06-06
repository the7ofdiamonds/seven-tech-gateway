<?php

namespace SEVEN_TECH\Gateway\Session;

use Predis\Client;

class SessionRedis
{
    private $redisConnection;

    public function __construct()
    {
        $options = ['parameters' => [
            'password' => 'password'
        ]];
        $this->redisConnection = new Client([
            'scheme' => $_ENV['REDIS_SCHEME'],
            'host'   => $_ENV['REDIS_HOST'],
            'port'   => $_ENV['REDIS_PORT'],
        ]);

        $this->redisConnection->set(2, 'session');
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
