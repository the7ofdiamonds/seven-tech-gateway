<?php

use SEVEN_TECH\Gateway\Cookie\Cookie;

$cookie = new Cookie();

if (is_int($cookie->determine_current_user()) && $cookie->determine_current_user() !== 0) {
    error_log($cookie->determine_current_user());
    header('Location: /dashboard');
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

get_header();

include SEVEN_TECH_GATEWAY . 'includes/react.php';

get_footer();
