<?php

namespace SEVEN_TECH\Gateway\Token;

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
