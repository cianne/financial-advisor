<?php
// add_action( 'genesis_meta', 'mb_do_less_vars' );
function mb_do_less_vars() {
    $color_option = mb_option( 'color_option' );
    $use_custom_typography = mb_option( 'use_custom_typography' );

    if ( $color_option ) {
        add_filter( 'less_vars', 'mb_color_option', 10, 2 );
    }

    if ( $use_custom_typography ) {
        add_filter( 'less_vars', 'mb_typography_option', 10, 3 );
    }
}

function mb_color_option( $vars, $handle ) {
    $color = mb_option( 'color_option' );
    $vars['color'] = $color;

    return $vars;
}

function mb_typography_option( $vars, $handle ) {
    $heading_font = mb_option( 'heading_font' );
	$heading_style = mb_option( 'heading_style' );
	$heading_weight = mb_option( 'heading_weight' );

	$body_font = mb_option( 'body_font' );
	$body_style = mb_option( 'body_style' );
	$body_weight = mb_option( 'body_weight' );

    $vars['heading_font'] = $heading_font;
    $vars['heading_style'] = $heading_style;
    $vars['heading_weight'] = $heading_weight;

    $vars['body_font'] = $body_font;
    $vars['body_style'] = $body_style;
    $vars['body_weight'] = $body_weight;

    return $vars;
}

add_action( 'init', 'mb_less_vars' );
function mb_less_vars() {
    $color = mb_option( 'color_option' );
    $use_custom_typography = mb_option( 'use_custom_typography' );

    $heading_font = mb_option( 'heading_font' );
	$heading_style = mb_option( 'heading_style' );
	$heading_weight = mb_option( 'heading_weight' );

	$body_font = mb_option( 'body_font' );
	$body_style = mb_option( 'body_style' );
	$body_weight = mb_option( 'body_weight' );
    if ( class_exists('WPLessPlugin') ) {
        // $color = mb_option( 'color_option' );
        $less = WPLessPlugin::getInstance();

        // $less->addVariable('myColor', '#666');
        // you can now use @myColor in your *.less files
        if ( $color ) {
            $less->addVariable( 'color', $color );
        }

        if ( $use_custom_typography ) {
            $less->setVariables( array(
                'heading_font' => $heading_font,
                'heading_style' => $heading_style,
                'heading_weight' => $heading_weight,
                'body_font' => $body_font,
                'body_weight' => $body_weight,
                'body_style' => $body_style
            ) );
        }

        $lessConfig = WPLessPlugin::getInstance()->getConfiguration();

        // compiles in the active theme, in a ‘compiled-css’ subfolder
        $lessConfig->setUploadDir(get_stylesheet_directory() . '/assets/css');
        $lessConfig->setUploadUrl(get_stylesheet_directory_uri() . '/assets/css');
    }
}
