<?php

namespace SEVEN_TECH\Router;

use Exception;

use SEVEN_TECH\Pages\Pages;
use SEVEN_TECH\Post_Types\Post_Types;
use SEVEN_TECH\Templates\Templates;

class Router
{
    private $custom_pages_list;
    private $protected_pages_list;
    private $pages_list;
    private $post_types;
    private $templates;

    public function __construct()
    {
        $pages = new Pages;
        $posttypes = new Post_Types;
        $this->templates = new Templates;

        $this->custom_pages_list = $pages->custom_pages_list;
        $this->protected_pages_list = $pages->protected_pages_list;
        $this->pages_list = $pages->pages_list;
        $this->post_types = $posttypes->post_types;
    }

    function load_page()
    {
        try {
            $path = $_SERVER['REQUEST_URI'];

            if ($path === '/') {
                add_filter('frontpage_template', [$this->templates, 'get_front_page_template']);
                return;
            }

            if (!empty($this->custom_pages_list)) {
                if (preg_match('#/about#', $path)) {
                    add_filter('template_include', [$this->templates, 'get_about_page_template']);
                }

                if (preg_match('#/dashboard#', $path)) {
                    add_filter('template_include', [$this->templates, 'get_dashboard_page_template']);
                }

                if (preg_match('#/forgot#', $path)) {
                    add_filter('template_include', [$this->templates, 'get_forgot_page_template']);
                }

                if (preg_match('#/logout#', $path)) {
                    add_filter('template_include', [$this->templates, 'get_logout_page_template']);
                }

                if (preg_match('#/founders/([a-zA-Z-]+)/resume$#', $path)) {
                    add_filter('template_include', [$this->templates, 'get_founder_resume_page_template']);
                }

                if (preg_match('#/login#', $path)) {
                    add_filter('template_include', [$this->templates, 'get_login_page_template']);
                }

                if (preg_match('#/signup#', $path)) {
                    add_filter('template_include', [$this->templates, 'get_signup_page_template']);
                }
            }

            if (!empty($this->protected_pages_list)) {
                foreach ($this->protected_pages_list as $protected_page) {

                    if (preg_match($protected_page['regex'], $path)) {
                        add_filter('template_include', [$this->templates, 'get_protected_page_template']);
                        break;
                    }
                }
            }

            if (!empty($this->pages_list) && $path !== '/') {
                foreach ($this->pages_list as $page) {

                    if (preg_match($page['regex'], $path)) {
                        add_filter('template_include', [$this->templates, 'get_page_template']);
                        break;
                    }
                }
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at load_page');

            return $response;
        }
    }


    function react_rewrite_rules()
    {
        add_rewrite_rule('^forgot/?', 'index.php?', 'top');
        add_rewrite_rule('^login/?', 'index.php?', 'top');
        add_rewrite_rule('^logout/?', 'index.php?', 'top');
        add_rewrite_rule('^signup/?', 'index.php?', 'top');
    }
}
