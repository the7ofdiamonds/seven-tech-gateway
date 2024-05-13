<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\User\User;

use Kreait\Firebase\Factory;

class API
{

  public function __construct()
  {
    $credentialsPath = SEVEN_TECH . 'serviceAccount.json';

    $user = new User;

    if (file_exists($credentialsPath)) {
      $jsonFileContents = file_get_contents($credentialsPath);


      if ($jsonFileContents !== false) {
        $decodedData = json_decode($jsonFileContents, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decodedData)) {
          if (
            isset($decodedData['type']) && $decodedData['type'] === 'service_account' &&
            isset($decodedData['project_id']) &&
            isset($decodedData['private_key_id']) &&
            isset($decodedData['private_key']) &&
            isset($decodedData['client_email'])
          ) {
            $credentialsPath = SEVEN_TECH . 'serviceAccount.json';
          } else {
            error_log('This is not a valid service account JSON');
            $credentialsPath = null;
          }
        } else {
          error_log('Failed to decode JSON');
          $credentialsPath = null;
        }
      } else {
        error_log('Failed to read file contents');
        $credentialsPath = null;
      }
    } else {
      error_log('File does not exist');
      $credentialsPath = null;
    }

    if ($credentialsPath !== null) {
      $factory = (new Factory)->withServiceAccount($credentialsPath);
      $auth = $factory->createAuth();

      $account = new Account($auth);
      $change = new Change($auth);
      $login = new Login($auth);
      $logout = new Logout();
      $password = new Password($auth);
      $signup = new Signup($auth, $user);
      $token = new Token($auth);
    } else {
      error_log('A path to the Google Service Account file is required.');
    }

    register_rest_route('seven-tech/v1', '/users/verify-email', array(
      'methods' => 'POST',
      'callback' => array($account, 'verifyAccount'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/users/unlock-account', array(
      'methods' => 'POST',
      'callback' => array($account, 'unlockAccount'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/users/remove-account', array(
      'methods' => 'POST',
      'callback' => array($account, 'removeAccount'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/users/change-username', array(
      'methods' => 'POST',
      'callback' => array($change, 'changeUsername'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/users/change-name', array(
      'methods' => 'POST',
      'callback' => array($change, 'changeName'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/users/change-phone', array(
      'methods' => 'POST',
      'callback' => array($change, 'changePhone'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/users/login', array(
      'methods' => 'POST',
      'callback' => [$login, 'login'],
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/users/logout', array(
      'methods' => 'POST',
      'callback' => [$logout, 'logout'],
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/users/change-password', array(
      'methods' => 'POST',
      'callback' => array($password, 'changePassword'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/users/update-password', array(
      'methods' => 'POST',
      'callback' => array($password, 'updatePassword'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/users/forgot-password', array(
      'methods' => 'POST',
      'callback' => array($password, 'forgotPassword'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/users/signup', array(
      'methods' => 'POST',
      'callback' => array($signup, 'signup'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/v1', '/users/token', array(
      'methods' => 'POST',
      'callback' => [$token, 'token'],
      'permission_callback' => '__return_true',
    ));
  }
}
