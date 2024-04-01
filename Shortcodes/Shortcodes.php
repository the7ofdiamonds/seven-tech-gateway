<?php

namespace SEVEN_TECH\Shortcodes;

class Shortcodes
{
    public function __construct()
    {
        add_shortcode('seven-tech-about', [$this, 'about_page_shortcode']);
        add_shortcode('seven-tech-social-bar', [$this, 'social_bar_shortcode']);
        add_shortcode('seven-tech-team', [$this, 'team_shortcode']);
    }

    function about_page_shortcode() {
        include SEVEN_TECH . 'includes/react.php';
    }

    function social_bar_shortcode() {
        include SEVEN_TECH . 'includes/part-social-bar.php';
    }

    function team_shortcode()
    {
        include SEVEN_TECH . 'includes/react.php';
    }
}
