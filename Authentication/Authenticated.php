<?php

namespace SEVEN_TECH\Gateway\Authentication;

class Authenticated
{
    public $id;
    public $email;
    public $accessToken;
    public $refreshToken;
    public $roles;
    public $level;
    public $profileImage;

    public function __construct($id, $email, $accessToken, $refreshToken, $roles, $level, $profileImage)
    {
        $this->id = $id;
        $this->email = $email;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->roles = $roles;
        $this->level = $level;
        $this->profileImage = $profileImage;
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

    public function getProfileImage(){
        return $this->profileImage;
    }
}
