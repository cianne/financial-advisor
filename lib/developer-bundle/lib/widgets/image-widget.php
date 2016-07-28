<?php
class MB_Image_Widget extends MB_Widget {
	public function __construct() {
		parent::__construct(
			'mb_image',
			'Image Widget',
			array(
				'description' => __('Easily add images to your sidebar.', 'starter')
			)
		);

		$this->_form = array(
			"mb_title" => array(
				'field_id' => 'title',
				'field_title' => __('Title', 'starter'),
				'field_type' => 'textbox'
			),
			"mb_image" => array(
				'field_id' => 'image',
				'field_title' => __('Upload Image', 'starter'),
				'field_type' => 'mediaupload'
			),
			"mb_alignment" => array(
				'field_id' => 'alignment',
				'field_title' => __('Alignment', 'starter'),
				'field_type' => 'select',
				'field_select_values' => array(
					'alignleft' => 'Align Left',
					'alignright' => 'Align Right',
					'aligncenter' => 'Align Center'
				)
			),
			"mb_imagex" => array(
				'field_id' => 'imagex',
				'field_title' => __( 'Image Width', 'starter' ),
				'field_type' => 'number'
			),
			"mb_imagey" => array(
				'field_id' => 'imagey',
				'field_title' => __( 'Image Height', 'starter' ),
				'field_type' => 'number'
			),
			"mb_imagecrop" => array(
				'field_id' => 'imagecrop',
				'field_title' => __( 'Crop Image', 'starter' ),
				'field_type' => 'checkbox'
			),
			"mb_rel" => array(
				'field_id' => 'rel',
				'field_title' => __( 'rel Attribute', 'starter' ),
				'field_type' => 'select',
				'field_select_values' => array(
					'alternate' => 'Alternate',
					'bookmark' => 'Bookmark',
					'nofollow' => 'No Follow'
				)
			),
			"mb_alt" => array(
				'field_id' => 'alt',
				'field_title' => __( 'alt Text', 'starter' ),
				'field_type' => 'textbox'
			),
			"mb_link" => array(
				'field_id' => 'imagelink',
				'field_title' => __( 'Image Link', 'starter' ),
				'field_type' => 'url'
			),
			"mb_before" => array(
				'field_id' => 'before_image',
				'field_title' => __( 'Before Image Text', 'starter' ),
				'field_type' => 'textarea'
			),
			"mb_after" => array(
				'field_id' => 'after_image',
				'field_title' => __( 'After Image Text', 'starter' ),
				'field_type' => 'textarea'
			),
			"mb_autop" => array(
				'field_id' => 'autop',
				'field_title' => __( 'Automatically add paragraphs.', 'starter' ),
				'field_type' => 'checkbox'
			)
		);
	}
	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$image = $instance['image'];
		$alignment = $instance['alignment'];
		$imagex = $instance['imagex'];
		$imagey = $instance['imagey'];
		$imagecrop = $instance['imagecrop'];
		$alt = esc_attr( $instance['alt'] );
		$rel = esc_attr( $instance['rel'] );
		$imagelink = esc_url( $instance['imagelink'] );
		$before_image = do_shortcode( $instance['before_image'] );
		$after_image = do_shortcode( $instance['after_image'] );
		$autop = $instance['autop'];

		// $imageid = mb_get_attachment_id_from_url( $image );
		// $imagemeta = wp_get_attachment_metadata( $imageid );

		// var_dump( $imageid );
        // var_dump( $imagemeta );

		// $width = $imagemeta['width'];
		// $height = $imagemeta['height'];

		switch ( $alignment ) {
			case 'alignleft':
				$alignment = 'alignleft';
				break;
			case 'alignright':
				$alignment = 'alignright';
				break;
			case 'aligncenter':
				$alignment = 'aligncenter';
				break;
			default:
				$alignment = 'alignnone';
				break;
		}

		echo $before_widget;

		if ( !empty($title) )
			echo $before_title . $title . $after_title;

		echo '<div class="imagewidget">';
			echo !$before_image ? '' : $autop ? wpautop( $before_image, false ) : $before_image;

			if ( !empty( $imagex ) ) {
				$image = aq_resize( $image, !empty( $imagex ) ? $imagex : '', !empty( $imagey ) ? $imagey : '', ( $imagecrop == 'imagecrop' ) ? true : false );
			} else {
				$image = $image;
			}

			echo ( !empty($imagelink) ? '<a rel="'.( !empty($rel) ? $rel : 'nofollow' ).'" href="'.$imagelink.'" target="_blank">' : '' );
				echo ( !empty($image) ? '<img alt="'.( !empty($alt) ? $alt : '' ).'" src="'.$image.'" class="'.esc_attr( $alignment ).'" />' : '');
			echo ( !empty( $imagelink ) ? '</a>' : '' );

			echo !$after_image ? '' : $autop ? wpautop( $after_image, false ) : $after_image;
		echo '</div>';

		echo $after_widget;
	}
}

add_action( 'widgets_init', create_function( '','register_widget( "MB_Image_Widget" );' ) );