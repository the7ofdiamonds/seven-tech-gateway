<?php

namespace THFW_Users\API;

use THFW_Users\API\Login;
use THFW_Users\API\Logout;

use Kreait\Firebase\Factory;

class API
{
  function __construct()
  {
    $factory = (new Factory)->withServiceAccount(THFW_USERS . 'API/serviceAccount.json');
    new Login($factory);
    new Logout($factory);
  }
}
