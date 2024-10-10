<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Services\Google\Firebase\FirebaseAuth;
use SEVEN_TECH\Gateway\Password\Password;
use SEVEN_TECH\Gateway\Token\Token;

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

    public function __construct($access_token, $refresh_token)
    {
        $token = new Token;
        $jwtBody = $token->getJWTBody($access_token);
        $email = $jwtBody['email'];
        $provider_given_id = $jwtBody['user_id'];

        $account = new Account($email);
        $user = (new FirebaseAuth)->getUserByID($provider_given_id);

        $this->id = $account->id;
        $this->email = $account->email;
        $this->username = $account->username;
        $this->passwordFrag = (new Password)->passwordFrag($account->password);
        $this->profile_image = $user->photoUrl ? $user->photoUrl : $account->profileImage;
        $this->algorithm = (new Token)->getJWTAlgorithm($access_token);
        $this->access_token = $access_token;
        $this->refresh_token = $refresh_token;
        $this->auth_time = $jwtBody['auth_time'];
        $this->expiration = $jwtBody['exp'];
        $this->roles = $account->roles;
        $this->level = $account->level;
    }
}
