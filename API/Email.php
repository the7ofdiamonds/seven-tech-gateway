<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class Email
{
    private $token;

    public function __construct(Auth $auth)
    {
        $this->token = new Token($auth);
    }
    // Send email from this class
    function verifyEmail(WP_REST_Request $request)
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

    // Need a away to have multiple accounts linked
    // function addEmail(WP_REST_Request $request)
    // {
    //     try {
    //         $accessToken = $this->token->getToken($request);
    //         $userData = $this->token->findUserWithToken($accessToken);
    //         $email = $userData->email;
    //         $password = $userData->password;
    //         $email = $request['email'];

    //         $addEmailResponse = [
    //             'successMessage' => $email
    //         ];

    //         return rest_ensure_response($addEmailResponse);
    //     } catch (FailedToVerifyToken $e) {
    //         $statusCode = 403;
    //         $tokenResponse = [
    //             'message' => $e->getMessage(),
    //             'errorMessage' => "Please login to gain access and permission.",
    //             'statusCode' => $statusCode
    //         ];

    //         $response = rest_ensure_response($tokenResponse);
    //         $response->set_status($statusCode);

    //         return $response;
    //     } catch (Exception $e) {
    //         error_log('There has been an error at add email.');
    //         $message = [
    //             'message' => $e->getMessage(),
    //         ];
    //         $response = rest_ensure_response($message);
    //         $response->set_status($e->getCode());
    //         return $response;
    //     }
    // }

    // function removeEmail(WP_REST_Request $request)
    // {
    //     try {
    //         $accessToken = $this->token->getToken($request);
    //         $userData = $this->token->findUserWithToken($accessToken);
    //         $email = $userData->email;
    //         $password = $userData->password;
    //         $email = $request['email'];

    //         $removeEmailResponse = [
    //             'successMessage' => $email
    //         ];

    //         return rest_ensure_response($removeEmailResponse);
    //     } catch (FailedToVerifyToken $e) {
    //         $statusCode = 403;
    //         $tokenResponse = [
    //             'message' => $e->getMessage(),
    //             'errorMessage' => "Please login to gain access and permission.",
    //             'statusCode' => $statusCode
    //         ];

    //         $response = rest_ensure_response($tokenResponse);
    //         $response->set_status($statusCode);

    //         return $response;
    //     } catch (Exception $e) {
    //         error_log('There has been an error at remove email.');
    //         $message = [
    //             'message' => $e->getMessage(),
    //         ];
    //         $response = rest_ensure_response($message);
    //         $response->set_status($e->getCode());
    //         return $response;
    //     }
    // }
}
