<?php

namespace SEVEN_TECH\Gateway\Shortcodes;

class Shortcodes
{
    public function __construct()
    {
        add_shortcode('seven-tech-gateway-nav', [$this, 'seven_tech_gateway_nav']);
    }

    function seven_tech_gateway_nav(){
       include SEVEN_TECH . 'includes/react.php';
    }  
}
