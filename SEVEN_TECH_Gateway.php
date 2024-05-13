<?php

namespace SEVEN_TECH\Gateway;

/**
 * @package SEVEN_TECH
 */
/*
Plugin Name: SEVEN TECH
Plugin URI: 
Description: Gateway.
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
define('SEVEN_TECH', WP_PLUGIN_DIR . '/seven-tech-gateway/');
define('SEVEN_TECH_URL', WP_PLUGIN_URL . '/seven-tech-gateway/');

require_once SEVEN_TECH . 'vendor/autoload.php';

use SEVEN_TECH\Gateway\Admin\Admin;

use SEVEN_TECH\Gateway\API\API;
use SEVEN_TECH\Gateway\CSS\CSS;
use SEVEN_TECH\Gateway\CSS\Customizer\Customizer;
use SEVEN_TECH\Gateway\CSS\Customizer\BorderRadius;
use SEVEN_TECH\Gateway\CSS\Customizer\Color;
use SEVEN_TECH\Gateway\CSS\Customizer\Shadow;
use SEVEN_TECH\Gateway\Database\Database;
use SEVEN_TECH\Gateway\JS\JS;
use SEVEN_TECH\Gateway\Pages\Pages;
use SEVEN_TECH\Gateway\Post_Types\Post_Types;
use SEVEN_TECH\Gateway\Router\Router;
use SEVEN_TECH\Gateway\Shortcodes\Shortcodes;
use SEVEN_TECH\Gateway\Taxonomies\Taxonomies;
use SEVEN_TECH\Gateway\Templates\Templates;

class SEVEN_TECH
{
    public $pages;
    public $css;
    public $js;
    public $posttypes;
    public $router;
    public $templates;
    public $roles;

    public function __construct()
    {
        $plugin = plugin_basename(__FILE__);
        add_filter("plugin_action_links_{$plugin}", [$this, 'settings_link']);

        $admin = new Admin;

        add_action('admin_init', function () use ($admin) {
            $admin;
        });

        add_action('rest_api_init', function () {
            new API();
        });

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
    }

    function activate()
    {
        (new Database)->establishConnection();
        (new Database)->createTables();
        $this->pages->add_pages();
        $this->router->react_rewrite_rules();
    }

    function deactivate()
    {
        flush_rewrite_rules();
    }

    public function settings_link($links)
    {
        $settings_link = '<a href="' . admin_url('admin.php?page=seven-tech') . '">Settings</a>';
        array_push($links, $settings_link);

        return $links;
    }
}

$seven_tech = new SEVEN_TECH();
register_activation_hook(__FILE__, array($seven_tech, 'activate'));
register_deactivation_hook(__FILE__, array($seven_tech, 'deactivate'));
