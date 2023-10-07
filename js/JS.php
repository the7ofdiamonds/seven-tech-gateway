<?php

namespace THFW_Users\JS;

class JS
{

    public function __construct()
    {
        add_action('wp_head', [$this, 'load_js']);
        add_action('wp_footer', [$this, 'load_react']);
        add_filter('script_loader_tag', [$this, 'set_script_type_to_module'], 10, 2);
        // add_action('wp_enqueue_scripts', [$this, 'load_firebase']);
    }

    function load_js()
    {
        wp_register_script('thfw_users_js', THFW_USERS_URL . 'JS/thfw-users.js', array('jquery'), false, false);
        wp_enqueue_script('thfw_users_js');
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
        $directory = THFW_USERS . 'build';

        if (is_front_page() | is_page('about') | is_page('login') | is_page('logout') | is_page('signup') | is_page('forgot')) {

            $jsFiles = $this->get_js_files($directory);

            foreach ($jsFiles as $jsFile) {
                $handle = 'thfw_users_react_' . basename($jsFile);

                wp_enqueue_script($handle, THFW_USERS_URL . 'build/' . $jsFile, array('react', 'react-dom', 'wp-element'), "1.0.0", true);
            }
        }
    }

    function set_script_type_to_module($tag, $handle)
    {
        if (strpos($handle, 'thfw_users_react_') === 0) {
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
