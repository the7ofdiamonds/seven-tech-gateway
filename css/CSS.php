<?php

namespace SEVEN_TECH\CSS;

class CSS
{

    public function __construct()
    {
        add_action('wp_head', [$this, 'load_css']);
        add_action('wp_head', [$this, 'load_social_bar_css']);

        new Customizer;
    }

    function load_social_bar_css()
    {
        wp_register_style('seven_tech_social_bar',  SEVEN_TECH_URL . 'CSS/social-bar.css', array(), false, 'all');
        wp_enqueue_style('seven_tech_social_bar');
    }

    function load_css()
    {
        $pages = [
            'about',
            'founder',
            'schedule',
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
