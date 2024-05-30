<?php

namespace SEVEN_TECH\Gateway\Roles;

class Roles
{

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

    public function unserializeRoles($serializedRoles)
    {
        if (empty($serializedRoles)) {
            return;
        }

        $unserializedRoles = unserialize($serializedRoles);

        $uroles = [];

        if(!is_array($unserializedRoles)){
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
