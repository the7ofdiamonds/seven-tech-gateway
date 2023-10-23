<?php

namespace SEVEN_TECH\Templates;

use SEVEN_TECH\CSS\CSS;
use SEVEN_TECH\JS\JS;

class Templates_Post_types
{
    private $css_file;
    private $js_file;

    public function __construct()
    {
        add_filter('archive_template', [$this, 'get_founder_archive_template']);
        add_filter('single_template', [$this, 'get_founder_single_template']);

        $this->css_file = new CSS;
        $this->js_file = new JS;
    }

    function get_founder_archive_template($archive_template)
    {
        if (is_post_type_archive('founders')) {
            $archive_template = SEVEN_TECH . 'Post_Types/Founders/archive-founder.php';

            if (file_exists($archive_template)) {
                add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                add_action('wp_footer', [$this->js_file, 'load_post_types_archive_react']);

                return $archive_template;
            }
        }

        return $archive_template;
    }

    function get_founder_single_template($singular_template)
    {
        if (is_singular('founders')) {
            $singular_template = SEVEN_TECH . 'Post_Types/Founders/single-founder.php';

            if (file_exists($singular_template)) {
                add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                add_action('wp_footer', [$this->js_file, 'load_post_types_single_react']);

                return $singular_template;
            }
        }

        return $singular_template;
    }
}
