<?php

namespace SEVEN_TECH\Gateway\Roles;

class Roles
{

    public function __construct()
    {
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
