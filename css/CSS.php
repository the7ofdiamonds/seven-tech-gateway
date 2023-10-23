<?php

namespace SEVEN_TECH\CSS;

use SEVEN_TECH\Pages\Pages;
use SEVEN_TECH\Post_Types\Post_Types;
use SEVEN_TECH\CSS\Customizer\Customizer;

class CSS
{
    private $handle_prefix;
    private $cssFolderPath;
    private $cssFolderPathURL;
    private $cssFileName;
    private $filePath;
    private $page_titles;
    private $post_types;

    public function __construct()
    {
        add_action('wp_head', [$this, 'load_social_bar_css']);

        $this->handle_prefix = 'seven_tech_';
        $this->cssFolderPath = SEVEN_TECH . 'CSS/';
        $this->cssFolderPathURL = SEVEN_TECH_URL . 'CSS/';
        $this->cssFileName = 'seven-tech.css';

        $this->filePath = $this->cssFolderPath . $this->cssFileName;

        $pages = new Pages;
        $posttypes = new Post_Types;

        $this->page_titles = $pages->page_titles;
        $this->post_types = $posttypes->post_types;

        new Customizer;
    }

    function load_front_page_css()
    {
        if (is_front_page()) {
            if ($this->filePath) {
                wp_register_style($this->handle_prefix . 'css',  $this->cssFolderPathURL . $this->cssFileName, array(), false, 'all');
                wp_enqueue_style($this->handle_prefix . 'css');
            } else {
                error_log('CSS file is missing at :' . $this->filePath);
            }
        }
    }

    function load_pages_css()
    {
        foreach ($this->page_titles as $page) {
            if (is_page($page)) {
                if ($this->filePath) {
                    wp_register_style($this->handle_prefix . 'css',  $this->cssFolderPathURL . $this->cssFileName, array(), false, 'all');
                    wp_enqueue_style($this->handle_prefix . 'css');
                } else {
                    error_log('CSS file is missing at :' . $this->filePath);
                }
            }
        }
    }

    function load_post_types_css()
    {
        foreach ($this->post_types as $post_type) {
            if (is_post_type_archive($post_type['name']) || is_singular($post_type['name'])) {
                if ($this->filePath) {
                    wp_register_style($this->handle_prefix . 'css',  $this->cssFolderPathURL . $this->cssFileName, array(), false, 'all');
                    wp_enqueue_style($this->handle_prefix . 'css');
                } else {
                    error_log('CSS file is missing at :' . $this->filePath);
                }
            }
        }
    }

    function load_social_bar_css(){
        wp_register_style($this->handle_prefix . 'social_bar_css',  $this->cssFolderPathURL . 'social-bar.css', array(), false, 'all');
        wp_enqueue_style($this->handle_prefix . 'social_bar_css');

    }
}
