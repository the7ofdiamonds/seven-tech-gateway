<?php

namespace SEVEN_TECH\Authentication;

use Exception;

use SEVEN_TECH\User\User;

use Kreait\Firebase\Auth;

class Authentication
{
    private $auth;
    private $user;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
        $this->user = new User;
    }

    function login($email, $password)
    {
        $user = $this->user->findUserByEmail($email);

        if ($user == null) {
            $statusCode = 404;
            throw new Exception('This email could not be found', $statusCode);
        }

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

        // $user = wp_signon($credentials, false);

        // if (is_wp_error($user)) {
        //     throw new Exception($user->get_error_message(), $user->get_error_code());
        // }

        wp_set_current_user($user->id);
        wp_set_auth_cookie($user->id, true);

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
            'email' => $user->email,
            'statusCode' => $statusCode
        ];

        return $loginResponse;
    }
}
