<?php

namespace SEVEN_TECH\Templates;

use SEVEN_TECH\CSS\CSS;
use SEVEN_TECH\JS\JS;

class Templates
{
    private $css_file;
    private $js_file;

    public function __construct()
    {
        add_filter('frontpage_template', [$this, 'get_custom_front_page']);

        add_filter('template_include', [$this, 'get_custom_about_page_template']);

        add_filter('template_include', [$this, 'get_custom_login_page_template']);
        add_filter('template_include', [$this, 'get_custom_signup_page_template']);
        add_filter('template_include', [$this, 'get_custom_forgot_page_template']);
        add_filter('template_include', [$this, 'get_custom_logout_page_template']);

        add_filter('template_include', [$this, 'get_custom_dashboard_page_template']);

        add_filter('template_include', [$this, 'get_founder_resume_page_template']);

        $this->css_file = new CSS;
        $this->js_file = new JS;

        new Templates_Post_types;
    }

    function get_custom_front_page($frontpage_template)
    {
        if (is_front_page()) {
            $frontpage_template = SEVEN_TECH . 'Pages/front-page.php';

            if (file_exists($frontpage_template)) {
                add_action('wp_head', [$this->css_file, 'load_front_page_css']);
                add_action('wp_footer', [$this->js_file, 'load_front_page_react']);

                return $frontpage_template;
            }
        }

        return $frontpage_template;
    }

    function get_custom_about_page_template($template_include)
    {
        $page = '/about';

        $full_url = explode('/', $page);
        $full_path = explode('/', $_SERVER['REQUEST_URI']);

        $full_url = array_filter($full_url, function ($value) {
            return $value !== "";
        });

        $full_path = array_filter($full_path, function ($value) {
            return $value !== "";
        });

        $full_url = array_values($full_url);
        $full_path = array_values($full_path);

        $differences = array_diff($full_url, $full_path);

        if (empty($differences)) {            $template_include = SEVEN_TECH . 'Pages/page-about.php';

            if (file_exists($template_include)) {
                add_action('wp_head', [$this->css_file, 'load_pages_css']);
                add_action('wp_footer', [$this->js_file, 'load_pages_react']);

                return $template_include;
            }
        }

        return $template_include;
    }

    function get_custom_login_page_template($template_include)
    {
        $page = '/login';

        $full_url = explode('/', $page);
        $full_path = explode('/', $_SERVER['REQUEST_URI']);

        $full_url = array_filter($full_url, function ($value) {
            return $value !== "";
        });

        $full_path = array_filter($full_path, function ($value) {
            return $value !== "";
        });

        $full_url = array_values($full_url);
        $full_path = array_values($full_path);

        $differences = array_diff($full_url, $full_path);

        if (empty($differences)) {
            $template_include = SEVEN_TECH . 'Pages/page-login.php';

            if (file_exists($template_include)) {
                add_action('wp_head', [$this->css_file, 'load_pages_css']);
                add_action('wp_footer', [$this->js_file, 'load_pages_react']);

                return $template_include;
            }
        }

        return $template_include;
    }

    function get_custom_signup_page_template($template_include)
    {
        $page = '/signup';

        $full_url = explode('/', $page);
        $full_path = explode('/', $_SERVER['REQUEST_URI']);

        $full_url = array_filter($full_url, function ($value) {
            return $value !== "";
        });

        $full_path = array_filter($full_path, function ($value) {
            return $value !== "";
        });

        $full_url = array_values($full_url);
        $full_path = array_values($full_path);

        $differences = array_diff($full_url, $full_path);

        if (empty($differences)) {            $template_include = SEVEN_TECH . 'Pages/page-signup.php';

            if (file_exists($template_include)) {
                add_action('wp_head', [$this->css_file, 'load_pages_css']);
                add_action('wp_footer', [$this->js_file, 'load_pages_react']);

                return $template_include;
            }
        }

        return $template_include;
    }

    function get_custom_forgot_page_template($template_include)
    {
        $page = '/forgot';

        $full_url = explode('/', $page);
        $full_path = explode('/', $_SERVER['REQUEST_URI']);

        $full_url = array_filter($full_url, function ($value) {
            return $value !== "";
        });

        $full_path = array_filter($full_path, function ($value) {
            return $value !== "";
        });

        $full_url = array_values($full_url);
        $full_path = array_values($full_path);

        $differences = array_diff($full_url, $full_path);

        if (empty($differences)) {            $template_include = SEVEN_TECH . 'Pages/page-forgot.php';

            if (file_exists($template_include)) {
                add_action('wp_head', [$this->css_file, 'load_pages_css']);
                add_action('wp_footer', [$this->js_file, 'load_pages_react']);

                return $template_include;
            }
        }

        return $template_include;
    }

    function get_custom_logout_page_template($template_include)
    {
        $page = '/logout';

        $full_url = explode('/', $page);
        $full_path = explode('/', $_SERVER['REQUEST_URI']);

        $full_url = array_filter($full_url, function ($value) {
            return $value !== "";
        });

        $full_path = array_filter($full_path, function ($value) {
            return $value !== "";
        });

        $full_url = array_values($full_url);
        $full_path = array_values($full_path);

        $differences = array_diff($full_url, $full_path);

        if (empty($differences)) {
            $template_include = SEVEN_TECH . 'Pages/page-logout.php';

            if (file_exists($template_include)) {
                add_action('wp_head', [$this->css_file, 'load_pages_css']);
                add_action('wp_footer', [$this->js_file, 'load_pages_react']);

                return $template_include;
            }
        }

        return $template_include;
    }

    function get_custom_dashboard_page_template($template_include)
    {
        $page = '/dashboard';

        $full_url = explode('/', $page);
        $full_path = explode('/', $_SERVER['REQUEST_URI']);

        $full_url = array_filter($full_url, function ($value) {
            return $value !== "";
        });

        $full_path = array_filter($full_path, function ($value) {
            return $value !== "";
        });

        $full_url = array_values($full_url);
        $full_path = array_values($full_path);

        $differences = array_diff($full_url, $full_path);

        if (empty($differences)) {
            $template_include = SEVEN_TECH . 'Pages/page-dashboard.php';

            if (file_exists($template_include)) {
                add_action('wp_head', [$this->css_file, 'load_pages_css']);
                add_action('wp_footer', [$this->js_file, 'load_pages_react']);

                return $template_include;
            }
        }

        return $template_include;
    }

    function get_founder_resume_page_template($template_include)
    {

        if (get_query_var('resume')) {
            $template_include = SEVEN_TECH . 'Post_Types/Founders/single-founder-resume.php';

            if (file_exists($template_include)) {
                return $template_include;
            } else {
                error_log('Resume Page Template does not exist.');
            }
        }

        return $template_include;
    }
}
