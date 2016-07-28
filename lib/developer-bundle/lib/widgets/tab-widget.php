<?php
class MB_Tabbed_Widget extends MB_Widget {
	public function __construct() {
		parent::__construct(
			'mb_tabbed',
			'Tabbed Widget',
			array(
				'description' => __( 'Turn your sidebar into tabs.', 'starter' )
			)
		);

		$this->_form = array(
            "mb_title" => array(
				'field_id' => 'title',
				'field_title' => __('Title', 'starter'),
				'field_type' => 'textbox'
			),
			"mb_sidebar" => array(
				'field_id' => 'sidebar',
				'field_title' => __( 'Select Sidebar', 'starter' ),
				'field_description' => __( 'Please do not add the sidebar in which this sidebar will reside.', 'starter' ),
				'field_type' => 'selectsidebar'
			)
		);
	}
	public function widget($args, $instance) {
		add_filter('dynamic_sidebar_params', array(&$this, 'widget_sidebar_params'));
        $title = apply_filters( 'widget_title', $instance['title'] );

		extract($args, EXTR_SKIP);

		// wp_enqueue_script('easytabs.js');
		wp_enqueue_script('widget-js');

		echo $before_widget;
            if ( !empty( $title ) ) echo $before_title . $title . $after_title;

            if ($args['id'] != $instance['sidebar']) {
                echo '<div id="tab-container" class="tab-container">';
                    echo '<ul class="etabs"></ul>';
                    dynamic_sidebar($instance['sidebar']);
                echo '</div>';
            } else {
                echo 'Tabber widget is not properly configured.';
            }
		echo $after_widget;

		remove_filter('dynamic_sidebar_params', array(&$this, 'widget_sidebar_params'));
	}

	public function widget_sidebar_params($params) {
        // var_dump( $params );
		$id = $params[0]['widget_id'];
        // var_dump( $params[0]['before_widget']);
        $class = 'class="tabs ' . $id;
        // $params[0]['before_widget'] = str_replace( 'class="widget ', $class, $params[0]['before_widget'] );
        $params[0]['before_widget'] = '<div id="'.$params[0]['widget_id'].'" class="tabs">';
        // $params[0]['before_widget'] = '<div id="%1$s" class="widget %2$s">';
		// $params[0]['before_widget'] = '<div id="'.$params[0]['widget_id'].'" class="tabs '.$classname_.'">';
        $params[0]['after_widget'] = '</div>';
        $params[0]['before_title'] = '<a href="#" class="tab-title" id="tab-'.$id.'">';
        $params[0]['after_title'] = '</a>';
        return $params;
    }
}

add_action('widgets_init', create_function('','register_widget("MB_Tabbed_Widget");' ));
