<?php
if (is_user_logged_in()) {
    header('Location: /logout');
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

get_header();

include THFW_USERS . 'includes/part-login.php';

get_footer();
