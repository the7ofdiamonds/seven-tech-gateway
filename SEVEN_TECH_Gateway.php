<?php

namespace SEVEN_TECH\Gateway;

/**
 * @package SEVEN_TECH
 */
/*
Plugin Name: SEVEN TECH GATEWAY
Plugin URI: 
Description: Gateway.
Version: 1.0.0
Author: THE7OFDIAMONDS.TECH
Author URI: http://THE7OFDIAMONDS.TECH
License: 
Text Domain: seven-tech
Plugin Slug: 
*/

/*
Licensing Info is needed
*/

defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');
define('SEVEN_TECH', plugin_dir_path(__FILE__));
define('SEVEN_TECH_URL', plugin_dir_url(__FILE__));
define('GOOGLE_SERVICE_ACCOUNT', plugin_dir_path(__FILE__) . 'Configuration/serviceAccount.json');

require_once SEVEN_TECH . 'vendor/autoload.php';

use SEVEN_TECH\Gateway\Account\Account;

use SEVEN_TECH\Gateway\Admin\Admin;
use SEVEN_TECH\Gateway\Admin\AdminAccountManagement;
use SEVEN_TECH\Gateway\Admin\AdminRecoverPassword;
use SEVEN_TECH\Gateway\Admin\AdminUserManagement;

use SEVEN_TECH\Gateway\API\API;
use SEVEN_TECH\Gateway\API\API_Account;
use SEVEN_TECH\Gateway\API\API_Authentication;
use SEVEN_TECH\Gateway\API\API_Password;
use SEVEN_TECH\Gateway\API\API_User;

use SEVEN_TECH\Gateway\Authentication\Authentication;

use SEVEN_TECH\Gateway\Authorization\Authorization;

use SEVEN_TECH\Gateway\CSS\CSS;
use SEVEN_TECH\Gateway\CSS\Customizer\Customizer;
use SEVEN_TECH\Gateway\CSS\Customizer\BorderRadius;
use SEVEN_TECH\Gateway\CSS\Customizer\Color;
use SEVEN_TECH\Gateway\CSS\Customizer\Shadow;

use SEVEN_TECH\Gateway\Database\Database;

use SEVEN_TECH\Gateway\JS\JS;

use SEVEN_TECH\Gateway\Pages\Pages;

use SEVEN_TECH\Gateway\Password\Password;

use SEVEN_TECH\Gateway\Post_Types\Post_Types;

use SEVEN_TECH\Gateway\Router\Router;

use SEVEN_TECH\Gateway\Shortcodes\Shortcodes;

use SEVEN_TECH\Gateway\Taxonomies\Taxonomies;

use SEVEN_TECH\Gateway\Templates\Templates;

use SEVEN_TECH\Gateway\Token\Token;

use SEVEN_TECH\Gateway\User\User;

use Exception;

use Kreait\Firebase\Factory;

class SEVEN_TECH
{
    private $plugin_file;
    public $pages;
    public $css;
    public $js;
    public $posttypes;
    public $router;
    public $templates;
    public $roles;

    public function __construct()
    {
        $this->plugin_file = plugin_basename(__FILE__);

        if (!function_exists('get_plugin_data')) {
            require_once(ABSPATH . 'wp-admin/includes/plugin.php');
        }

        $plugin_data = get_plugin_data(__FILE__);
        define('PLUGIN_NAME', $plugin_data['Name']);

        $admin = new Admin();

        add_action('admin_init', function () use ($admin) {
            $admin;
            add_filter("plugin_action_links_{$this->plugin_file}", [$admin, 'settings_link']);
        });

        try {
            $serviceAccountValid = $admin->areGoogleCredentialsPresent();

            if ($serviceAccountValid == 1) {
                $factory = (new Factory)->withServiceAccount(GOOGLE_SERVICE_ACCOUNT);
                $auth = $factory->createAuth();

                $token = new Token($auth);
                $account = new Account($auth);
                $authentication = new Authentication($auth, $account);
                $authorization = new Authorization($token);
                $password = new Password($authentication);
                $user = new User($auth);

                $accountAPI = new API_Account($account, $authentication, $authorization);
                $authAPI = new API_Authentication($authentication);
                $passwordAPI = new API_Password($password, $authentication, $authorization);
                $userAPI = new API_User($user, $authentication, $authorization);

                add_action('rest_api_init', function () use ($accountAPI, $authAPI, $passwordAPI, $userAPI) {
                    new API($accountAPI, $authAPI, $passwordAPI, $userAPI);
                });

                $adminAccountManagement = new AdminAccountManagement($account);
                $adminRecoverPassword = new AdminRecoverPassword($password);
                $adminUserManagement = new AdminUserManagement($user);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        add_action('admin_menu', [$admin, 'register_custom_menu_page']);
        add_action('admin_menu', [$adminAccountManagement, 'register_custom_submenu_page']);
        add_action('admin_menu', [$adminRecoverPassword, 'register_custom_submenu_page']);
        add_action('admin_menu', [$adminUserManagement, 'register_custom_submenu_page']);

        $pages = new Pages;
        $posttypes = new Post_Types;
        $taxonomies = new Taxonomies;
        $css = new CSS;
        $js = new JS;
        $templates = new Templates(
            $css,
            $js,
        );
        $router = new Router(
            $pages,
            $posttypes,
            $taxonomies,
            $templates
        );

        add_action('init', function () use ($posttypes, $taxonomies, $router) {
            $posttypes->custom_post_types();
            $taxonomies->custom_taxonomy();
            $router->load_page();
            $router->react_rewrite_rules();
            new Shortcodes;
        });

        add_action('customize_register', function ($wp_customize) {
            (new Customizer)->register_customizer_panel($wp_customize);
            (new BorderRadius)->seven_tech_border_radius_section($wp_customize);
            (new Color)->seven_tech_color_section($wp_customize);
            (new Shadow)->seven_tech_shadow_section($wp_customize);
        });

        $this->router = new Router(
            $pages,
            $posttypes,
            $taxonomies,
            $templates
        );
        $this->pages = new Pages;

        add_action('after_setup_theme', [$this, 'hide_admin_bar']);
    }

    function activate()
    {
        (new Database)->establishConnection();
        (new Database)->createTables();
        $this->pages->add_pages();
        $this->router->react_rewrite_rules();
    }

    function hide_admin_bar()
    {
        if (!current_user_can('administrator') && !is_admin()) {
            show_admin_bar(false);
        }
    }

    function deactivate()
    {
        flush_rewrite_rules();
    }
}

$seven_tech = new SEVEN_TECH();
register_activation_hook(__FILE__, array($seven_tech, 'activate'));
register_deactivation_hook(__FILE__, array($seven_tech, 'deactivate'));
