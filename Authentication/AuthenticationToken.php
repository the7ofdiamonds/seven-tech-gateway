<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class AuthenticationToken
{
    private $token;
    private $auth;

    public function __construct(Token $token, Auth $auth)
    {
        $this->token = $token;
        $this->auth = $auth;
    }

    function signInWithRefreshToken(WP_REST_Request $request)
    {
        try {
            $refreshToken = $this->token->getRefreshToken($request);

            $signedInUser = $this->auth->signInWithRefreshToken($refreshToken);

            $authenticationCredentials = $this->token->findUserWithToken($signedInUser->idToken());

            $user = $this->auth->getUser($signedInUser->data()['user_id']);

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
