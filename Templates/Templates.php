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
    }

    function get_custom_login_page_template($page_template)
    {

        if (is_page('login')) {
            $page_template = THFW_USERS . 'pages/page-login.php';
        }

        return $page_template;
    }

    function get_custom_signup_page_template($page_template)
    {

        if (is_page('signup')) {
            $page_template = THFW_USERS . 'pages/page-signup.php';
        }

        return $page_template;
    }

    function get_custom_forgot_page_template($page_template)
    {

        if (is_page('forgot')) {
            $page_template = THFW_USERS . 'pages/page-forgot.php';
        }

        return $page_template;
    }

    function get_custom_logout_page_template($page_template)
    {

        if (is_page('logout')) {
            $page_template = THFW_USERS . 'pages/page-logout.php';
        }

        return $page_template;
    }

    function get_custom_dashboard_page_template($page_template)
    {

        if (is_page('dashboard')) {
            $page_template = THFW_USERS . 'pages/page-dashboard.php';
        }

        return $page_template;
    }
}