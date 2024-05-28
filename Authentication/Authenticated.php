<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Account\Account;

use Kreait\Firebase\Auth\SignInResult;

class Authenticated
{
    public $id;
    public $email;
    public $access_token;
    public $refresh_token;
    public $roles;
    public $level;
    public $profile_image;

    public function __construct(Account $account, SignInResult $signedInUser)
    {
        $this->id = $account->id;
        $this->email = $account->email;
        $this->access_token = $signedInUser->idToken();
        $this->refresh_token = $signedInUser->refreshToken();
        $this->roles = $account->roles;
        $this->level = $account->level;
        $this->profile_image = $account->profile_image;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getAccessToken()
    {
        return $this->access_token;
    }

    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function getProfileImage()
    {
        return $this->profile_image;
    }
}
