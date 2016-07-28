<?php
/**
 * Misc Functions
 *
 * @package      Boilerplate for Genesis
 * @since        1.0
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2014, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Custom Image Function
function mb_post_image() {
	global $post;
	$image = '';
	$image_id = get_post_thumbnail_id( $post->ID );
	$image = wp_get_attachment_image_src( $image_id, 'full' );
	$image = $image[0];
	if ( $image ) return $image;
	return mb_get_first_image();
}

// Get the First Image Attachment Function
function mb_get_first_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
	$first_img = "";
	if ( isset( $matches[1][0] ) )
		$first_img = $matches[1][0];
	return $first_img;
}

// Additional Widget Class
add_filter( 'dynamic_sidebar_params', 'mb_widget_classes' );
function mb_widget_classes( $params ) {
	global $mb_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets
	if ( !$mb_widget_num ) {// If the counter array doesn't exist, create it
		$mb_widget_num = array();
	}
	if ( !isset( $arr_registered_widgets[$this_id] ) || !is_array( $arr_registered_widgets[$this_id] ) ) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}
	if ( isset($mb_widget_num[$this_id] ) ) { // See if the counter array has an entry for this sidebar
		$mb_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$mb_widget_num[$this_id] = 1;
	}
	$class = 'class="widget widget-' . $mb_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options
	if ( $mb_widget_num[$this_id] == 1 ) { // If this is the first widget
		$class .= 'widget widget-first ';
	} elseif( $mb_widget_num[$this_id] == count( $arr_registered_widgets[$this_id] ) ) { // If this is the last widget
		$class .= 'widget widget-last ';
	}
	$counted = count_sidebar_widgets( $this_id, false );
	if ( $counted == 1 ) {
		$class .= 'widget-full ';
	} elseif ( $counted == 2 ) {
		$class .= 'widget-half ';
	} elseif ( $counted == 3 ) {
		$class .= 'widget-third ';
	} elseif ( $counted == 4 ) {
		$class .= 'widget-fourth ';
	} elseif ( $counted == 5 ) {
		$class .= 'widget-fifth ';
	} elseif ( $counted == 6 ) {
		$class .= 'widget-sixth ';
	} else {
		$class .= '';
	}
	$params[0]['before_widget'] = str_replace( 'class="widget ', $class, $params[0]['before_widget'] ); // Insert our new classes into "before widget"
	return $params;
}

// Count Sidebar Widgets
function count_sidebar_widgets( $sidebar_id, $echo = true ) {
	$the_sidebars = wp_get_sidebars_widgets();
	if( !isset( $the_sidebars[$sidebar_id] ) )
		return __( 'Invalid sidebar ID' );
	if( $echo )
		echo count( $the_sidebars[$sidebar_id] );
	else
		return count( $the_sidebars[$sidebar_id] );
}

// Remove query string from static files
function mb_remove_cssjs_ver( $src ) {
	if( strpos( $src, '?ver=' ) )
	$src = remove_query_arg( 'ver', $src );
	return $src;
}

// Remove Post Info and Meta on CPTs
add_action( 'genesis_meta', 'mb_remove_postmeta' );
function mb_remove_postmeta() {
	$args = array(
		 'public'   => true,
		 '_builtin' => false
	);
	$output = 'names'; // names or objects, note names is the default
	$operator = 'and'; // 'and' or 'or'
	$post_types = get_post_types( $args, $output, $operator );
	foreach ( $post_types  as $post_type ) {
		if ( $post_type == get_post_type() ) {
			remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
			remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		}
	}
}

// Add Genesis Support To Custom Post Type
add_action( 'init', 'mb_add_genesis_support' );
function mb_add_genesis_support() {
	// $post_type = $_GET['post_type'];
    $args = array('public' => true, '_builtin' => false );
    $post_types = get_post_types( $args, 'names' );

    if ( $post_types && !is_wp_error( $post_types ) ) {
        foreach ( $post_types as $post_type ) {
            add_post_type_support( $post_type , array( 'genesis-seo', 'genesis-layouts', 'genesis-cpt-archives-settings' ) );
        }
    }
	/* if ( 'page' != $post_type ) {
		add_post_type_support( $post_type , array( 'genesis-seo', 'genesis-layouts', 'genesis-cpt-archives-settings' ) );
	} */
}

