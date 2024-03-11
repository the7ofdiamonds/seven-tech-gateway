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
use SEVEN_TECH\CSS\Customizer\BorderRadius;
use SEVEN_TECH\CSS\Customizer\Color;
use SEVEN_TECH\CSS\Customizer\Shadow;
use SEVEN_TECH\CSS\Customizer\SocialBar;
use SEVEN_TECH\Database\Database;
use SEVEN_TECH\JS\JS;
use SEVEN_TECH\Pages\Pages;
use SEVEN_TECH\Post_Types\Founders\Founders;
use SEVEN_TECH\Post_Types\Post_Types;
use SEVEN_TECH\Roles\Roles;
use SEVEN_TECH\Router\Router;
use SEVEN_TECH\Shortcodes\Shortcodes;
use SEVEN_TECH\Taxonomies\Taxonomies;
use SEVEN_TECH\Templates\Templates;
use SEVEN_TECH\Templates\TemplatesCustom;

class SEVEN_TECH
{
    public $pages;
    public $plugin;
    public $css;
    public $js;
    public $posttypes;
    public $router;
    public $templates;
    public $roles;

    public function __construct()
    {
        add_action('admin_init', function () {
            new Admin;
        });

        add_action('rest_api_init', function () {
            new API();
        });

        $css = new CSS;
        $js = new JS;
        $this->pages = new Pages;
        $templates_custom = new TemplatesCustom;

        add_action('init', function () use ($css, $js, $templates_custom) {
            $posttypes = new Post_Types;
            $posttypes->custom_post_types();
            $taxonomies = new Taxonomies;
            $taxonomies->custom_taxonomy();
            $templates = new Templates(
                $css,
                $js,
            );
            $router = new Router(
                $this->pages,
                $posttypes,
                $taxonomies,
                $templates,
                $templates_custom
            );
            $router->load_page();
            $router->react_rewrite_rules();
            new Shortcodes;
        });

        add_action('wp_head', function () {
            (new SocialBar)->load_css();
            (new CSS)->load_social_bar_css();
        });

        add_action('customize_register', function ($wp_customize) {
            (new Customizer)->register_customizer_panel($wp_customize);
            (new BorderRadius)->seven_tech_border_radius_section($wp_customize);
            (new Color)->seven_tech_color_section($wp_customize);
            (new Shadow)->seven_tech_shadow_section($wp_customize);
            (new SocialBar)->seven_tech_social_bar_section($wp_customize);
        });

        $this->roles = new Roles;

        add_action('update_option_wp_user_roles', array($this->roles, 'update_roles'), 10, 2);
        add_action('add_user_role', array($this->roles, 'update_user_roles'), 10, 2);
    }

    function activate()
    {
        (new Database)->establishConnection();
        (new Database)->createTables();
        (new Pages)->add_pages();
        $this->roles->add_roles();
        (new Founders)->add_founder_pages();

        flush_rewrite_rules();
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