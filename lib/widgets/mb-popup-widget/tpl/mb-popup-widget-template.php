<div>
<?php
$title = $instance['title'];
$popup_content = do_shortcode( $instance['popup_content'] );
$popup_id = $instance['popup_id'];
$autop = $instance['autop'];
$popup_width = $instance['popup_width'];
$popup_height = $instance['popup_height'];
$popup_padding = $instance['popup_padding'];
$popup_type = $instance['popup_type'];

// Enqueue Scripts & Stylesheet
// wp_enqueue_script('widget-vendor-js');
// wp_enqueue_script( 'widgetjs' );
// wp_enqueue_style( 'widgetcss' );
?>
<?php 
echo '<div class="popupwidget">';
    switch ( $popup_type ) {
        case 'inline':
        default:
            if ( $title ) {
                echo '<a href="#'.$popup_id.'" class="btn '.$popup_id.'">'.do_shortcode( $title ).'</a>';
            }
            if ( $popup_id ) {
                echo '<div style="display: none;">';
                    echo '<div class="popup-content" id="'.$popup_id.'">';
                        if ( $autop ) {
                            echo wpautop( $popup_content, true );
                        } else {
                            echo $popup_content;
                        }
                    echo '</div>';
                echo '</div>';
            }
            break;
        case 'iframe':
            if ( $title ) {
                echo '<a href="'.$popup_content.'" class="btn '.$popup_id.'">'.do_shortcode( $title ).'</a>';
            }
            break;
    }
    /* if ( $title ) {
        // echo '<a href="#'.$popup_id.'" id="inline" class="btn '.$popup_id.'">'.do_shortcode( $title ).'</a>';
        echo '<a href="#'.$popup_id.'" class="btn '.$popup_id.'">'.do_shortcode( $title ).'</a>';
    }

    if ( $popup_id && $popup_type == 'inline' ) {
        echo '<div style="display: none;">';
            echo '<div class="popup-content" id="'.$popup_id.'">';
                if ( $autop ) {
                    echo wpautop( $popup_content, true );
                } else {
                    echo $popup_content;
                }
            echo '</div>';
        echo '</div>';
    } */
echo '</div>'; ?>

<script type="text/javascript">
(function($){
    $(document).ready(function(){
        $('.<?php echo $popup_id; ?>').fancybox({
            padding: <?php echo $popup_padding ? (int) $popup_padding : (int) '30'; ?>,
            hideOnContentClick: true,
            width: <?php echo $popup_width ? (int) $popup_width : (int) '300'; ?>,
            maxWidth: <?php echo $popup_width ? (int) $popup_width : (int) '300'; ?>,
            height: <?php echo $popup_height ? (int) $popup_height : (int) '300'; ?>,
            maxHeight: <?php echo $popup_height ? (int) $popup_height : (int) '300'; ?>,
            autoSize: false,
            fitToView: true,
            autoResize: true,
            tpl: {
            	wrap: '<div class="<?php echo $popup_id ? $popup_id : 'popup'; ?>-wrap fancybox-wrap" tabIndex="-1"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>'
            },
            type: '<?php echo $popup_type; ?>'
        });
    });
})(jQuery);
</script>
</div>
