<?php

namespace SEVEN_TECH;

/**
 * @package SEVEN_TECH
 */
/*
Plugin Name: 7 TECH
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
use SEVEN_TECH\JS\JS;
use SEVEN_TECH\Menus\Menus;
use SEVEN_TECH\Pages\Pages;
use SEVEN_TECH\Post_Types\Post_Types;
use SEVEN_TECH\Roles\Roles;
use SEVEN_TECH\Shortcodes\Shortcodes;
use SEVEN_TECH\Templates\Templates;

use Kreait\Firebase\Factory;

class SEVEN_TECH
{
    public function __construct()
    {
        add_filter('upload_mimes', [$this, 'add_theme_support_upload_mimes']);

        $factory = (new Factory)->withServiceAccount(SEVEN_TECH . 'serviceAccount.json');
        $auth = $factory->createAuth();

        new Admin;
        new API($auth);
        new CSS;
        new JS;
        new Pages;
        new Post_Types;
        new Shortcodes;
        new Templates;
    }

    function activate()
    {
        flush_rewrite_rules();
    }

    function add_theme_support_upload_mimes($mimes)
    {
        $mimes['jpeg'] = 'image/jpeg';
        $mimes['jpg'] = 'image/jpeg';
        $mimes['svg'] = 'image/svg+xml';
        $mimes['eps'] = 'application/postscript';
        $mimes['ai'] = 'application/postscript';

        return $mimes;
    }
}

$seven_tech = new SEVEN_TECH();
register_activation_hook(__FILE__, array($seven_tech, 'activate'));

$seven_tech_roles = new Roles();
register_activation_hook(__FILE__, array($seven_tech_roles, 'add_roles'));

register_activation_hook(__FILE__, array(new Menus(), 'create_mobile_menu'));

$seven_tech_pages = new Pages();
register_activation_hook(__FILE__, array($seven_tech_pages, 'add_pages'));

// register_deactivation_hook(__FILE__, array($thfw_users, 'deactivate'));

//Uninstall move post type to trash