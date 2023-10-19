<?php

namespace SEVEN_TECH\Templates;

class Templates
{
    public function __construct()
    {
        add_filter('frontpage_template', [$this, 'get_custom_front_page'], 10, 1);
        add_filter('page_template', [$this, 'get_custom_about_page_template']);
        add_filter('page_template', [$this, 'get_custom_schedule_page_template']);
        add_filter('page_template', [$this, 'get_custom_login_page_template']);
        add_filter('page_template', [$this, 'get_custom_signup_page_template']);
        add_filter('page_template', [$this, 'get_custom_forgot_page_template']);
        add_filter('page_template', [$this, 'get_custom_logout_page_template']);
        add_filter('page_template', [$this, 'get_custom_dashboard_page_template']);
        // add_filter('page_template', [$this, 'get_founder_page_template']);
        add_filter('template_include', [$this, 'get_founder_resume_page_template']);
        add_filter('archive_template', [$this, 'get_founder_archive_template']);
        add_filter('single_template', [$this, 'get_founder_single_template']);
        add_filter('archive_template', [$this, 'get_team_archive_template']);
        add_filter('single_template', [$this, 'get_team_single_template']);
    }

    function get_custom_front_page($frontpage_template)
    {
        if (is_front_page()) {
            $frontpage_template = SEVEN_TECH . 'Pages/front-page.php';
        }

        return $frontpage_template;
    }

    function get_custom_about_page_template($page_template)
    {

        if (is_page('about')) {
            $page_template = SEVEN_TECH . 'Pages/page-about.php';
        }

        return $page_template;
    }

    function get_custom_schedule_page_template($page_template)
    {
        $schedule_page = get_page_by_path('schedule');

        if ($schedule_page && is_page($schedule_page->ID)) {
            $page_template = SEVEN_TECH . 'Pages/page-schedule.php';

            if (file_exists($page_template)) {
                return $page_template;
            } else {
                error_log('Schedule Page Template does not exist.');
            }
        }

        return $page_template;
    }

    function get_custom_login_page_template($page_template)
    {
        if (is_page('login')) {
            $page_template = SEVEN_TECH . 'Pages/page-login.php';
        }

        return $page_template;
    }

    function get_custom_signup_page_template($page_template)
    {
        if (is_page('signup')) {
            $page_template = SEVEN_TECH . 'Pages/page-signup.php';
        }

        return $page_template;
    }

    function get_custom_forgot_page_template($page_template)
    {
        if (is_page('forgot')) {
            $page_template = SEVEN_TECH . 'Pages/page-forgot.php';
        }

        return $page_template;
    }

    function get_custom_logout_page_template($page_template)
    {

        if (is_page('logout')) {
            $page_template = SEVEN_TECH . 'Pages/page-logout.php';
        }

        return $page_template;
    }

    function get_custom_dashboard_page_template($page_template)
    {
        if (is_page('dashboard')) {
            $page_template = SEVEN_TECH . 'Pages/page-dashboard.php';
        }

        return $page_template;
    }

    function get_founder_page_template($page_template)
    {
        if (is_page('founder')) {
            $page_template = SEVEN_TECH . 'Pages/page-founder.php';

            if (file_exists($page_template)) {
                return $page_template;
            } else {
                error_log('Founder Page Template does not exist.');
            }
        }

        return $page_template;
    }

    function get_founder_resume_page_template($singular_template)
    {

        if (is_page('resume')) {
            $singular_template = SEVEN_TECH . 'Post_Types/Founders/single-founder-resume.php';

            if (file_exists($singular_template)) {
                return $singular_template;
            } else {
                error_log('Resume Page Template does not exist.');
            }
        }

        return $singular_template;
    }

    function get_founder_archive_template($archive_template)
    {
        if (is_post_type_archive('founders')) {
            $archive_template = SEVEN_TECH . 'Post_Types/Founders/archive-founder.php';
        }

        return $archive_template;
    }

    function get_founder_single_template($singular_template)
    {
        if (is_singular('founders')) {
            $singular_template = SEVEN_TECH . 'Post_Types/Founders/single-founder.php';
        }

        return $singular_template;
    }

    function get_team_archive_template($archive_template)
    {
        if (is_post_type_archive('team')) {
            $archive_template = SEVEN_TECH . 'Post_Types/Team/archive-team.php';
        }

        return $archive_template;
    }

    function get_team_single_template($singular_template)
    {
        if (is_singular('team')) {
            $singular_template = SEVEN_TECH . 'Post_Types/Team/single-team.php';
        }

        return $singular_template;
    }
}
