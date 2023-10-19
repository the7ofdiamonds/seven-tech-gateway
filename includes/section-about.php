<?php
if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}
?>

<section class='about'>

    <?php
    include SEVEN_TECH . 'includes/part-about.php';

    include SEVEN_TECH . 'includes/part-schedule.php';

    include SEVEN_TECH . 'includes/part-headquarters.php';

    include SEVEN_TECH . 'includes/section-team.php';
    ?>

</section>