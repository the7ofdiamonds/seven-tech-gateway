<?php

namespace SEVEN_TECH\Gateway\Roles;

use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

use WP_Error;
use WP_User;

class Roles
{
    public function roleExists($roleName, $roleDisplayName)
    {
        $wp_roles = wp_roles()->get_names();

        $roleExists = false;

        foreach ($wp_roles as $roleKey => $roleValue) {
            if ($roleKey == $roleName && $roleValue == $roleDisplayName) {
                $roleExists = true;
                break;
            }
        }

        return $roleExists;
    }

    public function addRole($id, $roleName, $roleDisplayName)
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

            $roleExists = $this->roleExists($roleName, $roleDisplayName);

            if ($roleExists == false) {
                throw new Exception("Role {$roleDisplayName} does not exits.", 404);
            }

            $user = new WP_User($id);
            $user->add_role($roleName);

            $updated = wp_update_user($user);

            if (!is_int($updated)) {
                throw new Exception("There has been an error adding user role.", 500);
            }

            return $updated;
        } catch (WP_Error $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function removeRole($id, $roleName)
    {
        try {
            if (empty($id)) {
                throw new Exception('ID is required to remove role.');
            }

            if (empty($roleName)) {
                throw new Exception('Role name is required to remove role.');
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

    public function getRoles()
    {
        $roles = [];

        foreach (wp_roles()->roles as $roleKey => $roleValue) {
            if (isset($roleValue['capabilities']['level_1']) && $roleValue['capabilities']['level_1'] != 1) {
                $roles[] = [
                    'name' => $roleKey,
                    'display_name' => $roleValue['name']
                ];
            }
        }

        return $roles;
    }

    public function unserializeRoles($serializedRoles)
    {
        if (empty($serializedRoles)) {
            return;
        }

        $unserializedRoles = unserialize($serializedRoles);

        $uroles = [];

        if (!is_array($unserializedRoles)) {
            $uroles[] = $unserializedRoles;
        } else {
            $uroles = $unserializedRoles;
        }

        $wp_roles = wp_roles()->get_names();

        $roles = [];

        foreach ($wp_roles as $roleName => $roleDisplayName) {
            if ($this->roleExists($roleName, $roleDisplayName)) {
                foreach ($uroles as $key => $value) {
                    if ($roleName == $key && $value == 1) {
                        $roles[] = [
                            'name' => $roleName,
                            'display_name' => $roleDisplayName
                        ];
                    }
                }
            }
        }

        return $roles;
    }

    public function getRolesHighestLevel($roles)
    {
        if (!is_array($roles)) {
            return;
        }

        $highest_level = 0;
        $levels = [];

        foreach (wp_roles()->roles as $roleKey => $roleValue) {
            foreach ($roles as $role) {
                if ($roleKey == $role['name'] && $roleValue['name'] == $role['display_name']) {
                    foreach ($roleValue['capabilities'] as $capKey => $capValue) {
                        if (strpos($capKey, 'level_') === 0) {
                            $level_num = str_replace('level_', '', $capKey);

                            $levels[] = $level_num;
                        }
                    }
                }
            }
        }

        if (count($levels) >= 1) {
            $highest_level = max($levels);
        }

        return $highest_level;
    }

    public function getAvailableRoles($highest_level)
    {
        $availableRoles = [];

        $level_num = str_replace('level_', '', $highest_level) + 1;

        foreach (wp_roles()->roles as $roleKey => $roleValue) {
            if (!isset($roleValue['capabilities']["level_{$level_num}"])) {
                $availableRoles[] = [
                    'name' => $roleKey,
                    'display_name' => $roleValue['name']
                ];
            }
        }

        return $availableRoles;
    }
}
