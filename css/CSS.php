<?php

namespace SEVEN_TECH\CSS;

class CSS
{

    public function __construct()
    {
        add_action('wp_head', [$this, 'load_css']);

        new Customizer;
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
            wp_register_style('seven_tech_css',  SEVEN_TECH_URL . 'CSS/seven-tech.css', array(), false, 'all');
            wp_enqueue_style('seven_tech_css');
        }
    }
}
