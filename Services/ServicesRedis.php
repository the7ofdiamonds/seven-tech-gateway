<?php

namespace SEVEN_TECH\Gateway\Services;

use Predis\Client;

class ServicesRedis
{
    public $sessionDBConnection;

    public function __construct()
    {
        $options = ['parameters' => [
            'password' => 'password'
        ]];
        $this->sessionDBConnection = new Client([
            'scheme' => $_ENV['REDIS_SCHEME'],
            'host'   => $_ENV['REDIS_HOST'],
            'port'   => $_ENV['REDIS_PORT'],
        ]);
    }
}
