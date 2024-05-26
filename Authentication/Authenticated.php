<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Account\Account;

use Kreait\Firebase\Auth\SignInResult;

class Authenticated
{
    public $id;
    public $email;
    public $accessToken;
    public $refreshToken;
    public $roles;
    public $level;
    public $profileImage;

    public function __construct(Account $account, SignInResult $signedInUser)
    {
        $this->id = $account->id;
        $this->email = $account->email;
        $this->accessToken = $signedInUser->idToken();
        $this->refreshToken = $signedInUser->refreshToken();
        $this->roles = $account->roles;
        $this->level = $account->level;
        $this->profileImage = $account->profileImage;
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
        return $this->accessToken;
    }

    public function getRefreshToken()
    {
        return $this->refreshToken;
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
        return $this->profileImage;
    }
}
