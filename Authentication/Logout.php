<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Cookie\Cookie;
use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Services\Redis\RedisSession;
use SEVEN_TECH\Gateway\Session\Session;
use SEVEN_TECH\Gateway\Session\SessionRedis;
use SEVEN_TECH\Gateway\Session\SessionWordpress;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\Token\TokenFirebase;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

use WP_REST_Request;

class Logout
{
    private $tokenFirebase;

    public function __construct()
    {
        $this->tokenFirebase = new TokenFirebase;
    }

    public function logout(WP_REST_Request $request)
    {
        try {
            (new Validator)->isValidEmail($request['email']);

            $token = (new Cookie($_COOKIE))->token;
            $verifier = (new Token)->hashToken($token);

            $session_destroyed = (new Session)->deleteSession($request['id'], $verifier);

            if (!$session_destroyed) {
                throw new Exception('Unable to remove session.');
            }

            wp_logout();

            if (is_user_logged_in()) {
                throw new Exception('Account could not be logged out.', 400);
            }

            (new Authentication($request['email']))->isNotAuthenticated();

            $logoutResponse = [
                'successMessage' => 'You have been logged out',
                'statusCode' => 200
            ];

            return $logoutResponse;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function logoutAll(WP_REST_Request $request)
    {
        try {
            (new DatabaseExists)->existsByEmail($request['email']);

            $this->tokenFirebase->revokeAllRefreshTokens($request);

            if (!isset($request['id'])) {
                throw new Exception('ID is required to logout all accounts.', 500);
            }

            $wordpresSessions = (new SessionWordpress)->getSessions($request['id']);

            if (is_array($wordpresSessions)) {
                $session_tokens_deleted = delete_user_meta($request['id'], 'session_tokens');

                if (!$session_tokens_deleted) {
                    throw new Exception('There was an error deleting sessions.', 500);
                }
            }

            if ((new RedisSession)->isReady) {
                $redisSessions = (new SessionRedis)->getSessions($request['id']);

                if (is_array($redisSessions)) {
                    foreach ($redisSessions as $key => $value) {
                        (new SessionRedis)->deleteSession($key);
                    }
                }
            }

            wp_logout();

            if (is_user_logged_in()) {
                throw new Exception('Account could not be logged out.', 400);
            }

            (new Authentication($request['email']))->isNotAuthenticated();

            $logoutResponse = [
                'successMessage' => 'You have been logged out of all accounts successfully',
                'statusCode' => 200
            ];

            return $logoutResponse;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
