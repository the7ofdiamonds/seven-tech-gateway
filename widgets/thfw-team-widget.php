<?php

class THFW_Team_Widget extends WP_widget {

    public function __construct() {

        $widget_ops = array(
            'classname' => 'thfw-team-widget',
            'description' => 'THFW Team Widget',
        );

        parent::__construct('thfw_team_widget', 'THFW Team Widget', $widget_ops);
    }

    public function form( $instance ) {
        echo '<p>Shows team members info.</p>';
    }

    public function widget( $args, $instance) {
        
        include( WP_PLUGIN_DIR . '/thfw-users/includes/part-team.php' );
    }
}