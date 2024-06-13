<?php

namespace SEVEN_TECH\Gateway\Services\Redis;

use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

use Predis\Client;
use Redislabs\Module\RedisJson\RedisJson;

class RedisSession
{
    public $connection;
    public bool $isReady = false;

    public function __construct()
    {
        try {
            $options = ['parameters' => [
                'password' => 'password'
            ]];
            $client = new Client([
                'scheme' => $_ENV['REDIS_SCHEME'],
                'host'   => $_ENV['REDIS_HOST'],
                'port'   => $_ENV['REDIS_PORT'],
            ]);

            $redisJson = RedisJson::createWithPredis($client);

            if ($client && $client->ping() == "PONG") {
                $this->isReady = true;
            }

            $this->connection = $redisJson;
            
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
