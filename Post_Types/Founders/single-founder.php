<?php get_header(); ?>

<section class="founder" id="founder">
    <?php
    include SEVEN_TECH . 'includes/part-founder-nav.php';
    include SEVEN_TECH . 'includes/main-founder.php';

    if (is_plugin_active('seven-tech-portfolio/SEVEN_TECH_Portfolio.php')) {
        echo do_shortcode('[thfw-portfolio]');
    }
    ?>
</section>

<?php get_footer(); ?>