// Prevent WordPress from creating multiple image sizes function
function mb_remove_image_sizes( $sizes ) {
	unset( $sizes['thumbnail']);
	unset( $sizes['medium']);
	unset( $sizes['large']);
	return $sizes;
}

// Remove Header Full Width Class
function mb_remove_header_full_width( array $classes ) {
	foreach ( $classes as $index => $class ) {
		if ( 'header-full-width' === $class ) {
			unset( $classes[$index] );
			break;
		}
	}
	return $classes;
}

// High Quality JPEGs function
function high_jpg_quality() {
	return 100;
}

// This will occur when the comment is posted
function mb_comment_post( $incoming_comment ) {
	// convert everything in a comment to display literally
	$incoming_comment['comment_content'] = htmlspecialchars($incoming_comment['comment_content']);
	// the one exception is single quotes, which cannot be #039; because WordPress marks it as spam
	$incoming_comment['comment_content'] = str_replace( "'", '&apos;', $incoming_comment['comment_content'] );
	return( $incoming_comment );
}

// This will occur before a comment is displayed
function mb_comment_display( $comment_to_display ) {
	// Put the single quotes back in
	$comment_to_display = str_replace( '&apos;', "'", $comment_to_display );
	return $comment_to_display;
}

// Remove WP Version Function
function mb_remove_wp_version() {
	return '';
}

// Prevent Theme Update Check Function
function mb_prevent_theme_update( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
	return $r; // Not a theme update request. Bail immediately.
	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );
	$r['body']['themes'] = serialize( $themes );
	return $r;
}

// Remove Thumbnail Dimensions Function
function mb_remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}

// Allow PHP execution on widgets
function mb_execute_php( $html ){
	if( strpos( $html,"<"."?php" ) !== false ){
		ob_start();
		eval( "?".">".$html );
		$html=ob_get_contents();
		ob_end_clean();
	}
	return $html;
}

//  IE & Chrome Meta Tag
function mb_custom_meta_tag() { ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="format-detection" content="telephone=no" />
<?php }

// Remove unneeded widgets
function mb_remove_default_widgets() {
	// unregister_widget('WP_Widget_Pages');
	// unregister_widget( 'WP_Widget_Calendar' );
	// unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Links' );
	unregister_widget( 'WP_Widget_Meta' );
	// unregister_widget( 'WP_Widget_Search' );
	// unregister_widget( 'WP_Widget_Text' );
	// unregister_widget( 'WP_Widget_Categories' );
	// unregister_widget( 'WP_Widget_Recent_Posts' );
	// unregister_widget( 'WP_Widget_Recent_Comments' );
	// unregister_widget( 'WP_Widget_RSS' );
	// unregister_widget( 'WP_Widget_Tag_Cloud' );
	// unregister_widget( 'WP_Nav_Menu_Widget' );
	// unregister_widget( 'Genesis_Featured_Page' );
	// unregister_widget( 'Genesis_User_Profile_Widget' );
	// unregister_widget( 'Genesis_Featured_Post' );
}


// Remove Customize Admin Page
function mb_remove_customize() {
	remove_submenu_page( 'themes.php','customize.php' );
}

// Custom Images in Post Edit Screen
function mb_size_names_choose( $sizes ) {
	$custom_sizes = array(
		// 'slideshow' => 'Slideshow',
		// 'small' => 'Small',
		// 'mini' => 'Mini'
		// 'blog' => 'Blog'
	);
	return array_merge( $sizes, $custom_sizes );
}

// Change 'Leave a Reply' text
function mb_comment_form_args( $args ) {
	$args['title_reply'] = 'Leave a Comment';
	return $args;
}

