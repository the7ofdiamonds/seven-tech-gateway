<?php

get_header();

include SEVEN_TECH . 'includes/react.php';

if (is_plugin_active('seven-tech-portfolio/SEVEN_TECH_Portfolio.php')) {
    echo do_shortcode('[thfw-portfolio]');
}

get_footer();
