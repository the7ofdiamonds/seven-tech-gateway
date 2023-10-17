<?php
get_header();

if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}
?>

<div class="front-page">
    <?php
    if (is_plugin_active('orb-services/ORB_Services.php')) {
        echo do_shortcode('[orb-services-hero]');
    }

    if (is_plugin_active('orb-services/ORB_Services.php')) {
        echo do_shortcode('[orb-services]');
    }

    if (is_plugin_active('thfw-portfolio/THFW_Portfolio.php')) {
        echo do_shortcode('[thfw-portfolio]');
    }

    echo do_shortcode('[thfw-about]');
    ?>
</div>

<?php get_footer(); ?>