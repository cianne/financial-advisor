<?php
/**
 * Template Name: Thank You page
 *
 * @package      Boilerplate for Genesis
 * @since        1.0
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2015, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Force full width content
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );



genesis();
