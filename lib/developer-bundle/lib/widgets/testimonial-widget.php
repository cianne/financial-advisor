<?php
class MB_Testimonial_Widget extends MB_Widget {
	public function __construct() {
		parent::__construct(
			'mb_testimonial',
			'Testimonial Widget',
			array(
				'description' => __( 'Easily display testimonials on sidebars.', 'starter' )
			)
		);

		// Before Testimonial Content
		add_action( 'db_testimonial_before_content', array( $this, 'db_do_testimonial_before_content' ) );

		// Testimonial Content
		add_action( 'db_testimonial_content', array( $this, 'db_do_testimonial_content' ) );

		// After Testimonial Content
		add_action( 'db_testimonial_after_content', array( $this, 'db_do_testimonial_after_content' ) );

		// After Testimonial Content
		add_action( 'db_testimonial_after_loop', array( $this, 'db_do_testimonial_after_loop' ) );

		$this->_form = array(
			"mb_title" => array(
				'field_id' => 'title',
				'field_title' => __('Title', 'starter'),
				'field_type' => 'textbox'
			),

			"mb_class" => array(
				'field_id' => 'class',
				'field_title' => __( 'Testimonial Class', 'starter' ),
				'field_type' => 'textbox'
			),

			"mb_position" => array(
				'field_id' => 'position',
				'field_title' => __( 'Detail Position', 'starter' ),
				'field_type' => 'select',
				'field_select_values' => array(
					'before' => 'Before Content',
					'after' => 'After Content'
				)
			),

			"mb_cbslide" => array(
				'field_id' => 'cbslide',
				'field_title' => __( 'Enable Slideshow?', 'starter' ),
				'field_type' => 'checkbox'
			),

			"mb_numpost" => array(
				'field_id' => 'numpost',
				'field_title' => __( 'Number of Testimonials to show', 'starter' ),
				'field_type' => 'number'
			),

			"mb_show" => array(
				'field_id' => 'show',
				'field_title' => __( 'Slides to show', 'starter' ),
				'field_type' => 'number'
			),

			/* "mb_scroll" => array(
				'field_id' => 'scroll',
				'field_title' => __( 'Slides to scroll', 'starter' ),
				'field_type' => 'number'
			), */

			"mb_speed" => array(
				'field_id' => 'speed',
				'field_title' => __( 'Animation Speed', 'starter' ),
				'field_type' => 'number'
			),

			"mb_duration" => array(
				'field_id' => 'duration',
				'field_title' => __( 'Animation Duration', 'starter' ),
				'field_type' => 'number'
			),

			"mb_image" => array(
				'field_id' => 'image',
				'field_title' => __( 'Display featured image?', 'starter' ),
				'field_type' => 'checkbox'
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

			"mb_autoplay" => array(
				'field_id' => 'autoplay',
				'field_title' => __( 'Enable autoplay', 'starter' ),
				'field_type' => 'checkbox'
			),

			"mb_pager" => array(
				'field_id' => 'pager',
				'field_title' => __( 'Display pager?', 'starter' ),
				'field_type' => 'checkbox'
			),

			"mb_navigation" => array(
				'field_id' => 'navigation',
				'field_title' => __( 'Display navigation?', 'starter' ),
				'field_type' => 'checkbox'
			),

			"mb_autoheight" => array(
				'field_id' => 'autoheight',
				'field_title' => __( 'Enable autoheight?', 'starter' ),
				'field_type' => 'checkbox'
			),
		);
	}

	public function widget($args, $instance) {
		extract($args);

		$title = apply_filters( 'widget_title', $instance['title'] );
		$numpost = $instance['numpost'];
		$class = $instance['class'];
		$show = (int) $instance['show'];
		// $scroll = (int) $instance['scroll'];
		$speed = $instance['speed'];
		$duration = $instance['duration'];
		// $cbimage = $instance['image'];
		// $imagex = $instance['imagex'];
		// $imagey = $instance['imagey'];
		// $imagecrop = $instance['imagecrop'];
		$cbslide = $instance['cbslide'];
		$autoplay = $instance['autoplay'];
		$pager = $instance['pager'];
		$navigation = $instance['navigation'];
		// $position = $instance['position'];

		/* if ( $class ) {
		    $class = $class;
		} else {
		    $class = 'testimonial-widget';
		} */

		wp_enqueue_script( 'widget-js' );
		// wp_localize_script( 'testimonial', 'params', $widget_args );

		echo $before_widget;

		if ( !empty( $title ) )
			echo $before_title . $title . $after_title;

		global $post;

		$args = array(
			'post_type' => 'testimonial',
			'order_by' => 'date',
			'order' => 'ASC'
		);

		$args['posts_per_page'] = !$numpost ? -1 : $numpost;

		$loop = new WP_Query( apply_filters( 'db_testimonial_widget_args', $args ) );

		if ( $loop->have_posts() ) :
			// echo '<div class="'.$class.' owl-carousel">';
			echo '<div class="'.$class.''; echo ( $cbslide ? ' owl-carousel' : ' no-slide' ); echo '">';
			while ( $loop->have_posts() ) : $loop->the_post();

				// $subtitle = get_post_meta( get_the_ID(), '_testimonial_fld_subtitle', true );

				echo '<div class="testimonial-container">';
					db_testimonial_before_content( $instance );

					echo '<div class="testimonial-content">';
						db_testimonial_content( $instance );
					echo '</div>';

					db_testimonial_after_content( $instance );
				echo '</div>';
			endwhile;
			echo '</div>';
		endif;
		wp_reset_postdata();

		db_testimonial_after_loop( $instance );
        echo $after_widget;
	}

	public function db_do_testimonial_after_loop( $instance ) {
		$speed = $instance['speed'];
		$duration = $instance['duration'];
		$cbslide = $instance['cbslide'];
		$class = $instance['class'];
		$autoplay = $instance['autoplay'];
		$pager = $instance['pager'];
		$navigation = $instance['navigation'];
		$class = $instance['class'];
		$show = (int) $instance['show'];
		$autoheight = $instance['autoheight'];

		if ( $cbslide ) { ?>
        <script type="text/javascript">
            (function($){
				$(document).ready(function(){
					$("<?php echo $class ? '.' . $class : '.owl-carousel'; ?>").owlCarousel({
						items: <?php echo $show ? (int) $show : '1'; ?>,
						slideSpeed: <?php echo (int) $speed ? $speed : '200'; ?>,
						paginationSpeed: <?php echo (int) $speed ? $speed : '200'; ?>,
						navigation: <?php echo $navigation ? 'true' : 'false'; ?>,
						pagination: <?php echo $pager ? 'true' : 'false'; ?>,
						navigationText: false,
						autoPlay: <?php echo $autoplay ? ( $duration ? $duration : 'true' ) : 'false'; ?>,
						itemsDesktop: [1169, <?php echo $show ? (int) $show : '1'; ?>],
						itemsDesktopSmall: [969, <?php echo $show ? (int) ($show - 1) : '1'; ?>],
						itemsTablet: [749, <?php echo $show ? (int) ($show - 1) : '1'; ?>],
						itemsMobile: [479, <?php echo $show ? '1' : '1'; ?>],
						autoHeight: <?php echo $autoheight ? 'true' : 'false'; ?>
					});
				});
            })(jQuery);
        </script>
		<?php }
	}

	// Testimonial Content
	public function db_do_testimonial_before_content( $instance ) {
		$cbimage = $instance['image'];
		$imagex = $instance['imagex'];
		$imagey = $instance['imagey'];
		$imagecrop = $instance['imagecrop'];
		$position = $instance['position'];

		$subtitle = get_post_meta( get_the_ID(), '_testimonial_fld_subtitle', true );

		$imagesrc = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

		$image = $imagesrc[0];

		if ( !empty( $imagex ) ) {
			$image = aq_resize( $image, !empty( $imagex ) ? $imagex : '', !empty( $imagey ) ? $imagey : '', ( $imagecrop == 'imagecrop' ) ? true : false );
		} else {
			$image = $image;
		}

		if ( $position == 'before' ) {
			echo '<div class="testimonial-details">';

				if ( $cbimage ) {
					if ( $image ) {
						echo '<div class="testimonial-image"><img src="'.$image.'" alt="" /></div>';
					}
				}

				echo '<div class="testimonial-info">';
					echo '<h4 class="testimonial-title">'.get_the_title().'</h4>';
					if ( $subtitle )
						echo '<span class="testimonial-subtitle">'.$subtitle.'</span>';
				echo '</div>';
			echo '</div>';
		}
	}

	// Testimonial Before Content
	public function db_do_testimonial_after_content( $instance ) {
		$cbimage = $instance['image'];
		$imagex = $instance['imagex'];
		$imagey = $instance['imagey'];
		$imagecrop = $instance['imagecrop'];
		$position = $instance['position'];

		$subtitle = get_post_meta( get_the_ID(), '_testimonial_fld_subtitle', true );

		$imagesrc = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

		$image = $imagesrc[0];

		if ( !empty( $imagex ) ) {
			$image = aq_resize( $image, !empty( $imagex ) ? $imagex : '', !empty( $imagey ) ? $imagey : '', ( $imagecrop == 'imagecrop' ) ? true : false );
		} else {
			$image = $image;
		}

		if ( $position == 'after' || !$position ) {
			echo '<div class="testimonial-details">';

				if ( $cbimage ) {
					if ( $image ) {
						echo '<div class="testimonial-image"><img src="'.$image.'" alt="" /></div>';
					}
				}

				echo '<div class="testimonial-info">';
					echo '<h4 class="testimonial-title">'.get_the_title().'</h4>';
					if ( $subtitle )
						echo '<span class="testimonial-subtitle">'.$subtitle.'</span>';
				echo '</div>';
			echo '</div>';
		}
	}

	// Testimonial After Content
	public function db_do_testimonial_content( $instance ) {
		the_content();
	}
}

// add_action( 'testimonial_after_content', array( $this, 'testing_action' ) );

add_action( 'widgets_init', create_function( '','register_widget( "MB_Testimonial_Widget" );' ) );
