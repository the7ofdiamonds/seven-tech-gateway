<?php

namespace SEVEN_TECH\Roles;

use SEVEN_TECH\Database\DatabaseOptions;
use SEVEN_TECH\Database\DatabaseUserMeta;

class Roles
{
    private $db_options;
    private $db_usermeta;

    public function __construct()
    {
        $this->db_options = new DatabaseOptions;
        $this->db_usermeta = new DatabaseUserMeta;
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
        $roles = json_encode($new_value, JSON_PRETTY_PRINT);

        return $this->db_options->update_options('orb_user_roles', $roles);
    }

    public function update_user_roles($user_id, $role)
    {
        $wp_cap = get_user_meta($user_id, 'wp_capabilities', true);

        $user_roles = json_encode($wp_cap, JSON_PRETTY_PRINT);

        return $this->db_usermeta->update_usermeta($user_id, 'orb_capabilities', $user_roles);
    }
}
