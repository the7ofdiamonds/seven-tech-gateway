<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Auth;

class Authentication
{
    private $account;
    private $token;
    private $auth;

    public function __construct(Account $account, Token $token, Auth $auth)
    {
        $this->account = $account;
        $this->token = $token;
        $this->auth = $auth;
    }

    function signInWithEmailAndPassword(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];
            $password = $request['password'];

            if (empty($email)) {
                throw new Exception('An Email is required for login.', 400);
            }

            if (empty($password)) {
                throw new Exception('A Password is required for login', 400);
            }

            $account = $this->account->findAccount($email);

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

            return new Authenticated($account->id, $account->email, $signedInUser->idToken(), $signedInUser->refreshToken());
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
                $authenticatedAccount = $this->signInWithEmailAndPassword($request);
            } else {
                $authenticatedAccount = $this->token->signInWithRefreshToken($request);
            }

            if ($authenticatedAccount == '') {
                throw new Exception('Access Denied: Either a token or username and password are required to login.', 403);
            }

            if (isset($request['location'])) {
                $location = $request['location'];

                error_log(print_r($location, true));
            }

            wp_set_current_user($authenticatedAccount->id);
            wp_set_auth_cookie($authenticatedAccount->id, true);

            if (!is_user_logged_in()) {
                throw new Exception('You could not be logged in successfully', 403);
            }

            $loginResponse = [
                'successMessage' => 'You have been logged in successfully',
                'accessToken' => $authenticatedAccount->accessToken,
                'refreshToken' => $authenticatedAccount->refreshToken,
                'email' => $authenticatedAccount->email,
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
            if (empty($username)) {
                throw new Exception('A Username or email is required to update password.', 400);
            }

            if (empty($confirmationCode)) {
                throw new Exception('A Confirmation Code is required to update password.', 400);
            }

            $email = $request['email'];
            $confirmationCode = $request['confirmationCode'];

            if (empty($confirmationCode)) {
                throw new Exception('A Confirmation Code is required to verify your email. Check your inbox.', 400);
            }

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

            $verifyEmailResponse = [
                'successMessage' => 'Your credentials have been verified.',
                'statusCode' => 200
            ];

            return rest_ensure_response($verifyEmailResponse);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function logout(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];

            if (empty($email)) {
                $statusCode = 400;
                throw new Exception('An Email is required to logout', $statusCode);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL existsByEmail(%s)", $email)
            );

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            $userExists = $results[0]->resultSet;

            if (!$userExists) {
                $statusCode = 404;
                throw new Exception('User could not be found', $statusCode);
            }

            wp_logout();

            if (is_user_logged_in()) {
                $statusCode = 400;
                throw new Exception('User could not be logged out.', $statusCode);
            }

            $statusCode = 200;
            $logoutResponse = [
                'successMessage' => 'You have been logged out',
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($logoutResponse);
            $response->set_status($statusCode);

            return $response;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function logoutAll()
    {
    }
}
