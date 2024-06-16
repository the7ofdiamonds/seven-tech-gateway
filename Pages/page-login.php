<?php

if (is_user_logged_in()) {
    header('Location: /logout');
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// global $current_user;

// error_log(print_r($current_user, true));

get_header();

include SEVEN_TECH_GATEWAY . 'includes/react.php';

get_footer();
