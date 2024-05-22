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

    public function __construct(Auth $auth, Account $account)
    {
        $this->validator = new Validator;
        $this->account = $account;
        $this->auth = $auth;
        $this->token = new Token($auth);
    }

    function login(WP_REST_Request $request)
    {
        try {
            $account = '';

            if (isset($request['email']) && isset($request['password'])) {
                $email = $request['email'];
                $password = $request['password'];

                if (empty($email)) {
                    throw new Exception('An Email is required for login.', 400);
                }

                if (empty($password)) {
                    throw new Exception('A Password is required for login', 400);
                }

                $signedInUser = $this->auth->signInWithEmailAndPassword($email, $password);
                $email = $signedInUser->data()['email'];

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

                $credentials = array(
                    'user_login'    => $account->email,
                    'user_password' => $password,
                    'remember'      => true,
                );

                $signedInWPUser = wp_signon($credentials, false);

                if (is_wp_error($signedInWPUser)) {
                    throw new Exception($signedInWPUser->get_error_message(), $signedInWPUser->get_error_code());
                }
            }

            $headers = $request->get_headers();

            if (isset($headers['authorization'][0]) && isset($headers['refresh_token'][0])) {
                $account = $this->token->findUserWithToken($request);

                if ($account == null) {
                    throw new Exception('User could not be found please signup to gain permission and access.', 404);
                }

                $signedInUser = $this->auth->signInWithRefreshToken($headers['refresh_token'][0]);
                $uid = $signedInUser->data()['user_id'];

                $user = $this->auth->getUser($uid);

                $account = $this->account->findAccount($user->email);
            }

            if (empty($account) && empty($signedInUser)) {
                throw new Exception('Access Denied: Either a token or username and password are required to login.', 403);
            }

            if (isset($request['location'])) {
                $location = $request['location'];

                error_log(print_r($location, true));
            }

            wp_set_current_user($account->id);
            wp_set_auth_cookie($account->id, true);

            if (!is_user_logged_in()) {
                throw new Exception('You could not be logged in successfully', 403);
            }

            $loginResponse = [
                'successMessage' => 'You have been logged in successfully',
                'accessToken' => $signedInUser->idToken(),
                'refreshToken' => $signedInUser->refreshToken(),
                'email' => $account->email,
                'statusCode' => 200
            ];

            return $loginResponse;
        } catch (Exception $e) {
            throw new Exception($e);
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
        } catch (Exception $e) {
            throw new Exception($e);
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
            throw new Exception($e);
        }
    }

    public function logoutAll()
    {
    }
}
