<?php

// Font Awesome
function db_fontawesome_shortcode( $atts, $content = null ) {
	wp_enqueue_style( 'fontawesome' );
	$defaults = array(
		'class' => '',
		'size' => 'inherit',
		'color' => ''
	);

	$atts = shortcode_atts( $defaults, $atts, 'fontawesome' );

	$output = '<span class="fa fa-'.esc_attr( $atts['class'] ).'" style="font-size: '.esc_attr( $atts['size'] ).'; color= '.esc_attr( $atts['color'] ).';"></span>';

	return apply_filters( 'db_fontawesome_shortcode', $output, $atts );
}

if ( shortcode_exists( 'fontawesome' ) ) {
	remove_shortcode( 'fontawesome' );
	add_shortcode( 'fontawesome', 'db_fontawesome_shortcode' );
} else {
	add_shortcode( 'fontawesome', 'db_fontawesome_shortcode' );
}

// Content Shortcode
function db_text_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => 'text',
		'color' => '',
		'font_size' => '',
		'font_style' => '',
		'font_weight' => '',
		'text_transform' => '',
		'font_family' => '',
		'line_height' => '',
		'text_align' => '',
		'display' => '',
		'letter_spacing' => '',
		'wrap' => 'span'
	);

	$atts = shortcode_atts( $defaults, $atts, 'text' );

	$output = '';
    $output .= '<'.$atts['wrap'].' class="text '.$atts['class'].'"';
    $output .= 'style="';
    $output .= !empty( $atts['font_family'] ) ? 'font-family: '.$atts['font_family'].';' : '';
    $output .= !empty( $atts['font_style'] ) ? 'font-style: '.$atts['font_style'].';' : '';
    $output .= !empty( $atts['line_height'] ) ? 'line-height: '.$atts['line_height'].';' : '';
    $output .= !empty( $atts['letter_spacing'] ) ? 'letter-spacing: '.$atts['letter_spacing'].';' : '';
    $output .= !empty( $atts['display'] ) ? 'display: '.$atts['display'].';' : '';
    $output .= !empty( $atts['text_align'] ) ? 'text-align: '.$atts['text_align'].';' : '';
    $output .= !empty( $atts['color'] ) ? 'color: '.$atts['color'].';' : '';
    $output .= !empty( $atts['font_size'] ) ? 'font-size: '.$atts['font_size'].';' : '';
    $output .= !empty( $atts['font_weight'] ) ? 'font-weight: '.$atts['font_weight'].';' : '';
    $output .= !empty( $atts['text_transform'] ) ? 'text-transform: '.$atts['text_transform'].';' : '';
    $output .= '">';
    $output .= do_shortcode( $content );
    $output .= '</'.$atts['wrap'].'>';

    return apply_filters( 'db_text_shortcode', $output, $atts );
}

if ( shortcode_exists( 'text' ) ) {
	remove_shortcode( 'text' );
	add_shortcode( 'text', 'db_text_shortcode' );
} else {
	add_shortcode( 'text', 'db_text_shortcode' );
}

// Button Shortcode
function db_button_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => '',
		'url' => '',
		'target' => '_self',
		'title' => ''
	);

	$atts = shortcode_atts( $defaults, $atts, 'button' );

	$output = '';
	$output .= '<a title="'.$atts['title'].'" target="'.$atts['target'].'" href="'.$atts['url'].'" class="btn '.$atts['class'].'">'.do_shortcode( $content ).'</a>';

	return apply_filters( 'db_button_shortcode', $output, $atts );
}

if ( shortcode_exists( 'button' ) ) {
	remove_shortcode( 'button' );
	add_shortcode( 'button', 'db_button_shortcode' );
} else {
	add_shortcode( 'button', 'db_button_shortcode' );
}

