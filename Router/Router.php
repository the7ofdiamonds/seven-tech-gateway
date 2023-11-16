<?php

namespace SEVEN_TECH\Router;

use SEVEN_TECH\Pages\Pages;
use SEVEN_TECH\Post_Types\Post_Types;
use SEVEN_TECH\Templates\Templates;

class Router
{
    private $pages;
    private $protected_pages;
    private $post_types;
    private $templates;

    public function __construct()
    {
        $pages = new Pages;
        $posttypes = new Post_Types;
        $this->templates = new Templates;

        $this->pages = $pages->pages;
        $this->protected_pages = $pages->protected_pages;
        $this->post_types = $posttypes->post_types;
    }

    function load_page()
    {
        $path = $_SERVER['REQUEST_URI'];

        if ($path === '/') {
            add_filter('frontpage_template', [$this->templates, 'get_front_page_template']);
        }

        if (!empty($this->protected_pages)) {
            foreach ($this->protected_pages as $pattern) {
                $regex = '#^/' . $pattern . '/$#';

                if (preg_match($regex, $path)) {
                    add_filter('template_include', [$this->templates, 'get_protected_page_template']);
                    break;
                }
            }
        }

        if (!empty($this->pages)) {
            foreach ($this->pages as $page) {
                $regex = '#^/' . $page['url'] . '/$#';

                if (preg_match($regex, $path)) {
                    $page_name = $page['name'];

                    if (!empty($page_name)) {
                        add_filter('template_include', function ($template) use ($page_name) {
                            return $this->templates->get_custom_page_template($template, $page_name);
                        });
                    } else {
                        add_filter('template_include', [$this->templates, 'get_page_template']);
                    }
                    break;
                }
            }
        }

        if (!empty($this->post_types)) {
            foreach ($this->post_types as $post_type) {
                $url = array_filter(explode('/', $path), function ($value) {
                    return !empty($value);
                });

                if (count($url) === 1 && $url[1] === $post_type['archive_page']) {
                    add_filter('archive_template', [$this->templates, 'get_archive_page_template']);
                    break;
                }
            }

            add_filter('single_template', [$this->templates, 'get_single_page_template']);
        }

        $regex = '#^/founders/([a-zA-Z-]+)/resume$#';

        if (preg_match($regex, $path)) {
            add_filter('template_include', [$this->templates, 'get_founder_resume_page_template']);
        }
    }
}
