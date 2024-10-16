<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Services\Google\Firebase\FirebaseAuth;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\User\User;

class Authenticated
{
    public $access_token;
    public $refresh_token;
    public $id;
    public $email;
    public $username;
    public $profile_image;
    public $algorithm;

    public $auth_time;
    public $expiration;
    public $roles;
    public $level;
    public $isAccountNonExpired;

    public $issuer;

    public function __construct($access_token, $refresh_token)
    {
        $this->access_token = $access_token;
        $this->refresh_token = $refresh_token;

        $token = new Token;
        $this->algorithm = $token->getJWTAlgorithm($access_token);
        $accessTokenBody = $token->getJWTBody($access_token);

        $this->issuer = $accessTokenBody['iss'];

        $user = null;

        if ($this->issuer == "" || $this->issuer == "orb-gateway") {
            $user = new User($accessTokenBody['sub']);
            $this->username = $accessTokenBody['sub'];
            $this->profile_image = null;
        } else {
            $user = (new FirebaseAuth)->getUserByID($accessTokenBody['sub']);
            $this->username = $user->displayName;
            $this->profile_image = $user->photoUrl;
        }

        $this->auth_time = $accessTokenBody['iat'];
        $this->expiration = $accessTokenBody['exp'];

        $this->email = $user->email;

        $account = new Account($this->email);
        $this->id = $account->id;
        $this->roles = $account->roles;
        $this->level = $account->level;
        $this->isAccountNonExpired = $account->isAccountNonExpired;
    }

    function validAccessToken(): bool
    {
        if ($this->expiration < time() || $this->id == null) {
            return false;
        }

        return true;
    }

    function validRefreshToken(): bool
    {
        return true;
    }
}
