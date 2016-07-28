<?php
/*
Plugin Name: Developer Bundle
Description: A collection of widgets and shortcodes for WordPress and Genesis Framework.
Version: 1.4
Author: RecommendWP
Author URI: http://www.recommendwp.com
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
Bitbucket Plugin URI: https://bitbucket.org/webdevsuperfast/developer-bundle
*/

// Add Widget Class
if ( !class_exists( 'MB_Widget' ) )
	include_once( dirname( __FILE__ ) . '/lib/classes/widget-class.php' );

// Vafpress
if ( !class_exists( 'VP_AutoLoader' ) )
	require_once ( dirname( __FILE__ ) . '/lib/vafpress-framework/bootstrap.php' );


// AQ Resize
if( !class_exists( 'Aq_Resize' ) )
    require_once( dirname( __FILE__ ) . '/lib/classes/aq_resizer.php' );

// Shortcodes
require_once( dirname( __FILE__ ) . '/lib/classes/shortcodes.php' );

// Widgets
$widgets = glob( dirname( __FILE__ ) . '/lib/widgets/*.php', GLOB_NOSORT );
if ( is_array( $widgets ) ) {
	foreach ( $widgets as $widget ) {
		include_once $widget;
	}
}

// Functions
$functions = glob( dirname( __FILE__ ) . '/lib/functions/*.php', GLOB_NOSORT );
if ( is_array( $functions ) ) {
	foreach ( $functions as $function ) {
		require_once $function;
	}
}

// Scripts
add_action( 'admin_enqueue_scripts', 'db_widget_enqueue_scripts' );
function db_widget_enqueue_scripts( $hook ){

	// Image Upload
	wp_enqueue_media();
	wp_enqueue_script( 'widget-image-upload', MB_DEVELOPER_BUNDLE_URL . 'assets/js/image-upload.js', array( 'jquery' ) );
}

// Metabox for Masonry Layout
add_action( 'after_setup_theme', 'db_widget_metaboxes' );
function db_widget_metaboxes() {
	if( !class_exists( 'VP_AutoLoader' ) )
        return;

	$mb1 = new VP_Metabox( array(
        'id' => 'db_post',
		'types' => array( 'post' ),
		'title' => __( 'Masonry Settings', 'starter' ),
		'context' => 'side',
		'priority' => 'default',
		'is_dev_mode' => false,
		'mode' => WPALCHEMY_MODE_EXTRACT,
		'prefix' => '_post_',
		'template' => array(
			array(
				'type' => 'select',
		        'name' => 'fld_masonry',
		        'label' => __( 'Brick Size', 'starter' ),
				'items' => array(
					array(
						'value' => 'size11',
						'label' => '1x1'
					),
					array(
						'value' => 'size12',
						'label' => '1x2'
					),
					array(
						'value' => 'size21',
						'label' => '2x1'
					),
					array(
						'value' => 'size22',
						'label' => '2x2'
					),
				),
				'default' => array(
					'size11'
				)
			)
		)
	) );
}

// Masonry Sizes
add_action( 'init', 'db_masonry_thumbnail' );
function db_masonry_thumbnail() {
	add_image_size( 'masonry-size11', 265, 265, true );
	add_image_size( 'masonry-size12', 265, 555, true );
	add_image_size( 'masonry-size21', 555, 265, true );
	add_image_size( 'masonry-size22', 555, 555, true );
}

// Add Class
add_filter( 'post_class', 'db_post_masonry_class' );
function db_post_masonry_class( $classes ) {
	$mason = get_post_meta( get_the_ID(), '_post_fld_masonry', true );
	// var_dump( $mason );

	if ( 'post' == get_post_type() ) {
		if ( $mason ) {
			$classes[] = $mason;
		} else {
			$classes[] = 'size11';
		}
	}
	return $classes;
}

// Add additional sidebar
add_action( 'widgets_init', 'db_do_add_sidebar' );
function db_do_add_sidebar() {
	register_sidebar( array(
		'name' => __( 'Tab Sidebar', 'starter' ),
		'id' => 'tab-sidebar',
		'description' => __( 'Place widgets you wish to display on tabs', 'starter' )
	) );
}

// Before Testimonial Content
function db_testimonial_before_content( $instance ) {
	do_action( 'db_testimonial_before_content', $instance );
}

// After Testimonial Content
function db_testimonial_content( $instance ) {
	do_action( 'db_testimonial_content', $instance );
}

// After Testimonial Content
function db_testimonial_after_content( $instance ) {
	do_action( 'db_testimonial_after_content', $instance );
}

// After Testimonial Loop
function db_testimonial_after_loop( $instance ) {
	do_action( 'db_testimonial_after_loop', $instance );
}

// Custom Image Function
function db_post_image() {
	global $post;
	$image = '';
	$image_id = get_post_thumbnail_id( $post->ID );
	$image = wp_get_attachment_image_src( $image_id, 'full' );
	$image = $image[0];
	if ( $image ) return $image;
	return db_get_first_image();
}
