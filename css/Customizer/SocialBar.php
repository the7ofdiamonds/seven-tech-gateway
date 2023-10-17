<?php

namespace SEVEN_TECH\CSS\Customizer;

class SocialBar
{

    public function __construct()
    {
        add_action('customize_register', array($this, 'register_customizer_section'));
        add_action('wp_head', [$this, 'load_css']);
    }

    public function register_customizer_section($wp_customize)
    {
        $this->thfw_social_bar_section($wp_customize);
    }

    private function thfw_social_bar_section($wp_customize)
    {

        $wp_customize->add_section(
            'social_bar_settings',
            array(
                'priority'       => 9,
                'capability'     => 'edit_theme_options',
                'theme_supports' => '',
                'title'          => __('Social Bar', 'the-house-forever-wins'),
                'description'    =>  __('Social Bar Settings', 'the-house-forever-wins'),
                'panel'  => 'theme_options',
            )
        );

        $wp_customize->add_setting('social_bar_box_shadow', array(
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control(
            'social_bar_box_shadow',
            array(
                'type' => 'input',
                'label' => __('Social Bar Box Shadow', 'the-house-forever-wins'),
                'section' => 'social_bar_settings',
            )
        );
    }

    function load_css()
    {
?>
        <style>
            .social-bar {
                box-shadow: <?php if (!get_theme_mod('social_bar_box_shadow')) {
                                    echo 'var(--thfw-box-shadow-social)';
                                } else {
                                    echo esc_html(get_theme_mod('social_bar_border_radius'));
                                } ?>;
            }
        </style>
<?php
    }
}
