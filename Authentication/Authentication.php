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

    public function __construct(Auth $auth)
    {
        $this->validator = new Validator;
        $this->account = new Account;
        $this->token = new Token($auth);
    }

    function login(WP_REST_Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];
        $location = $request['location'];
        error_log(print_r($location, true));

        if (empty($email)) {
            $statusCode = 400;
            throw new Exception('An Email is required for login.', $statusCode);
        }

        if (empty($password)) {
            $statusCode = 400;
            throw new Exception('A Password is required for login', $statusCode);
        }

        $account = $this->account->findAccount($email);

        if ($account == null) {
            $statusCode = 404;
            throw new Exception('This email could not be found', $statusCode);
        }

        $verifiedIdToken = $this->token->getToken($request);

            if ($verifiedIdToken == '') {
                $statusCode = 403;
                throw new Exception('Valid token is required.', $statusCode);
            }

            $user = $this->token->findUserWithToken($verifiedIdToken);

            if ($user == null) {
                $statusCode = 404;
                throw new Exception('User could not be found please signup to gain permission and access.', $statusCode);
            }

            $location = $request['location'];

            error_log(print_r($location, true));
        // $password_check = password_verify($password, $user->password);
        // $password_check = wp_check_password($password, $user->password, $user->id);
        // error_log(print_r($password_check, true));
        // if (!$password_check) {
        //     $statusCode = 400;
        //     throw new Exception('The password you entered for this username is not correct.', $statusCode);
        // }

        // $credentials = array(
        //     'user_login'    => $user->email,
        //     'user_password' => $password,
        //     'remember'      => true,
        // );

        // $account = wp_signon($credentials, false);

        // if (is_wp_error($user)) {
        //     throw new Exception($user->get_error_message(), $user->get_error_code());
        // }

        wp_set_current_user($account->id);
        wp_set_auth_cookie($account->id, true);

        if (!is_user_logged_in()) {
            $statusCode = 400;
            throw new Exception('You could not be logged in successfully', $statusCode);
        }

        // $signedInUser = $this->auth->signInWithEmailAndPassword($user->email, $password);
        // $accessToken = $signedInUser->idToken();
        // $refreshToken = $signedInUser->refreshToken();

        $statusCode = 200;
        $loginResponse = [
            'successMessage' => 'You have been logged in successfully',
            // 'accessToken' => $accessToken,
            // 'refreshToken' => $refreshToken,
            'email' => $account->email,
            'statusCode' => $statusCode
        ];

        return $loginResponse;
    }

    function verifyCredentials(WP_REST_Request $request)
    {
        try {
            $accessToken = $this->token->getToken($request);
            $userData = $this->token->findUserWithToken($accessToken);
            $email = $userData->email;
            $password = $userData->password;
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
