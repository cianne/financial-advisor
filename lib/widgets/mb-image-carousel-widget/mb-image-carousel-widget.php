<?php

/*
Widget Name: Image Carousel Widget
Description: A simple image carousel widget
Author: RecommendWP
Author URI: http://www.recommendwp.com
*/

class MB_Image_Carousel_Widget extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'mb-image-carousel-widget',
			__( 'Image Carousel Widget', 'starter' ),
			array(
				'description' => __( 'A simple image carousel widget.', 'starter' ),
			),

			array(

			),

			array(
				'title' => array(
					'type' => 'text',
					'label' => __( 'Title', 'siteorigin-widgets' ),
					'default' => ''
				),

				'carousel' => array(
					'type' => 'checkbox',
					'label' => __( 'Enable carousel?', 'siteorigin-widgets' ),
					'default' => ''
				),

				'class' => array(
					'type' => 'text',
					'label' => __( 'Carousel Class', 'siteorigin-widgets' ),
					'default' => ''
				),

				'show' => array(
					'type' => 'text',
					'label' => __( 'Slides to show', 'siteorigin-widgets' )
				),

				'images' => array(
					'type' => 'repeater',
					'label' => __( 'Add Images' , 'siteorigin-widgets' ),
					'item_name'  => __( 'Image', 'siteorigin-widgets' ),
					'item_label' => array(
						'selector'     => "[id*='repeat_text']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(
						'image' => array(
							'type' => 'media',
							'label' => __( 'Choose an image', 'siteorigin-widgets' ),
							'choose' => __( 'Choose image', 'siteorigin-widgets' ),
							'update' => __( 'Set image', 'siteorigin-widgets' ),
							'library' => 'image'
						),
						'link' => array(
							'type' => 'text',
							'label' => __( 'Link', 'siteorigin-widgets' ),
							'default' => ''
						)
					)
				)
			),

			MB_THEME_LIB
		);
	}

	function get_template_name($instance) {
		return 'mb-image-carousel-widget-template';
	}

	function get_style_name($instance) {
		return 'mb-image-carousel-widget-style';
	}

}

siteorigin_widget_register( 'mb-image-carousel-widget', __FILE__, 'MB_Image_Carousel_Widget' );
