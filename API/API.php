<?php

namespace SEVEN_TECH\Gateway\API;

class API
{
  public function __construct()
  {
    $accountAPI = new API_Account();
    $authAPI = new API_Authentication();
    $changeAPI = new API_Change();
    $emailAPI = new API_Email();
    $passwordAPI = new API_Password();
    $rolesAPI = new API_Roles();
    $userAPI = new API_User();

    register_rest_route('seven-tech/v1', '/account/create', array(
      'methods' => 'POST',
      'callback' => array($accountAPI, 'register'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/account/activate', array(
      'methods' => 'POST',
      'callback' => array($accountAPI, 'activate'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/account/lock', array(
      'methods' => 'POST',
      'callback' => array($accountAPI, 'lock'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/account/unlock', array(
      'methods' => 'POST',
      'callback' => array($accountAPI, 'unlock'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/account/disable', array(
      'methods' => 'POST',
      'callback' => array($accountAPI, 'disable'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/account/enable', array(
      'methods' => 'POST',
      'callback' => array($accountAPI, 'enable'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/auth/login', array(
      'methods' => 'POST',
      'callback' => array($authAPI, 'login'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/auth/logout', array(
      'methods' => 'POST',
      'callback' => array($authAPI, 'logout'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/auth/logout-all', array(
      'methods' => 'POST',
      'callback' => array($authAPI, 'logoutAll'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/change/username', array(
      'methods' => 'POST',
      'callback' => array($changeAPI, 'username'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/change/nicename', array(
      'methods' => 'POST',
      'callback' => array($changeAPI, 'nicename'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/change/nickname', array(
      'methods' => 'POST',
      'callback' => array($changeAPI, 'nickname'),
      'permission_callback' => '__return_true',
    ));
    
    register_rest_route('seven-tech/v1', '/change/name', array(
      'methods' => 'POST',
      'callback' => array($changeAPI, 'name'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/change/phone', array(
      'methods' => 'POST',
      'callback' => array($changeAPI, 'phone'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/email/add', array(
      'methods' => 'POST',
      'callback' => array($emailAPI, 'add'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/email/remove', array(
      'methods' => 'POST',
      'callback' => array($emailAPI, 'remove'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/password/forgot', array(
      'methods' => 'POST',
      'callback' => array($passwordAPI, 'forgot'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/password/change', array(
      'methods' => 'POST',
      'callback' => array($passwordAPI, 'change'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/password/update', array(
      'methods' => 'POST',
      'callback' => array($passwordAPI, 'updated'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/user/add', array(
      'methods' => 'POST',
      'callback' => array($userAPI, 'add'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/user/get', array(
      'methods' => 'POST',
      'callback' => array($userAPI, 'get'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/roles/get', array(
      'methods' => 'POST',
      'callback' => array($rolesAPI, 'getRoles'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/roles/available', array(
      'methods' => 'POST',
      'callback' => array($rolesAPI, 'getAvailableRoles'),
      'permission_callback' => '__return_true',
    ));
    
    register_rest_route('seven-tech/v1', '/user/roles/add', array(
      'methods' => 'POST',
      'callback' => array($userAPI, 'addUserRole'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/user/roles/remove', array(
      'methods' => 'POST',
      'callback' => array($userAPI, 'removeUserRole'),
      'permission_callback' => '__return_true',
    ));
  }
}
