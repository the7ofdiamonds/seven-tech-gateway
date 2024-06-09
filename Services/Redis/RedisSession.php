<?php

namespace SEVEN_TECH\Gateway\Services\Redis;

use Predis\Client;

class RedisSession
{
    public $connection;

    public function __construct()
    {
        $options = ['parameters' => [
            'password' => 'password'
        ]];
        $this->connection = new Client([
            'scheme' => $_ENV['REDIS_SCHEME'],
            'host'   => $_ENV['REDIS_HOST'],
            'port'   => $_ENV['REDIS_PORT'],
        ]);
    }
}
