<?php

namespace SEVEN_TECH\Gateway\Token;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;

class Token
{
    private $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    function getVerifiedToken($token)
    {
        try {
            return $this->auth->verifyIdToken($token, true);
        } catch (FailedToVerifyToken $e) {
            throw new DestructuredException($e);
        }
    }

    function getAccessToken(WP_REST_Request $request)
    {
        try {
            $headers = $request->get_headers();

            if (!isset($headers['authorization'][0])) {
                throw new Exception('Authorization header could not be found in the headers of this request.', 403);
            }

            $authentication = $headers['authorization'][0];
            $accessToken = substr($authentication, 7);

            if (empty($accessToken)) {
                throw new Exception('Access Token could not be found.', 403);
            }

            return $this->getVerifiedToken($accessToken);
        } catch (FailedToVerifyToken $e) {
            throw new DestructuredException($e);
        } catch (RevokedIdToken $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function getRefreshToken(WP_REST_Request $request)
    {
        try {
            $headers = $request->get_headers();

            if (!isset($headers['refresh_token'])) {
                throw new Exception('A Refresh Token is required to gain permission and access.', 403);
            }

            return (string) $headers['refresh_token'][0];
        } catch (FailedToVerifyToken $e) {
            throw new DestructuredException($e);
        } catch (RevokedIdToken $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function getEmailFromToken($accessToken)
    {
        $verifiedAccessToken = $this->getVerifiedToken($accessToken);

        $email = $verifiedAccessToken->claims()->get('email');

        return $email;
    }

    function findUserWithToken($accessToken)
    {
        try {
            $email = $this->getEmailFromToken($accessToken);

            return new Authentication($email);
        } catch (FailedToVerifyToken $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
