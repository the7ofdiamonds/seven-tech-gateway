<?php

namespace SEVEN_TECH\Post_Types;

class Post_Types
{
    public $post_types;
    
    public function __construct()
    {
        new PostTypeTeam;
        new PostTypeFounders;

        $this->post_types = [
            'team',
            'employees',
            'founders',
            'executives'
        ];
    }
}
