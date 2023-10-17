<?php

namespace SEVEN_TECH\CSS;

use SEVEN_TECH\CSS\Customizer\SocialBar;

class Customizer
{
	public function __construct()
	{
		add_theme_support('custom-logo');
		add_theme_support("custom-background");
		add_action('wp_head', [$this, 'load_css']);

		new SocialBar();
	}

	function load_css()
	{
?>
		<style>
			:root {
				--thfw-color-primary: #000;
				--thfw-color-secondary: #fff;
				--thfw-color-tertiary: red;
				--thfw-color-quaternary: #2ed341;
				--thfw-color-success: green;
				--thfw-color-error: red;
				--thfw-color-caution: yellow;
				--thfw-color-info: blue;
				--thfw-border-radius: 0.25em;
				--thfw-box-shadow: 0 0 0.5em rgba(0, 0, 0, 0.85);
				--thfw-box-shadow-btn: 0 0 0.5em rgba(0, 0, 0, 0.85);
				--thfw-box-shadow-social: 0.25em -0.25em 0.25em rgba(0, 0, 0, 0.5), 0.25em 0.25em 0.25em rgba(0, 0, 0, 0.5);
			}
		</style>
<?php
	}
}
