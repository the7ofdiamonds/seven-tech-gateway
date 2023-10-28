<?php

namespace SEVEN_TECH\Pages;

class Pages
{
    public $front_page_react;
    public $page_titles;

    public function __construct()
    {
        $this->front_page_react = [
            'about',
        ];

        $this->page_titles = [
            'about',
            'login',
            'signup',
            'forgot',
            'logout',
            'dashboard'
        ];

        add_action('init', [$this, 'react_rewrite_rules']);
        add_action('init', [$this, 'founder_resume_rewrite_rules']);

        add_filter('query_vars', [$this, 'add_query_vars']);
        add_filter('query_vars', [$this, 'add_query_var_resume']);

        add_action('init', [$this, 'is_user_logged_in']);
    }

    public function add_pages()
    {
        global $wpdb;

        foreach ($this->page_titles as $page_title) {
            $page_exists = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'page'", $page_title));

            if (!$page_exists) {
                $page_data = array(
                    'post_title'   => strtoupper($page_title),
                    'post_type'    => 'page',
                    'post_content' => '',
                    'post_status'  => 'publish',
                );

                wp_insert_post($page_data);
            }
        }
    }

    function react_rewrite_rules()
    {
        if (is_array($this->page_titles) && count($this->page_titles) > 0) {

            foreach ($this->page_titles as $page_title) {
                $url = explode('/', $page_title);

                add_rewrite_rule('^' . $page_title, 'index.php?' . $url[0] . '=$1', 'top');
            }
        }
    }

    function founder_resume_rewrite_rules()
    {
        $founder_resume_path = 'founders/([a-zA-Z-]+)/resume';
        $url = explode('/', $founder_resume_path);

        add_rewrite_rule('^' . $founder_resume_path, 'index.php?' . $url[2] . '=$1', 'top');
    }

    function add_query_vars($query_vars)
    {
        if (is_array($this->page_titles) && count($this->page_titles) > 0) {

            foreach ($this->page_titles as $page_title) {
                $query_vars[] = $page_title;
            }

            return $query_vars;
        }
    }

    function add_query_var_resume($query_vars)
    {
        $query_vars[] = 'resume';

        return $query_vars;
    }

    function is_user_logged_in()
    {
        return isset($_SESSION['idToken']);
    }
}
