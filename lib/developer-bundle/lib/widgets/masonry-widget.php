<?php
class MB_Masonry_Widget extends MB_Widget {
	public function __construct() {
		parent::__construct(
			'mb_masonry',
			'Masonry Widget',
			array(
				'description' => __( 'Display posts in grid layout.', 'starter' )
			)
		);

		$this->_form = array(
			"mb_title" => array(
				'field_id' => 'title',
				'field_title' => __('Title', 'starter'),
				'field_type' => 'textbox'
			),
			"mb_numpost" => array(
				'field_id' => 'numpost',
				'field_title' => __( 'Posts per Page', 'starter' ),
				'field_type' => 'textbox'
			)
		);
	}

	public function widget($args, $instance) {
		extract($args);

		$title = apply_filters( 'widget_title', $instance['title'] );
		$numpost = $instance['numpost'];

		echo $before_widget;
		if ( !empty( $title ) ) echo $before_title . $title . $after_title;

		echo '<div class="masonry-widget">';
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $numpost ? $numpost : '5'
			);

			$query = new WP_Query( $args );

			if ($query->have_posts() ) :
                while( $query->have_posts() ) : $query->the_post();
                    $imagesize = get_post_meta( get_the_ID(), '_post_fld_masonry', true );

                    echo '<div id="post-' . get_the_ID() . '" '; post_class( 'item' ); echo '>';
                        echo '<div class="post-content">';
                            printf( '<a href="%s" title="%s" class="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), esc_attr( $alignment ), genesis_get_image( array( 'format' => 'html', 'size' => $imagesize ? 'masonry-' . $imagesize : 'masonry-size11' ) ) );
                        echo '<div class="post-details">';
                            // printf( '<p class="byline post-info">%s</p>', do_shortcode( '[post_categories before=""]' ) );
                            printf( '<h2><a href="%s" title="%s">%s</a></h2>', get_permalink(), the_title_attribute( 'echo=0' ), get_the_title() );
                        echo '</div>';
                        echo '</div>';
                    echo '</div>';
                endwhile;
                wp_reset_postdata();
            endif;
		echo '</div>';

		echo $after_widget;
	}
}

add_action( 'widgets_init', create_function( '','register_widget( "MB_Masonry_Widget" );' ) );
