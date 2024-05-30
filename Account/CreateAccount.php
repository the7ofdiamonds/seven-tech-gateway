<?php

namespace SEVEN_TECH\Gateway\Account;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Roles\Roles;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

use Kreait\Firebase\Contract\Auth;

class CreateAccount
{
    private $auth;
    private $roles;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
        $this->roles = new Roles;
    }

    function existsByEmail($email)
    {
        global $wpdb;

        $results = $wpdb->get_results(
            $wpdb->prepare("CALL existsByEmail('%s')", $email)
        );

        if ($wpdb->last_error) {
            throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
        }

        if (!isset($results[0])) {
            throw new Exception('There was an error searching for Account.', 404);
        }

        return $results[0]->resultSet;
    }

    function existsByUsername($username)
    {
        global $wpdb;

        $results = $wpdb->get_results(
            $wpdb->prepare("CALL existsByUsername('%s')", $username)
        );

        if ($wpdb->last_error) {
            throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
        }

        if (!isset($results[0])) {
            throw new Exception('There was an error searching for Account.', 404);
        }

        return $results[0]->resultSet;
    }

    function existsByNicename($nicename)
    {
        global $wpdb;

        $results = $wpdb->get_results(
            $wpdb->prepare("CALL existsByNicename('%s')", $nicename)
        );

        if ($wpdb->last_error) {
            throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
        }

        if (!isset($results[0])) {
            throw new Exception('There was an error searching for Account.', 404);
        }

        return $results[0]->resultSet;
    }

    // Search for phone
    function existsByPhone($phone)
    {
        global $wpdb;

        $results = $wpdb->get_results(
            $wpdb->prepare("CALL existsByPhone('%s')", $phone)
        );

        if ($wpdb->last_error) {
            throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
        }

        if (!isset($results[0])) {
            throw new Exception('There was an error searching for Account.', 404);
        }

        return $results[0]->resultSet;
    }

    // Check password
    function checkPassword($password)
    {
        // validate password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        return $hashedPassword;
    }

    function createFirebaseUser($email, $phone, $password, $username)
    {
        $newUser = [
            'email' => $email,
            'emailVerified' => false,
            'phoneNumber' => '+' . $phone,
            'password' => $password,
            'displayName' => $username,
            'disabled' => false,
        ];

        $newFirebaseUser = $this->auth->createUser($newUser);

        return $newFirebaseUser;
    }

    function createAccount($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone, $roles)
    {
        try {

            $emailExists = $this->existsByEmail($email);

            if ($emailExists == 'TRUE') {
                throw new Exception('This email is currently in use check your inbox.', 400);
            }

            $usernameExists = $this->existsByUsername($username);

            if ($usernameExists == 'TRUE') {
                throw new Exception('This username is in use at this time.', 400);
            }

            $nicenameExists = $this->existsByNicename($nicename);

            if ($nicenameExists == 'TRUE') {
                throw new Exception('This nicename is in use at this time.', 400);
            }

            $phoneExists = $this->existsByPhone($phone);

            if ($phoneExists == 'TRUE') {
                throw new Exception('This phone number is in use at this time.', 400);
            }

            $newFirebaseUser = $this->createFirebaseUser($email, $phone, $password, $username);
            $providergivenID = $newFirebaseUser->uid;
            error_log($providergivenID);
            if (empty($providergivenID)) {
                error_log("Unable to add user with email {$email} to firebase.");
            }

            $hashedPassword = $this->checkPassword($password);

            $user_activation_key = wp_generate_password(20, false);

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL createAccount('%s', '%s','%s','%s','%s','%s','%s','%s','%s')", $email, $username, $hashedPassword, $nicename, $nickname, $firstname, $lastname, $phone, $user_activation_key)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $account = $results[0];

            if (empty($account)) {
                throw new Exception("Account could not be created.", 404);
            }

            if (empty($roles)) {
                $updatedAccountID = $this->roles->addRole($account->id, 'subscriber', 'Subscriber');
            }

            if ($account->id !== $updatedAccountID) {
                throw new Exception('The wrong account may have been updated check records.');
            }
            // send signup email with activation code
            return new Account($account->email);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
