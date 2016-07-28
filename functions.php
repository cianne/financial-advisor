<?php
/**
 * Functions
 *
 * @package      Boilerplate for Genesis
 * @since        1.0
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2014, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

add_action( 'genesis_setup', 'mb_child_theme_setup', 15 );
function mb_child_theme_setup() {
	// Start the engine
	include_once( get_template_directory() . '/lib/init.php' );

	// Define CSS Theme Version
	define( 'MB_THEME_VERSION', filemtime( get_stylesheet_directory() . '/style.css' ) );

	// Child theme (do not remove)
	define( 'MB_THEME_NAME', 'Boilerplate for Genesis' );
	define( 'MB_THEME_URL', 'http://www.recommendwp.com/' );
	define( 'MB_THEME_LIB', CHILD_DIR . '/lib/' );
	define( 'MB_THEME_LIB_URL', CHILD_URL . '/lib/' );
	define( 'MB_THEME_IMAGES', CHILD_URL . '/images/' );
	define( 'MB_THEME_SCRIPTS', CHILD_URL . '/assets/js/' );
	define( 'MB_THEME_STYLES', CHILD_URL . '/assets/css/' );
	define( 'MB_THEME_LESS', CHILD_URL . '/assets/less/' );
	define( 'MB_DEVELOPER_BUNDLE', CHILD_DIR . '/lib/developer-bundle/' );
	define( 'MB_DEVELOPER_BUNDLE_URL', CHILD_URL . '/lib/developer-bundle/' );

	// TGM Plugin Activation
	require_once( MB_THEME_LIB . 'classes/class-tgm-plugin-activation.php' );

	// Developer Bundle
	require_once( MB_THEME_LIB . 'developer-bundle/plugin.php' );

	// WP-Less Support
	if ( !class_exists( 'WPLessPlugin' ) ){
		require_once dirname( __FILE__ ) . '/lib/wp-less/bootstrap-for-theme.php';
		WPLessPlugin::getInstance()->dispatch();
	}

	// Easy WP Thumbs
	// require_once( MB_THEME_LIB . 'classes/easy_wp_thumbs.php' );

	// Include Required PHP Files
    $functions = glob( MB_THEME_LIB . '*.php', GLOB_NOSORT );
    if ( is_array( $functions ) ) {
    	foreach ( $functions as $function ) {
    		include_once $function;
    	}
    }

	// Remove Genesis Admin Menu
	// remove_theme_support( 'genesis-admin-menu' );

	// Genesis 2.0 HTML5 Structure
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	// Add support for 3-column footer widgets
	add_theme_support( 'genesis-footer-widgets', 3 );

	// WooCommerce Support
	add_theme_support( 'genesis-connect-woocommerce' );

	// Structural Wraps
	add_theme_support( 'genesis-structural-wraps', array(
		'header',
		'nav',
		'subnav',
		'site-inner',
		'footer-widgets',
		'footer',
	) );

	// Navigation Menus
	// remove_theme_support ( 'genesis-menus' );
	/* add_theme_support ( 'genesis-menus' , array(
		'primary' => __( 'Primary Navigation Menu', 'starter' ) ,
		'secondary' => __( 'Secondary Navigation Menu', 'starter' ) ,
		'footer' => __( 'Footer Navigation Menu', 'starter' ),
		// 'mobile' => __( 'Mobile Navigation Menu', 'starter' )

	) ); */

	// Add viewport meta tag for mobile browsers
	add_theme_support( 'genesis-responsive-viewport' );

	// Post Formats
	add_theme_support( 'post-formats', array(
		'aside',
		'audio',
		'chat',
		'gallery',
		'image',
		'link',
		'quote',
		'status',
		'video'
	) );

	// Custom Image Sizes
	add_image_size( 'boilerplate-blog', 750, 422, true );
	add_image_size( 'blogpage-thumbnail', 390, 290, true );
	add_image_size( 'popular-thumbnail', 103, 103, true );
	add_image_size( 'testimonial-thumbnail', 145, 144, true );


	// Unregister site layouts
	// genesis_unregister_layout( 'content-sidebar-sidebar' );
	// genesis_unregister_layout( 'sidebar-sidebar-content' );
	// genesis_unregister_layout( 'sidebar-content-sidebar' );
	// genesis_unregister_layout( 'sidebar-content' );


	// Unregister unneeded sidebars
	 unregister_sidebar( 'header-right' );
	// unregister_sidebar( 'sidebar-alt' );

	// Cleanup WP Head
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'start_post_rel_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );

	// Remove Stylesheet
	// remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
	//* Reposition the primary navigation menu
	remove_action( 'genesis_after_header', 'genesis_do_nav' );
	add_action( 'genesis_header', 'genesis_do_nav', 12 );

	// Reposition Secondary Navigation
	remove_action( 'genesis_after_header', 'genesis_do_subnav' );
	//add_action( 'genesis_before_header', 'genesis_do_subnav', 20 );

	// IE Only Meta Tag & Safari Telephone Number Fix
	add_action( 'genesis_meta', 'mb_custom_meta_tag' );

	// Deregister footer widget area and reinstate
	remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
	add_action( 'genesis_before_footer', 'genesis_footer_widget_areas', 20 );

	// Before Footer Widgets Area
	add_action( 'genesis_before_footer', 'mb_before_footer_widget_area', 15 );

	// Before Footer
	add_action( 'genesis_before_footer', 'mb_before_footer', 25 );

	// Remove unneeded WordPress and Genesis Widgets
	add_action( 'widgets_init', 'mb_remove_default_widgets', 11 );

	// Remove 'Customize Page' link in Admin
	add_action('admin_init', 'mb_remove_customize');

	// Register Sidebar
	add_action( 'init', 'mb_register_sidebars' );

	// Allow PHP Execution on Widgets
	add_filter( 'widget_text','mb_execute_php', 100 );

	// Add Shortcode Functionality to Text Widgets
	add_filter( 'widget_text', 'shortcode_unautop' );
	add_filter( 'widget_text', 'do_shortcode' );

	// Add shortcode functionality to widget title
	add_filter( 'widget_title', 'shortcode_unautop' );
	add_filter( 'widget_title', 'do_shortcode' );

	// Prevent WordPress from displaying login error message
	add_filter( 'login_errors', create_function( '$a', "return null;" ) );

	// Remove Admin Bar
	//if ( !is_admin() ) add_filter('show_admin_bar', '__return_false');

	// Remove the edit link
	add_filter ( 'genesis_edit_post_link' , '__return_false' );

	// Prevent Theme Update Check
	// add_filter( 'http_request_args', 'mb_prevent_theme_update', 5, 2 );

	// Remove WP Version
	add_filter( 'the_generator', 'mb_remove_wp_version' );

	// HTML Editor as default
	// add_filter( 'wp_default_editor', create_function( '', 'return "html";' ) );

	// Prevent HTML on Comments
	add_filter( 'preprocess_comment', 'mb_comment_post', '', 1 );
	add_filter( 'comment_text', 'mb_comment_display', '', 1 );
	add_filter( 'comment_text_rss', 'mb_comment_display', '', 1 );
	add_filter( 'comment_excerpt', 'mb_comment_display', '', 1 );

	// This stops WordPress from trying to automatically make hyperlinks on text:
	remove_filter( 'comment_text', 'make_clickable', 9 );

	// High Quality JPEGs
	// add_filter( 'jpg_quality', 'high_jpg_quality' );

	// Remove header-full-width
	add_filter( 'body_class', 'mb_remove_header_full_width' );

	// Remove Query Strings
	add_filter( 'style_loader_src', 'mb_remove_cssjs_ver', 10, 2 );
	add_filter( 'script_loader_src', 'mb_remove_cssjs_ver', 10, 2 );

	// Custom Image Sizes on Media Library
	// add_filter( 'image_size_names_choose', 'mb_size_names_choose' );

	// Change 'Leave a Reply'
	add_filter( 'genesis_comment_form_args', 'mb_comment_form_args' );

	// Custom Meta
	add_action( 'genesis_meta', 'mb_do_meta' );

	// Remove jQuery Migrate
	// add_filter( 'wp_default_scripts', 'mb_remove_jquery_migrate' );

	// Remove unused Genesis settings metaboxes
	add_action( 'genesis_theme_settings_metaboxes', 'mb_remove_metaboxes' );

	// Remove Primary Navigation
	// remove_action( 'genesis_after_header', 'genesis_do_nav' );

	// Remove WP Link Pages
	remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );

	// Change Default WP Link Pages Pagination
	add_action( 'genesis_entry_content', 'mb_do_post_content_nav' );

	// add_filter( 'use_default_gallery_style', '__return_false' );

	// Move Featured Image In Entry Header
	remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
	add_action( 'genesis_entry_header', 'genesis_do_post_image', 8 );

	// Remove Default Genesis Page Templates
	// add_filter( 'theme_page_templates', 'mb_remove_genesis_page_templates' );

	// Remove Post Info and Meta
	//remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

	// Display author box on single posts
	// add_filter( 'get_the_author_genesis_author_box_single', '__return_true' );

	// Scripts
	add_action( 'wp_enqueue_scripts', 'mb_theme_scripts' );

	// Favicon
	add_filter( 'genesis_pre_load_favicon', 'mb_favicon' );

	// TGM Plugin Activation
	add_action( 'tgmpa_register', 'mb_do_plugins_register' );

	// Remove WP Emoji
	// @http://www.denisbouquet.com/remove-wordpress-emoji-code/
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');

	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );

	//display featured image in singular post
	add_action( 'genesis_before_entry', 'mb_featured_post_image', 8 );	
}


// Load Genesis Stylesheet after Plugins Stylesheet
// add_action( 'genesis_setup', 'mb_genesisstyletrump_load_stylesheet', 20 );

// Load Languages
// @https://github.com/vafour/vafpress-framework-theme-boilerplate/blob/master/functions.php
add_action( 'after_setup_theme', 'mb_load_textdomain' );
function mb_load_textdomain() {
	load_theme_textdomain( 'boilerplate', CHILD_DIR . '/lang/' );
}
