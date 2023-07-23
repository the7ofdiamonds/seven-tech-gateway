<?php

class THFW_Member_Widget extends WP_widget {

    public function __construct() {

        $widget_ops = array(
            'classname' => 'thfw-member-widget',
            'description' => 'THFW Member Widget',
        );

        parent::__construct('thfw_member_widget', 'THFW Member Widget', $widget_ops);
    }

    public function form( $instance ) {
        echo '<p>Shows currently loggedin users info.</p>';
    }

    public function widget( $args, $instance) {
        
        include( WP_PLUGIN_DIR . '/thfw-users/includes/part-user.php' );
    }
}