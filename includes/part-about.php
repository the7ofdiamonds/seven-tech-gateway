<?php
if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}
?>

<section class='about'>

    <h2>ABOUT</h2>

    <div class="mission-statement-card card">
        <h4 class="mission-statement">
            <q>
                <?php echo get_option('mission-statement'); ?>
            </q>
        </h4>
    </div>
    <!-- Add to page template -->
    <?php
    $page_slug = 'about'; // Replace with the slug of the page you want to get the ID for
    $page = get_page_by_path($page_slug);

    if ($page) {
        $page_id = $page->ID;
        $page = get_post($page_id);

        if ($page) {
            $page_content = $page->post_content;

            echo $page_content;
        }
    } ?>
    <!--  -->
    <?php
    if (is_plugin_active('orb-products-services/ORB_Products_Services.php')) {
        echo do_shortcode('[orb-services-schedule]');
    }

    if (is_plugin_active('orb-products-services/ORB_Products_Services.php')) {
        echo do_shortcode('[orb-services-headquarters]');
    }

    if (is_plugin_active('orb-products-services/ORB_Products_Services.php')) {
        echo do_shortcode('[thfw-team]');
    }
    ?>

</section>