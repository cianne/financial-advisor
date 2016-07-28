<?php
// SiteOrigin Widgets
function mb_siteorigin_widgets( $folders ){
	$folders[] = MB_THEME_LIB . 'widgets/';
	return $folders;
}

add_filter('siteorigin_widgets_widget_folders', 'mb_siteorigin_widgets');