<?php
echo '<div>';
    $title = $instance['title'];
    $class = $instance['class'];
    $testimonials = $instance['testimonial'];

    wp_enqueue_script( 'widget-vendor-js' );

    if ( $title )
        echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];

    if ( $testimonials && !is_wp_error( $testimonials ) ) {
        echo '<div class="testimonial-widget '.$class.'"  >';
            foreach( $testimonials as $testimonial ) {
                $img_url = wp_get_attachment_image_src( $testimonial['image'], 'testimonial-thumb' )[0];

                echo '<div class="item '. ($testimonial['image'] ? 'has-image' : '' ) .'">';

                    $img = aq_resize($img_url, 145, 145, true);

                    if($testimonial['image']){
                        echo '<image src="'.$img .'" class="alignleft">';
                    }
                    echo '<div class="testimonial-content">';
                        echo wpautop( $testimonial['content'], false );
                    echo '</div>';

                    echo '<h5 class="testimonial-name">'.$testimonial['name'].'</h4>';
                    echo '<h5 class="testimonial-business">'.$testimonial['business'].'</h4>';
                echo '</div>';
            }
        echo '</div>';
    }
echo '</div>';
