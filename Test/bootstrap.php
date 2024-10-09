<?php

define('WP_ENVIRONMENT_TYPE', 'testing');

require dirname(__DIR__, 4) . '/wp-load.php';

if (function_exists('add_user_meta')) {
    echo "WordPress is loaded correctly.";
} else {
    echo "Failed to load WordPress.";
}