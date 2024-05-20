<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Account\Account;
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

    public function __construct(Auth $auth)
    {
        $this->validator = new Validator;
        $this->account = new Account;
        $this->auth = $auth;
        $this->token = new Token($auth);
    }

    function login(WP_REST_Request $request)
    {
        try {
            $account = '';
            $signedInUser = '';

            if (isset($request['email']) && isset($request['password'])) {
                $email = $request['email'];
                $password = $request['password'];

                if (empty($email)) {
                    $statusCode = 400;
                    throw new Exception('An Email is required for login.', $statusCode);
                }

                if (empty($password)) {
                    $statusCode = 400;
                    throw new Exception('A Password is required for login', $statusCode);
                }

                $signedInUser = $this->auth->signInWithEmailAndPassword($email, $password);
            }

            $headers = $request->get_headers();

            if (isset($headers['authorization'][0])) {
                $account = $this->token->findUserWithToken($request);

                if ($account == null) {
                    throw new Exception('User could not be found please signup to gain permission and access.', 404);
                }

                $signedInUser = $this->auth->signInWithRefreshToken($account['token']);
            }

            if (empty($account) && empty($signedInUser)) {
                throw new Exception('Access Denied: Either a token or username and password are required to login.', 403);
            }

            $account = $this->account->findAccount($email);

            if (isset($request['location'])) {
                $location = $request['location'];

                error_log(print_r($location, true));
            }

            $password_check = password_verify($password, $account->password);

            error_log(print_r($password_check, true));
            if (!$password_check) {
                throw new Exception('The password you entered for this username is not correct.', 400);
            }

            $credentials = array(
                'user_login'    => $account->email,
                'user_password' => $password,
                'remember'      => true,
            );

            $signedInWPUser = wp_signon($credentials, false);
            error_log(print_r($signedInWPUser, true));
            if (is_wp_error($signedInWPUser)) {
                throw new Exception($signedInWPUser->get_error_message(), $signedInWPUser->get_error_code());
            }

            wp_set_current_user($signedInWPUser->id);
            wp_set_auth_cookie($signedInWPUser->id, true);

            if (!is_user_logged_in()) {
                throw new Exception('You could not be logged in successfully', 403);
            }

            $statusCode = 200;
            $loginResponse = [
                'successMessage' => 'You have been logged in successfully',
                'accessToken' => $signedInUser->idToken(),
                'refreshToken' => $signedInUser->refreshToken(),
                'email' => $account->email,
                'statusCode' => $statusCode
            ];

            return $loginResponse;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function verifyCredentials(WP_REST_Request $request)
    {
        try {
            $userData = $this->token->findUserWithToken($request);
            $email = $userData['account']->email;
            $password = $userData['account']->password;
            $confirmationCode = $request['confirmationCode'];

            if (empty($confirmationCode)) {
                $statusCode = 400;
                throw new Exception('A Confirmation Code is required to verify your email. Check your inbox.', $statusCode);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL enableAccount('$email', '$password', '$confirmationCode')"
            );

            if ($wpdb->last_error) {
                $statusCode = 500;
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, $statusCode);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                $statusCode = 400;
                throw new Exception("There was an error verifying your account please try again at another time.", $statusCode);
            }

            $statusCode = 200;
            $verifyEmailResponse = [
                'successMessage' => 'Email has been verified.',
                'statusCode' => $statusCode
            ];

            return rest_ensure_response($verifyEmailResponse);
        } catch (Exception $e) {
            error_log('There has been an error at verify email.');
            $statusCode = $e->getCode();
            $response_data = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];
            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
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
        } catch (Exception $e) {
            $statusCode = $e->getCode();
            $response_data = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];
            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    public function logoutAll()
    {
    }
}