// Image Shortcode
function db_image_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => 'image',
		'url' => '',
		'width' => '',
		'height' => '',
		'crop' => 'yes',
		'link' => '',
		'alt' => '',
		'target' => ''
	);

	$image = $atts['url'];
	/* if ( !empty( $image ) ) {
		$image = aq_resize( $image, ( !empty( $atts['width'] ) ? $atts['width'] : 999999 ), ( !empty( $atts['height'] ) ? $atts['height'] : 999999 ), ( $atts['crop'] == 'yes' ) ? true : false );
	} */

	$output = '';
	$output .= ( !empty( $atts['link'] ) ? '<a href="'.esc_url( $atts['link'] ).'" target="'.( !empty( $atts['target'] ) ? esc_attr( $atts['target'] ) : '_self' ).'">' : '');
	$output .= ( !empty( $image ) ? '<img class="'.esc_attr( $atts['class'] ).'" src="'.esc_url( $image ).'" alt="'.( !empty( $atts['alt'] ) ? esc_attr( $atts['alt'] ) : '').'"/>' : '' );
	$output .= ( !empty( $atts['link'] ) ? '</a>' : '' );

	return apply_filters( 'db_image_shortcode', $output, $atts );
}

if ( shortcode_exists( 'image' ) ) {
	remove_shortcode( 'image' );
	add_shortcode( 'image', 'db_image_shortcode' );
} else {
	add_shortcode( 'image', 'db_image_shortcode' );
}

// Box Shortcode
function db_box_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => 'content-box-blue',
	);

	$atts = shortcode_atts( $defaults, $atts, 'box' );

	$output = '';

	$output .= '<div class="content-box '.$atts['class'].'">';
	$output .= do_shortcode( $content );
	$output .= '</div>';

	return apply_filters( 'db_box_shortcode', $output, $atts );
}

if ( shortcode_exists( 'box' ) ) {
	remove_shortcode( 'box' );
	add_shortcode( 'box', 'db_box_shortcode' );
} else {
	add_shortcode( 'box', 'db_box_shortcode' );
}

// Permalink Shortcode
function db_permalink_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => 'entry-permalink',
		'label' => 'Permalink'
	);

	$atts = shortcode_atts( $defaults, $atts, 'post_permalink' );

	$output = '';

	$output .= '<span class="'.esc_attr( $atts['class'] ).'">';
	$output .= '<a href="'.get_permalink().'">'.$atts['label'].'</a>';
	$output .= '</span>';

	return apply_filters( 'db_permalink_shortcode', $output, $atts );
}

if ( shortcode_exists( 'post_permalink' ) ) {
	remove_shortcode( 'post_permalink' );
	add_shortcode( 'post_permalink', 'db_permalink_shortcode' );
} else {
	add_shortcode( 'post_permalink', 'db_permalink_shortcode' );
}

// Social Media Shortcode
function db_social_media_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => '',
		'facebook' => '',
		'flickr' => '',
		'google_plus' => '',
		'instagram' => '',
		'linkedin' => '',
		'mail' => '',
		'pinterest' => '',
		'rss' => '',
		'tumblr' => '',
		'twitter' => '',
		'youtube' => ''
	);

	$atts = shortcode_atts( $defaults, $atts, 'socialmedia' );

	$icons = array(
		'facebook' => $atts['facebook'],
		'flickr' => $atts['flickr'],
		'google_plus' => $atts['google_plus'],
		'instagram' => $atts['instagram'],
		'linkedin' => $atts['linkedin'],
		'mail' => $atts['mail'],
		'pinterest' => $atts['pinterest'],
		'rss' => $atts['rss'],
		'tumblr' => $atts['tumblr'],
		'twitter' => $atts['twitter'],
		'youtube' => $atts['youtube']
	);

	$output = '';

	$output .= '<ul class="social-media '.$atts['class'].'">';

	foreach ( $icons as $key => $value ) {

		$text = str_replace( '_', ' ', ucwords( $key ) );
		$icon = str_replace( '_', '-', strtolower( $key ) );
		$text = ucwords( $text );

		if ( $key == 'rss' ) {
			$text = __( 'RSS', 'starter' );
		}

		if ( $key == 'mail' ) {
			$ouput .= $value ? '<li class="'.$key.'"><a href="mailto:'.esc_url( $value ).'">'.( $cbtext == 'enabled' ?  $text : '' ).'</a>' : '';
		} else {
			$output .= $value ? '<li class="'.$key.'"><a href="'.esc_url( $value ).'"><span class="fa fa-'.$icon.'"></span>'.( $cbtext == 'enabled' ?  $text : '' ).'</a>' : '';
		}
	}
	$output .= '</ul>';

	return apply_filters( 'db_social_media_shortcode', $output, $atts );
}

