<?php

class THFW_Author_Widget extends WP_widget {

    public function __construct() {

        $widget_ops = array(
            'classname' => 'thfw-author-widget',
            'description' => 'THFW Author Widget',
        );

        parent::__construct('thfw_author_widget', 'THFW Author Widget', $widget_ops);
    }

    public function widget( $args, $instance) {
        
        include( WP_PLUGIN_DIR . '/thfw-users/features/widgets/includes/widget-author.php' );
    }
}