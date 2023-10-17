<?php

namespace SEVEN_TECH\JS;

use SEVEN_TECH\SEVEN_TECH;

class JS
{

    public function __construct()
    {
        // add_action('wp_footer', [$this, 'load_js']);
        add_action('wp_footer', [$this, 'load_react']);
        add_filter('script_loader_tag', [$this, 'set_script_type_to_module'], 10, 2);
        // add_action('wp_enqueue_scripts', [$this, 'load_firebase']);
    }

    function load_js()
    {
        wp_register_script('seven_tech_js', SEVEN_TECH_URL . 'JS/seven-tech.js', array('jquery'), false, false);
        wp_enqueue_script('seven_tech_js');
    }

    function get_js_files($directory)
    {
        $jsFiles = array();
        $files = scandir($directory);

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'js') {
                $jsFiles[] = $file;
            }
        }
        return $jsFiles;
    }

    function load_react()
    {
        $pages = [
            'about',
            'forgot',
            'login',
            'logout',
            'signup'
        ];

        if (is_front_page() || is_page($pages)) {

            $directory = SEVEN_TECH . 'build';

            $jsFiles = $this->get_js_files($directory);

            foreach ($jsFiles as $jsFile) {
                $handle = 'seven_tech_react_' . basename($jsFile);

                wp_enqueue_script($handle, SEVEN_TECH_URL . 'build/' . $jsFile, array('react', 'react-dom', 'wp-element'), "1.0.0", true);
            }
        }
    }

    function set_script_type_to_module($tag, $handle)
    {
        if (strpos($handle, 'seven_tech_react_') === 0) {
            $tag = str_replace('type=\'text/javascript\'', 'type=\'module\'', $tag);
        }
        return $tag;
    }

    function load_firebase()
    { ?>
        <script type="module">
            import {
                initializeApp
            } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-app.js";
            import {
                getAuth
            } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-auth.js";
        </script>
<?php }
}
