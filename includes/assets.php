<?php

function html5blank_header_scripts()
{
	global $wp_query;

	if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) {
		wp_register_script( 'type_theme_plugins', get_template_directory_uri() . '/assets/js/plugins.js', array( 'jquery' ), '1.0.0' ); // Custom pluginss
		wp_enqueue_script( 'type_theme_plugins' );
		wp_register_script( 'type_theme_script', get_template_directory_uri() . '/assets/js/script.js', array( 'jquery' ), '1.0.0' ); // Custom scripts
		wp_enqueue_script( 'type_theme_script' );

		wp_localize_script( 'type_theme_script', 'ajax_var', array(
			'url'        => admin_url( 'admin-ajax.php' ),
			'nonce'      => wp_create_nonce( 'ajax-nonce' ),
			'totalPages' => $wp_query->max_num_pages
		) );
	}
}

// Load HTML5 Blank styles
function html5blank_styles()
{
	wp_register_style( 'style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'style' );
}
