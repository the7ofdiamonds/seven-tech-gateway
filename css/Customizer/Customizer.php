<?php

namespace SEVEN_TECH\CSS\Customizer;

class Customizer
{
	public function __construct()
	{
		add_theme_support('custom-logo');
		add_theme_support("custom-background");

		add_action('customize_register', array($this, 'register_customizer_panel'));

		new BorderRadius;
		new Color;
		new Shadow;
		new SocialBar;
	}

	function register_customizer_panel($wp_customize)
	{
		add_theme_support('customizer');
		$wp_customize->add_panel(
			'seven_tech_settings',
			array(
				'title' => __('SEVEN TECH Settings', 'the-house-forever-wins'),
				'priority' => 10,
			)
		);
	}
}
