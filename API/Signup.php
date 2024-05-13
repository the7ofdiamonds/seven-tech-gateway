<?php

namespace SEVEN_TECH\Gateway\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Gateway\User\User;

use Kreait\Firebase\Auth;

class Signup
{
    private $auth;
    private $user;

    public function __construct(Auth $auth, User $user)
    {
        $this->auth = $auth;
        $this->user = $user;
    }

// Send verify email
    public function signup(WP_REST_Request $request)
    {
        try {
            $displayName = $request['username'];
            $user_email = $request['email'];
            $user_password = $request['password'];
            $nicename = $request['nicename'];
            $nickname = $request['nickname'];
            $firstname = $request['firstname'];
            $lastname = $request['lastname'];
            $phone = $request['phone'];

            $userLogin = get_user_by('login', $displayName);

            if ($userLogin) {
                $statusCode = 400;
                throw new Exception('A user already exists with this user name. Choose another user name.', $statusCode);
            }

            $userEmail = get_user_by('email', $user_email);

            if ($userEmail) {
                $statusCode = 400;
                throw new Exception('A user already exists with this email. Please go to the forgot page to reset your password.', $statusCode);
            }

            $hashedPassword = password_hash($user_password, PASSWORD_BCRYPT);
            $confirmationCode = wp_generate_password(20, false);

            $newWPUser = $this->user->addNewUser($user_email, $displayName, $hashedPassword, $nicename, $nickname, $firstname, $lastname, $phone, 'subscriber', $confirmationCode);

            $user_id = $newWPUser->id;

            if (empty($user_id)) {
                error_log("Unable to add new user with email {$user_email}.");
            }

            $newUser = [
                'email' => $user_email,
                'emailVerified' => false,
                'phoneNumber' => '+' . $phone,
                'password' => $user_password,
                'displayName' => $displayName,
                'disabled' => false,
            ];

            $newFirebaseUser = $this->auth->createUser($newUser);
            $providergivenID = $newFirebaseUser->uid;

            if (empty($providergivenID)) {
                error_log("Unable to add user with email {$user_email} to firebase.");
            }

            $providergivenIDAdded = add_user_meta($user_id, 'provider_given_id', $providergivenID, true);

            if (!is_int($providergivenIDAdded)) {
                error_log("Unable to add provider given id for the user with email {$user_email}.");
            }

            $credentials = [
                'user_login' => $user_email,
                'user_password' => $user_password,
                'remember' => true
            ];

            $signedInUser = wp_signon($credentials);

            if (is_wp_error($signedInUser)) {
                $statusCode = 400;
                throw new Exception($signedInUser->get_error_message(), $statusCode);
            }

            wp_set_current_user($signedInUser->ID, $signedInUser->user_login);
            wp_set_auth_cookie($signedInUser->ID, true);

            if (!is_user_logged_in()) {
                $statusCode = 500;
                throw new Exception("There was an error signing in new user.", $statusCode);
            }

            $statusCode = 201;
            $signupResponse = [
                'successMessage' => 'You have logged in successfully as ' . $displayName . ' using the email ' . $user_email . '.',
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($signupResponse);
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
}
