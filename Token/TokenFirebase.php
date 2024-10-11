<?php

namespace SEVEN_TECH\Gateway\Token;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Services\Google\Firebase\FirebaseAuth;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;

class TokenFirebase
{
    private $firebaseAuth;

    public function __construct()
    {
        $this->firebaseAuth = new FirebaseAuth;
    }

    function hashToken($token)
    {
        if (function_exists('hash')) {
            return hash('sha256', $token);
        } else {
            return sha1($token);
        }
    }

    // get username
    function getEmailFromToken($accessToken)
    {
        $verifiedAccessToken = $this->firebaseAuth->getVerifiedToken($accessToken);

        $email = $verifiedAccessToken->claims()->get('email');

        return $email;
    }

    function findUserWithToken($accessToken)
    {
        try {
            $email = $this->firebaseAuth->getEmailFromToken($accessToken);

            return new Authentication($email);
        } catch (FailedToVerifyToken $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function revokeAllRefreshTokens(string $accessToken)
    {
        $verifiedAccessToken = $this->firebaseAuth->getVerifiedToken($accessToken);
        $uid = $verifiedAccessToken->claims()->get('sub');

        return $this->firebaseAuth->revokeRefreshTokens($uid);
    }
}
