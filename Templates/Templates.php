<?php

namespace SEVEN_TECH\Templates;

use SEVEN_TECH\CSS\CSS;
use SEVEN_TECH\JS\JS;
use SEVEN_TECH\Post_Types\Post_Types;

class Templates
{
    private $css_file;
    private $js_file;
    private $post_types;

    public function __construct()
    {
        $this->css_file = new CSS;
        $this->js_file = new JS;
        $posttypes = new Post_Types;

        $this->post_types = $posttypes->post_types;
    }

    function get_front_page_template($frontpage_template)
    {
        if (is_front_page()) {
            $frontpage_template = SEVEN_TECH . 'Pages/front-page.php';

            if (file_exists($frontpage_template)) {
                add_action('wp_head', [$this->css_file, 'load_front_page_css']);
                add_action('wp_footer', [$this->js_file, 'load_front_page_react']);

                return $frontpage_template;
            }
        }

        return $frontpage_template;
    }

    function get_custom_page_template($template, $name)
    {
        if (is_page($name)) {
            $custom_template = SEVEN_TECH . "Pages/page-{$name}.php";

            if (file_exists($custom_template)) {
                add_action('wp_head', [$this->css_file, 'load_pages_css']);
                add_action('wp_footer', [$this->js_file, 'load_pages_react']);
    
                return $custom_template;
            } else {
                return SEVEN_TECH . "Pages/page.php";
            }
        }

        return $template;
    }

    function get_protected_page_template($template)
    {
        $template = SEVEN_TECH . 'Pages/page-protected.php';

        if (file_exists($template)) {
            add_action('wp_head', [$this->css_file, 'load_pages_css']);
            add_action('wp_footer', [$this->js_file, 'load_pages_react']);
            return $template;
        } else {
            error_log('Protected Page Template does not exist.');
        }

        return $template;
    }

    function get_page_template($template)
    {
        $template = SEVEN_TECH . 'Pages/page.php';;

        if (file_exists($template)) {
            add_action('wp_head', [$this->css_file, 'load_pages_css']);
            add_action('wp_footer', [$this->js_file, 'load_pages_react']);

            return $template;
        } else {
            error_log('Page Template does not exist.');
        }

        return $template;
    }

    function get_archive_page_template($archive_template)
    {
        if (!empty($this->post_types)) {
            foreach ($this->post_types as $post_type) {

                if (is_post_type_archive($post_type['name'])) {
                    $archive_template = SEVEN_TECH . 'Post_Types/' . $post_type['plural'] . '/archive-' . $post_type['name'] . '.php';

                    if (file_exists($archive_template)) {
                        add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                        add_action('wp_footer', [$this->js_file, 'load_post_types_archive_react']);

                        return $archive_template;
                    }

                    break;
                }
            }
        }

        return $archive_template;
    }

    function get_single_page_template($single_template)
    {
        if (!empty($this->post_types)) {
            foreach ($this->post_types as $post_type) {

                if (is_singular($post_type['name'])) {
                    $single_template = SEVEN_TECH . 'Post_Types/' . $post_type['plural'] . '/single-' . $post_type['name'] . '.php';

                    if (file_exists($single_template)) {
                        add_action('wp_head', [$this->css_file, 'load_post_types_css']);
                        add_action('wp_footer', [$this->js_file, 'load_post_types_single_react']);
                    }

                    break;
                }
            }
        }

        return $single_template;
    }

    function get_founder_resume_page_template($template_include)
    {
        $resume_template = SEVEN_TECH . 'Post_Types/Founders/single-founder-resume.php';

        if (file_exists($resume_template)) {
            return $resume_template;
        } else {
            error_log('Resume Page Template does not exist.');
        }

        return $template_include;
    }
}
