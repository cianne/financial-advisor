<?php

/*
Widget Name: Testimonial Widget
Description: A simple testimonial widget.
Author: RecommendWP
Author URI: http://www.recommendwp.com
*/

class MB_Testimonials_Widget extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'mb-testimonial-widget',
			__( 'Testimonial Widget', 'starter' ),
			array(
				'description' => __( 'A simple Testimonial widget.', 'starter' ),
			),

			array(

			),

			array(
				'title' => array(
					'type' => 'text',
					'label' => __( 'Title', 'siteorigin-widgets' ),
					'default' => ''
				),
				'class' => array(
				        'type' => 'text',
				        'label' => __( 'add class', 'widget-form-fields-text-domain' ),
				        'default' => true
				),
				'testimonial' => array(
					'type' => 'repeater',
					'label' => __( 'Add Testimonials' , 'siteorigin-widgets' ),
					'item_name'  => __( 'People', 'siteorigin-widgets' ),
					'item_label' => array(
						'selector'     => "[id*='name']",
						'update_event' => 'change',
						'value_method' => 'val'
				),
				
				'fields' => array(
						'name' => array(
							'type' => 'text',
							'label' => __( 'Person\'s Name', 'siteorigin-widgets' ),
							'default' => ''
						),
						'business' => array(
							'type' => 'text',
							'label' => __( 'Person\'s Business', 'siteorigin-widgets' ),
							'default' => ''
						),
						'content' => array(
							'type' => 'textarea',
							'label' => __( 'Content', 'siteorigin-widgets' ),
							'default' => ''
						),
						'image' => array(
					        'type' => 'media',
					        'label' => __( 'Choose a image(not less than 145x145 pixel size)', 'widget-form-fields-text-domain' ),
					        'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
					        'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
					        'library' => 'image',
					        'fallback' => true
					    )
					)
				)
			),

			MB_THEME_LIB
		);
	}

	function get_template_name($instance) {
		return 'mb-testimonial-widget-template';
	}

	function get_style_name($instance) {
		return 'mb-testimonial-widget-style';
	}

}

siteorigin_widget_register( 'mb-testimonial-widget', __FILE__, 'MB_Testimonials_Widget' );
