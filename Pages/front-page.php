<?php

get_header();

if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

?>

<div class="front-page">
    <?php
    if (is_plugin_active('orb-products-services/ORB_Products_Services.php')) {
        echo do_shortcode('[orb-products-services-frontpage]');
    }

    if (is_plugin_active('seven-tech-portfolio/SEVEN_TECH_Portfolio.php')) {
        echo do_shortcode('[seven-tech-portfolio]');
    }
    ?>

    <div id="seven_tech"></div>

    <?php
    if (is_plugin_active('seven-tech-location/SEVEN_TECH_Location.php')) {
        echo do_shortcode('[seven-tech-locations]');
    }

    if (is_plugin_active('seven-tech-schedule/SEVEN_TECH_Schedule.php')) {
        echo do_shortcode('[seven-tech-schedule]');
    }
    ?>
</div>

<?php get_footer();
