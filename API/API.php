<?php

namespace SEVEN_TECH\Gateway\API;

class API
{
  public function __construct()
  {
    $accountAPI = new API_Account();
    $authAPI = new API_Authentication();
    $passwordAPI = new API_Password();
    $rolesAPI = new API_Roles();
    $userAPI = new API_User();

    register_rest_route('seven-tech/v1', '/account/create', array(
      'methods' => 'POST',
      'callback' => array($accountAPI, 'createAccount'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/account/lock', array(
      'methods' => 'POST',
      'callback' => array($accountAPI, 'lockAccount'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/account/unlock', array(
      'methods' => 'POST',
      'callback' => array($accountAPI, 'unlockAccount'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/account/enable', array(
      'methods' => 'POST',
      'callback' => array($accountAPI, 'enableAccount'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/authentication/login', array(
      'methods' => 'POST',
      'callback' => array($authAPI, 'login'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/authentication/logout', array(
      'methods' => 'POST',
      'callback' => array($authAPI, 'logout'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/authentication/logout-all', array(
      'methods' => 'POST',
      'callback' => array($authAPI, 'logoutAll'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/password/forgot', array(
      'methods' => 'POST',
      'callback' => array($passwordAPI, 'recoverPassword'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/password/change', array(
      'methods' => 'POST',
      'callback' => array($passwordAPI, 'changePassword'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/password/update', array(
      'methods' => 'POST',
      'callback' => array($passwordAPI, 'updatePassword'),
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

    register_rest_route('seven-tech/v1', '/user/add', array(
      'methods' => 'POST',
      'callback' => array($userAPI, 'addUser'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/user/get', array(
      'methods' => 'POST',
      'callback' => array($userAPI, 'getUser'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/user/change-username', array(
      'methods' => 'POST',
      'callback' => array($userAPI, 'changeUsername'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/user/change-name', array(
      'methods' => 'POST',
      'callback' => array($userAPI, 'changeName'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/user/change-nickname', array(
      'methods' => 'POST',
      'callback' => array($userAPI, 'changeNickname'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/user/change-nicename', array(
      'methods' => 'POST',
      'callback' => array($userAPI, 'changeNicename'),
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

    register_rest_route('seven-tech/v1', '/user/change-phone', array(
      'methods' => 'POST',
      'callback' => array($userAPI, 'changePhone'),
      'permission_callback' => '__return_true',
    ));
  }
}
