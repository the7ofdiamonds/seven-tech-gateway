<?php

if (!is_user_logged_in()) {
    $fullUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    header("Location: /login?redirectTo=" . $fullUrl);
    exit;
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
