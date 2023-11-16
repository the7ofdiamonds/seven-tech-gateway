<?php

namespace SEVEN_TECH\API;

use SEVEN_TECH\API\Google\Google;

use Kreait\Firebase\Factory;

class API
{
  function __construct()
  {
    $credentialsPath = SEVEN_TECH . 'serviceAccount.json';

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
      new Google($credentialsPath);

      $factory = (new Factory)->withServiceAccount($credentialsPath);
      $auth = $factory->createAuth();

      $login = new Login($auth);
      $logout = new Logout();
      $signup = new Signup($auth);
    } else {
      error_log('A path to the Google Service Account file is required.');
    }

    $content = new Content;
    $founders = new Founders;
    $location = new Location;
    $users = new Users;

    register_rest_route('seven-tech/v1', '/content/(?P<slug>[a-zA-Z0-9-_]+)', array(
      'methods' => 'GET',
      'callback' => array($content, 'get_content'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/users/v1', '/founders', array(
      'methods' => 'GET',
      'callback' => array($founders, 'get_founders'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/users/v1', '/founder/(?P<slug>[a-zA-Z0-9-_]+)', array(
      'methods' => 'GET',
      'callback' => array($founders, 'get_founder'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/users/v1', '/founder/(?P<slug>[a-zA-Z0-9-_]+)/resume', array(
      'methods' => 'GET',
      'callback' => array($founders, 'get_founder_resume'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/location/v1', '/headquarters', array(
      'methods' => 'GET',
      'callback' => array($location, 'get_headquarters'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/users/v1', '/login', array(
      'methods' => 'POST',
      'callback' => [$login, 'login'],
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/users/v1', '/logout', array(
      'methods' => 'POST',
      'callback' => array($logout, 'logout'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/users/v1', '/signup', array(
      'methods' => 'POST',
      'callback' => array($signup, 'signup'),
      'permission_callback' => '__return_true',
    ));

    register_rest_route('seven-tech/users/v1', '/(?P<slug>[a-zA-Z0-9-_%.]+)', array(
      'methods' => 'GET',
      'callback' => array($users, 'get_user'),
      'permission_callback' => '__return_true',
    ));
  }
}
