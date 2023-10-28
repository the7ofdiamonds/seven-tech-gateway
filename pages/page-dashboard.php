<?php

if (!is_user_logged_in()) {
    $fullUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    header("Location: /login?redirectTo=" . $fullUrl);
    exit;
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

get_header();
echo isset($_SESSION['idToken']);
include SEVEN_TECH . 'includes/react.php';

get_footer();
