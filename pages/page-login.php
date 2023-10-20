<?php
if (is_user_logged_in()) {
    header('Location: /logout');
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

get_header();

include SEVEN_TECH . 'includes/react.php';

get_footer();
