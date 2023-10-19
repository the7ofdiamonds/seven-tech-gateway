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
}
