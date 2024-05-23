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
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
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
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    // Send username changed email
    function changeUsername($email, $username)
    {
        try {
            if (empty($email)) {
                throw new Exception('Email is required.', 400);
            }

            if (empty($username)) {
                throw new Exception('Username is required.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changeUsername('$email', '$username')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                throw new Exception('Username could not be updated at this time.', 500);
            }

            return "Username has been changed to {$username} succesfully.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    // Send name changed email
    function changeFirstName($email, $firstname)
    {
        try {
            if (empty($email)) {
                throw new Exception('Email is required to change first name.', 400);
            }

            if (empty($firstname)) {
                throw new Exception('First name is required to change first name.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changeFirstName('$email', '$firstname')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            // $results = $results[0]->resultSet;
            error_log(print_r($results, true));
            // if (!$results) {
            //     throw new Exception('First name could not be changed at this time.', 400);
            // }

            return "Your first name has been changed to {$firstname} succesfully.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function changeLastName($email, $lastname)
    {
        try {
            if (empty($email)) {
                throw new Exception('Email is required to change last name.', 400);
            }

            if (empty($lastname)) {
                throw new Exception('Last name is required to change last name.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changeLastName('$email', '$lastname')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                throw new Exception('Last name could not be changed at this time.', 400);
            }

            return "Your last name has been changed to {$lastname} succesfully.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function changeNickname($email, $nickname)
    {
        try {
            if (empty($email)) {
                throw new Exception('Email is required to change nick name.', 400);
            }

            if (empty($nickname)) {
                throw new Exception('Nick name is required to change nick name.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changeNickName('$email', '$nickname')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                throw new Exception('Nick name could not be changed at this time.', 400);
            }

            return "Your nickname has been changed to {$nickname} succesfully.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    // Send phone number changed email
    function changePhone($email, $phone)
    {
        try {
            if (empty($email)) {
                throw new Exception('Email is required to change phone number.', 400);
            }

            if (empty($phone)) {
                throw new Exception('Phone number is required to change phone number.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changePhoneNumber('$email', '$phone')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                throw new Exception('Phone number could not be changed at this time.', 500);
            }

            return "You phone number has been changed to {$phone} succesfully.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function getUserRoles($id, $roles = '')
    {
        try {
            if (empty($id)) {
                throw new Exception('ID is required to get roles.');
            }

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
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function addUserRole($id, $roleName, $roleDisplayName)
    {
        try {
            if (empty($id)) {
                throw new Exception('ID is required to add role.');
            }

            if (empty($roleName)) {
                throw new Exception('Role name is required to add role.');
            }

            if (empty($roleDisplayName)) {
                throw new Exception('Role display name is required to add role.');
            }

            $roleExists = $this->roles->roleExists($roleName, $roleDisplayName);

            if ($roleExists == false) {
                throw new Exception("Role {$roleDisplayName} does not exits.", 404);
            }

            $user = new WP_User($id);
            $user->add_role($roleName);

            $email = $user->user_email;
            $updated = wp_update_user($user);

            if (!is_int($updated)) {
                throw new Exception("There has been an error adding user role.", 500);
            }

            return "A Role of {$roleDisplayName} has been added to the user with the email {$email}.";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function removeUserRole($id, $roleName)
    {
        try {
            if (empty($id)) {
                throw new Exception('ID is required to add role.');
            }

            if (empty($roleName)) {
                throw new Exception('Role name is required to add role.');
            }

            $user = new WP_User($id);
            $user_roles = $user->roles;

            $hasRole = false;

            foreach ($user_roles as $user_role) {
                if ($roleName == $user_role) {
                    $hasRole = true;
                }
            }

            if ($hasRole) {
                $user->remove_role($roleName);
            }

            $updated = wp_update_user($user);

            if (!is_int($updated)) {
                return "There has been an error removing user role.";
            }

            return "User role {$roleName} has been removed successfully";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function changeUserNicename($id, $nicename)
    {
        try {
            if (empty($id)) {
                throw new Exception('ID is required to change nicename.', 400);
            }

            if (empty($nicename)) {
                throw new Exception('Nicename is required to change nicename.', 400);
            }

            $user = new WP_User($id);
            $user->user_nicename = $nicename;

            $updated = wp_update_user($user);

            if (!is_int($updated)) {
                throw new Exception("There has been an error updating User nice name.", 500);
            }

            return "User nicename has been changed to {$nicename} successfully";
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