// Custom Meta Function
function mb_do_meta() {
	// Custom Body Class
	add_filter( 'body_class', 'mb_do_body_class' );

	// Custom Header
	$custom_header = mb_option( 'use_custom_header' );
	switch ( $custom_header ) {
		case '0':
		default:
			# code...
			break;
		case '1':
			remove_action( 'genesis_header', 'genesis_do_header' );
			add_action( 'genesis_header', 'mb_do_header' );
			break;
	}

	// Remove default footer
	$custom_footer = mb_option( 'use_custom_footer' );
	switch ( $custom_footer ) {
		case '0':
		default:
			add_filter( 'genesis_attr_site-footer', 'mb_attr_site_footer' );
			break;
		case '1':
			remove_action( 'genesis_footer', 'genesis_do_footer' );
			add_action( 'genesis_footer', 'mb_do_footer' );
			if ( !is_active_sidebar( 'footer-right' ) ) {
				add_filter( 'genesis_attr_site-footer', 'mb_attr_site_footer' );
			}
			break;
	}

	// Mobile Header
	// add_action( 'genesis_before_header', 'mb_do_mobile_header', 15 );

	// Pushy Navigation
	// add_action( 'genesis_before', 'mb_pushy_navigation' );

	$post_info = mb_option( 'post_info' );
	if ( $post_info ) {
		add_filter( 'genesis_post_info', 'mb_post_info');
	}

	$post_meta = mb_option( 'post_meta' );
	if ( $post_meta ) {
		add_filter( 'genesis_post_meta', 'mb_post_meta' );
	}

	$read_more = mb_option( 'read_more' );
	$excerpt_more = mb_option( 'excerpt_more' );
	if ( $read_more ) {
		if ( $excerpt_more ) {
			add_filter( 'excerpt_more', 'get_read_more_link' );
		}

		add_filter('get_the_content_more_link', 'get_read_more_link');
		add_filter( 'the_content_more_link', 'get_read_more_link' );			
		
	}

	$body_layout = mb_option( 'body_layout' );
	switch( $body_layout ) {
		case 'full-width':
			break;
		case 'boxed':
			add_filter( 'body_class', 'mb_do_body_layout' );
			break;
	}

	add_action('genesis_before_header', 'rwp_do_before_header_section', 10);
	add_action( 'genesis_before_footer', 'rwp_after_content', 50 );
	add_action( 'genesis_before_footer', 'rwp_before_footer_1', 100 );		
	add_action( 'genesis_before_footer', 'rwp_before_footer_2', 150 );
}

//display featured image in single post
function mb_featured_post_image() {
  if ( ! is_singular( 'post' ) )  return;
	the_post_thumbnail('full');
}


// Custom Body Class
function mb_do_body_class( $classes ) {
	if ( is_page_template( 'page_blog.php' ) ) {
		$classes[] = 'blog';
	}

	return $classes;
}

// Remove jQuery Migrate
function mb_remove_jquery_migrate( &$scripts ) {
	if( !is_admin() ) {
		$scripts->remove( 'jquery' );
		$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
	}
}

// Remove unused Genesis Settings Metaboxes
function mb_remove_metaboxes( $_genesis_theme_settings_pagehook ) {
	remove_meta_box( 'genesis-theme-settings-header', $_genesis_theme_settings_pagehook, 'main' );
	// remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );
	// remove_meta_box( 'genesis-theme-settings-layout', $_genesis_theme_settings_pagehook, 'main' );
	 remove_meta_box( 'genesis-theme-settings-breadcrumb', $_genesis_theme_settings_pagehook, 'main' );
	// remove_meta_box( 'genesis-theme-settings-comments', $_genesis_theme_settings_pagehook, 'main' );
	// remove_meta_box( 'genesis-theme-settings-blogpage', $_genesis_theme_settings_pagehook, 'main' );
}

