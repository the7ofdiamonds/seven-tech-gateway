<?php
namespace THFW_Users\CSS;

use THFW\CSS\Customizer\Customizer;

class CSS {
    
    public function __construct() {
        add_action('wp_head', [$this, 'load_css']);

        // new Customizer;
    }

    //Load Plugin CSS & JS
    function load_css(){
        
        wp_register_style('thfw_users_css',  THFW_USERS_URL . 'CSS/thfw-users.css', array(), false, 'all' );
        wp_enqueue_style('thfw_users_css');
    }  
}