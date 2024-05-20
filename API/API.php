<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Authorization\Authorization;
use SEVEN_TECH\Gateway\Token\Token;

use Kreait\Firebase\Factory;

class API
{

  public function __construct()
  {
    $googleServiceAccountPath = SEVEN_TECH . 'serviceAccount.json';

    $serviceAccountValid = $this->areGoogleCredentialsPresent($googleServiceAccountPath);

    if ($serviceAccountValid) {
      $factory = (new Factory)->withServiceAccount($googleServiceAccountPath);
      $auth = $factory->createAuth();

      $token = new Token($auth);
      $authentication = new Authentication($auth);
      $authorization = new Authorization($token);

      $account = new API_Account($auth, $token);
      $authAPI = new API_Authentication($authentication);
      $password = new API_Password($authorization, $authentication);
      $user = new API_User($auth, $token);
    } else {
      error_log('A path to the Google Service Account file is required.');
    }

    register_rest_route('seven-tech/v1', '/account/create', array(
      'methods' => 'POST',
      'callback' => array($account, 'createAccount'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/account/lock', array(
      'methods' => 'POST',
      'callback' => array($account, 'lockAccount'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/account/unlock', array(
      'methods' => 'POST',
      'callback' => array($account, 'unlockAccount'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/account/enable', array(
      'methods' => 'POST',
      'callback' => array($account, 'enableAccount'),
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

    register_rest_route('seven-tech/v1', '/authentication/logoutAll', array(
      'methods' => 'POST',
      'callback' => array($authAPI, 'logoutAll'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/password/forgot', array(
      'methods' => 'POST',
      'callback' => array($password, 'forgotPassword'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/password/change', array(
      'methods' => 'POST',
      'callback' => array($password, 'changePassword'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/password/update', array(
      'methods' => 'POST',
      'callback' => array($password, 'updatePassword'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/user/add', array(
      'methods' => 'POST',
      'callback' => array($user, 'addUser'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/user/change-username', array(
      'methods' => 'POST',
      'callback' => array($user, 'changeUsername'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/user/change-name', array(
      'methods' => 'POST',
      'callback' => array($user, 'changeName'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/user/change-nickname', array(
      'methods' => 'POST',
      'callback' => array($user, 'changeNickname'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/user/change-phone', array(
      'methods' => 'POST',
      'callback' => array($user, 'changePhone'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/user/add-role', array(
      'methods' => 'POST',
      'callback' => array($user, 'addUserRole'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/user/remove-role', array(
      'methods' => 'POST',
      'callback' => array($user, 'removeUserRole'),
      'permission_callback' => '__return_true',
    ));
  }
// Show result in the admin area
  private function areGoogleCredentialsPresent($credentialsPath)
  {
    if (!file_exists($credentialsPath)) {
      return false;
    }

    $jsonFileContents = file_get_contents($credentialsPath);

    if ($jsonFileContents === false) {
      return false;
    }

    $decodedData = json_decode($jsonFileContents, true);

    if (json_last_error() !== JSON_ERROR_NONE && !is_array($decodedData)) {
      return false;
    }

    if (!isset($decodedData['type']) && $decodedData['type'] !== 'service_account') {
      return false;
    }

    if (!isset($decodedData['project_id'])) {
      return false;
    }

    if (!isset($decodedData['private_key_id'])) {
      return false;
    }

    if (!isset($decodedData['private_key'])) {
      return false;
    }

    if (!isset($decodedData['client_email'])) {
      return false;
    }

    return true;
  }
}
