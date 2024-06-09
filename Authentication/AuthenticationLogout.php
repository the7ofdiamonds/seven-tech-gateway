<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Session\SessionWordpress;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\Token\TokenFirebase;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

use WP_REST_Request;

class AuthenticationLogout
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

            $refreshToken = (new Token)->getRefreshToken($request);
            $verifier = (new Token)->hashToken($refreshToken);

            $session_destroyed = (new SessionWordpress)->deleteSession($request['id'], $verifier);
// delete redis session
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
            
            if (!isset($request['id'])) {
                throw new Exception('ID is required to logout all accounts.', 500);
            }

            $session_tokens_deleted = delete_user_meta($request['id'], 'session_tokens');

            if (!$session_tokens_deleted) {
                throw new Exception('There was an error deleting sessions.', 500);
            }

            $this->tokenFirebase->revokeAllRefreshTokens($request);
// delete redis session

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