// Custom Post Info
// add_filter( 'genesis_post_info', 'mb_post_info' );
function mb_post_info( $post_info ) {
	$info = mb_option( 'post_info' );

	if ( !is_page() ) {
		$post_info = $info;
	}

	return $post_info;
}

// Custom Post Meta
// add_filter( 'genesis_post_meta', 'mb_post_meta' );
function mb_post_meta( $post_meta ) {
	$meta  = mb_option( 'post_meta' );

	if ( !is_page() ) {
		$post_meta = $meta;
	}

	return $post_meta;
}

// Add Read More Link to Excerpts
//add_filter( 'get_the_content_more_link', 'get_read_more_link', 10 );
function get_read_more_link() {
	$read_more = mb_option( 'read_more' );
	return '...</p> <p><a class="more-link" href="' . get_permalink() . '">Read More</a>';
}

//add_filter( 'the_content_more_link', 'mb_read_more_link' );
function mb_read_more_link() {
	return '<a class="more-link" href="' . get_permalink() . '">[Continue Reading]</a>';
}


// Custom WP Link Pages
function mb_do_post_content_nav() {
	wp_link_pages( array(
		'before' => genesis_markup( array(
				'html5'   => '<div %s>',
				'xhtml'   => '<p class="pages">',
				'context' => 'entry-pagination',
				'echo'    => false,
			) ) . __( 'Pages:', 'genesis' ),
		'after'  => genesis_html5() ? '</div>' : '</p>',
		'next_or_number' => 'next_and_number',
		'nextpagelink' => __( 'Next' ),
		'previouspagelink' => __( 'Previous' ),
		'pagelink' => '%',
		'echo' => 1 )
	);
}

// WP Link Pages Filter
add_filter( 'wp_link_pages_args','add_next_and_number' );
function add_next_and_number( $args ){
	if( $args['next_or_number'] == 'next_and_number' ){
		global $page, $numpages, $multipage, $more, $pagenow;
		$args['next_or_number'] = 'number';
		$prev = '';
		$next = '';
		if ( $multipage ) {
			if ( $more ) {
				$i = $page - 1;
				if ( $i && $more ) {
					$prev .= _wp_link_page($i);
					$prev .= $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>';
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$next .= _wp_link_page( $i );
					$next .= $args['link_before']. $args['nextpagelink'] . $args['link_after'] . '</a>';
				}
			}
		}
		$args['before'] = $args['before'].$prev;
		$args['after'] = $next.$args['after'];
	}
	return $args;
}

// Load Plugins CSS before Genesis Stylesheet
function mb_genesisstyletrump_load_stylesheet() {
	remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
	add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 999 );
}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'mb_remove_comment_form_allowed_tags' );
function mb_remove_comment_form_allowed_tags( $defaults ) {
	$fields['comment_notes_before'] = ''; //Removes Email Privacy Notice
	$fields['title_reply'] = __( 'Leave a Comment', 'textdomain' );
	// $fields['label_submit'] = __( 'Share My Comment', 'customtheme' );
	$defaults['comment_notes_after'] = '';
	return $defaults;
}

// Remove Genesis Page Templates
function mb_remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}

// Customize search form input box text
// add_filter( 'genesis_search_text', 'mb_search_text' );
function mb_search_text( $text ) {
	return esc_attr( 'Search...' );
}

// Before Footer Widget Area
function mb_before_footer_widget_area() {
	do_action( 'mb_before_footer_widget_area' );
}

// Before Footer
function mb_before_footer() {
	do_action( 'mb_before_footer' );
}

// Post Navigation
add_filter( 'genesis_next_link_text', 'mb_next_link_text' );
function mb_next_link_text( $text ) {
	return 'Next';
}

add_filter( 'genesis_prev_link_text', 'mb_prev_link_text' );
function mb_prev_link_text( $text ) {
	return 'Previous';
}

// Navigation After Post
function mb_single_post_navigation() {
	if ( is_single ( ) ) { ?>
		<div class="prev_next">
			<div class="nav_left">
				<span class="prev"><?php previous_post_link('%link', '&laquo; Previous'); ?></span>
			 </div>
			<div class="nav_right">
				<span class="next"><?php next_post_link('%link', 'Next &raquo;'); ?></span>
			</div>
		</div>
	<?php }
}

