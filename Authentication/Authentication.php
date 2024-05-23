<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Auth;

class Authentication
{
    private $validator;
    private $account;
    private $token;
    private $auth;

    public function __construct(Account $account, Token $token, Auth $auth)
    {
        $this->validator = new Validator;
        $this->account = $account;
        $this->token = $token;
        $this->auth = $auth;
    }

    function signInWithEmailAndPassword(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];
            $password = $request['password'];

            $this->validator->validEmail($email);

            $this->validator->validPassword($password);

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

            return new Authenticated($account->id, $account->email, $signedInUser->idToken(), $signedInUser->refreshToken(), $account->roles);
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
            if (isset($request['email'])) {
                throw new Exception('An email is required.', 400);
            }

            if (isset($request['confirmationCode'])) {
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
