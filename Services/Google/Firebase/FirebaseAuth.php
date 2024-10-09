<?php

namespace SEVEN_TECH\Gateway\Services\Google\Firebase;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;

class FirebaseAuth
{
    private $auth;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(GOOGLE_SERVICE_ACCOUNT);

        $this->auth = $factory->createAuth();
    }

    function createFirebaseUser(String $email, String $phone, String $password, String $username)
    {
        $newUser = [
            'email' => $email,
            'emailVerified' => false,
            'phoneNumber' => '+' . $phone,
            'password' => $password,
            'displayName' => $username,
            'disabled' => false,
        ];

        $newFirebaseUser = $this->auth->createUser($newUser);
        $providergivenID = $newFirebaseUser->uid;

        if (empty($providergivenID)) {
            error_log("Unable to add user with email {$email} to firebase.");
        }

        return $newFirebaseUser;
    }

    function getUserByID(String $uid)
    {
        return $this->auth->getUser($uid);
    }

    function signInWithEmailAndPassword(String $email, String $password)
    {
        try {
            return $this->auth->signInWithEmailAndPassword($email, $password);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function signInWithRefreshToken(String $refreshToken)
    {
        return $this->auth->signInWithRefreshToken($refreshToken);
    }

    function getVerifiedToken(String $token)
    {
        try {
            return $this->auth->verifyIdToken($token, true);
        } catch (FailedToVerifyToken $e) {
            throw new DestructuredException($e);
        }
    }

    function getEmailFromToken(String $accessToken)
    {
        $verifiedAccessToken = $this->getVerifiedToken($accessToken);

        $email = $verifiedAccessToken->claims()->get('email');

        return $email;
    }

    function changeFirebasePassword(String $uid, String $newPassword)
    {
        return $this->auth->changeUserPassword($uid, $newPassword);
    }

    function revokeRefreshTokens(String $uid)
    {
        return $this->auth->revokeRefreshTokens($uid);
    }

    function deleteUser(String $uid) {
        return $this->auth->deleteUser($uid);
    }
}
