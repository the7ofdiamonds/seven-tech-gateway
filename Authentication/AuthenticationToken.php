<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class AuthenticationToken
{
    private $token;

    public function __construct()
    {
        $this->token = new Token;
    }

    function signInWithRefreshToken(WP_REST_Request $request)
    {
        try {
            $accessToken = $this->token->getAccessToken($request);
            $refreshToken = $this->token->getRefreshToken($request);
            $email = $this->token->getEmailFromToken($accessToken);

            (new Authentication($email))->isAuthenticated();

            return new Authenticated($accessToken, $refreshToken);
        } catch (FailedToVerifyToken $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