if ( shortcode_exists( 'socialmedia' ) ) {
	remove_shortcode( 'socialmedia' );
	add_shortcode( 'socialmedia', 'db_social_media_shortcode' );
} else {
	add_shortcode( 'socialmedia', 'db_social_media_shortcode' );
}

function db_span_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => 'normal',
        'before' => '',
        'after' => ''
	);

	$atts = shortcode_atts( $defaults, $atts, 'span' );

	$output = '';

    $output .= '<span class="span span-'.$atts['class'].'">'.$atts['before'].' '.do_shortcode( $content ).' '.$atts['after'].'</span>';

	return apply_filters( 'db_span_shortcode', $output, $atts );
}

if ( shortcode_exists( 'span' ) ) {
	remove_shortcode( 'span' );
	add_shortcode( 'span', 'db_span_shortcode' );
} else {
	add_shortcode( 'span', 'db_span_shortcode' );
}

function db_wrapper_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => 'block'
	);

	$atts = shortcode_atts( $defaults, $atts, 'wrapper' );

	$output = '';

	$output .= '<div class="wrapper wrapper-'.esc_attr( $atts['class'] ).'">';
	$output .= do_shortcode( $content );
	$output .= '</div>';

	return apply_filters( 'db_wrapper_shortcode', $output, $atts );
}

if ( shortcode_exists( 'wrapper' ) ) {
	remove_shortcode( 'wrapper' );
	add_shortcode( 'wrapper', 'db_wrapper_shortcode' );
} else {
	add_shortcode( 'wrapper', 'db_wrapper_shortcode' );
}

// Wp Nav Menu Shortcode
// @http://www.cozmoslabs.com/1170-wp_nav_menu-shortcode/
// Function that will return our Wordpress menu
function db_list_menu($atts, $content = null) {
	extract(shortcode_atts(array(
		'menu'            => '',
		'container'       => '',
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'depth'           => 0,
		'items_wrap' => '%3$s',
		'walker'          => '',
		'theme_location'  => ''),
						   $atts));


	return wp_nav_menu( array(
		'menu'            => $menu,
		'container'       => $container,
		'container_class' => $container_class,
		'container_id'    => $container_id,
		'menu_class'      => $menu_class,
		'menu_id'         => $menu_id,
		'echo'            => false,
		'fallback_cb'     => $fallback_cb,
		'before'          => $before,
		'after'           => $after,
		'link_before'     => $link_before,
		'link_after'      => $link_after,
		'items_wrap' => $items_wrap,
		'depth'           => $depth,
		'walker'          => $walker,
		'theme_location'  => $theme_location));
}
//Create the shortcode
add_shortcode("listmenu", "db_list_menu");

// List Shortcode
function db_clearfix_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => ''
	);

	$atts = shortcode_atts( $defaults, $atts, 'clearfix' );

	$output = '';
	$output .= '<div class"clearfix '.esc_attr( $atts['class'] ).'">';
	$output .= '&nbsp;';
	$output .= '</div>';

	return apply_filters( 'db_clearfix_shortcode', $output, $atts );
}

if ( shortcode_exists( 'clearfix' ) ) {
	remove_shortcode( 'clearfix' );
	add_shortcode( 'clearfix', 'db_clearfix_shortcode' );
} else {
	add_shortcode( 'clearfix', 'db_clearfix_shortcode' );
}

