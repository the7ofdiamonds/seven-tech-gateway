<?php

namespace SEVEN_TECH;

/**
 * @package SEVEN_TECH
 */
/*
Plugin Name: SEVEN TECH
Plugin URI: 
Description: Users.
Version: 1.0.0
Author: THE7OFDIAMONDS.TECH
Author URI: http://THE7OFDIAMONDS.TECH
License: 
Text Domain: seven-tech
*/

/*
Licensing Info is needed
*/

defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');
define('SEVEN_TECH', WP_PLUGIN_DIR . '/seven-tech/');
define('SEVEN_TECH_URL', WP_PLUGIN_URL . '/seven-tech/');

require_once SEVEN_TECH . 'vendor/autoload.php';

use SEVEN_TECH\Admin\Admin;
use SEVEN_TECH\API\API;
use SEVEN_TECH\CSS\CSS;
use SEVEN_TECH\CSS\Customizer\Customizer;
use SEVEN_TECH\Database\Database;
use SEVEN_TECH\Pages\Pages;
use SEVEN_TECH\Post_Types\Post_Types;
use SEVEN_TECH\Roles\Roles;
use SEVEN_TECH\Router\Router;
use SEVEN_TECH\Shortcodes\Shortcodes;

class SEVEN_TECH
{
    public function __construct()
    {
        add_action('admin_init', function () {
            new Admin;
        });

        add_action('rest_api_init', function () {
            new API;
        });

        add_action('init', function () {
            (new Pages)->react_rewrite_rules();
            (new Post_Types)->custom_post_types();
            (new Router)->load_page();
            new Shortcodes;
            // (new Taxonomies)->custom_taxonomy();
        });

        add_action('wp_head', [(new CSS), 'load_social_bar_css']);
        add_action('customize_register', [(new Customizer), 'register_customizer_panel']);

        add_filter('query_vars', [(new Pages), 'add_query_vars']);
    }

    function activate()
    {
        flush_rewrite_rules();
        (new Database)->createTables();
        (new Pages)->add_pages();
        (new Roles)->add_roles();
    }
}

$seven_tech = new SEVEN_TECH();
register_activation_hook(__FILE__, array($seven_tech, 'activate'));

// $seven_tech_roles = new Roles();
// register_activation_hook(__FILE__, array($seven_tech_roles, 'add_roles'));


// $seven_tech_pages = new Pages();
// register_activation_hook(__FILE__, array($seven_tech_pages, 'add_pages'));
// register_activation_hook(__FILE__, [$seven_tech_pages, 'add_founder_subpages']);

// register_deactivation_hook(__FILE__, array($thfw_users, 'deactivate'));

//Uninstall move post type to trash