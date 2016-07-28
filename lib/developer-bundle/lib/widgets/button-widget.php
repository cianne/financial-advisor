<?php
class MB_Button_Widget extends MB_Widget {
	public function __construct() {
		parent::__construct(
			'mb_button',
			'Button Widget',
			array(
				'description' => __( 'Easily add buttons on your sidebar.', 'starter' )
			)
		);

		$this->_form = array(
			"mb_title" => array(
				'field_id' => 'title',
				'field_title' => __( 'Button Text', 'starter' ),
				'field_description' => __( '', 'starter' ),
				'field_type' => 'textbox'
			),
			"mb_btnlink" => array(
				'field_id' => 'btnlink',
				'field_title' => __( 'Button Link', 'starter' ),
				'field_description' => __( '', 'starter' ),
				'field_type' => 'textbox'
			),
			"mb_btnclass" => array(
				'field_id' => 'btnclass',
				'field_title' => __( 'Button Class', 'starter' ),
				'field_description' => __( '', 'starter' ),
				'field_type' => 'textbox'
			),
            "mb_btntype" => array(
                'field_id' => 'btntype',
                'field_title' => __( 'Button Type', 'starter' ),
                'field_description' => __( '', 'starter' ),
                'field_type' => 'select',
                'field_select_values' => array(
                    'flat' => 'Flat',
                    'rounded' => 'Rounded',
                    'border' => 'Border'
                )
            ),
			"mb_btntarget" => array(
				'field_id' => 'btntarget',
				'field_title' => __( 'Button Target', 'starter' ),
				'field_description' => __( '', 'starter' ),
				'field_type' => 'select',
				'field_select_values' => array(
					'_blank' => 'Blank',
					'_self' => 'Self',
					'_parent' => 'Parent',
					'_top' => 'Top'
				)
			),
			"mb_before" => array(
				'field_id' => 'btnbefore',
				'field_title' => __( 'Text Before Button', 'starter' ),
				'field_description' => __( '', 'starter' ),
				'field_type' => 'textarea'
			),
			"mb_after" => array(
				'field_id' => 'btnafter',
				'field_title' => __( 'Text After Button', 'starter' ),
				'field_description' => __( '', 'starter' ),
				'field_type' => 'textarea'
			),
			"mb_autop" => array(
				'field_id' => 'autop',
				'field_title' => __( 'Automatically add paragraphs.', 'starter' ),
				'field_type' => 'checkbox'
			)
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );

		$title = do_shortcode(apply_filters( 'widget_title', $instance['title'] ));
		$btnlink = esc_url( $instance['btnlink'] );
		$btnclass = esc_attr( $instance['btnclass'] );
        $btntype = esc_attr( $instance['btntype'] );
        $btntype = $btntype ? $btntype : '';
		$btntarget = esc_attr( $instance['btntarget'] );
		$btntarget = !$btntarget ? '_self' : $btntarget;
		$btnbefore = do_shortcode( $instance['btnbefore'] );
		$btnafter = do_shortcode( $instance['btnafter'] );
		$autop = $instance['autop'];

		echo $before_widget;

		echo '<div class="buttonwidget">';
			echo !$btnbefore ? '' : $autop ? wpautop( $btnbefore, false ) : $btnbefore;

			if ( !empty( $btnlink ) ) {
				echo '<a class="btn '.$btnclass.' '.$btntype.'" target="'.$btntarget.'" href="'.$btnlink.'">'.$title.'</a>';
			}

			echo !$btnafter ? '' : $autop ? wpautop( $btnafter, false ) : $btnafter;
		echo '</div>';

		echo $after_widget;
	}
}

add_action( 'widgets_init', create_function( '','register_widget( "MB_Button_Widget" );' ) );
