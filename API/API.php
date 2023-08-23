<?php

namespace THFW_Users\API;

use THFW_Users\API\Signup;
use THFW_Users\API\Login;
use THFW_Users\API\Logout;

class API
{
  function __construct($auth)
  {
    new Signup($auth);
    new Login($auth);
    new Logout();
  }
}
