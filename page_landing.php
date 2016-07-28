<?php
/**
 * Template Name: Landing
 *
 * @package      Boilerplate for Genesis
 * @since        1.0
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2014, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Force full width content
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Custom Landing Page Body Class
add_filter( 'body_class', 'mb_landing_page_class' );
function mb_landing_page_class( $classes ) {
	$classes[] = 'landing-page';
	return $classes;
}

// Custom Landing Page Conditions
add_action( 'genesis_meta', 'mb_landing_page_meta' );
function mb_landing_page_meta() {
	remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
	remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
	remove_action( 'genesis_header', 'mb_do_header' );
	remove_action( 'genesis_header', 'genesis_do_header' );
	remove_action( 'genesis_after_header', 'genesis_do_nav' );
	remove_action( 'genesis_after_header', 'genesis_do_subnav' );
	remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas', 20 );
	remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
	remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
	remove_action( 'genesis_footer', 'mb_do_footer' );
	remove_action( 'genesis_footer', 'genesis_do_footer' );
}

genesis();
