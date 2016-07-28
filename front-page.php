<?php
/**
 * Front Page
 *
 * @package      RWP - Financial Theme
 * @since        1.0
 * @link         http://www.RecommendWP.com
 * @author       RecommendWP <www.RecommendWP.com>
 * @copyright    Copyright (c) 2016, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/


add_action( 'genesis_meta', 'rwp_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function rwp_home_genesis_meta() {

	if ( is_active_sidebar( 'home-section-1' ) ) {


		//* Force full-width-content layout setting
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
		
		//* Add financial body class
		add_filter( 'body_class', 'rwp_body_class' );
		
		//* Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		//* Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		remove_action( 'genesis_before_footer', 'rwp_after_content', 50 );
		
		//* Add home top widgets
		add_action( 'genesis_after_header', 'rwp_font_page_section_1', 50 );
		add_action( 'genesis_after_header', 'rwp_font_page_section_2', 100 );
		add_action( 'genesis_after_header', 'rwp_font_page_section_3', 150 );
		add_action( 'genesis_loop', 'rwp_font_page_section_4', 50 );
		add_action( 'genesis_loop', 'rwp_font_page_section_5', 100 );
		add_action( 'genesis_loop', 'rwp_font_page_section_6', 150 );
		add_action( 'genesis_loop', 'rwp_font_page_section_7', 200 );
		add_action( 'wp_footer', 'rwp_popup_placeholder', 100 );

		
			
		//* Add home bottom widgets
		//add_action( 'genesis_before_footer', 'rwp_home_bottom_widgets', 1 );
	}

}

function rwp_body_class( $classes ) {

	$classes[] = 'financial-body-home';
	return $classes;
	
}

function rwp_font_page_section_1() {
	genesis_widget_area( 'home-section-1', array(
		'before' => '<div class="home-section-1"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}


function rwp_font_page_section_2() {
	genesis_widget_area( 'home-section-2', array(
		'before' => '<div class="home-section-2"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

function rwp_font_page_section_3() {
	genesis_widget_area( 'home-section-3', array(
		'before' => '<div class="home-section-3"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

function rwp_font_page_section_4() {
	genesis_widget_area( 'home-section-4', array(
		'before' => '<div class="home-section-4"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}


function rwp_font_page_section_5() {
	genesis_widget_area( 'home-section-5', array(
		'before' => '<div class="home-section-5"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

function rwp_font_page_section_6() {
	genesis_widget_area( 'home-section-6', array(
		'before' => '<div class="home-section-6"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

function rwp_font_page_section_7() {
	genesis_widget_area( 'home-section-7', array(
		'before' => '<div class="home-section-7"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

function rwp_popup_placeholder(){
	echo "<div id='popup'  style='display:none;'>Test</div>";
}

genesis();

