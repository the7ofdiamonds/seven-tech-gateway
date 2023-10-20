<?php

get_header();

if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

?>

<div class="front-page">
    <?php
    if (is_plugin_active('orb-products-services/ORB_Products_Services.php')) {
        echo do_shortcode('[orb-services-hero]');
    }

    if (is_plugin_active('orb-products-services/ORB_Products_Services.php')) {
        echo do_shortcode('[orb-services]');
    }

    if (is_plugin_active('seven-tech-portfolio/SEVEN_TECH_Portfolio.php')) {
        echo do_shortcode('[thfw-portfolio]');
    }

    include SEVEN_TECH . 'includes/react.php';
    ?>
</div>

<?php get_footer(); ?>