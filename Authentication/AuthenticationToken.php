<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Services\Google\Firebase\FirebaseAuth;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\Token\TokenFirebase;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class AuthenticationToken
{
    private $tokenFirebase;
    private $firebaseAuth;

    public function __construct()
    {
        $this->tokenFirebase = new TokenFirebase;
        $this->firebaseAuth = new FirebaseAuth;
    }

    function signInWithRefreshToken(WP_REST_Request $request)
    {
        try {
            $refreshToken = (new Token)->getRefreshToken($request);

            $signedInUser = $this->firebaseAuth->signInWithRefreshToken($refreshToken);

            $authenticationCredentials = $this->tokenFirebase->findUserWithToken($signedInUser->idToken());

            $user = $this->firebaseAuth->getUserByID($signedInUser->data()['user_id']);

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
