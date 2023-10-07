<?php

namespace THFW_Users\Templates;

class Templates
{
    public function __construct()
    {
        add_filter('page_template', [$this, 'get_custom_login_page_template']);
        add_filter('page_template', [$this, 'get_custom_signup_page_template']);
        add_filter('page_template', [$this, 'get_custom_forgot_page_template']);
        add_filter('page_template', [$this, 'get_custom_logout_page_template']);
        add_filter('page_template', [$this, 'get_custom_dashboard_page_template']);
        add_filter('archive_template', [$this, 'get_team_archive_template']);
        add_filter('single_template', [$this, 'get_team_single_template']);
    }

    function get_custom_login_page_template($page_template)
    {
        if (is_page('login')) {
            $page_template = THFW_USERS . 'Pages/page-login.php';
        }

        return $page_template;
    }

    function get_custom_signup_page_template($page_template)
    {
        if (is_page('signup')) {
            $page_template = THFW_USERS . 'Pages/page-signup.php';
        }

        return $page_template;
    }

    function get_custom_forgot_page_template($page_template)
    {
        if (is_page('forgot')) {
            $page_template = THFW_USERS . 'Pages/page-forgot.php';
        }

        return $page_template;
    }

    function get_custom_logout_page_template($page_template)
    {

        if (is_page('logout')) {
            $page_template = THFW_USERS . 'Pages/page-logout.php';
        }

        return $page_template;
    }

    function get_custom_dashboard_page_template($page_template)
    {
        if (is_page('dashboard')) {
            $page_template = THFW_USERS . 'Pages/page-dashboard.php';
        }

        return $page_template;
    }

    function get_team_archive_template($archive_template)
    {
        if (is_post_type_archive('team')) {
            $archive_template = THFW_USERS . 'Pages/archive-team.php';
        }

        return $archive_template;
    }

    function get_team_single_template($singular_template)
    {
        if (is_singular('team')) {
            $singular_template = THFW_USERS . 'Pages/single-team.php';
        }

        return $singular_template;
    }
}
