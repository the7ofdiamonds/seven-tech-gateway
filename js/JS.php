<?php

namespace THFW_Users\JS;

class JS
{

    public function __construct()
    {
        add_action('wp_head', [$this, 'load_js']);
        add_action('wp_enqueue_scripts', [$this, 'load_react']);
        add_action('wp_enqueue_scripts', [$this, 'load_firebase']);
    }

    //Load Plugin JS
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
        $directory = THFW_USERS . 'JS/React/';
        $jsFiles = $this->get_js_files($directory);

        foreach ($jsFiles as $jsFile) {
            $handle = 'orb_services_react_' . basename($jsFile);
?>
            <script type="module" src=<?php echo THFW_USERS_URL . 'JS/React/' . $jsFile ?> id="<?php echo $handle ?>"></script>
        <?php
        }
    }

    function load_firebase()
    { ?>
        <script type="module">
            import {
                initializeApp
            } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-app.js";

            const firebaseConfig = {
                apiKey: "AIzaSyBu0CCToizQh2SORCP-4dAmXHJpzB6tU6k",
                authDomain: "theorb-f3a48.firebaseapp.com",
                databaseURL: "https://theorb-f3a48.firebaseio.com",
                projectId: "theorb-f3a48",
                storageBucket: "theorb-f3a48.appspot.com",
                messagingSenderId: "1073451047758",
                appId: "1:1073451047758:web:ae958815b1fd677e071c1f",
                measurementId: "G-09W10PNNF0"
            };

            const firebase = initializeApp(firebaseConfig);
        </script>
<?php }
}
