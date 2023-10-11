<?php

namespace THFW_Users\CSS;

use THFW\CSS\Customizer\Customizer;

class CSS
{

    public function __construct()
    {
        add_action('wp_head', [$this, 'load_css']);

        // new Customizer;
    }

    function load_css()
    {
        $pages = [
            'about',
            'login',
            'signup',
            'forgot',
            'logout',
            'dashboard'
        ];

        if (
            is_front_page() ||
            is_page($pages) ||
            is_post_type_archive('team') || is_singular('team')
        ) {
            wp_register_style('thfw_users_css',  THFW_USERS_URL . 'CSS/thfw-users.css', array(), false, 'all');
            wp_enqueue_style('thfw_users_css');
        }
    }
}
