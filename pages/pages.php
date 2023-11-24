<?php

namespace SEVEN_TECH\Pages;

class Pages
{
    public $front_page_react;
    public $custom_pages_list;
    public $protected_pages_list;
    public $pages_list;
    public $pages;
    public $page_titles;

    public function __construct()
    {
        $this->front_page_react = [
            'about',
        ];

        $this->custom_pages_list = [
            [
                'url' => 'about',
                'regex' => '#^/about#',
                'file_name' => 'About',
                'title' => 'ABOUT',
                'name' => 'about'
            ],
            [
                'url' => 'dashboard',
                'regex' => '#^/dashboard#',
                'file_name' => 'Dashboard',
                'title' => 'DASHBOARD',
                'name' => 'dashboard'
            ],
            [
                'url' => 'forgot',
                'regex' => '#^/forgot#',
                'file_name' => 'Forgot',
                'title' => 'FORGOT',
                'name' => 'forgot'
            ],
            [
                'url' => 'founders/([a-zA-Z-]+)/resume',
                'regex' => '#^/founders/([a-zA-Z-]+)/resume$#',
                'file_name' => 'FounderResume',
                'title' => '',
                'name' => 'founder_resume'
            ],
            [
                'url' => 'login',
                'regex' => '#^/login#',
                'file_name' => 'Login',
                'title' => 'LOGIN',
                'name' => 'login'
            ],
            [
                'url' => 'logout',
                'regex' => '#^/logout#',
                'file_name' => 'Logout',
                'title' => 'LOGOUT',
                'name' => 'logout'
            ],
            [
                'url' => 'signup',
                'regex' => '#^/signup#',
                'file_name' => 'Signup',
                'title' => 'SIGNUP',
                'name' => 'signup'
            ],
        ];

        $this->protected_pages_list = [];

        $this->pages_list = [];

        $this->pages = [
            ['title' => 'ABOUT']
        ];

        $this->page_titles = [
            ...$this->custom_pages_list,
            ...$this->protected_pages_list,
            ...$this->pages_list,
        ];
    }

    function add_pages()
    {
        global $wpdb;

        foreach ($this->pages as $page) {
            if (!empty($page['title'])) {
                $page_exists = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'page'", $page['title']));

                if (!$page_exists) {
                    $page_data = array(
                        'post_title'   => $page['title'],
                        'post_type'    => 'page',
                        'post_content' => '',
                        'post_status'  => 'publish',
                    );

                    wp_insert_post($page_data);

                    error_log($page['title'] . ' page added.');
                }
            }
        }
    }

    function add_query_vars($query_vars)
    {
        if (is_array($this->page_titles) && count($this->page_titles) > 0) {

            foreach ($this->page_titles as $page_title) {
                $url = explode('/', $page_title['url']);
                $segment = count($url) - 1;

                if (!in_array($url[$segment], $query_vars)) {
                    $query_vars[] = $url[$segment];
                } else {
                    continue;
                }
            }

            return array_unique($query_vars);
        }

        return $query_vars;
    }

    function is_user_logged_in()
    {
        return isset($_SESSION['idToken']);
    }
}
