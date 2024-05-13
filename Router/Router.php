<?php

namespace SEVEN_TECH\Gateway\Router;

use Exception;

use SEVEN_TECH\Gateway\Pages\Pages;
use SEVEN_TECH\Gateway\Post_Types\Post_Types;
use SEVEN_TECH\Gateway\Taxonomies\Taxonomies;
use SEVEN_TECH\Gateway\Templates\Templates;

class Router
{
    private $front_page_react;
    private $custom_pages;
    private $protected_pages;
    private $pages;
    private $pages_list;
    private $post_types_list;
    private $taxonomies_list;
    private $templates;

    public function __construct(
        Pages $pages,
        Post_Types $posttypes,
        Taxonomies $taxonomies,
        Templates $templates
    ) {
        $this->front_page_react = $pages->front_page_react;
        $this->custom_pages = $pages->custom_pages;
        $this->protected_pages = $pages->protected_pages;
        $this->pages = $pages->pages;
        $this->pages_list = $pages->pages_list;

        $this->post_types_list = $posttypes->post_types_list;
        $this->taxonomies_list = $taxonomies->taxonomies_list;

        $this->templates = $templates;
    }

    function load_page()
    {
        try {
            $path = $_SERVER['REQUEST_URI'];

            if (!empty($this->front_page_react) && preg_match("#^/$#", $path)) {
                $sections = $this->front_page_react;

                add_filter('frontpage_template', function ($frontpage_template) use ($sections) {
                    return $this->templates->get_front_page_template($frontpage_template, $sections);
                });
            }

            if (!empty($this->custom_pages)) {
                foreach ($this->custom_pages as $custom_page) {
                    if (!isset($custom_page['regex'])) {
                        error_log('Regex is required for custom_pages at Pages.');
                        break;
                    }

                    if (preg_match($custom_page['regex'], $path)) {
                        add_filter('template_include', function ($template_include) use ($custom_page) {
                            return $this->templates->get_custom_page_template($template_include, $custom_page);
                        });
                        break;
                    }
                }
            }

            if (!empty($this->protected_pages)) {
                foreach ($this->protected_pages as $protected_page) {
                    if (!isset($protected_page['regex'])) {
                        error_log('Regex is required for protected_pages at Pages.');
                        break;
                    }

                    if (preg_match($protected_page['regex'], $path)) {

                        if (!isset($protected_page['file_name'])) {
                            error_log('Filename is required for protected_pages at Pages.');
                            return;
                        }

                        add_filter('template_include',  function ($template_include) use ($protected_page) {
                            return $this->templates->get_protected_page_template($template_include, $protected_page);
                        });
                        break;
                    }
                }
            }

            if (!empty($this->pages)) {
                foreach ($this->pages as $page) {
                    if (!isset($page['regex'])) {
                        error_log('Regex is required for pages at Pages.');
                        break;
                    }

                    if (preg_match($page['regex'], $path)) {

                        if (!isset($page['file_name'])) {
                            error_log('Filename is required for pages at Pages.');
                            return;
                        }

                        add_filter('template_include', function ($template_include) use ($page) {
                            return $this->templates->get_page_template($template_include, $page);
                        });

                        break;
                    }
                }
            }

            if (!empty($this->taxonomies_list)) {
                foreach ($this->taxonomies_list as $taxonomy) {
                    if (!isset($taxonomy['slug'])) {
                        error_log('Regex is required for taxonomies at Taxonomies.');
                        break;
                    }

                    if (preg_match("#^/{$taxonomy['slug']}/([a-zA-Z-]+)#", $path)) {
                        $filename = str_replace(' ', '', $taxonomy['singular']);

                        add_filter('template_include', function ($template_include) use ($taxonomy, $filename) {
                            return $this->templates->get_taxonomy_page_template($template_include, $taxonomy, $filename);
                        });
                        break;
                    }

                    if (preg_match("#^/{$taxonomy['slug']}#", $path)) {
                        $filename = str_replace(' ', '', $taxonomy['plural']);

                        add_filter('template_include', function ($template_include) use ($taxonomy, $filename) {
                            return $this->templates->get_taxonomy_page_template($template_include, $taxonomy, $filename);
                        });
                        break;
                    }
                }
            }

            if (!empty($this->post_types_list)) {
                foreach ($this->post_types_list as $post_type) {
                    if (!isset($post_type['slug'])) {
                        error_log('Regex is required for post types at Post_Types.');
                        break;
                    }

                    if (preg_match("#^/{$post_type['slug']}/([a-zA-Z-]+)#", $path)) {
                        add_filter('single_template', function ($single_template) use ($post_type) {
                            return $this->templates->get_single_page_template($single_template, $post_type);
                        });
                        break;
                    }

                    if (preg_match("#^/{$post_type['slug']}#", $path)) {
                        add_filter('archive_template', function ($archive_template) use ($post_type) {
                            return $this->templates->get_archive_page_template($archive_template, $post_type);
                        });
                        break;
                    }
                }
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at load_page');

            return $response;
        }
    }

    function react_rewrite_rules()
    {
        add_rewrite_rule('^forgot/?', 'index.php?', 'top');
        add_rewrite_rule('^password-recovery\/([a-z0-9.%]+)\/([a-zA-Z0-9-]+)?$', 'index.php?', 'top');
        add_rewrite_rule('^account-recovery\/([a-z0-9.%]+)\/([a-zA-Z0-9-]+)?$', 'index.php?', 'top');
        add_rewrite_rule('^verify-email\/([a-z0-9.%]+)\/([a-zA-Z0-9-]+)?$', 'index.php?', 'top');
        add_rewrite_rule('^remove-account\/([a-z0-9.%]+)\/([a-zA-Z0-9-]+)?$', 'index.php?', 'top');
        add_rewrite_rule('^login/?', 'index.php?', 'top');
        add_rewrite_rule('^logout/?', 'index.php?', 'top');
        add_rewrite_rule('^signup/?', 'index.php?', 'top');
        add_rewrite_rule('^dashboard/?', 'index.php?', 'top');
    }
}
