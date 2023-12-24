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
use SEVEN_TECH\Assets\CSS\CSS;
use SEVEN_TECH\Assets\CSS\Customizer\Customizer;
use SEVEN_TECH\Assets\CSS\Customizer\BorderRadius;
use SEVEN_TECH\Assets\CSS\Customizer\Color;
use SEVEN_TECH\Assets\CSS\Customizer\Shadow;
use SEVEN_TECH\Assets\CSS\Customizer\SocialBar;
use SEVEN_TECH\Database\Database;
use SEVEN_TECH\Assets\JS\JS;
use SEVEN_TECH\Pages\Pages;
use SEVEN_TECH\Post_Types\Post_Types;
use SEVEN_TECH\Roles\Roles;
use SEVEN_TECH\Router\Router;
use SEVEN_TECH\Shortcodes\Shortcodes;
use SEVEN_TECH\Taxonomies\Taxonomies;
use SEVEN_TECH\Templates\Templates;

class SEVEN_TECH
{
    public $pages;
    public $plugin;
    public $css;
    public $js;
    public $posttypes;
    public $router;
    public $templates;

    public function __construct()
    {
        add_action('admin_init', function () {
            new Admin;
        });

        add_action('rest_api_init', function () {
            new API;
        });

        $css = new CSS;
        $js = new JS;
        $this->pages = new Pages;

        add_action('init', function () use ($css, $js) {
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
                $templates
            );
            $router->load_page();
            $router->react_rewrite_rules();
            new Shortcodes;
        });

        add_action('wp_head', function(){
            (new CSS)->load_social_bar_css();
            (new SocialBar)->load_css();
        });

        add_action('customize_register', function($wp_customize){
            (new Customizer)->register_customizer_panel($wp_customize);    
            (new BorderRadius)->seven_tech_border_radius_section($wp_customize);
            (new Color)->seven_tech_color_section($wp_customize);
            (new Shadow)->seven_tech_shadow_section($wp_customize);
            (new SocialBar)->seven_tech_social_bar_section($wp_customize);    
        });
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