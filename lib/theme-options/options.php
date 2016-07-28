<?php
return array(
	'title' => __( 'Theme Options', 'genesis' ),
	'logo' => MB_THEME_IMAGES . 'logo.png',
	'menus' => array(
		array(
			'title' => 'General',
			'name' => 'general_settings',
			'icon' => 'font-awesome:fa-gears',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => 'General Settings',
					'name' => 'general',
					'description' => 'Set your website\'s logo and favicon.',
					'fields' => array(
						array(
							'type' => 'upload',
							'name' => 'favicon',
							'label' => 'Favicon',
							'description' => 'Upload site favicon.'
						),
						array(
							'type' => 'textbox',
							'name' => 'post_info',
							'label' => __( 'Post Info', 'starter' ),
							'description' => __( 'Before content entry meta.', 'starter' ),
							'default' => '[post_date] By [post_author_posts_link] [post_comments] [post_edit]'
						),
						array(
							'type' => 'textbox',
							'name' => 'post_meta',
							'label' => __( 'Post Meta', 'starter' ),
							'description' => __( 'After content entry meta.', 'starter' ),
							'default' => '[post_categories] [post_tags]'
						),
						array(
							'type' => 'textbox',
							'name' => 'read_more',
							'label' => __( 'Read More Text', 'starter' ),
							'description' => __( 'Change default read more text', 'starter' ),
							'default' => ''
						),
						array(
							'type' => 'toggle',
							'name' => 'excerpt_more',
							'label' => __( 'Read More on Excerpts', 'starter' ),
							'description' => __( 'Read more text on excerpts', 'starter' )
						)
					)
				),
				array(
					'type' => 'section',
					'title' => __( 'Custom Header', 'starter' ),
					'name' => 'custom_header_decider',
					'fields' => array(
						array(
							'type' => 'toggle',
							'name' => 'use_custom_header',
							'label' => __( 'Enable Custom Header', 'starter' ),
							'description' => __( 'Replaces the default Genesis header function.', 'starter' ),
							'default' => '0'
						)
					)
				),
				array(
					'type' => 'section',
					'title' => 'Site Header',
					'name' => 'header',
					'description' => 'Set settings for the header.',
					'dependency' => array(
						'field' => 'use_custom_header',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
						array(
							'type' => 'upload',
							'name' => 'logo',
							'label' => 'Logo',
							'description' => 'Upload site logo.',
							'default' => ''
						),
					)
				),
				array(
					'type' => 'section',
					'title' => __('Custom Footer', 'starter'),
					'name' => 'custom_footer_decider',
					'fields' => array(
						array(
							'type' => 'toggle',
							'name' => 'use_custom_footer',
							'label' => __('Enable Custom Footer', 'starter'),
							'description' => __('Enable custom footer or not.', 'starter'),
							'default' => '0'
						),
					),
				),
				array(
					'type' => 'section',
					'title' => 'Site Footer',
					'name' => 'footer',
					'description' => 'Set values for the footer.',
					'dependency' => array(
						'field' => 'use_custom_footer',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
						array(
							'type' => 'textarea',
							'name' => 'footer_left',
							'label' => 'Footer Left',
							'description' => 'Place text content, shortcodes or any relevant information e.g. copyright information.',
							'default' => '[footer_copyright before="Copyright "] &middot; [footer_childtheme_link before="" after=" On"] [footer_genesis_link url="http://www.studiopress.com/" before=""] &middot; [footer_wordpress_link] &middot; [footer_loginout]'
						),
					)
				)
			),
		),
		array(
			'title' => __( 'Theming', 'starter' ),
			'name' => 'styling_settings',
			'icon' => 'font-awesome:fa-info',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __( 'Layout Settings', 'starter' ),
					'name' => 'custom_background_decider',
					'fields' => array(
						array(
							'type' => 'toggle',
							'name' => 'use_custom_background',
							'label' => __( 'Enable Custom Layouts?', 'starter' ),
							'description' => __( 'Enable the use of custom layouts.', 'starter' ),
							'default' => '0'
						)
					)
				),
				array(
					'type' => 'section',
					'title' => __( 'Body Settings', 'starter' ),
					'name' => 'body_settings',
					'description' => __( '', 'starter' ),
					'dependency' => array(
						'field' => 'use_custom_background',
						'function' => 'vp_dep_boolean'
					),
					'fields' => array(
						array(
							'type' => 'select',
							'name' => 'body_layout',
							'label' => __( 'Body Layout', 'starter' ),
							'description' => __( '', 'starter' ),
							'items' => array(
								array(
									'label' => __( 'Box Layout', 'starter' ),
									'value' => 'boxed'
								),
								array(
									'label' => __( 'Full Width Layout', 'starter' ),
									'value' => 'full-width'
								),
							),
							'default' => array(
								'full-width'
							)
						),
						array(
							'type' => 'color',
							'name' => 'body_background',
							'label' => __( 'Background', 'starter' ),
							'description' => __( 'Change body background color.', 'starter' ),
						),
						array(
							'type' => 'radioimage',
							'name' => 'body_image',
							'label' => __( 'Background Image', 'starter' ),
							'description' => __( 'Change background image.', 'starter' ),
							'item_max_height' => '100',
							'item_max_width' => '100',
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'mb_get_background_images'
									)
								)
							)
						)
					)
				),
				array(
					'type' => 'section',
					'title' => __( 'Color Options', 'starter' ),
					'name' => 'color_options',
					'fields' => array(
						array(
							'type' => 'color',
							'name' => 'color_option',
							'label' => __( 'Choose Color', 'starter' ),
							'description' => __( 'Choose your color option.', 'starter' )
						)
					)
				)
			)
		),
		array(
			'title' => 'Typography',
			'name' => 'typography_settings',
			'icon' => 'font-awesome:fa-font',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Typography Settings', 'starter'),
					'name' => 'custom_typography_decider',
					'fields' => array(
						array(
							'type' => 'toggle',
							'name' => 'use_custom_typography',
							'label' => __('Enable Custom Typography', 'starter'),
							'description' => __('Enable custom typography or not.', 'starter'),
						),
					),
				),
				array(
					'type' => 'section',
					'title' => 'Heading Settings',
					'name' => 'heading',
					'description' => '',
					'dependency' => array(
						'field' => 'use_custom_typography',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
						array(
							'type' => 'html',
							'name' => 'heading_font_preview',
							'binding' => array(
								'field'    => 'heading_font,heading_style,heading_weight',
								'function' => 'vp_font_preview',
							),
						),
						array(
							'type' => 'select',
							'name' => 'heading_font',
							'label' => 'Select Font',
							'description' => '',
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family'
									)
								)
							)
						),
						array(
							'type' => 'radiobutton',
							'name' => 'heading_style',
							'label' => __('Font Style', 'genesis'),
							'description' => __('Select Font Style', 'genesis'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'heading_font',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'{{first}}',
							),
						),
						array(
							'type' => 'radiobutton',
							'name' => 'heading_weight',
							'label' => __('Font Weight', 'genesis'),
							'description' => __('Select Font Weight', 'genesis'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'heading_font',
										'value' => 'vp_get_gwf_weight',
									),
								),
							),
							'default' => array(
								'{{first}}'
							)
						),
					),
				),
				array(
					'type' => 'section',
					'title' => 'Body Settings',
					'name' => 'body',
					'description' => '',
					'dependency' => array(
						'field' => 'use_custom_typography',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
						array(
							'type' => 'html',
							'name' => 'body_font_preview',
							'binding' => array(
								'field'    => 'body_font,body_style,body_weight',
								'function' => 'vp_font_preview',
							),
						),
						array(
							'type' => 'select',
							'name' => 'body_font',
							'label' => 'Select Font',
							'description' => '',
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family'
									)
								)
							)
						),
						array(
							'type' => 'radiobutton',
							'name' => 'body_style',
							'label' => __('Font Style', 'genesis'),
							'description' => __('Select Font Style', 'genesis'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'body_font',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'{{first}}',
							),
						),
						array(
							'type' => 'radiobutton',
							'name' => 'body_weight',
							'label' => __('Font Weight', 'vp_textdomain'),
							'description' => __('Select Font Weight', 'vp_textdomain'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'body_font',
										'value' => 'vp_get_gwf_weight',
									),
								),
							),
							'default' => array(
								'{{first}}'
							)
						),
					),
				),
			),
		),
		array(
			'title' => 'Miscellaneous',
			'name' => 'misc',
			'icon' => 'font-awesome:fa-wrench',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => 'Custom CSS',
					'name' => 'css',
					'description' => '',
					'fields' => array(
						array(
							'type' => 'codeeditor',
							'name' => 'custom_css',
							'label' => 'Custom CSS',
							'description' => '',
							'theme' => 'github',
							'mode' => 'css'
						)
					)
				)
			)
		)
	)
);
