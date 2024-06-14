<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Password\Password;
use SEVEN_TECH\Gateway\Token\Token;

use Kreait\Firebase\Auth\SignInResult;
use Kreait\Firebase\Auth\UserRecord;

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
    public $expiresIn;
    public $roles;
    public $level;

    public function __construct(string $email, SignInResult $signedInUser, UserRecord $user)
    {
        $account = new Account($email);

        $this->id = $account->id;
        $this->email = $account->email;
        $this->username = $account->username;
        $this->passwordFrag = (new Password)->passwordFrag($account->password);
        $this->profile_image = $user->photoUrl ? $user->photoUrl : $account->profile_image;
        $this->algorithm = (new Token)->getJwtAlgorithm($signedInUser->idToken());
        $this->access_token = $signedInUser->idToken();
        $this->refresh_token = $signedInUser->refreshToken();
        $this->expiresIn = $signedInUser->data()['expiresIn'];
        $this->roles = $account->roles;
        $this->level = $account->level;
    }
}
