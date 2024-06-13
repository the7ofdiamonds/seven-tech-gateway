<?php

namespace SEVEN_TECH\Gateway\Services\Redis;

use Predis\Client;
use Redislabs\Module\RedisJson\RedisJson;

class RedisSession
{
    public $connection;
    public bool $isReady = false;

    public function __construct()
    {
        $options = ['parameters' => [
            'password' => 'password'
        ]];
        $client = new Client([
            'scheme' => $_ENV['REDIS_SCHEME'],
            'host'   => $_ENV['REDIS_HOST'],
            'port'   => $_ENV['REDIS_PORT'],
        ]);

        $jsonRedis = RedisJson::createWithPredis($client);
        
        if ($client && $client->ping() == "PONG") {
            $client->connect();
            $this->isReady = true;
            $this->connection = $jsonRedis;
        }
    }
}
