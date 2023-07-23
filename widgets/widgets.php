<?php
include 'thfw-member-widget.php';
include 'thfw-team-widget.php';
include 'thfw-modal-widget.php';
include 'thfw-author-widget.php';

class THFW_Users_Widgets extends WP_widget {

    public function __construct() {
        add_theme_support( 'widgets');
        add_action( 'widgets_init', [$this, 'thfw_register_widget_areas'] );
        add_action( 'widgets_init', function() {
			register_widget('THFW_Member_Widget');
			register_widget('THFW_Team_Widget');
			register_widget('THFW_Modal_Widget');
			register_widget('THFW_Author_Widget');
        });
    }

	function thfw_register_widget_areas() {

		register_sidebar( 
			array(
			'name'          => 'Dashboard Page',
			'id'            => 'thfw_dashboard',
			'description'   => 'This widget area discription',
			'before_widget' => '<section class="dashboard">',
			'after_widget'  => '</section>',
		  )
		);
	}
}