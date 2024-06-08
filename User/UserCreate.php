<?php

namespace SEVEN_TECH\Gateway\User;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Email\EmailUser;
use SEVEN_TECH\Gateway\Services\ServicesFirebase;

use Exception;

class UserCreate
{
    private $servicesFirebase;
    private $email;

    public function __construct(ServicesFirebase $servicesFirebase)
    {
        $this->servicesFirebase = $servicesFirebase;
        $this->email = new EmailUser;
    }

    public function createUser($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone)
    {
        try {
            $this->servicesFirebase->createFirebaseUser($email, $phone, $password, $username);

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL addNewUser('%s', '%s','%s','%s','%s','%s','%s','%s','%s','%s')", $email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            if (empty($results[0])) {
                error_log("User could not be added.");
                return '';
            }

            $this->email->userAdded($email);

            return $results[0];
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
