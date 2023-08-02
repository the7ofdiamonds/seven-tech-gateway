<?php
if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
} ?>
<section class="dashboard" id="thfw">
    <h2>DASHBOARD</h2>
    <?php include THFW_USERS . 'includes/part-user.php'; ?>
    <?php if (is_plugin_active('thfw-portfolio/THFW_Portfolio.php')) : ?>
        <div class="thfw-portfolio" id="thfw_portfolio"></div>
    <?php endif;
    if (is_plugin_active('orb-services/ORB_Services.php')) : ?>
        <div class="orb-services" id="orb_services"></div>
    <?php endif; ?>
</section>