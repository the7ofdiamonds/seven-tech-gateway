<?php

class THFW_Login {

    public function __construct() {
        add_action('wp_login', [$this, 'thfw_start_session']);
    }

    public function thfw_start_session() {

        global $user_ID;

        $user_ID = get_current_user_id();

        wp_set_current_user($user_ID);

        wp_set_auth_cookie($user_ID, 1, is_ssl());        
    }
}
