<?php
// Metabox
add_action( 'after_setup_theme', 'db_do_vafpress_metabox' );
function db_do_vafpress_metabox() {
    $testimonial = new VP_Metabox( array(
        'id' => 'mb_testimonial',
		'types' => array( 'testimonial' ),
		'title' => __( 'Additional Information', 'starter' ),
		'priority' => 'high',
		'is_dev_mode' => false,
		'mode' => WPALCHEMY_MODE_EXTRACT,
		'prefix' => '_testimonial_',
		'template' => array(
            array(
                'type' => 'textbox',
                'name' => 'fld_subtitle',
                'label' => __( 'Subtitle', 'starter' )
            )
        )
	) );
}
