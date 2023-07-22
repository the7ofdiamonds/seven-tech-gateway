<?php

class THFW_Modal_Widget extends WP_widget {

    public function __construct() {

        $widget_ops = array(
            'classname' => 'thfw-modal-widget',
            'description' => 'THFW Modal Widget',
        );

        parent::__construct('thfw_modal_widget', 'THFW Modal Widget', $widget_ops);
    }

    public function form( $instance ) {
        echo '<p>Dashboard popup opened up by clicking site icon.</p>';
    }

    public function widget( $args, $instance) {
        
        include( WP_PLUGIN_DIR . '/thfw-users/includes/part-modal.php' );
    }
}