// Post Navigation
function mb_posts_nav() {
	global $wp_query;
	$big = 999999999;

	$pagination_links = paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'mid_size' => 8,
		'total' => $wp_query->max_num_pages
	) );

	echo $pagination_links;
}

// Google Web Font
add_action( 'wp_print_styles', 'mb_google_webfont_enqueue' );
function mb_google_webfont_enqueue() {
	wp_register_style('google-fonts', '//fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,900', array(), MB_THEME_VERSION );
	wp_enqueue_style( 'google-fonts' );
}

// Change the breadcrumb separator
// @ http://www.rickrduncan.com/wordpress/customize-genesis-breadcrumb
add_filter( 'genesis_breadcrumb_args', 'mb_change_separator_breadcrumb' );
function mb_change_separator_breadcrumb( $args ) {
	$args['sep'] = ' &gt; ';
	$args['labels']['prefix'] = '';
	return $args;
}

// Custom Header
function mb_do_header() {
	global $wp_registered_sidebars;
	$logo = mb_option( 'logo' );

	genesis_markup( array(
		'html5'   => '<div %s>',
		'xhtml'   => '<div class="title-area" id="title-area">',
		'context' => 'title-area'
	) );
	if ( !empty( $logo ) ) {
		echo '<h1 class="site-title" itemprop="headline">';
			echo '<a href="'.get_bloginfo( 'url' ).'" class="logo" title="'.get_bloginfo( 'name' ).'">';
				echo '<img src="'.$logo.'" alt="'.get_bloginfo( 'name' ).'"/>';
			echo '</a>';
		echo '</h1>';
	} else {
		do_action( 'genesis_site_title' );
		do_action( 'genesis_site_description' );
	}
	echo '</div>';

	if ( ( isset( $wp_registered_sidebars['header-right'] ) && is_active_sidebar( 'header-right' ) ) || has_action( 'genesis_header_right' ) ) {
		genesis_markup( array(
			'html5'   => '<aside %s>',
			'xhtml'   => '<div class="widget-area header-widget-area">',
			'context' => 'header-widget-area',
		) );

			do_action( 'genesis_header_right' );
			add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
			add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
			dynamic_sidebar( 'header-right' );
			remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
			remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );

		genesis_markup( array(
			'html5' => '</aside>',
			'xhtml' => '</div>',
		) );
	}
}

// Custom Footer
function mb_do_footer() {
	$footer_left = mb_option( 'footer_left' );

	if ( $footer_left ) {
		genesis_markup(array(
			'html5' => '<div %s>',
			'xhtml' => '<div class="copyright">',
			'context' => 'copyright'
		));
			echo wpautop( do_shortcode( $footer_left ), false );
		echo '</div>';
	}

	if ( is_active_sidebar( 'footer-right' ) ) {
		genesis_markup( array(
			'html5' => '<div %s>',
			'xhtml' => '<div class="widget-area">',
			'context' => 'widget-area'
		) );

		genesis_widget_area( 'footer-right', array(
			'before' => '',
			'after' => ''
		) );

		echo '</div>';
	}
}

// Genesis Footer Attribute
function mb_attr_site_footer( $context ) {
	$class = $context['class'];
	$context['class'] = $class . ' full-width';

	return $context;
}

// Single Post Navigation
// add_action('genesis_after_entry', 'mb_single_post_navigation_links', 5 );
function mb_single_post_navigation_links() {
	if ( is_single ( ) ) { ?>
	<div class="prev_next">
		<div class="nav_left">
			<?php previous_post_link('%link', '&laquo; Previous Post'); ?>
		</div>
		<div class="nav_right">
		  <?php next_post_link('%link', 'Next Post &raquo;'); ?>
		</div>
	</div>
	<?php }
}

