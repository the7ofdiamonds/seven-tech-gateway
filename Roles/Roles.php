<?php

namespace THFW_Users\Roles;

class Roles
{
    public function __construct()
    {
        add_role('founder/managing member', 'Founder/Managing Member', get_role('administrator')->capabilities);
    }
}
