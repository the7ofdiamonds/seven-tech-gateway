<?php

namespace SEVEN_TECH\Templates;

use SEVEN_TECH\CSS\CSS;
use SEVEN_TECH\JS\JS;
use SEVEN_TECH\Post_Types\Post_Types;

class Templates_Post_types
{
    private $css_file;
    private $js_file;
    private $post_types;

    public function __construct()
    {
        add_filter('archive_template', [$this, 'get_archive_page_template']);
        add_filter('single_template', [$this, 'get_single_page_template']);

        $posttypes = new Post_Types();
        $this->css_file = new CSS;
        $this->js_file = new JS;

        $this->post_types = $posttypes->post_types;
    }

    function get_archive_page_template($archive_template)
    {
        foreach ($this->post_types as $post_type) {

            if (is_post_type_archive($post_type['name'])) {
                $archive_template = SEVEN_TECH . 'Post_Types/' . $post_type['plural'] . '/archive-' . $post_type['name'] . '.php';

                if (file_exists($archive_template)) {
                    add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                    add_action('wp_footer', [$this->js_file, 'load_post_types_archive_react']);

                    return $archive_template;
                } else {
                    error_log('Post Type ' . $post_type['name'] . ' archive template not found.');
                }
            }
        }
    }

    function get_single_page_template($single_template)
    {
        foreach ($this->post_types as $post_type) {

            if (is_singular($post_type['name'])) {
                $single_template = SEVEN_TECH . 'Post_Types/' . $post_type['plural'] . '/single-' . $post_type['name'] . '.php';

                if (file_exists($single_template)) {
                    add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                    add_action('wp_footer', [$this->js_file, 'load_post_types_single_react']);

                    return $single_template;
                } else {
                    error_log('Post Type ' . $post_type['name'] . ' single template not found.');
                }
            }
        }
    }
}