// Author Box Image Size
// add_filter( 'genesis_author_box_gravatar_size', 'mb_author_box_gravatar_size' );
function mb_author_box_gravatar_size( $size ) {
	return '150';
}

// Favicon
function mb_favicon( $favicon ) {
	$favicon = mb_option( 'favicon' );

	if ( $favicon ) {
		$favicon = $favicon;
	} else {
		$favicon = MB_THEME_IMAGES . 'favicon.ico';
	}

	return $favicon;
}

// Get Attachment ID from URL
// @https://philipnewcomer.net/2012/11/get-the-attachment-id-from-an-image-url-in-wordpress/
function mb_get_attachment_id_from_url( $attachment_url = '' ) {

	global $wpdb;
	$attachment_id = false;

	// If there is no url, return.
	if ( '' == $attachment_url )
		return;

	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();

	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

	}

	return $attachment_id;
}

// Prevent Images being wrapped in 'p' tags
// @http://www.wpfill.me/
add_filter( 'the_content', 'mb_filter_ptags_on_images' );
function mb_filter_ptags_on_images( $content ){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// Stop users from creating galleries
// @http://www.wpfill.me/
// add_action( 'admin_head_media_upload_gallery_form', 'mfields_remove_gallery_setting_div' );
if( !function_exists( 'mfields_remove_gallery_setting_div' ) ) {
	function mfields_remove_gallery_setting_div() {
        print '
		<style type="text/css">
			#gallery-settings *{
				display:none;
			}
		</style>';
    }
}

// Lighten Color
// @http://lab.clearpixel.com.au/2008/06/darken-or-lighten-colours-dynamically-using-php/
function colourBrightness($hex, $percent) {
	// Work out if hash given
	$hash = '';
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
		$hash = '#';
	}
	/// HEX TO RGB
	$rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
	//// CALCULATE
	for ($i=0; $i<3; $i++) {
		// See if brighter or darker
		if ($percent > 0) {
			// Lighter
			$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
		} else {
			// Darker
			$positivePercent = $percent - ($percent*2);
			$rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
		}
		// In case rounding up causes us to go to 256
		if ($rgb[$i] > 255) {
			$rgb[$i] = 255;
		}
	}
	//// RBG to Hex
	$hex = '';
	for($i=0; $i < 3; $i++) {
		// Convert the decimal digit to hex
		$hexDigit = dechex($rgb[$i]);
		// Add a leading zero if necessary
		if(strlen($hexDigit) == 1) {
		$hexDigit = "0" . $hexDigit;
		}
		// Append to the hex string
		$hex .= $hexDigit;
	}
	return $hash.$hex;
}

// Remove Default Image Sizes
// @http://www.paulund.co.uk/remove-default-wordpress-image-sizes
function mb_remove_default_image_sizes( $sizes) {
    unset( $sizes['thumbnail']);
    unset( $sizes['medium']);
    unset( $sizes['large']);

    return $sizes;
}

// add_filter('intermediate_image_sizes_advanced', 'mb_remove_default_image_sizes');

// Mobile Header
function mb_do_mobile_header() {
	genesis_markup( array(
		'html5' => '<div %s><div class="wrap">',
		'xhtml' => '<div class="mobile-header"><div class="wrap">',
		'context' => 'mobile-header'
	) );

	global $wp_registered_sidebars;
	$logo = mb_option( 'logo' );

	genesis_markup( array(
		'html5'   => '<div %s>',
		'xhtml'   => '<div class="mobile-title-area" id="mobile-title-area">',
		'context' => 'mobile-title-area'
	) );
	if ( !empty( $logo ) ) {
		echo '<h1 class="site-title" itemprop="headline">';
			echo '<a href="'.get_bloginfo( 'url' ).'" class="logo" title="'.get_bloginfo( 'name' ).'">';
				echo '<img src="'.$logo.'" alt="'.get_bloginfo( 'name' ).'"/>';
			echo '</a>';
		echo '</h1>';
	} else {
		do_action( 'genesis_site_title' );
		do_action( 'genesis_site_description' );
	}
	echo '</div>';

	genesis_markup( array(
		'html5' => '<div %s>',
		'xhtml' => '<div class="widget-area">',
		'context' => 'widget-area'
	) );

	echo '<div class="menu-btn"><span class="genericon genericon-menu"></span></div>';

	echo '</div>';

	echo '</div></div>';
}

