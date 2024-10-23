<?php

namespace SEVEN_TECH\Gateway\User;

use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Model\Response\ResponseCreateUser;
use SEVEN_TECH\Gateway\Services\Google\Firebase\FirebaseAuth;

use Exception;

use Kreait\Firebase\Auth\UserRecord;

class Add
{
    private $databaseExists;
    private $firebaseAuth;

    public function __construct()
    {
        $this->databaseExists = new DatabaseExists;
        $this->firebaseAuth = new FirebaseAuth;
    }

    public function user($email, $username, $password, $confirmPassword, $nicename, $phone)
    {
        try {

            if ($password !== $confirmPassword) {
                throw new Exception("Passwords do not match reenter the same password twice.");
            }
            
            $emailExists = $this->databaseExists->existsByEmail($email);

            if ($emailExists) {
                throw new Exception('This email is currently in use check your inbox.', 400);
            }

            $usernameExists = $this->databaseExists->existsByUsername($username);

            if ($usernameExists) {
                throw new Exception('This username is in use at this time.', 400);
            }

            $nicenameExists = $this->databaseExists->existsByNicename($nicename);

            if ($nicenameExists) {
                throw new Exception('This nicename is in use at this time.', 400);
            }

            $phoneExists = $this->databaseExists->existsByPhone($phone);

            if ($phoneExists) {
                throw new Exception('This phone number is in use at this time.', 400);
            }

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
