<?php

namespace SEVEN_TECH\Gateway\Token;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Services\ServicesFirebase;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;

class TokenFirebase
{
    private $servicesFirebase;

    public function __construct(ServicesFirebase $servicesFirebase)
    {
        $this->servicesFirebase = $servicesFirebase;
    }

    function hashToken($token)
    {
        if (function_exists('hash')) {
            return hash('sha256', $token);
        } else {
            return sha1($token);
        }
    }

    function getEmailFromToken($accessToken)
    {
        $verifiedAccessToken = $this->servicesFirebase->getVerifiedToken($accessToken);

        $email = $verifiedAccessToken->claims()->get('email');

        return $email;
    }

    function findUserWithToken($accessToken)
    {
        try {
            $email = $this->servicesFirebase->getEmailFromToken($accessToken);

            return new Authentication($email);
        } catch (FailedToVerifyToken $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function revokeAllRefreshTokens(WP_REST_Request $request)
    {
        $accessToken = (new Token)->getAccessToken($request);
        $verifiedAccessToken = $this->servicesFirebase->getVerifiedToken($accessToken);
        $uid = $verifiedAccessToken->claims()->get('sub');

        return $this->servicesFirebase->revokeRefreshTokens($uid);
    }
}