function mb_pushy_navigation() {
	if ( ! genesis_nav_menu_supported( 'mobile' ) )
		return;

	if ( has_nav_menu( 'mobile' ) ) {
		$class = 'menu genesis-nav-menu menu-mobile';

		$args = array(
			'theme_location' => 'mobile',
			'container' => '',
			'menu_class' => $class,
			'echo' => 0,
		);

		$nav = wp_nav_menu( $args );

		if ( !$nav )
			return;

		$nav_markup_open = genesis_markup( array(
			'html5' => '<nav class="pushy pushy-left">',
			'xhtml' => '<div class="pushy pushy-left">',
			'context' => '',
			'echo' => false
		) );

		$nav_markup_close = genesis_html5 ? '</nav>' : '</div>';

		$nav_output = $nav_markup_open . $nav . $nav_markup_close;

		echo apply_filters( 'mb_pushy_navigation', $nav_output, $nav, $args );
	}

	echo '<div class="site-overlay">&nbsp;</div>';
}

// add_filter( 'genesis_attr_site-container', 'mb_attr_site_container');
function mb_attr_site_container( $attr ) {
	$attr['id'] = 'container';

	return $attr;
}

// Layout
function mb_do_body_layout( $classes ) {
	$classes[] = 'boxed';

	return $classes;
}

// Dequeue Gravity Forms CSS
// @https://katz.co/disable-gravity-forms-css-stylesheet/
function remove_gravityforms_style() {
	global $post;
	if(get_post_meta($post->ID, 'GFRemoveStyle', true)) {
		wp_dequeue_style('gforms_css');
	}
}

// add_action('wp_print_styles', 'remove_gravityforms_style');

function rwp_do_before_header_section() {

	genesis_widget_area( 'before-header', array(
		'before' => '<div class="before-header"><div class="wrap">',
		'after'  => '</div></div>',
	) );
	
}


//Filter menu items, appending either a search form.
add_filter( 'wp_nav_menu_items', 'theme_menu_extras', 10, 2 );
function theme_menu_extras( $menu, $args ) {
	if ( 'primary' !== $args->theme_location )
		return $menu;

	ob_start();

	get_search_form();
	$search = ob_get_clean();
	$menu  .= '<li class="search-menu"><a id="main-nav-search-link" class="icon-search"></a><div class="search-div">' . get_search_form( false ) . '</div></li>';
	return $menu;
}

//display blog title
add_action( 'genesis_before', 'mb_blog_page_title' ); 
function mb_blog_page_title() {
    if ( is_page_template( 'page_blog.php' ) ) {
        add_action( 'genesis_before_content', 'mb_show_blog_page_title_text', 2 );
    }
}

function mb_show_blog_page_title_text() {
    echo '<header class="entry-header"><h1 class="entry-title">' . get_the_title() . '</h1></header>';
}

function rwp_before_footer_1() {
	genesis_widget_area( 'before-footer-1', array(
		'before' => '<div class="home-section-8"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}
function rwp_before_footer_2() {
	echo "<div class=before-footer><div class=wrap>";
	
	// Remove the line above when adding to functions.php
	genesis_nav_menu( array(
		'theme_location' => 'secondary',
		'container'       => 'div',
		'menu_class'     => 'menu genesis-nav-menu menu-footer',
		'depth'           => 1
	) );
	genesis_widget_area( 'before-footer-2', array(
		'before' => '<div class="before-footer-widget">',
		'after'  => '</div>',
	) );

	echo "</div></div>";
}

function rwp_after_content(){
	genesis_widget_area( 'after-content', array(
		'before' => '<div class="after-content"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

