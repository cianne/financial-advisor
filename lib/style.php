<?php
/**
 * Dynamic CSS
 *
 * @package 	OTR by RecommendWP V2
 * @since 		1.0
 * @author 		RecommendWP <http://www.recommendwp.com>
 * @copyright 	Copyright (c) 2014, RecommendWP
 * @license 	http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

function mb_option( $name ) {
	if( !class_exists( 'VP_AutoLoader' ) )
		return;

	return vp_option( 'mb_option.' . $name );
}

function mb_inline_styles() {
	$link_color = mb_option( 'link_color' );
	$link_hover = mb_option( 'link_hover' );

	$heading_font = mb_option( 'heading_font' );
	$heading_style = mb_option( 'heading_style' );
	$heading_weight = mb_option( 'heading_weight' );

	$body_font = mb_option( 'body_font' );
	$body_style = mb_option( 'body_style' );
	$body_weight = mb_option( 'body_weight' );

	$optin_color = mb_option( 'optin_color' );
	$optin_background = mb_option( 'optin_background' );
	$optin_hover = mb_option( 'optin_hover' );

	$styles = '
		body, .entry-meta a, .site-description, form, .search-form input[type="search"] {
			'.( !empty( $body_font ) ? 'font-family: "'.$body_font.'"' : '' ).';
			'.( !empty( $body_weight ) ? 'font-weight: '.$body_weight.'' : '' ).';
			'.( !empty( $body_style ) ? 'font-style: '.$body_style.'' : '' ).';
		}

		body, input[type="search"], input[type="text"], input[type="password"], input[type="email"], input[type="url"], textarea, select, .site-description, .entry-meta a, .comment-respond .required, .gform_wrapper input[type="text"], .gform_wrapper input[type="url"], .gform_wrapper input[type="email"], .gform_wrapper input[type="tel"], .gform_wrapper input[type="number"], .gform_wrapper input[type="password"], .before-header {
			'.( !empty( $body_font ) ? 'font-family: "'.$body_font.'"' : '' ).';
			'.( !empty( $body_weight ) ? 'font-weight: '.$body_weight.'' : '' ).';
			'.( !empty( $body_style ) ? 'font-style: '.$body_style.'' : '' ).';
		}

		h1, h2, h3, h4, h5, h6, th, dt, label, legend, button, input[type="submit"], input[type="reset"], input[type="button"], .footer-widgets .widgettitle, .entry-footer .entry-meta, .pagination li > a, .pagination a, .entry-comments a.comment-reply-link, .entry-comments .comment-author a, .entry-comments .comment-author span[itemprop="name"], .entry-pings .fn, .widget_recent_entries li a, .before-header .btn, .home .content .entry-title, .home .content .entry-header .entry-meta, .home-featured .widgettitle, .home .content .entry-footer .entry-meta a {
			'.( !empty( $heading_font ) ? 'font-family: "'.$heading_font.'"' : '' ).';
			'.( !empty( $heading_weight ) ? 'font-weight: '.$heading_weight.'' : '' ).';
			'.( !empty( $heading_style ) ? 'font-style: '.$heading_style.'' : '' ).';
		}

		.before-header .btn {
			'.( !empty( $optin_color ) ? 'color: '.$optin_color.'' : '' ).';
			'.( !empty( $optin_background ) ? 'background: '.$optin_background.'' : '' ).';
		}

		.before-header .btn:hover {
			'.( !empty( $optin_hover ) ? 'background: '.$optin_hover.'' : '' ).';
		}
	';

	wp_add_inline_style( 'child-theme', $styles );
}

function mb_heading_webfont() {
	// Google Font
	$heading_font = mb_option( 'heading_font' );
	$heading_style = mb_option( 'heading_style' );
	$heading_weight = mb_option( 'heading_weight' );
	VP_Site_GoogleWebFont::instance()->add($heading_font, $heading_weight, $heading_style);
	VP_Site_GoogleWebFont::instance()->register_and_enqueue();
}

function mb_body_webfont() {
	$body_font = mb_option( 'body_font' );
	$body_style = mb_option( 'body_style' );
	$body_weight = mb_option( 'body_weight' );
	VP_Site_GoogleWebFont::instance()->add( $body_font, $body_style, $body_weight );
	VP_Site_GoogleWebFont::instance()->register_and_enqueue();
}

// Custom CSS
function mb_custom_css() {
	$custom = mb_option( 'custom_css' );

	if ( $custom ) {
		wp_add_inline_style( 'child-theme', $custom );
	}
}

// Google Font Enqueue
function mb_custom_typography_meta() {
	$use_custom_typography = mb_option( 'use_custom_typography' );
	$use_custom_background = mb_option( 'use_custom_background' );

	switch ( $use_custom_typography ) {
		case '0':
		default:
			// Google Web Font
			// add_action( 'wp_print_styles', 'mb_google_webfont_enqueue' );
			break;
		case '1':
			// add_action( 'wp_enqueue_scripts', 'mb_inline_styles' );
			add_action( 'wp_print_styles', 'mb_heading_webfont' );
			add_action( 'wp_print_styles', 'mb_body_webfont' );
			remove_action( 'wp_print_styles', 'mb_google_webfont_enqueue' );
			break;
	}

	switch ( $use_custom_background ) {
		case '0':
		default:
			# code...
			break;

		case '1':
			add_action( 'wp_enqueue_scripts', 'mb_body_styles' );
			break;
	}

	add_action( 'wp_enqueue_scripts', 'mb_custom_css' );
	// add_action( 'wp_enqueue_scripts', 'mb_custom_color_option' );
}

// Body Background
function mb_body_styles() {
	$body_background = mb_option( 'body_background' );
	$body_image = mb_option( 'body_image' );

	$foo = '
		body {
			'.( !empty( $body_background ) ? 'background: '.$body_background.'' : '' ).';
			'.( !empty( $body_image ) ? 'background-image: url('.$body_image.')' : '' ).';
			background-repeat: repeat;
			background-position: left top;
		}
	';
	if ( $body_background )
		wp_add_inline_style( 'child-theme', $foo );
}

function mb_custom_color_option() {
	$color_option = mb_option( 'color_option' );
	$lighten = colourBrightness( $color_option, 0.9 );

	$styles = '
	';

	if ( $color_option )
		wp_add_inline_style( 'child-theme', $styles );

}

add_action( 'genesis_meta', 'mb_custom_typography_meta' );
