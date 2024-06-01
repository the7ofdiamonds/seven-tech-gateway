<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Session\Session;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Auth;

class AuthenticationLogout
{
    private $token;
private $auth;

    public function __construct(Token $token, Auth $auth)
    {
        $this->token = $token;
        $this->auth = $auth;
    }

    public function logout(WP_REST_Request $request)
    {
        try {
            (new Validator)->isValidEmail($request['email']);

            $refreshToken = $this->token->getRefreshToken($request);
            $verifier = (new Session)->hash_token($refreshToken);

            $session_destroyed = (new Session)->destroy_session($request['id'], $verifier);

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

            $accessToken = $this->token->getAccessToken($request);
            $uid = $accessToken->claims()->get('sub');

            $this->auth->revokeRefreshTokens($uid);
            
            wp_logout();

            if (is_user_logged_in()) {
                throw new Exception('Account could not be logged out.', 400);
            }

            if (!isset($request['id'])) {
                throw new Exception('ID is required to logout all accounts.', 500);
            }

            $session_tokens_deleted = delete_user_meta($request['id'], 'session_tokens');

            if (!$session_tokens_deleted) {
                throw new Exception('There was an error deleting sessions.', 500);
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
