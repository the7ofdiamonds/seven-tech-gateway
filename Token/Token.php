<?php

namespace SEVEN_TECH\Gateway\Token;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Authentication\Authenticated;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;

class Token
{
    private $auth;
    private $account;

    public function __construct(Auth $auth, Account $account)
    {
        $this->auth = $auth;
        $this->account = $account;
    }

    function getVerifiedToken($token)
    {
        return $this->auth->verifyIdToken($token, true);
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

            return $this->auth->verifyIdToken($accessToken, true);
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

    function findUserWithToken($accessToken)
    {
        try {
            $verifiedAccessToken = $this->getVerifiedToken($accessToken);

            $email = $verifiedAccessToken->claims()->get('email');

            $account = $this->account->findAccount($email);

            return $account;
        } catch (FailedToVerifyToken $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function signInWithRefreshToken(WP_REST_Request $request)
    {
        try {
            $refreshToken = $this->getRefreshToken($request);

            $signedInUser = $this->auth->signInWithRefreshToken($refreshToken);

            $account = $this->findUserWithToken($signedInUser->idToken());
            $profile_image_url = get_avatar_url($account->id);

            return new Authenticated($account->id, $account->email, $signedInUser->idToken(), $signedInUser->refreshToken(), $account->roles, $account->level, $profile_image_url);
        } catch (FailedToVerifyToken $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
