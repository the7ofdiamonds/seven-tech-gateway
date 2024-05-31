<?php

namespace SEVEN_TECH\Gateway\Account;

use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Password\Password;
use SEVEN_TECH\Gateway\Roles\Roles;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

use Kreait\Firebase\Contract\Auth;

class CreateAccount
{
    private $password;
    private $auth;
    private $roles;
    private $databaseExists;

    public function __construct(Auth $auth)
    {
        $this->password = new Password;
        $this->auth = $auth;
        $this->roles = new Roles;
        $this->databaseExists = new DatabaseExists;
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
            $emailExists = $this->databaseExists->existsByEmail($email);

            if ($emailExists == 'TRUE') {
                throw new Exception('This email is currently in use check your inbox.', 400);
            }

            $usernameExists = $this->databaseExists->existsByUsername($username);

            if ($usernameExists == 'TRUE') {
                throw new Exception('This username is in use at this time.', 400);
            }

            $nicenameExists = $this->databaseExists->existsByNicename($nicename);

            if ($nicenameExists == 'TRUE') {
                throw new Exception('This nicename is in use at this time.', 400);
            }

            $phoneExists = $this->databaseExists->existsByPhone($phone);

            if ($phoneExists == 'TRUE') {
                throw new Exception('This phone number is in use at this time.', 400);
            }

            $newFirebaseUser = $this->createFirebaseUser($email, $phone, $password, $username);
            $providergivenID = $newFirebaseUser->uid;

            if (empty($providergivenID)) {
                error_log("Unable to add user with email {$email} to firebase.");
            }

            $hashedPassword = $this->password->hashPassword($password);

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
