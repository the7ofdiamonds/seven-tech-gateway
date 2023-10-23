<?php

namespace SEVEN_TECH\CSS;

use SEVEN_TECH\Pages\Pages;
use SEVEN_TECH\Post_Types\Post_Types;

class CSS
{
    private $page_titles;
    private $post_types;

    public function __construct()
    {
        add_action('wp_head', [$this, 'load_social_bar_css']);

        new Customizer;

        $pages = new Pages;
        $posttypes = new Post_Types;
        
        $this->page_titles = $pages->page_titles;
        $this->post_types = $posttypes->post_types;
    }

    function load_front_page_css()
    {
        if (is_front_page()) {
            $filePath = SEVEN_TECH_URL . 'CSS/seven-tech.css';

            if ($filePath) {
                wp_register_style('seven_tech_css',  SEVEN_TECH_URL . 'CSS/seven-tech.css', array(), false, 'all');
                wp_enqueue_style('seven_tech_css');
            } else {
                error_log('CSS file is missing at :' . $filePath);
            }
        }
    }

    function load_pages_css()
    {
        if (!empty($this->page_titles) && is_array($this->page_titles)) {
            foreach ($this->page_titles as $page) {
                if (is_page($page)) {
                    $filePath = SEVEN_TECH_URL . 'CSS/seven-tech.css';
    
                    if ($filePath) {
                        wp_register_style('seven_tech_css', SEVEN_TECH_URL . 'CSS/seven-tech.css', array(), false, 'all');
                        wp_enqueue_style('seven_tech_css');
                    } else {
                        error_log('CSS file is missing at: ' . $filePath);
                    }
                }
            }
        } else {
            error_log('There are no page titles in the array at SEVEN_TECH Pages');
        }
    }
    
    function load_post_types_css()
    {
        if (!empty($this->post_types) && is_array($this->post_types)) {
            foreach ($this->post_types as $post_type) {
                if (is_post_type_archive($post_type) || is_singular($post_type)) {
                    $filePath = SEVEN_TECH_URL . 'CSS/seven-tech.css';
    
                    if ($filePath) {
                        wp_register_style('seven_tech_css', SEVEN_TECH_URL . 'CSS/seven-tech.css', array(), false, 'all');
                        wp_enqueue_style('seven_tech_css');
                    } else {
                        error_log('CSS file is missing at: ' . $filePath);
                    }
                }
            }
        } else {
            error_log('There are no post types in the array at SEVEN_TECH Post_Types');
        }
    }    

    function load_social_bar_css()
    {
        wp_register_style('seven_tech_social_bar',  SEVEN_TECH_URL . 'CSS/social-bar.css', array(), false, 'all');
        wp_enqueue_style('seven_tech_social_bar');
    }
}
