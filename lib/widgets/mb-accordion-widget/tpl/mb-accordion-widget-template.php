<?php
echo '<div>';
    $title = $instance['title'];
    $faqs = $instance['faqs'];

    wp_enqueue_script( 'widget-vendor-js' );

    if ( $title )
        echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];

    if ( $faqs && !is_wp_error( $faqs ) ) {
        echo '<div class="accordion" data-anijs="if: click, on: .heading, do: $removeClass open, to: .open;
        if: click, on: .heading, do: $toggleClass open, to: $parent target;">';
            $count = 0;
            foreach( $faqs as $faq ) {
                echo '<div class="item'; if($count === 0){echo ' open';} echo'">';
                    echo '<h4 class="heading">'.$faq['heading'].'</h4>';
                    echo '<div class="faq-content">';
                        echo wpautop( $faq['content'], false );
                    echo '</div>';
                echo '</div>';
                $count++;
            }
        echo '</div>';
    }
echo '</div>';
