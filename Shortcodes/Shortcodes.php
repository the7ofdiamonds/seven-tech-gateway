<?php

namespace SEVEN_TECH\Shortcodes;

class Shortcodes
{
    public function __construct()
    {
        add_shortcode('thfw-about', [$this, 'about_page_shortcode']);
        add_shortcode('thfw-social-bar', [$this, 'social_bar_shortcode']);
        add_shortcode('thfw-team', [$this, 'team_shortcode']);
        add_shortcode('orb-services-schedule', [$this, 'orb_services_schedule_shortcode']);
        add_shortcode('orb-services-headquarters', [$this, 'orb_services_headquarters_shortcode']);
    }

    function about_page_shortcode() {
        include SEVEN_TECH . 'includes/part-about.php';
    }

    function social_bar_shortcode() {
        include SEVEN_TECH . 'includes/part-social-bar.php';
    }

    function team_shortcode()
    {
        include SEVEN_TECH . 'includes/section-team.php';
    }

    function orb_services_schedule_shortcode()
    {
        include SEVEN_TECH . 'includes/part-schedule.php';
    }

    function orb_services_headquarters_shortcode()
    {
        include SEVEN_TECH . 'includes/part-headquarters.php';
    }
}
