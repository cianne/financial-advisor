<?php
/**
 * Scripts
 *
 * @package      Boilerplate for Genesis
 * @since        1.0
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2014, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Theme Scripts
add_action( 'wp_enqueue_scripts', 'mb_theme_scripts' );
function mb_theme_scripts() {
	$color_option = mb_option( 'color_option' );
	$use_custom_typography = mb_option( 'use_custom_typography' );

	if ( !is_admin() ) {
		wp_register_script( 'vendor-js', MB_THEME_SCRIPTS . 'vendor.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'vendor-js' );

		wp_register_script( 'app-js', MB_THEME_SCRIPTS . 'app.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'app-js' );

		// Dequeue Developer Bundle Stylesheet
		wp_deregister_style( 'db-css' );
		wp_dequeue_style( 'db-css' );

		// WP-Less
		if ( $color_option || $use_custom_typography )
			wp_enqueue_style( 'custom-css', MB_THEME_LESS . 'custom-css.less' );
	}
}

// Admin Scripts
add_action( 'admin_enqueue_scripts', 'mb_admin_scripts' );
function mb_admin_scripts() {
	wp_enqueue_style( 'admin-css', MB_THEME_LESS . 'admin.less' );
}
