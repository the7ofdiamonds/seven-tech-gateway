<?php

namespace THFW_Users\API;

use THFW_Users\API\Signup;
use THFW_Users\API\Login;
use THFW_Users\API\Logout;

use Kreait\Firebase\Factory;

class API
{
  function __construct()
  {
    $factory = (new Factory)->withServiceAccount(THFW_USERS . 'API/serviceAccount.json');
    $auth = $factory->createAuth();
    
    new Signup($auth);
    new Login($auth);
    new Logout();
  }
}
