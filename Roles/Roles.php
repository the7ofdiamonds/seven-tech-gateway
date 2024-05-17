<?php

namespace SEVEN_TECH\Gateway\Roles;

class Roles
{

    public function __construct()
    {
    }

    public function unserializeRoles($serializedRoles)
    {
        $uroles = unserialize($serializedRoles);
        $wp_roles = wp_roles()->get_names();

        $roles = [];

        foreach ($wp_roles as $roleKey => $roleValue) {
            foreach ($uroles as $key => $value) {
                if ($roleKey == $key && $value == 1) {
                    $roles[] = [
                        'name' => $roleKey,
                        'display_name' => $roleValue
                    ];
                }
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
}
