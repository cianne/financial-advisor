<?php

class MB_Widget extends WP_Widget {

	public function update( $new_instance, $old_instance ) {
		$instance = array();
			foreach ($this->_form as $updatekey => $updateentry){
				$idkey = $updateentry['field_id'];
				$instance[$idkey] = strip_tags( $new_instance[$idkey] );
				if ( current_user_can('unfiltered_html') ) {
					$instance[$idkey] =  $new_instance[$idkey];
				} else {
					$instance[$idkey] = stripslashes( wp_filter_post_kses( addslashes($new_instance[$idkey]) ) );
				}
				$instance['filter'] = isset($new_instance['filter']);
			}
		return $instance;
	}

	public function form( $instance ) {
		foreach ($this->_form as $formkey => $formentry){
			//Show the field type and pass the variables
			$this->$formentry['field_type'](
				$formentry['field_id'],
				$formentry['field_title'],
				$formentry['field_description'],
				!empty( $instance[$formentry['field_id']] ) ? esc_attr( $instance[$formentry['field_id']] ) : NULL,
				isset( $formentry['field_select_values'] ) ? $formentry['field_select_values'] : NULL
			);
		}
	}

	/**
	* textbox field
	*/
	function textbox($field_id, $field_title, $field_description, $value){ ?>
        <p>
            <label for="<?php echo esc_attr( $field_id ); ?>"><?php echo $field_title ?> <?php echo $field_description != "" ? ' - ' . $field_description : ''; ?> </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $field_id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $field_id ) ); ?>" type="text" value="<?php echo $value; ?>" />
        </p>
    <?php }

	/**
	* url field
	*/
	function url($field_id, $field_title, $field_description, $value){ ?>
        <p>
            <label for="<?php echo esc_attr( $field_id ); ?>"><?php echo $field_title ?> <?php echo $field_description != "" ? ' - ' . $field_description : ''; ?> </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $field_id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $field_id ) ); ?>" type="url" value="<?php echo $value; ?>" />
        </p>
    <?php }

	/**
	* password field
	*/
	function password($field_id, $field_title, $field_description, $value){ ?>
        <p>
            <label for="<?php echo esc_attr( $field_id ); ?>"><?php echo $field_title ?> <?php echo $field_description != "" ? ' - ' . $field_description : ''; ?> </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $field_id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $field_id ) ); ?>" type="password" value="<?php echo $value; ?>" />
        </p>
    <?php }

	/**
	* number field
	*/
	function number($field_id, $field_title, $field_description, $value){ ?>
        <p>
            <label for="<?php echo esc_attr( $field_id ); ?>"><?php echo $field_title ?> <?php echo $field_description != "" ? ' - ' . $field_description : ''; ?> </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $field_id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $field_id ) ); ?>" type="number" value="<?php echo $value; ?>" />
        </p>
    <?php }

	/**
	* select field
	*/
	function select($field_id, $field_title, $field_description, $value, $field_select_values){ ?>
        <p>
        	<label for="<?php echo esc_attr( $field_id ); ?>"><?php echo $field_title ?> <?php echo !empty($field_description) ? ' - ' . $field_description : ''; ?> 	</label><br />
			<select name="<?php echo esc_attr( $this->get_field_name( $field_id ) ); ?>" >
				<option value=""></option>
				<?php foreach ( $field_select_values as $select_value => $select_text) : ?>
				<option value="<?php echo esc_attr( $select_value ); ?>" <?php selected( $select_value, $value ); ?>>
					<?php echo isset($select_text) ? esc_attr( $select_text ) : esc_attr( $select_value ); ?>
				</option>
				<?php endforeach; ?>
			</select>
        </p>
    <?php }

	/**
	* Select Page Field
	*/
	function selectpage($field_id, $field_title, $field_description, $value){ ?>
		<p>
			<label for="<?php echo esc_attr( $field_id ); ?>"><?php echo $field_title ?> <?php echo !empty($field_description) ? ' - ' . $field_description : ''; ?> </label><br />
			<select name="<?php echo esc_attr( $this->get_field_name( $field_id ) ); ?>" class="widefat">
				<?php $pages = get_pages(); ?>
				<option value=""></option>
				<?php foreach($pages as $page) { ?>
					<?php $id = $page->ID;
					$title = $page->post_title; ?>
					<option value="<?php echo $id; ?>" <?php selected($id, $value);?>><?php echo $title; ?></option>
				<?php } ?>
			</select>
		</p>
	<?php }

	/**
	* Select Custom Post Type
	*/
	function selectcpt($field_id, $field_title, $field_description, $value){ ?>
		<p>
			<label for="<?php echo esc_attr( $field_id ); ?>"><?php echo $field_title ?> <?php echo !empty($field_description) ? ' - ' . $field_description : ''; ?> </label><br />
			<select name="<?php echo esc_attr( $this->get_field_name( $field_id ) ); ?>" class="widefat">
				<?php $args = array('public' => true); ?>
				<option value=""></option>
				<?php $cpts = get_post_types($args, 'names'); ?>
				<?php foreach($cpts as $cpt) { ?>
					<?php $id = $cpt;
					$title = $cpt; ?>
					<option value="<?php echo $id; ?>" <?php selected($id, $value);?>><?php echo $title; ?></option>
				<?php } ?>
			</select>
		</p>
	<?php }

	/**
	 * Select Category
	 */
	function selectcategory($field_id, $field_title, $field_description, $value) { ?>
		<p>
			<label for="<?php echo esc_attr( $field_id ); ?>"><?php echo $field_title ?> <?php echo !empty($field_description) ? ' - ' . $field_description : ''; ?> </label><br />
			<select name="<?php echo esc_attr( $this->get_field_name( $field_id ) ); ?>" class="widefat">
				<?php $args = array(
					'type' => 'post',
					'hide_empty' => 0
				); ?>
				<option value=""></option>
				<?php $categories = get_categories($args); ?>
				<?php foreach($categories as $category) { ?>
					<?php $id = $category->slug;
					$title = $category->name; ?>
					<option value="<?php echo $id; ?>" <?php selected($id, $value);?>><?php echo $title; ?></option>
				<?php } ?>
			</select>
		</p>
	<?php }

	/**
	 * Select Sidebar
	 *
	 */
	function selectsidebar($field_id, $field_title, $field_description, $value){ ?>
		<p>
			<label for="<?php echo esc_attr( $field_id ); ?>"><?php echo $field_title ?> <?php echo !empty($field_description) ? ' - ' . $field_description : ''; ?> </label><br />
			<select name="<?php echo esc_attr( $this->get_field_name( $field_id ) ); ?>" class="widefat">
				<?php global $wp_registered_sidebars; ?>
				<option value=""></option>
				<?php foreach ($wp_registered_sidebars as $id => $sidebar) { ?>
					<?php if ($id != 'wp_inactive_widgets') { ?>
						<?php $ids = $sidebar['id'];
						$title = $sidebar['name'];
						?>
	                    <option value="<?php echo $ids; ?>" <?php selected($ids, $value); ?>><?php echo $title; ?></option>
                    <?php } ?>
                <?php } ?>
			</select>
		</p>
	<?php }

	/**
	* checkbox field
	*/
	function checkbox($field_id, $field_title, $field_description, $value){ ?>
		<?php $checked = empty($value) ? '' : 'checked'; ?>
        <p>
            <label for="<?php echo esc_attr( $field_id ); ?>"><?php echo $field_title ?> <?php echo $field_description != "" ? ' - ' . $field_description : ''; ?> </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $field_id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $field_id ) ); ?>" type="checkbox" value="<?php echo $field_id; ?>" <?php echo $checked; ?>/>
        </p>
    <?php }

	/**
	* textarea field
	*/
	function textarea($field_id, $field_title, $field_description, $value){ ?>
        <p>
            <label for="<?php echo esc_attr( $field_id ); ?>"><?php echo $field_title ?> <?php echo $field_description != "" ? ' - ' . $field_description : ''; ?> </label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( $field_id ) ); ?>" rows="4" cols="50" name="<?php echo esc_attr( $this->get_field_name( $field_id ) ); ?>" ><?php echo $value; ?></textarea>
        </p>
    <?php }

	/**
	* colorpicker field
	*/
	function colorpicker($field_id, $field_title, $field_description, $value){ ?>
        <p>
            <label for="<?php echo esc_attr( $field_id ); ?>"><?php echo $field_title ?> <?php echo $field_description != "" ? ' - ' . $field_description : ''; ?> </label>
            <div class="ra_color_picker">
            	<input class="of-color" id="<?php echo esc_attr( $this->get_field_id( $field_id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $field_id ) ); ?>" type="text" value="<?php echo $value; ?>" >
            </div>
        </p>
    <?php }

	/**
	* mediaupload field
	*/
	function mediaupload($field_id, $field_title, $field_description, $value){ ?>
        <p>
            <label for="<?php echo esc_attr( $field_id ); ?>"><?php echo $field_title ?> <?php echo $field_description != "" ? ' - ' . $field_description : ''; ?> </label>
            <!-- Upload button and text field -->
            <div class="ra_media_upload">
                <input class="custom_media_url" id="<?php echo esc_attr( $this->get_field_id( $field_id ) ); ?>" type="text" name="<?php echo esc_attr( $this->get_field_name( $field_id ) ); ?>" value="<?php echo esc_attr( $value ); ?>">
                <a href="#" class="button custom_media_upload" style="margin-bottom:10px;"><?php _e('Upload', 'ra_core'); ?></a>
            </div>
            <?php
            //Image thumbnail
            if (isset($value)){
                $ext = pathinfo($value, PATHINFO_EXTENSION);
                if ($ext == 'png' || $ext == 'jpg'){
                    ?><img class="custom_media_image" src="<?php echo $value; ?>" style="display:inline-block; width:100%; height:auto;" /><?php
                }else{
                    ?><img class="custom_media_image" src="<?php echo $value; ?>" style="display: none;" /><?php
                }
            } ?>
	<?php }

	/**
	* dashiconpicker field
	*/
	function dashiconpicker($field_id, $field_title, $field_description, $value) { ?>
		<p>
			<label for="<?php echo esc_attr($field_id); ?>"><?php echo $field_title; ?> <?php echo $field_description != "" ? ' - ' . $field_description : ''; ?></label>
			<!-- Dashicons -->
			<div class="ra_dashicons_picker">
				<input class="regular-text" id="<?php echo esc_attr($this->get_field_id($field_id)); ?>" type="text" name="<?php echo esc_attr($this->get_field_name($field_id)); ?>" value="<?php echo esc_attr($value); ?>"/>
				<input class="button dashicons-picker" type="button" value="Choose Icon" data-target="#<?php echo esc_attr($this->get_field_id($field_id)); ?>" />
			</div>
		</p>
	<?php }

	/**
	* iconpicker field
	*/
	function iconpicker($field_id, $field_title, $field_description, $value) { ?>
		<p>
			<label for="<?php echo esc_attr($field_id); ?>"><?php echo $field_title; ?> <?php echo $field_description != "" ? ' - ' . $field_description : ''; ?></label>
			<!-- Dashicons -->
			<!--<div class="ra_icon_picker">
				<input class="regular-text" type="hidden" id="<?php echo esc_attr($this->get_field_id($field_id)); ?>" name="<?php echo esc_attr($this->get_field_name($field_id)); ?>" value="<?php echo esc_attr($value); ?>"/>
    			<div id="preview_<?php echo esc_attr($this->get_field_id($field_id)); ?>" data-target="#<?php echo esc_attr($this->get_field_id($field_id)); ?>" class="button icon-picker <?php echo esc_attr($value); ?>"></div>
			</div>-->
			<div class="ra_icon_picker">
				<input class="regular-text" id="<?php echo esc_attr($this->get_field_id($field_id)); ?>" type="text" name="<?php echo esc_attr($this->get_field_name($field_id)); ?>" value="<?php echo esc_attr($value); ?>"/>
				<input class="button icon-picker" type="button" value="Choose Icon" data-target="#<?php echo esc_attr($this->get_field_id($field_id)); ?>" />
			</div>
		</p>
	<?php }

	/**
	* datepicker field
	*/
	function datepicker($field_id, $field_title, $field_description, $value) { ?>
		<p>
			<label for="<?php echo esc_attr($field_id); ?>"><?php echo $field_title; ?> <?php echo $field_description != "" ? ' - ' . $field_description : ''; ?></label>
			<input type="date" id="<?php echo esc_attr($this->get_field_id($field_id)); ?>" name="<?php echo esc_attr($this->get_field_name($field_id)); ?>" value="<?php echo esc_attr($value); ?>" class="widget-datepicker" />
		</p>
	<?php }

	/**
	* datepicker field
	*/
	function rangeslider($field_id, $field_title, $field_description, $value) { ?>
		<p>
			<label for="<?php echo esc_attr($field_id); ?>"><?php echo $field_title; ?> <?php echo $field_description != "" ? ' - ' . $field_description : ''; ?></label>
			<!-- <input type="date" id="<?php echo esc_attr($this->get_field_id($field_id)); ?>" name="<?php echo esc_attr($this->get_field_name($field_id)); ?>" value="<?php echo esc_attr($value); ?>" class="widget-datepicker" /> -->
			<div class="ra_range_slider">
				<input type="range" id="<?php echo esc_attr($this->get_field_id($field_id)); ?>" name="<?php echo esc_attr($this->get_field_name($field_id)); ?>" min="16" max="64" step="2" value="<?php echo esc_attr($value); ?>" class="rangeslider" data-rangeslider />
				<output></output>
			</div>
		</p>
	<?php }

} // class RA__Widget
