<?php
if (!is_user_logged_in()) {
    header('Location: /login');
}

get_header();

include THFW_USERS . 'includes/part-dashboard.php';

get_footer();