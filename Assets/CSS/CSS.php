<?php

namespace SEVEN_TECH\Assets\CSS;

use Exception;

use SEVEN_TECH\Assets\CSS\Customizer\BorderRadius;
use SEVEN_TECH\Assets\CSS\Customizer\Color;
use SEVEN_TECH\Assets\CSS\Customizer\Shadow;

class CSS
{
    private $handle_prefix;
    private $dir;
    private $dirURL;
    private $cssFolderPath;
    private $cssFolderPathURL;
    private $cssFileName;
    private $filePath;

    public function __construct()
    {
        $this->handle_prefix = 'seven_tech_';
        $this->dir = SEVEN_TECH;
        $this->dirURL = SEVEN_TECH_URL;
        $this->cssFileName = 'seven-tech.css';

        $this->cssFolderPath = $this->dir . 'Assets/CSS/dist';
        $this->cssFolderPathURL = $this->dirURL . 'Assets/CSS/';

        $this->filePath = $this->cssFolderPath . $this->cssFileName;
    }

    function load_customization_css()
    {
        (new BorderRadius)->load_css();
        (new Color)->load_css();
        (new Shadow)->load_css();
    }

    function load_front_page_css($section)
    {
        try {
            if (!empty($section)) {
                $this->load_customization_css();

                if ($this->filePath) {
                    wp_register_style($this->handle_prefix . 'css',  $this->cssFolderPathURL . $this->cssFileName, array(), false, 'all');
                    wp_enqueue_style($this->handle_prefix . 'css');
                } else {
                    throw new Exception('CSS file is missing at :' . $this->filePath, 404);
                }
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at load_front_page_css');

            return $response;
        }
    }

    function load_pages_css($page)
    {
        try {
            if (!empty($page)) {
                $this->load_customization_css();

                if ($this->filePath) {
                    wp_register_style($this->handle_prefix . 'css',  $this->cssFolderPathURL . $this->cssFileName, array(), false, 'all');
                    wp_enqueue_style($this->handle_prefix . 'css');
                } else {
                    throw new Exception('CSS file is missing at :' . $this->filePath, 404);
                }
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at load_pages_css');

            return $response;
        }
    }

    function load_taxonomies_css($taxonomy)
    {
        try {
            if (!empty($taxonomy['name']) && is_tax($taxonomy['name'])) {
                $this->load_customization_css();

                if ($this->filePath) {
                    wp_register_style($this->handle_prefix . 'css',  $this->cssFolderPathURL . $this->cssFileName, array(), false, 'all');
                    wp_enqueue_style($this->handle_prefix . 'css');
                } else {
                    throw new Exception('CSS file is missing at :' . $this->filePath, 404);
                }
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at load_taxonomies_css');

            return $response;
        }
    }

    function load_post_types_css($post_type)
    {
        try {
            if (!empty($post_type) && (is_array($post_type) || is_object($post_type)) && (is_post_type_archive($post_type) || is_singular($post_type))) {
                $this->load_customization_css();

                if ($this->filePath) {
                    wp_register_style($this->handle_prefix . 'css',  $this->cssFolderPathURL . $this->cssFileName, array(), false, 'all');
                    wp_enqueue_style($this->handle_prefix . 'css');
                } else {
                    throw new Exception('CSS file is missing at :' . $this->filePath, 404);
                }
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();
            $response = $errorMessage . ' ' . $errorCode;

            error_log($response . ' at load_post_types_css');

            return $response;
        }
    }

    function load_social_bar_css()
    {
        wp_register_style($this->handle_prefix . 'social_bar_css',  $this->cssFolderPathURL . 'social-bar.css', array(), false, 'all');
        wp_enqueue_style($this->handle_prefix . 'social_bar_css');
    }
}
