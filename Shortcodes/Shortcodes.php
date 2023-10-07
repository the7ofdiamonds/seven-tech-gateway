<?php

namespace THFW_Users\Shortcodes;

class Shortcodes
{
    public function __construct()
    {
        add_shortcode('thfw-team', [$this, 'team_shortcode']);
    }

    function team_shortcode()
    {
        include THFW_USERS . 'includes/section-team.php';
    }
}
