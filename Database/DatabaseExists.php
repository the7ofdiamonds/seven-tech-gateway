<?php

namespace SEVEN_TECH\Gateway\Database;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

class DatabaseExists
{
    private $validator;

    public function __construct()
    {
        $this->validator = new Validator;
    }

    function existsByEmail($email)
    {
        try {
            $this->validator->isValidEmail($email);

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
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function existsByUsername($username)
    {
        try {
            $this->validator->isValidUsername($username);

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
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function existsByNicename($nicename)
    {
        try {
            $this->validator->isValidNicename($nicename);

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
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function existsByPhone($phone)
    {
        try {
            $this->validator->isValidPhone($phone);

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
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