// Line Break Shortcode
function db_break_shortcode( $atts, $content = null ) {
	$defaults = array(
		// 'class' => ''
	);

	$atts = shortcode_atts( $defaults, $atts, 'br' );

	$output = '';
	$output .= '<br/>';

	return apply_filters( 'db_break_shortcode', $output, $atts );
}

if ( shortcode_exists( 'br' ) ) {
	remove_shortcode( 'br' );
	add_shortcode( 'br', 'db_break_shortcode' );
} else {
	add_shortcode( 'br', 'db_break_shortcode' );
}

// Back To Top
function db_backtotop_shortcode( $atts, $content = null ) {
    $defaults = array(
        'class' => 'backtotop',
        'link' => '#'
    );

    $atts = shortcode_atts( $defaults, $atts, 'backtotop' );

    $output = '';
    $output .= '<a href="'.$atts['link'].'" class="'.$atts['class'].'">'.do_shortcode( $content ).'</a>';

    return apply_filters( 'db_backtotop_shortcode', $output, $atts );
}

if ( shortcode_exists( 'backtotop' ) ) {
    remove_shortcode( 'backtotop' );
    add_shortcode( 'backtotop', 'db_backtotop_shortcode' );
} else {
    add_shortcode( 'backtotop', 'db_backtotop_shortcode' );
}

// Phone Shortcode
function db_phone_shortcode( $atts, $content = null ) {
	$defaults = array(
		'number' => '',
		'class' => ''
	);

	$atts = shortcode_atts( $defaults, $atts, 'tel' );

	$output = '';
	$output .= '<span class="phone '.$atts['class'].'">';
	$output .= '<a href="tel: '.$atts['number'].'">'.do_shortcode( $content ).'</a>';
	$output .= '</span>';

	return apply_filters( 'db_phone_shortcode', $output, $atts );
}

if ( shortcode_exists( 'tel' ) ) {
	remove_shortcode( 'tel' );
	add_shortcode( 'tel', 'db_phone_shortcode' );
} else {
	add_shortcode( 'tel', 'db_phone_shortcode' );
}

function db_share_shortcode( $atts, $content = null ) {
	$defaults = array(
		'before' => 'Share this post',
		'via' => ''
	);

	$description = get_post_meta( get_the_ID(), '_genesis_description', true );

	if ( !$description ) {
		$description = get_post_meta( get_the_ID(), '_yoast_wpseo_metadesc', true );
	}

	$atts = shortcode_atts( $defaults, $atts, 'share' );

	$before = $atts['before'];
	$via = $atts['via'];

	$output = '';
	$output .= '<span class="entry-share">';
	$output .= $before ? '<a href="#" class="before">'.$before.'</a>' : '';
	$output .= '<a href="#" data-type="facebook" data-url="'.get_permalink().'" data-description="'.$description.'"  data-title="'.get_the_title().'" class="prettySocial"><span>Facebook</span></a>';
	$output .= '<a href="#" data-type="googleplus" data-url="'.get_permalink().'" data-description="'.$description.'" class="prettySocial"><span>Google+</span></a>';
	$output .= '<a href="#" data-type="linkedin" data-url="'.get_permalink().'" data-description="'.$description.'" class="prettySocial"><span>LinkedIn</span></a>';
	$output .= '<a href="#" data-type="pinterest" data-url="'.get_permalink().'" data-description="'.$description.'"  data-media="'.aq_resize( db_post_image(), 100, 100, true ).'" class="prettySocial"><span>Pinterest</span></a>';
	$output .= '<a href="#" data-type="twitter" data-url="'.get_permalink().'" data-description="'.$description.'" class="prettySocial"';
	$output .= $via ? 'data-via="'.$via.'"' : '';
	$output .= '><span>Twitter</span></a>';
	$output .= '</span>';

	return apply_filters( 'db_share_shortcode', $output, $atts );
}

if ( shortcode_exists( 'share' ) ) {
	remove_shortcode( 'share' );
	add_shortcode( 'share', 'db_share_shortcode' );
} else {
	add_shortcode( 'share', 'db_share_shortcode' );
}
