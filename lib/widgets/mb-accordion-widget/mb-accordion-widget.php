<?php

/*
Widget Name: Accordion Widget
Description: A simple accordion widget.
Author: RecommendWP
Author URI: http://www.recommendwp.com
*/

class MB_Accordion_Widget extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'mb-accordion-widget',
			__( 'Accordion Widget', 'starter' ),
			array(
				'description' => __( 'A simple accordion widget.', 'starter' ),
			),

			array(

			),

			array(
				'title' => array(
					'type' => 'text',
					'label' => __( 'Title', 'siteorigin-widgets' ),
					'default' => ''
				),

				'faqs' => array(
					'type' => 'repeater',
					'label' => __( 'FAQs' , 'siteorigin-widgets' ),
					'item_name'  => __( 'FAQ', 'siteorigin-widgets' ),
					'item_label' => array(
						'selector'     => "[id*='heading']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(
						'heading' => array(
							'type' => 'text',
							'label' => __( 'Heading', 'siteorigin-widgets' ),
							'default' => ''
						),
						'content' => array(
							'type' => 'textarea',
							'label' => __( 'Content', 'siteorigin-widgets' ),
							'default' => ''
						)
					)
				)
			),

			MB_THEME_LIB
		);
	}

	function get_template_name($instance) {
		return 'mb-accordion-widget-template';
	}

	function get_style_name($instance) {
		return 'mb-accordion-widget-style';
	}

}

siteorigin_widget_register( 'mb-accordion-widget', __FILE__, 'MB_Accordion_Widget' );
