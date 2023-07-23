<?php

namespace THFW_Users\Pages;

class Pages
{

    public function __construct()
    {
    }

    function add_pages()
    {
        global $wpdb;

        $page_titles = [
            'LOGIN',
            'SIGNUP',
            'FORGOT',
            'LOGOUT'
        ];

        foreach ($page_titles as $page_title) {
            $page_exists = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'page'", $page_title));

            if (!$page_exists) {
                $page_data = array(
                    'post_title'   => $page_title,
                    'post_type'    => 'page',
                    'post_content' => '',
                    'post_status'  => 'publish',
                );

                wp_insert_post($page_data);
            }
        }
    }
}
