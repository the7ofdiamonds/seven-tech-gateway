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
            'About',
        ];

        $this->custom_pages_list = [
            [
                'url' => 'forgot',
                'regex' => '#^/forgot#',
                'file_name' => 'Forgot',
                'title' => 'FORGOT',
                'name' => 'forgot'
            ],
            [
                'url' => 'founders/([a-zA-Z-]+)/resume',
                'regex' => '#^/founders/([a-zA-Z-]+)/resume#',
                'file_name' => 'FounderResume',
                'title' => '',
                'name' => 'founder-resume'
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
            [
                'url' => 'dashboard',
                'regex' => '#^/dashboard#',
                'file_name' => 'Dashboard',
                'title' => 'DASHBOARD',
                'name' => 'dashboard'
            ],
        ];

        $this->protected_pages_list = [];

        $this->pages_list = [
            [
                'url' => 'about',
                'regex' => '#^/about$#',
                'file_name' => 'About',
                'title' => 'ABOUT',
                'name' => 'about'
            ],
        ];

        $this->page_titles = [
            ...$this->custom_pages_list,
            ...$this->protected_pages_list,
            ...$this->pages_list,
        ];

        $this->pages = [
            [
                'title' => 'ABOUT',
                'filename' => 'About'
            ]
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

    function is_user_logged_in()
    {
        return isset($_SESSION['idToken']);
    }
}
