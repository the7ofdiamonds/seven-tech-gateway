<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Account\Details;
use SEVEN_TECH\Gateway\Services\Google\Firebase\FirebaseAuth;
use SEVEN_TECH\Gateway\Password\Password;
use SEVEN_TECH\Gateway\Session\Session;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\User\User;

class Authenticated
{
    public $id;
    public $email;
    public $username;
    public $passwordFrag;
    public $profile_image;
    public $algorithm;
    public $access_token;
    public $refresh_token;
    public $auth_time;
    public $expiration;
    public $roles;
    public $level;
    public $location;
    public $issuer;
    public $token;
    public $verifier;

    public function __construct($access_token, $refresh_token)
    {
        $token = new Token;
        $this->algorithm = $token->getJWTAlgorithm($access_token);
        $accessTokenBody = $token->getJWTBody($access_token);

        $this->issuer = $accessTokenBody['iss'];

        $this->access_token = $access_token;
        $this->refresh_token = $refresh_token;

        $user = null;

        if ($this->issuer == "" || $this->issuer == "orb-gateway") {
            $user = (new User($accessTokenBody['sub']));
            $this->username = $accessTokenBody['sub'];
            $this->location = $accessTokenBody['location'];
        } else {
            $user = (new FirebaseAuth)->getUserByID($accessTokenBody['sub']);
            $this->username = $user->displayName;
            $this->location = "";
        }

        $this->auth_time = $accessTokenBody['iat'];
        $this->expiration = $accessTokenBody['exp'];

        $this->email = $user->email;

        $account = new Account($this->email);
        $this->id = $account->id;
        $this->profile_image = $account->profileImage;
        $this->passwordFrag = (new Password)->frag($account->password);
        $this->profile_image = $user->photoUrl ? $user->photoUrl : $account->profileImage;
        $this->roles = $account->roles;
        $this->level = $account->level;
        $this->token = $this->getToken($refresh_token);
        $this->verifier = $this->getVerifier();
    }

    function validAccessToken() : bool {
        (new Details())->isAuthenticated($this->id);

        return true;
    }

    function validRefreshToken() : bool {
        return true;
    }

    function getToken(string $refresh_token) : string {
        return substr((new Token)->hashToken($refresh_token), 0, 43);
    }

    function getVerifier() : string {
        return (new Token)->hashToken($this->token);
    }
}
