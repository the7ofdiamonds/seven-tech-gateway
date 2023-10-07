<?php

namespace THFW_Users\API;

class API
{
  function __construct($auth)
  {
    new Signup($auth);
    new Login($auth);
    new Logout();
    new Users();
    new Team();
  }
}
