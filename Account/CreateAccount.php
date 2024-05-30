<?php

namespace SEVEN_TECH\Gateway\Account;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

use Kreait\Firebase\Contract\Auth;

class CreateAccount
{
    private $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    // Search for email

    // Search for username

    // Search for nicename

    // Search for phone

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
            $newFirebaseUser = $this->createFirebaseUser($email, $phone, $password, $username);
            $providergivenID = $newFirebaseUser->uid;

            if (empty($providergivenID)) {
                error_log("Unable to add user with email {$email} to firebase.");
            }

            $hashedPassword = $this->checkPassword($password);

            $role = array('subscriber');
            $roles = serialize($role);

            $user_activation_key = wp_generate_password(20, false);

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL addNewUser('%s', '%s','%s','%s','%s','%s','%s','%s','%s','%s')", $email, $username, $hashedPassword, $nicename, $nickname, $firstname, $lastname, $phone, $roles, $user_activation_key)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $account = $results[0];

            if (empty($account)) {
                throw new Exception("User could not be added.", 404);
            }

            // send signup email with activation code
            return $account;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
