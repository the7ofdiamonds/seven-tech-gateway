<?php

namespace SEVEN_TECH\Gateway\User;

use Exception;

use WP_User;

use SEVEN_TECH\Gateway\Validator\Validator;
use SEVEN_TECH\Gateway\Roles\Roles;

class User
{
    private $validator;
    private $roles;

    public function __construct()
    {
        $this->validator = new Validator;
        $this->roles = new Roles;
    }

    public function addNewUser($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone, $role, $confirmationCode)
    {
        global $wpdb;

        $results = $wpdb->get_results(
            $wpdb->prepare("CALL addNewUser('%s', '%s','%s','%s','%s','%s','%s','%s','%s','%s')", $email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone, $role, $confirmationCode)
        );

        if ($wpdb->last_error) {
            error_log("Error executing stored procedure: " . $wpdb->last_error);
            throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
        }

        if (empty($results[0])) {
            error_log("User could not be added.");
            return '';
        }

        return $results[0];
    }

    public function findUserByEmail($email)
    {
        try {
            // $validEmail = $this->validator->validEmail($email);

            // if (!$validEmail) {
            //     throw new Exception('Email is not valid', 400);
            // }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL findUserByEmail('%s')", $email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            if (empty($results[0])) {
                return '';
            }

            return $results[0];
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function verifyAccount($email, $password, $confirmationCode)
    {
        $validConfirmationCode = $this->validator->validConfirmationCode($confirmationCode);

        if (!$validConfirmationCode) {
            return false;
        }

        $password = $this->validator->validPassword($password);

        if (!$password) {
            return false;
        }

        $user = $this->findUserByEmail($email);

        $password_check = wp_check_password($password, $user->password, $user->id);

        if (!$password_check) {
            return false;
        }

        if ($confirmationCode != $user->confirmationCode) {
            return false;
        }

        return true;
    }

    public function addUserRole($id, $roleName, $roleDisplayName)
    {
        $roleExists = $this->roles->roleExists($roleName, $roleDisplayName);

        if (!$roleExists) {
            return "Role {$roleDisplayName} does not exits.";
        }

        $user = new WP_User($id);
        $user->add_role($roleName);

        return $user;
    }

    public function getUserRoles($id)
    {
        $user = new WP_User($id);
        $roles = $user->roles;

        $wp_roles = wp_roles()->get_names();

        $user_roles = [];

        foreach ($wp_roles as $roleKey => $roleValue) {
            foreach ($roles as $role) {
                if ($roleKey == $role) {
                    $user_roles[] = [
                        'name' => $roleKey,
                        'display_name' => $roleValue
                    ];
                }
            }
        }

        return $user_roles;
    }

    public function removeUserRole($id, $role)
    {
        $user = new WP_User($id);
        $user->remove_role($role);

        return $user;
    }

    public function changeUserNicename($id, $nicename)
    {
        $user_data = get_userdata($id);
        $user_data->user_nicename = $nicename;

        $updated = wp_update_user($user_data);

        if (!is_int($updated)) {
            return "There has been an error updating User nice name.";
        }

        return "User nice name has been updated successfully";
    }
}
