<?php

namespace SEVEN_TECH\Gateway\User;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Roles\Roles;

use Exception;

use WP_User;

use Kreait\Firebase\Auth;

class User
{
    private $auth;
    private $roles;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
        $this->roles = new Roles;
    }

    public function addUser($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone, $role, $confirmationCode)
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

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL addNewUser('%s', '%s','%s','%s','%s','%s','%s','%s','%s','%s')", $email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone, $role, $confirmationCode)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            if (empty($results[0])) {
                error_log("User could not be added.");
                return '';
            }

            return $results[0];
        } catch (Exception | DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    public function getUser($query_param)
    {
        try {
            $user_data = new WP_User($query_param);

            if (empty($user_data->ID)) {
                return '';
            }

            $id = $user_data->ID;

            $firstname = get_user_meta($id, 'first_name');
            $lastname = get_user_meta($id, 'last_name');

            $user = [
                'id' => $id,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'nicename' => $user_data->data->user_nicename,
                'email' => $user_data->data->user_email,
                'url' => $user_data->data->user_url,
                'join_date' => $user_data->data->user_registered,
                'status' => $user_data->data->user_status,
                'username' => $user_data->data->display_name,
                'roles' => $this->getUserRoles($id, $user_data->roles)
            ];

            return $user;
        } catch (Exception | DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    public function addUserRole($id, $roleName, $roleDisplayName)
    {
        try {
            if (empty($id)) {
                throw new Exception('ID is required.');
            }

            $roleExists = $this->roles->roleExists($roleName, $roleDisplayName);

            if ($roleExists == false) {
                return "Role {$roleDisplayName} does not exits.";
            }

            $user = new WP_User($id);
            $user->add_role($roleName);

            $email = $user->user_email;
            $updated = wp_update_user($user);

            if (!is_int($updated)) {
                return "There has been an error adding user role.";
            }

            return "A Role of {$roleDisplayName} has been added to the user with the email {$email}.";
        } catch (Exception | DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    public function getUserRoles($id, $roles = '')
    {
        try {
            if (empty($roles)) {
                $user = new WP_User($id);
                $roles = $user->roles;
            }

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
        } catch (Exception | DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    public function removeUserRole($id, $role)
    {
        try {
            $user = new WP_User($id);
            $user_roles = $user->roles;

            $hasRole = false;

            foreach ($user_roles as $user_role) {
                if ($role == $user_role) {
                    $hasRole = true;
                }
            }

            if ($hasRole) {
                $user->remove_role($role);
            }

            $updated = wp_update_user($user);

            if (!is_int($updated)) {
                return "There has been an error removing user role.";
            }

            return "User role {$role} has been removed successfully";
        } catch (Exception | DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    public function changeUserNicename($id, $nicename)
    {
        try {
            $user = new WP_User($id);
            $user->user_nicename = $nicename;

            $updated = wp_update_user($user);

            if (!is_int($updated)) {
                return "There has been an error updating User nice name.";
            }

            return "User nicename has been changed to {$nicename} successfully";
        } catch (Exception | DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }
}
