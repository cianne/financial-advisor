<?php
// Theme Options
add_action( 'after_setup_theme', 'mb_theme_options' );
function mb_theme_options() {
	if( !class_exists( 'VP_AutoLoader' ) )
        return;

	$options = MB_THEME_LIB . 'theme-options/options.php';

	$theme_options = new VP_Option( array(
		'is_dev_mode' => false,
		'option_key' => 'mb_option',
		'page_slug' => 'mb_option',
		'template' => $options,
		'menu_page' => 'themes.php',
		'use_auto_group_naming' => true,
		'use_exim_menu' => true,
		'minimum_role' => 'edit_theme_options',
		'layout' => 'fluid',
		'page_title' => 'Theme Options',
		'menu_label' => 'Theme Options'
	) );
}
