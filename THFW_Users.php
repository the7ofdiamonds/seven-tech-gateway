<?php

namespace THFW_Users;

/**
 * @package THFW Users
 */
/*
Plugin Name: THFW Users
Plugin URI: 
Description: Users.
Version: 1.0.0
Author: THE7OFDIAMONDS.TECH
Author URI: http://THE7OFDIAMONDS.TECH
License: 
Text Domain: thfw-users
*/

/*
Licensing Info is needed
*/

require_once 'vendor/autoload.php';

defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');
define('THFW_USERS', WP_PLUGIN_DIR . '/thfw-users/');
define('THFW_USERS_URL', WP_PLUGIN_URL . '/thfw-users/');

use THFW_Users\API\API;
use THFW_Users\CSS\CSS;
use THFW_Users\JS\JS;
use THFW_Users\Menus\Menus;
use THFW_Users\Pages\Pages;
use THFW_Users\Templates\Templates;

class THFW_Users
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'load_css_js']);

        // new Admin;
        new API;
        new CSS;
        new JS;
        new Pages;
        // new Shortcodes;
        new Templates;
        // new Post_Type();
        // new Widgets();
        // new Admin_Team();

    }

    function activate()
    {
        flush_rewrite_rules();
    }

    //Load Plugin CSS & JS
    function load_css_js()
    {

        wp_register_style('thfw_users_css',  WP_PLUGIN_URL . '/thfw-users/css/thfw-users.css', array(), false, 'all');
        wp_enqueue_style('thfw_users_css');

        wp_register_script('thfw_users_js', WP_PLUGIN_URL . '/thfw-users/js/thfw-users.js', array('jquery'), false, false);
        wp_enqueue_script('thfw_users_js');
    }

    //Add Roles
    function add_roles()
    {
        add_role('founder/managing member', 'Founder/Managing Member', get_role('administrator')->capabilities);
    }
}

$thfw_users = new THFW_Users();
register_activation_hook(__FILE__, array($thfw_users, 'activate'));
register_activation_hook(__FILE__, array($thfw_users, 'add_roles'));

register_activation_hook(__FILE__, array(new Menus(), 'create_mobile_menu'));

$thfw_users_pages = new Pages();
register_activation_hook(__FILE__, array($thfw_users_pages, 'add_pages'));

// register_deactivation_hook(__FILE__, array($thfw_users, 'deactivate'));

//Uninstall move post type to trash