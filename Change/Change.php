<?php

namespace SEVEN_TECH\Gateway\Change;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Email\EmailUser;

use Exception;

use WP_User;

class Change {
    public $id;
    public $email;
    public $status;
    public $username;
    public $firstname;
    public $lastname;
    public $nickname;
    public $nicename;
    public $phone;
    public $url;

    public function __construct($email)
    {
        try {
            $user_data = new WP_User($email);

            if (empty($user_data->ID)) {
                throw new Exception('User could not be found.', 404);
            }

            $this->id = $user_data->ID;
            $this->email = $user_data->data->user_email;
            $this->status = $user_data->data->user_status;
            $this->username = $user_data->data->display_name;
            $this->firstname = get_user_meta($this->id, 'first_name');
            $this->lastname = get_user_meta($this->id, 'last_name');
            $this->nickname = get_user_meta($this->id, 'nickname');
            $this->nicename = $user_data->data->user_nicename;
            $this->phone = get_user_meta($this->id, 'phone_number');
            $this->url = $user_data->data->user_url;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function username($username)
    {
        try {
            
            if (empty($this->email)) {
                throw new Exception('Email is required.', 400);
            }

            if (empty($username)) {
                throw new Exception('Username is required.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changeUsername('$this->email', '$username')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (!isset($results[0])) {
                throw new Exception('Username could not be updated at this time.', 500);
            }

            if (!$results[0]->resultSet) {
                throw new Exception('Account with this email could not be found.', 404);
            }

            (new EmailUser)->usernameChanged($this->email, $username);

            return "Username has been changed to {$username} succesfully.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function nicename($nicename)
    {
        try {

            if (empty($this->email)) {
                throw new Exception('Email is required to change nicename.', 400);
            }

            if (empty($nicename)) {
                throw new Exception('Nicename is required to change nicename.', 400);
            }

            $user = new WP_User($this->email);
            $user->user_nicename = $nicename;

            $updated = wp_update_user($user);

            if (!is_int($updated)) {
                throw new Exception("There has been an error updating User nice name.", 500);
            }

            (new EmailUser)->nicenameChanged($this->email, $nicename);

            return "User nicename has been changed to {$nicename} successfully";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function nickname($nickname)
    {
        try {

            if (empty($this->email)) {
                throw new Exception('Email is required to change nick name.', 400);
            }

            if (empty($nickname)) {
                throw new Exception('Nick name is required to change nick name.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changeNickName('$this->email', '$nickname')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (!isset($results[0])) {
                throw new Exception('Nick name could not be changed at this time.', 500);
            }

            if (!$results[0]->resultSet) {
                throw new Exception('Account with this email could not be found.', 404);
            }

            (new EmailUser)->nicknameChanged($this->email, $nickname);

            return "Your nickname has been changed to {$nickname} succesfully.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function firstName($firstname)
    {
        try {

            if (empty($this->email)) {
                throw new Exception('Email is required to change first name.', 400);
            }

            if (empty($firstname)) {
                throw new Exception('First name is required to change first name.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changeFirstName('$this->email', '$firstname')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (!isset($results[0])) {
                throw new Exception('First name could not be changed at this time.', 500);
            }

            if (!$results[0]->resultSet) {
                throw new Exception('Account with this email could not be found.', 404);
            }

            (new EmailUser)->nameChanged($this->email, $firstname);

            return "Your first name has been changed to {$firstname} succesfully.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function lastName($lastname)
    {
        try {

            if (empty($this->email)) {
                throw new Exception('Email is required to change last name.', 400);
            }

            if (empty($lastname)) {
                throw new Exception('Last name is required to change last name.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changeLastName('$this->email', '$lastname')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (!isset($results[0])) {
                throw new Exception('Last name could not be changed at this time.', 500);
            }

            if (!$results[0]->resultSet) {
                throw new Exception('Account with this email could not be found.', 404);
            }

            (new EmailUser)->nameChanged($this->email);

            return "Your last name has been changed to {$lastname} succesfully.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function name(String $firstName, String $lastName)
    {
        try {

            if (empty($this->email)) {
                throw new Exception('Email is required.', 400);
            }

            if (!empty($firstName)) {
                $this->firstName($firstName);
            }

            if (!empty($lastName)) {
                $this->lastName($lastName);
            }

            $responseNameChanged = [
                'successMessage' => "Your name has been changed to {$firstName} {$lastName} succesfully.",
                'firstName' => $firstName,
                'lastName' => $lastName,
                'statusCode' => 200
            ];

            return $responseNameChanged;
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function phone($phone)
    {
        try {

            if (empty($this->email)) {
                throw new Exception('Email is required to change phone number.', 400);
            }

            if (empty($phone)) {
                throw new Exception('Phone number is required to change phone number.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changePhoneNumber('$this->email', '$phone')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (!isset($results[0])) {
                throw new Exception('Phone number could not be changed at this time.', 500);
            }

            if (!$results[0]->resultSet) {
                throw new Exception('Account with this email could not be found.', 404);
            }

            (new EmailUser)->phoneChanged($this->email, $phone);

            return "You phone number has been changed to {$phone} succesfully.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}