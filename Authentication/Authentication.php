<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Session\Session;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Auth;

class Authentication
{
    private $validator;
    private $token;
    private $auth;
    private $session;

    public function __construct(Auth $auth)
    {
        $this->validator = new Validator;
        $this->auth = $auth;
        $this->token = new Token($auth);
        $this->session = new Session;
    }

    function signInWithEmailAndPassword($email, $password)
    {
        try {
            $this->validator->validEmail($email);
            $this->validator->validPassword($password);

            $account = new Account($email);

            $first_two_chars = substr($account->password, 0, 2);

            if ($first_two_chars === '$P') {
                $password_check = wp_check_password($password, $account->password);
            } else {
                $password_check = password_verify($password, $account->password);
            }

            if (!$password_check) {
                throw new Exception('The password you entered for this username is not correct.', 400);
            }

            $signedInUser = $this->auth->signInWithEmailAndPassword($email, $password);

            $user = $this->auth->getUser($signedInUser->data()['localId']);

            return new Authenticated($account, $signedInUser, $user);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function login(WP_REST_Request $request)
    {
        try {
            $authenticatedAccount = '';

            if (isset($request['email']) && isset($request['password'])) {
                $authenticatedAccount = $this->signInWithEmailAndPassword($request['email'], $request['password']);
            } else {
                $authenticatedAccount = $this->token->signInWithRefreshToken($request);
            }

            if ($authenticatedAccount == '') {
                throw new Exception('Access Denied: Either a token or username and password are required to login.', 403);
            }

            // if (isset($request['location'])) {
            //     $location = $request['location'];

            //     error_log(print_r($location, true));
            // }

            wp_set_current_user($authenticatedAccount->id);
            $this->session->createSesssion($authenticatedAccount->id, true, is_ssl(), $authenticatedAccount->refresh_token);

            if (!is_user_logged_in()) {
                throw new Exception('You could not be logged in successfully', 403);
            }

            $loginResponse = [
                'successMessage' => 'You have been logged in successfully',
                'authenticatedAccount' => $authenticatedAccount,
                'statusCode' => 200
            ];

            return $loginResponse;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function verifyCredentials(WP_REST_Request $request)
    {
        try {
            if (!isset($request['email'])) {
                throw new Exception('An email is required.', 400);
            }

            if (!isset($request['confirmationCode'])) {
                throw new Exception('A Confirmation Code is required to verify your email. Check your inbox.', 400);
            }

            $email = $request['email'];
            $confirmationCode = $request['confirmationCode'];

            $this->validator->validEmail($email);

            $this->validator->validConfirmationCode($confirmationCode);

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL verifyCredentials('$email', '$confirmationCode')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                throw new Exception("There was an error verifying your account please try again at another time.", 500);
            }

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function logout(WP_REST_Request $request)
    {
        try {
            $refreshToken = $this->token->getRefreshToken($request);
            $verifier = $this->session->hash_token($refreshToken);

            $session_destroyed = $this->session->destroy_session($request['id'], $verifier);

            if(!$session_destroyed){
                throw new Exception('Unable to remove session.');
            }

            wp_logout();

            if (is_user_logged_in()) {
                throw new Exception('User could not be logged out.', 400);
            }

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
            $accessToken = $this->token->getAccessToken($request);
            $uid = $accessToken->claims()->get('sub');

            $this->auth->revokeRefreshTokens($uid);

            if (!isset($request['id'])) {
                throw new Exception('ID is required to logout all accounts.', 500);
            }

            $session_tokens_deleted = delete_user_meta($request['id'], 'session_tokens');

            if (!$session_tokens_deleted) {
                throw new Exception('There was an error deleting session tokens.', 500);
            }

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
