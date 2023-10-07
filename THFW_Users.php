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

defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');
define('THFW_USERS', WP_PLUGIN_DIR . '/thfw-users/');
define('THFW_USERS_URL', WP_PLUGIN_URL . '/thfw-users/');

require_once THFW_USERS . 'vendor/autoload.php';

use THFW_Users\Admin\Admin;
use THFW_Users\API\API;
use THFW_Users\CSS\CSS;
use THFW_Users\JS\JS;
use THFW_Users\Menus\Menus;
use THFW_Users\Pages\Pages;
use THFW_Users\Post_Types\Users;
use THFW_Users\Roles\Roles;
use THFW_Users\Shortcodes\Shortcodes;
use THFW_Users\Templates\Templates;

use Kreait\Firebase\Factory;

class THFW_Users
{
    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(THFW_USERS . 'serviceAccount.json');
        $auth = $factory->createAuth();

        new Admin;
        new API($auth);
        new CSS;
        new JS;
        new Pages;
        new Roles;
        new Shortcodes;
        new Templates;
        new Users;
    }

    function activate()
    {
        flush_rewrite_rules();
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