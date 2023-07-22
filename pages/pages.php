<?php

class THFW_Users_Pages {

    public function __construct() {
        add_filter( 'page_template', [$this, 'get_custom_dashboard_page_template'] );
        add_filter( 'page_template', [$this, 'get_custom_login_page_template'] );
        add_filter( 'page_template', [$this, 'get_custom_reset_page_template'] );
        add_filter( 'page_template', [$this, 'get_custom_signup_page_template'] );
        add_filter( 'author_template', [$this, 'get_custom_author_page_template'] );
    }

    function add_pages() {

        if (!post_exists( 'dashboard' )) {

            $dashboard_page = array(
                'post_title' => 'DASHBOARD',
                'post_type' => 'page',
                'post_content' => '',
                'post_status' => 'publish',
            );
    
            wp_insert_post($dashboard_page, true);    
        }

        if (!post_exists( 'login' )) {

            $login_page = array(
                'post_title' => 'LOGIN',
                'post_type' => 'page',
                'post_content' => '',
                'post_status' => 'publish',
            );
    
            wp_insert_post($login_page, true);    
        }

        if (!post_exists( 'reset' )) {

            $reset_page = array(
                'post_title' => 'RESET',
                'post_type' => 'page',
                'post_content' => '',
                'post_status' => 'publish',
            );
    
            wp_insert_post($reset_page, true);    
        }

        if (!post_exists( 'signup' )) {

            $signup_page = array(
                'post_title' => 'SIGN UP',
                'post_type' => 'page',
                'post_content' => '',
                'post_status' => 'publish',
            );
    
            wp_insert_post($signup_page, true);    
        }
    }

    function get_custom_dashboard_page_template( $page_template ) {

        if ( is_page( 'dashboard' ) ) {
            $page_template = WP_PLUGIN_DIR . '/thfw-users/pages/page-dashboard.php';
        }
        return $page_template;
    }

    function get_custom_login_page_template( $page_template ) {

        if ( is_page( 'login' ) ) {
            $page_template = WP_PLUGIN_DIR . '/thfw-users/pages/page-login.php';
        }
        return $page_template;
    }

    function get_custom_reset_page_template( $page_template ) {

        if ( is_page( 'reset' ) ) {
            $page_template = WP_PLUGIN_DIR . '/thfw-users/pages/page-reset.php';
        }
        return $page_template;
    }

    function get_custom_signup_page_template( $page_template ) {

        if ( is_page( 'sign-up' ) ) {
            $page_template = WP_PLUGIN_DIR . '/thfw-users/pages/page-signup.php';
        }
        return $page_template;
    }

    function get_custom_author_page_template( $author_template ) {

        if ( is_author() ) {
            $author_template = WP_PLUGIN_DIR . '/thfw-users/pages/author.php';
        }
        return $author_template;
    }
}