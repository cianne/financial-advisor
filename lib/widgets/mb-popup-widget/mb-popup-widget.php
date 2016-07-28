<?php

/*
Widget Name: Popup Widget
Description: A simple popup widget.
Author: RecommendWP
Author URI: http://www.recommendwp.com
*/

class MB_Popup_Widget extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'mb-popup-widget',
			__( 'Popup Widget', 'starter' ),
			array(
				'description' => __( 'A simple popup widget.', 'starter' ),
			),

			array(

			),

			array(
				'title' => array(
					'type' => 'text',
					'label' => __('Button Text', 'siteorigin-widgets'),
					'default' => ''
				),

				'popup_type' => array(
					'type' => 'select',
					'label' => __( 'Choose Popup Type', 'siteorigin-widgets' ),
					'options' => array(
						'inline' => __( 'Inline', 'siteorigin-widgets' ),
						'iframe' => __( 'Iframe', 'siteorigin-widgets' )
					),
					'default' => 'inline'
				),

				'popup_width' => array(
					'type' => 'text',
					'label' => __( 'Popup Width', 'siteorigin-widgets' ),
					'default' => ''
				),

				"popup_height" => array(
					'type' => 'text',
					'label' => __( 'Popup Height', 'siteorigin-widgets' ),
					'default' => ''
				),

				"popup_padding" => array(
					'type' => 'text',
					'label' => __( 'Popup Padding', 'siteorigin-widgets' ),
					'default' => ''
				),

				'popup_id' => array(
					'type' => 'text',
					'label' => __( 'Popup ID', 'siteorigin-widgets' ),
					'description' => __( 'Required for the popup to work.', 'siteorigin-widgets' ),
					'default' => ''
				),

				'popup_content' => array(
					'type' => 'textarea',
					'label' => __( 'Popup Content', 'siteorigin-widgets' ),
					'description' => __( 'Add content via shortcode or HTML. If your using iframe as type just input the URL.', 'siteorigin-widgets' ),
					'default' => '',
					'allow_html_formatting' => true,
					'rows' => 15
				),

				'autop' => array(
					'type' => 'checkbox',
					'label' => __( 'Automatically add paragraph tags?', 'siteorigin-widgets' ),
					'default' => false
				)
			),

			MB_THEME_LIB
		);
	}

	function get_template_name($instance) {
		return 'mb-popup-widget-template';
	}

	function get_style_name($instance) {
		return 'mb-popup-widget-style';
	}

}

siteorigin_widget_register( 'mb-popup-widget', __FILE__, 'MB_Popup_Widget' );
