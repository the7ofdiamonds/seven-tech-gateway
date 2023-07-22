<?php
/**
 * @package THFWPortfolio
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
Licensing Info Here
*/
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );
include 'features/features.php';
include 'pages/pages.php';
include 'post-types/thfw-users-post-type.php';

class THFW_Users
{
    public function __construct(){
        add_action('wp_enqueue_scripts', [$this, 'load_css_js']);
        new THFW_Users_Features();
        new THFW_Users_Post_Type();
    }

    function activate() {
        flush_rewrite_rules();
    }

    //Load Plugin CSS & JS
    function load_css_js(){

        wp_register_style('thfw_users_css',  WP_PLUGIN_URL . '/thfw-users/css/thfw-users.css', array(), false, 'all' );
        wp_enqueue_style('thfw_users_css');

        wp_register_script('thfw_users_js', WP_PLUGIN_URL . '/thfw-users/js/thfw-users.js', array('jquery'), false, false );
        wp_enqueue_script('thfw_users_js');
    }
    
    //Add Roles
    function add_roles() {

        add_role( 'founder/managing member', 'Founder/Managing Member', get_role( 'administrator' )->capabilities );
    }
}

$thfw_users = new THFW_Users();
register_activation_hook( __FILE__, array( $thfw_users, 'activate' ) );
register_activation_hook( __FILE__, array( $thfw_users, 'add_roles' ) );

$thfw_users_pages = new THFW_Users_Pages();
register_activation_hook( __FILE__, array( $thfw_users_pages, 'add_pages' ) );

register_deactivation_hook( __FILE__, array( $thfw, 'deactivate' ) );

//Uninstall move post type to trash