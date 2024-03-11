<?php

namespace SEVEN_TECH\Roles;

use SEVEN_TECH\Database\DatabaseOptions;

class Roles
{
    private $db_options;

    public function __construct()
    {
        $this->db_options = new DatabaseOptions;
        
        // remove_role('investor');
        // remove_role('founder');
        // remove_role('managing_member');
        // remove_role('executive');
        // remove_role('employee');
        // remove_role('freelancer');
    }

    function add_roles()
    {
        add_role('investor', 'Investor', get_role('contributor')->capabilities);
        add_role('founder', 'Founder', get_role('editor')->capabilities);
        add_role('managing_member', 'Managing Member', get_role('editor')->capabilities);
        add_role('executive', 'Executive', get_role('editor')->capabilities);
        add_role('employee', 'Employee', get_role('author')->capabilities);
        add_role('freelancer', 'Freelancer', get_role('author')->capabilities);
    }


    function remove_role($role)
    {
        remove_role($role);
    }

    public function update_roles($old_value, $new_value)
    {
        error_log("get_roles");

        $roles = json_encode($new_value, JSON_PRETTY_PRINT);

        return $this->db_options->update_options('orb_user_roles', $roles);
    }
}
