<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Services\ServicesFirebase;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\Token\TokenFirebase;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class AuthenticationToken
{
    private $tokenFirebase;
    private $servicesFirebase;

    public function __construct(TokenFirebase $tokenFirebase, ServicesFirebase $servicesFirebase)
    {
        $this->tokenFirebase = $tokenFirebase;
        $this->servicesFirebase = $servicesFirebase;
    }

    function signInWithRefreshToken(WP_REST_Request $request)
    {
        try {
            $refreshToken = (new Token)->getRefreshToken($request);

            $signedInUser = $this->servicesFirebase->signInWithRefreshToken($refreshToken);

            $authenticationCredentials = $this->tokenFirebase->findUserWithToken($signedInUser->idToken());

            $user = $this->servicesFirebase->getUserByID($signedInUser->data()['user_id']);

           (new Authentication($authenticationCredentials->email))->isAuthenticated($authenticationCredentials->password);

            return new Authenticated($authenticationCredentials->email, $signedInUser, $user);
        } catch (FailedToVerifyToken $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
