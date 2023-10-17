<?php
namespace THFW\Customizer;

include 'customizer-social-bar.php';

use THFW\Customizer\Social_Bar\THFW_Customizer_Social_Bar;

class THFW_Customizer
{
	public function __construct()
	{
		add_theme_support('custom-logo');
		add_theme_support("custom-background");
		add_action('wp_head', [$this, 'load_css']);

		new THFW_Customizer_Social_Bar();
	}

	function load_css()
	{
?>
		<style>
			:root {
				--thfw-box-shadow-social: 0.25em -0.25em 0.25em rgba(0, 0, 0, 0.5), 0.25em 0.25em 0.25em rgba(0, 0, 0, 0.5);
			}
		</style>
<?php
	}
}
