<?php

namespace SEVEN_TECH\Pages;

class Pages
{
    public $front_page_react;
    public $pages;
    public $protected_pages;
    public $page_titles;

    public function __construct()
    {
        $this->front_page_react = [
            'about',
        ];

        $this->pages = [
            [
                'url' => 'about',
                'title' => 'ABOUT',
                'name' => 'about'
            ],
            [
                'url' => 'dashboard',
                'title' => 'DASHBOARD',
                'name' => 'dashboard'
            ],
            [
                'url' => 'login',
                'title' => 'LOGIN',
                'name' => 'login'
            ],
            [
                'url' => 'signup',
                'title' => 'SIGNUP',
                'name' => 'signup'
            ],
            [
                'url' => 'forgot',
                'title' => 'FORGOT',
                'name' => 'forgot'
            ],
            [
                'url' => 'logout',
                'title' => 'LOGOUT',
                'name' => 'logout'
            ],
            [
                'url' => 'founders/([a-zA-Z-]+)/resume',
                'title' => '',
                'name' => 'founder_resume'
            ]
        ];

        $this->protected_pages = [];

        $this->page_titles = [
            ...$this->pages,
            ...$this->protected_pages
        ];

        add_action('init', [$this, 'react_rewrite_rules']);

        add_action('init', [$this, 'is_user_logged_in']);
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
                }
            }
        }
    }

    function react_rewrite_rules()
    {
        if (is_array($this->page_titles) && count($this->page_titles) > 0) {

            foreach ($this->page_titles as $page_title) {
                if (!empty($page_title['url'])) {
                    $url = explode('/', $page_title['url']);
                    $segment = count($url) - 1;
                    $query_var = $url[$segment];

                    if (!empty($query_var)) {
                        add_action('init',  function () use ($page_title, $query_var) {
                            add_rewrite_rule('^' . $page_title['url'], 'index.php?' . $query_var . '=$matches[1]', 'top');
                        });
                    } else {
                        continue;
                    }
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
