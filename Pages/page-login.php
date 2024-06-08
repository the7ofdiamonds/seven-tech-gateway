<?php
use SEVEN_TECH\Gateway\Cookie\Cookie;

$cookie = new Cookie($_COOKIE);
error_log(print_r($_REQUEST, true));

if ((new Cookie($_COOKIE))->isValid) {
    header('Location: /logout');
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

get_header();

include SEVEN_TECH_GATEWAY . 'includes/react.php';

get_footer();
