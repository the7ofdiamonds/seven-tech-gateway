<?php

namespace SEVEN_TECH\Gateway\Account;

use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Email\EmailAccount;
use SEVEN_TECH\Gateway\Password\Password;
use SEVEN_TECH\Gateway\Roles\Roles;
use SEVEN_TECH\Gateway\Services\ServicesFirebase;

use Exception;

use Kreait\Firebase\Auth\UserRecord;

class AccountCreate
{
    private $databaseExists;
    private $password;
    private $servicesFirebase;
    private $roles;
    private $email;

    public function __construct(ServicesFirebase $servicesFirebase)
    {
        $this->databaseExists = new DatabaseExists;
        $this->password = new Password;
        $this->servicesFirebase = $servicesFirebase;
        $this->roles = new Roles;
        $this->email = new EmailAccount;
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

            $hashedPassword = $this->password->hashPassword($password);

            $user_activation_key = wp_generate_password(20, false);

            $newFirebaseUser = $this->servicesFirebase->createFirebaseUser($email, $phone, $password, $username);

            if (!$newFirebaseUser instanceof UserRecord) {
                error_log("Unable to add user with email {$email} to firebase.");
            }

            $providergivenID = $newFirebaseUser->uid;

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL createAccount('%s', '%s','%s','%s','%s','%s','%s','%s','%s','%s')", $email, $username, $hashedPassword, $nicename, $nickname, $firstname, $lastname, $phone, $user_activation_key, $providergivenID)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $account = $results[0];

            if (empty($account)) {
                throw new Exception("Account could not be created.", 404);
            }

            if (empty($roles)) {
                $this->roles->addRole($account->id, 'subscriber');
            }

            if (is_array($roles)) {
                foreach ($roles as $role) {
                    $this->roles->addRole($account->id, $role);
                }
            }

            $this->email->accountCreated($email);

            return new Account($account->email);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
