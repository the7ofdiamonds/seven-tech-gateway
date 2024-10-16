<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Authentication\Authenticated;
use SEVEN_TECH\Gateway\Authorization\Authorization;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Password\Password;
use SEVEN_TECH\Gateway\Token\Token;

use Exception;

use WP_REST_Request;
use WP_REST_Response;

class API_Password
{
    private $password;

    public function __construct()
    {
        $this->password = new Password;
    }

    function forgot(WP_REST_Request $request)
    {
        try {

            if (empty($request['email'])) {
                throw new Exception('An email is required to reset password.', 400);
            }

            $this->password->recover($request['email']);

            $forgotPasswordResponse = [
                'successMessage' => "An email has been sent to {$request['email']} check your inbox for directions on how to reset your password.",
                'statusCode' => 200
            ];

            $response = new WP_REST_Response($forgotPasswordResponse);
            $response->set_status(200);

            return rest_ensure_response($response);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function change(WP_REST_Request $request)
    {
        try {
            $authorized = (new Authorization)->isAuthorized($request);

            if (!$authorized) {
                throw new Exception("Please login to change your password.", 403);
            }

            $tokens = (new Token)->getTokens($request);
            $auth = new Authenticated($tokens['access_token'], $tokens['Refresh-Token']);

            if (empty($auth->email)) {
                throw new Exception('An email is required to change password.', 400);
            }

            $this->password->change($auth->email, $request['password'], $request['confirmPassword']);

            $changePasswordResponse = [
                'successMessage' => "Your password has been changed successfully an email has been sent to {$auth->email} check your inbox.",
                'statusCode' => 200
            ];

            $response = new WP_REST_Response($changePasswordResponse);
            $response->set_status(200);

            return rest_ensure_response($response);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function updated(WP_REST_Request $request)
    {
        try {

            if (empty($request['email'])) {
                throw new Exception('An email is required to reset password.', 400);
            }

            $this->password->updated($request['email'], $request['confirmationCode'], $request['password'], $request['confirmPassword']);

            $updatedPasswordResponse = [
                'successMessage' => "Your password has been updated an email has been sent to {$request['email']} check your inbox to confirm this action was completed.",
                'statusCode' => 200
            ];

            $response = new WP_REST_Response($updatedPasswordResponse);
            $response->set_status(200);

            return rest_ensure_response($response);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
