<?php

namespace SEVEN_TECH\Roles;

class Roles
{
    public function __construct()
    {
    }

    function add_roles()
    {
        add_role('founder', 'Founder', get_role('administrator')->capabilities);
        add_role('team member', 'Team Member', get_role('contributor')->capabilities);
    }


    function remove_role($role)
    {
        remove_role($role);
    }

    public function get_roles($old_value, $new_value)
    {
        error_log("get_roles");

        $jsonData = json_encode($new_value, JSON_PRETTY_PRINT);

        error_log($jsonData);

        return $jsonData;
    }
}
