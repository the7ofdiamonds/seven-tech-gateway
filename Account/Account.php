<?php

namespace SEVEN_TECH\Gateway\Account;

use Exception;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Validator\Validator;
use SEVEN_TECH\Gateway\Roles\Roles;

use Kreait\Firebase\Auth;

class Account
{
    private $auth;
    private $validator;
    private $roles;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
        $this->validator = new Validator;
        $this->roles = new Roles;
    }

    // Search for email

    // Search for username

    // Search for nicename

    // Search for phone

    function createAccount($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone, $roles)
    {
        try {
            $newUser = [
                'email' => $email,
                'emailVerified' => false,
                'phoneNumber' => '+' . $phone,
                'password' => $password,
                'displayName' => $username,
                'disabled' => false,
            ];

            $newFirebaseUser = $this->auth->createUser($newUser);
            $providergivenID = $newFirebaseUser->uid;

            if (empty($providergivenID)) {
                error_log("Unable to add user with email {$email} to firebase.");
            }

            global $wpdb;

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $user_roles = [];

            foreach ($roles as $role) {
                $user_roles[$role] = 1;
            }

            $added_roles = serialize($user_roles);
            $user_activation_key = wp_generate_password(20, false);

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL addNewUser('%s', '%s','%s','%s','%s','%s','%s','%s','%s','%s')", $email, $username, $hashedPassword, $nicename, $nickname, $firstname, $lastname, $phone, $added_roles, $user_activation_key)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $account = $results[0];

            if (empty($account)) {
                throw new Exception("User could not be added.", 404);
            }

            $account->roles = $this->roles->unserializeRoles($account->roles);
            
// send signup email with activation code
            return $account;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function findAccount($email)
    {
        try {
            if (empty($email)) {
                throw new Exception('Email is required.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL findUserByEmail('%s')", $email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $account = $results[0];

            if (empty($account)) {
                throw new Exception('Account could not be found.', 404);
            }

            $account->roles = $this->roles->unserializeRoles($account->roles);

            return $account;
               } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }catch (Exception $e) {
            throw new DestructuredException($e);
        }

    }

    function getAccountStatus($id)
    {
        try {
            if (empty($id)) {
                throw new Exception('ID is required.', 400);
            }

            $account_status = get_user_meta($id, 'session_tokens');

            if ($account_status == false) {
                throw new Exception('User ID is not valid.', 400);
            }

            return $account_status;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function verifyAccount($email, $password, $confirmationCode)
    {
        try {
            $validConfirmationCode = $this->validator->validConfirmationCode($confirmationCode);

            if (!$validConfirmationCode) {
                return false;
            }

            $password = $this->validator->validPassword($password);

            if (!$password) {
                return false;
            }

            $validEmail = $this->validator->validEmail($email);

            if (!$validEmail) {
                throw new Exception('Email is not valid', 400);
            }

            $account = $this->findAccount($email);

            $password_check = wp_check_password($password, $account->password, $account->id);

            if (!$password_check) {
                return false;
            }

            if ($confirmationCode != $account->confirmationCode) {
                return false;
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    // Send account locked email
    public function lockAccount($email)
    {
        try {
            $user = $this->findAccount($email);

            $user_id = $user->id;

            $accountLocked = add_user_meta($user_id, 'is_account_non_locked', 0, true);

            if (is_int($accountLocked)) {
                return 'Account removed succesfully.';
            }

            $password = $user->password;

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL lockAccount('%s', '%s')", $email, $password)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || !$results[0]->resultSet) {
                throw new Exception('Account could not be locked at this time.', 500);
            }

            return 'Account has been locked successfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function unlockAccount($email)
    {
        try {
            $user = $this->findAccount($email);

            global $wpdb;

            $password = $user->password;
            $confirmationCode = $user->confirmation_code;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL unlockAccount('%s', '%s', '%s')", $email, $password, $confirmationCode)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || !$results[0]->resultSet) {
                throw new Exception('Account could not be removed at this time.', 500);
            }

            return 'Account has been unlocked succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    // Send account removed email
    function disableAccount($email)
    {
        try {
            $user = $this->findAccount($email);

            if ($user == '') {
                throw new Exception("Account could not be found.", 404);
            }

            $user_id = $user->id;

            $accountDisabled = add_user_meta($user_id, 'is_enabled', 0, true);

            if (is_int($accountDisabled)) {
                return 'Account removed succesfully.';
            }

            $password = $user->password;

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL disableAccount('%s', '%s')", $email, $password)
            );

            $accountDisabled = $results[0]->resultSet;

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (!$accountDisabled) {
                throw new Exception('Account could not be removed at this time.', 500);
            }

            return 'Account removed succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

     // Send account enabled email
     function enableAccount($email)
     {
         try { 
             $user = $this->findAccount($email);
 
             if ($user == '') {
                 throw new Exception("Account could not be found.", 404);
             }
 
             $user_id = $user->id;
 
             $accountDisabled = add_user_meta($user_id, 'is_enabled', 0, true);
 
             if (!is_int($accountDisabled)) {
                 throw new Exception('Account removed succesfully.');
             }
 
             $password = $user->password;
 
             global $wpdb;
 
             $results = $wpdb->get_results(
                 $wpdb->prepare("CALL enableAccount('%s', '%s')", $email, $password)
             );
 
             $accountDisabled = $results[0]->resultSet;
 
             if ($wpdb->last_error) {
                 throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
             }
 
             if (!$accountDisabled) {
                 throw new Exception('Account could not be removed at this time.', 500);
             }
 
             $message = 'Account removed succesfully.';
 
             wp_send_json_success($message);
         } catch (Exception $e) {
            throw new DestructuredException($e);
         }
     }
}
