<?php

namespace SEVEN_TECH\Gateway\Roles;

class Roles
{

    public function __construct()
    {
    }

    public function getRoles()
    {
        $wp_roles = wp_roles()->get_names();
        $roles = [];

        foreach ($wp_roles as $roleKey => $roleValue) {
            $roles[] = [
                'name' => $roleKey,
                'display_name' => $roleValue
            ];
        }

        return $roles;
    }

    public function roleExists($roleName, $roleDisplayName)
    {
        $wp_roles = $this->getRoles();

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
        $uroles = unserialize($serializedRoles);
        $wp_roles = $this->getRoles();

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

    public function getAvailableRoles()
    {
        return $this->getRoles();
    }
}
