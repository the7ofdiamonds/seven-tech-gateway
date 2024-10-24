<?php

use SEVEN_TECH\Gateway\Cookie\Cookie;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$cookie = new Cookie();

if (!$cookie->determine_current_user()) {
    $fullUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    header("Location: /login?redirectTo=" . $fullUrl);
    exit;
}

get_header(); ?>

<div class="dashboard">
    <?php

    include SEVEN_TECH_GATEWAY . 'includes/react.php';

    if (!function_exists('is_plugin_active')) {
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');
    }
    
    if (is_plugin_active('seven-tech-schedule/SEVEN_TECH_Schedule.php')) {
        echo do_shortcode('[seven-tech-schedule]');
    }

    if (is_plugin_active('seven-tech-portfolio/SEVEN_TECH_Portfolio.php')) {
        echo do_shortcode('[seven-tech-portfolio]');
    }

    if (is_plugin_active('orb-products-services/ORB_Products_Services.php')) {
        echo do_shortcode('[orb-dashboard]');
    }
    ?>
</div>

<?php get_footer();
