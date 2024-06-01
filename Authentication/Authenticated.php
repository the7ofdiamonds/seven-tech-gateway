<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Account\Account;

use Kreait\Firebase\Auth\SignInResult;
use Kreait\Firebase\Auth\UserRecord;

class Authenticated
{
    public $id;
    public $email;
    public $username;
    public $profile_image;
    public $access_token;
    public $refresh_token;
    public $roles;
    public $level;

    public function __construct(string $email, SignInResult $signedInUser, UserRecord $user)
    {
        $account = new Account($email);
        
        $this->id = $account->id;
        $this->email = $account->email;
        $this->username = $account->username;
        $this->profile_image = $user->photoUrl ? $user->photoUrl : $account->profile_image;
        $this->access_token = $signedInUser->idToken();
        $this->refresh_token = $signedInUser->refreshToken();
        $this->roles = $account->roles;
        $this->level = $account->level;  
    }
}
