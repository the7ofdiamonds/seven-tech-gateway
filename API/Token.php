<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\AppCheck\FailedToVerifyAppCheckToken;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;

class Token
{
    private $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    function token(WP_REST_Request $request)
    {
        try {
            $location = $request['location'];

            error_log(print_r($location, true));

            $verifiedIdToken = $this->getToken($request);

            if($verifiedIdToken == ''){
                $statusCode = 403;
                throw new Exception('Valid token is required.', $statusCode);
            }

            $user = $this->findUserWithToken($verifiedIdToken);

            if ($user == null) {
                $statusCode = 404;
                throw new Exception('User could not be found please signup to gain permission and access.', $statusCode);
            }

            wp_set_current_user($user->id);
            wp_set_auth_cookie($user->id, true);

            if (!is_user_logged_in()) {
                $statusCode = 400;
                throw new Exception('You could not be logged in successfully', $statusCode);
            }

            $statusCode = 200;
            $tokenResponse = [
                'successMessage' => 'You have been logged in successfully',
                "statusCode" => $statusCode
            ];

            $response = rest_ensure_response($tokenResponse);
            $response->set_status($statusCode);

            return $response;
        } catch (FailedToVerifyAppCheckToken $e) {
            $statusCode = 403;
            $tokenResponse = [
                'message' => $e->getMessage(),
                'errorMessage' => "Please login to gain access and permission.",
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($tokenResponse);
            $response->set_status($statusCode);

            return $response;
        } catch (Exception $e) {
            error_log('There has been an error at loging in using the tokens provided.');
            $statusCode = $e->getCode();
            $message = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];
            $response = rest_ensure_response($message);
            $response->set_status($statusCode);

            return $response;
        }
    }

    function getToken(WP_REST_Request $request)
    {
        try {
            $headers = $request->get_headers();
            $authentication = $headers['authorization'][0];
            $idToken = substr($authentication, 7);

            return $this->auth->verifyIdToken($idToken);
        } catch (FailedToVerifyToken $e) {
            throw new FailedToVerifyToken($e);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function findUserWithToken($token)
    {
        try {
            $verifiedIdToken = $this->auth->verifyIdToken($token);

            $email = $verifiedIdToken->claims()->get('email');

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL findUserByEmail(%s)", $email)
            );

            if ($wpdb->last_error) {
                $statusCode = 500;
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, $statusCode);
            }

            if ($results == null) {
                return '';
            }
// catch revoked id tokens
            return $results[0];
        } catch (FailedToVerifyToken $e) {
            throw new FailedToVerifyToken($e);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
