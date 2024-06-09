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

    function createFirebaseUser($email, $phone, $password, $username)
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

    function getUserByID($id)
    {
        return $this->auth->getUser($id);
    }

    function signInWithEmailAndPassword($email, $password)
    {
        try {
            return $this->auth->signInWithEmailAndPassword($email, $password);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function signInWithRefreshToken($refreshToken)
    {
        return $this->auth->signInWithRefreshToken($refreshToken);
    }

    function getVerifiedToken($token)
    {
        try {
            return $this->auth->verifyIdToken($token, true);
        } catch (FailedToVerifyToken $e) {
            throw new DestructuredException($e);
        }
    }

    function getEmailFromToken($accessToken)
    {
        $verifiedAccessToken = $this->getVerifiedToken($accessToken);

        $email = $verifiedAccessToken->claims()->get('email');

        return $email;
    }

    function changeFirebasePassword($uid, $newPassword)
    {
        return $this->auth->changeUserPassword($uid, $newPassword);
    }

    function revokeRefreshTokens($uid)
    {
        return $this->auth->revokeRefreshTokens($uid);
    }
}
