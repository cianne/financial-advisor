<?php
class MB_Video_Widget extends MB_Widget {
	public function __construct() {
		parent::__construct(
			'mb_video',
			'Video Widget',
			array(
				'description' => __( 'Easily add videos to your sidebar. Supports mp4 format and oEmbed compatible video sites.', 'starter' )
			)
		);

		$this->_form = array(
			"mb_title" => array(
				'field_id' => 'title',
				'field_title' => __('Title', 'starter'),
				'field_type' => 'textbox'
			),
			"mb_video" => array(
				'field_id' => 'video_url',
				'field_title' => __( 'Video URL', 'starter' ),
				'field_type' => 'textbox'
			),
			"mb_before_video" => array(
				'field_id' => 'before_video',
				'field_title' => __( 'Text Before Video:', 'starter' ),
				'field_type' => 'textarea'
			),
			"mb_after_video" => array(
				'field_id' => 'after_video',
				'field_title' => __( 'Text After Video:', 'starter' ),
				'field_description' => '',
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

		$title = apply_filters( 'widget_title', $instance['title'] );
		$video = $instance['video_url'];
		$before_video = do_shortcode( $instance['before_video'] );
		$after_video = do_shortcode( $instance['after_video'] );
		$autop = $instance['autop'];

		echo $before_widget;
		
		if ( !empty( $title ) ) 
			echo $before_title . $title . $after_title;

		echo '<div class="videowidget">';
			echo !$before_video ? '' : $autop ? wpautop( $before_video, false ) : $before_video;
			// echo ( !empty( $video ) ? '<div class="video">'.$video.'</div>' : '');
			if ( $video ) {
				if ( strpos( $video, '.mp4' ) !== false ) {
					echo '<video controls>';
						echo '<source src="'.esc_url( $video ).'" type="video/mp4">';
					echo '</video>';
				} else { 
					$embed_code = wp_oembed_get( $video );
					echo $embed_code;
				}
			}
			
			echo !$after_video ? '' : $autop ? wpautop( $after_video, false ) : $after_video;
		echo '</div>';

		echo $after_widget;
	}
}

add_action( 'widgets_init', create_function( '','register_widget( "MB_Video_Widget" );' ) );