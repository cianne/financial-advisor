<div>
    <?php
    $title = $instance['title'];
    $carousel = $instance['carousel'];
    $images = $instance['images'];
    $class = $instance['class'];
    $show = $instance['show'];
    // $imagesource = wp_get_attachment_image_src( $image, 'full' );
    // $imageurl = $imagesource[0];

    // $id = $args['widget_id'];
    // wp_enqueue_script( 'widgetjs' );

    $class = $carousel ? 'image-carousel' : 'image-list';
    ?>

    <?php if ( !empty( $title ) ) { ?>
    	<?php echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title']; ?>
    <?php } ?>

    <div class="image-carousel-widget<?php echo $carousel ? ' ' . $carousel : ' no-slide'; ?>">
        <?php if ( $images ) {
            echo '<div class="'.$class.'">';
                foreach ( $images as $image ) {
                    $imagesource = wp_get_attachment_image_src( $image['image'], 'full' );
                    $link = $image['link'];
                    $imageurl = $imagesource[0];
                    echo '<div>';
                        echo $link ? '<a href="'.$link.'" target="_blank">' : '';
                            echo '<img src="'.$imageurl.'" alt="" />';
                        echo $link ? '</a>' : '';
                    echo '</div>';
                }
            echo '</div>';
        } ?>
    </div>

    <script type="text/javascript">
        (function($){
            <?php if ( $carousel ) { ?>
            $(document).ready(function(){
                $("<?php echo $class ? '.' . $class : '.owl-carousel'; ?>").owlCarousel({
                    items: '4',
                    slideSpeed: '200',
                    paginationSpeed: '200',
                    navigation: true,
                    pagination: false,
                    navigationText: false,
                    autoPlay: false,
                    itemsDesktop: [1169, <?php echo $show ? (int) $show : '1'; ?>],
                    itemsDesktopSmall: [969, <?php echo $show ? (int) ($show - 1) : '1'; ?>],
                    itemsTablet: [749, <?php echo $show ? (int) ($show - 1) : '1'; ?>],
                    itemsMobile: [479, <?php echo $show ? '1' : '1'; ?>],
                    afterUpdate: function () {
                        updateSize();
                    },
                    afterInit:function(){
                        updateSize();
                    }
                });

                function updateSize(){
                    var minHeight=parseInt($('.owl-wrapper-outer').eq(0).css('height'));
                    $('.owl-item').each(function () {
                        var $$ = $(this), thisHeight = $$.height();
                        // var thisHeight = parseInt($(this).css('height'));
                        // var minHeight=(minHeight<=thisHeight?minHeight:thisHeight);
                        $$.css('min-height', thisHeight);
                        if (minHeight >= thisHeight) {
                            $$.css('margin-top', (minHeight-thisHeight)/2);
                        }

                    });
                    $('.owl-wrapper-outer').css('min-height',minHeight+'px');
                };
            });
            <?php } ?>
        })(jQuery);
    </script>
</div>