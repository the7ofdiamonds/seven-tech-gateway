<?php

namespace SEVEN_TECH\Gateway\User;

use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Model\Response\ResponseCreateUser;
use SEVEN_TECH\Gateway\Password\Password;
use SEVEN_TECH\Gateway\Services\Google\Firebase\FirebaseAuth;
use SEVEN_TECH\Gateway\Email\EmailUser;

use Exception;

use Kreait\Firebase\Auth\UserRecord;

class UserCreate
{
    private $databaseExists;
    private $password;
    private $firebaseAuth;
    private $email;

    public function __construct()
    {
        $this->databaseExists = new DatabaseExists;
        $this->password = new Password;
        $this->firebaseAuth = new FirebaseAuth;
        $this->email = new EmailUser;
    }

    public function createUser($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone)
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

            // $hashedPassword = $this->password->hashPassword($password);

            $user_id = wp_create_user( 
                $username, 
                $password, 
                $email 
            );

            $newFirebaseUser = $this->firebaseAuth->createFirebaseUser($email, $phone, $password, $username);

            if (!$newFirebaseUser instanceof UserRecord) {
                error_log("Unable to add user with email {$email} to firebase.");
            }

            $providergivenID = $newFirebaseUser->uid;

            return new ResponseCreateUser($user_id, $providergivenID);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
