<?php

include "includes/functions.php";
include "includes/assets.php";
include "includes/colors.php";
include "includes/shortcodes.php";
include "includes/tinymce.php";
include "includes/social.php";
include "includes/actions.php";
include "includes/filters.php";

function type_customize_register( $wp_customize )
{

    $wp_customize->remove_section( 'nav' );
    $wp_customize->remove_section( 'static_front_page' );

    $wp_customize->add_section( 'social_section', array(
        'title'      => 'Social media profiles',
        'capability' => 'edit_theme_options',
        'priority'   => 24
    ) );

    $wp_customize->add_section( 'colors_section', array(
        'title'      => 'Colors',
        'capability' => 'edit_theme_options',
        'priority'   => 23
    ) );

    $wp_customize->add_section( 'theme_section', array(
        'title'      => 'Theme options',
        'capability' => 'edit_theme_options',
        'priority'   => 21
    ) );

    $wp_customize->add_section( 'about_section', array(
        'title'      => '"About" Section',
        'capability' => 'edit_theme_options',
        'priority'   => 25
    ) );

    $wp_customize->add_section( 'custom_css_section', array(
        'title'      => 'Custom css',
        'capability' => 'edit_theme_options',
        'priority'   => 1000
    ) );


    /**
     * Avatar
     */
    $wp_customize->add_setting( 'type_theme_options[avatar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'avatar', array(
        'label'    => 'Upload avatar',
        'section'  => 'theme_section',
        'settings' => 'type_theme_options[avatar]'
    ) ) );


    /**
     * Top gradient color
     */
    $wp_customize->add_setting( 'type_theme_options[type-start-color]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '#0088f3'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'type-start-color', array(
        'label'    => 'Gradient color 1',
        'section'  => 'colors_section',
        'settings' => 'type_theme_options[type-start-color]'
    ) ) );


    /**
     * Top gradient color
     */
    $wp_customize->add_setting( 'type_theme_options[type-end-color]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '#1abc9c'
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'type-end-color', array(
        'label'    => 'Gradient color 2',
        'section'  => 'colors_section',
        'settings' => 'type_theme_options[type-end-color]'
    ) ) );

    /**
     * Fancy photo captions
     */
    $wp_customize->add_setting( 'type_theme_options[fancy-captions]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => true
    ) );

    $wp_customize->add_control( 'fancy-caption', array(
        'settings' => 'type_theme_options[fancy-captions]',
        'label'    => 'Fancy photo captions',
        'section'  => 'theme_section',
        'type'     => 'checkbox',
    ) );

    /**
     * Format first paragraph
     */
    $wp_customize->add_setting( 'type_theme_options[format-lede]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => true
    ) );

    $wp_customize->add_control( 'format-lede', array(
        'settings' => 'type_theme_options[format-lede]',
        'label'    => 'Format first paragraph',
        'section'  => 'theme_section',
        'type'     => 'checkbox',
    ) );

    /**
     * Prev / Next on post page
     */
    $wp_customize->add_setting( 'type_theme_options[post-nav]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => true
    ) );

    $wp_customize->add_control( 'post-nav', array(
        'settings' => 'type_theme_options[post-nav]',
        'label'    => 'Prev / Next on post page',
        'section'  => 'theme_section',
        'type'     => 'checkbox',
    ) );

    /**
     * Infinite scroll
     */
    $wp_customize->add_setting( 'type_theme_options[infinite-scroll]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => true
    ) );

    $wp_customize->add_control( 'infinite-scroll', array(
        'settings' => 'type_theme_options[infinite-scroll]',
        'label'    => 'Infinite scroll',
        'section'  => 'theme_section',
        'type'     => 'checkbox',
    ) );

    /**
     * Show/Hide Search
     */
    $wp_customize->add_setting( 'type_theme_options[show-search]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => true
    ) );

    $wp_customize->add_control( 'show-search', array(
        'settings' => 'type_theme_options[show-search]',
        'label'    => 'Show search',
        'section'  => 'theme_section',
        'type'     => 'checkbox',
    ) );

    /**
     * Show/Hide Social Share Buttons
     */
    $wp_customize->add_setting( 'type_theme_options[show-social-share]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => true
    ) );

    $wp_customize->add_control( 'show-social-share', array(
        'settings' => 'type_theme_options[show-social-share]',
        'label'    => 'Show social share buttons',
        'section'  => 'theme_section',
        'type'     => 'checkbox',
    ) );

    /**
     * Google Analytics ID
     */
    $wp_customize->add_setting( 'type_theme_options[analytics-id]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option'
    ) );

    $wp_customize->add_control( 'analytics-id', array(
        'settings' => 'type_theme_options[analytics-id]',
        'label'    => 'Google Analytics ID',
        'section'  => 'theme_section',
        'type'     => 'text',
    ) );

    /**
     * Round/Square logo
     */
    $wp_customize->add_setting( 'type_theme_options[round-avatars]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => true
    ) );

    $wp_customize->add_control( 'round-avatars', array(
        'settings' => 'type_theme_options[round-avatars]',
        'label'    => 'Round avatar',
        'section'  => 'theme_section',
        'type'     => 'checkbox',
    ) );

    /**
     * About Section
     */
    $wp_customize->add_setting( 'type_theme_options[about-section-caption]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option'
    ) );

    $wp_customize->add_control( 'about-section-caption', array(
        'settings' => 'type_theme_options[about-section-caption]',
        'label'    => 'Caption',
        'section'  => 'about_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'type_theme_options[about-section-content]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option'
    ) );

    $wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize, 'about-section-content', array(
        'label'    => 'Bio',
        'section'  => 'about_section',
        'settings' => 'type_theme_options[about-section-content]'
    ) ) );

    /**
     * Custom css
     */
    $wp_customize->add_setting( 'type_theme_options[custom-css]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option'
    ) );

    $wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize, 'custom-css', array(
        'label'    => '',
        'section'  => 'custom_css_section',
        'settings' => 'type_theme_options[custom-css]'
    ) ) );

    /**
     * Social icons
     */
    registerSocial( 'type-behance', 'Behance' );
    registerSocial( 'type-deviantart', 'DeviantArt' );
    registerSocial( 'type-dribbble', 'Dribbble' );
    registerSocial( 'type-facebook', 'Facebook' );
    registerSocial( 'type-flickr', 'Flickr' );
    registerSocial( 'type-github', 'Github' );
    registerSocial( 'type-instagram', 'Instagram' );
    registerSocial( 'type-linkedin', 'LinkedIn' );
    registerSocial( 'type-pinterest', 'Pinterest' );
    registerSocial( 'type-reddit', 'Reddit' );
    registerSocial( 'type-skype', 'Skype' );
    registerSocial( 'type-twitter', 'Twitter' );
    registerSocial( 'type-vimeo', 'Vimeo' );
    registerSocial( 'type-youtube', 'Youtube' );
}

function registerSocial( $name, $label )
{
    global $wp_customize;

    $wp_customize->add_setting( "type_theme_options[$name]", array(
        'capability' => 'edit_theme_options',
        'type'       => 'option'
    ) );

    $wp_customize->add_control( $name, array(
        'settings' => "type_theme_options[$name]",
        'label'    => $label,
        'section'  => 'social_section',
        'type'     => 'text',
    ) );
}

if ( class_exists( 'WP_Customize_Control' ) ):
    class WP_Customize_Textarea_Control extends WP_Customize_Control {
        public $type = 'textarea';

        public function render_content()
        {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5"
                          style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
            <?php
        }
    }
endif;

add_action( 'customize_register', 'type_customize_register' );