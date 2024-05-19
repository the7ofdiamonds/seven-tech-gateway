<?php

namespace SEVEN_TECH\Gateway\Token;

use Kreait\Firebase\Auth;

class Token
{
    private $auth;
    
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
}
