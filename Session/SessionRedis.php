<?php

namespace SEVEN_TECH\Gateway\Session;

use Predis\Client;
use SEVEN_TECH\Gateway\Authentication\Authenticated;

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
    }

    function createSession($ip, $userAgent, Authenticated $authenticated)
    {
        $session = array(
            'algorithm' => '',
            'expiration' => time() + DAY_IN_SECONDS,
            'ip' => $ip,
            'ua' => $userAgent,
            'login' => time(),
            'access_token' => $authenticated->access_token,
            'refresh_token' => $authenticated->refresh_token,
            'username' => $authenticated->username,
            // 'authorities' => $authenticated->roles
        );
        $this->redisConnection->hmset($authenticated->refresh_token, $session);
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

    function updateSession()
    {
    }

    function deleteById()
    {
    }
}
