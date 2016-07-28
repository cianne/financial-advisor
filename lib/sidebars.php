<?php
/**
 * Widget Areas
 *
 * @package      Boilerplate for Genesis
 * @since        1.0
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2014, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Register Sidebar Function
function mb_register_sidebars() {
	// Register Custom Sidebars
    genesis_register_sidebar( array(
        'id' => 'footer-right',
        'name' => __( 'Footer Right', 'financial' ),
        'description' => __( 'This is the footer right area. It usually appears after the copyright information.', 'financial' )
    ) );

    genesis_register_sidebar( array(
        'id' => 'before-header',
        'name' => __( 'Before header', 'financial' ),
        'description' => __( 'This is before header section area', 'financial' )
    ) );

    genesis_register_sidebar( array(
        'id' => 'home-section-1',
        'name' => __( 'Home Section 1', 'financial' ),
        'description' => __( 'This is banner area', 'financial' )
    ) );

    genesis_register_sidebar( array(
        'id' => 'home-section-2',
        'name' => __( 'Home Section 2', 'financial' ),
        'description' => __( 'This is Section 2 area', 'financial' )
    ) );

    genesis_register_sidebar( array(
        'id' => 'home-section-3',
        'name' => __( 'Home Section 3', 'financial' ),
        'description' => __( 'This is Section 3 area', 'financial' )
    ) );

    genesis_register_sidebar( array(
        'id' => 'home-section-4',
        'name' => __( 'Home Section 4', 'financial' ),
        'description' => __( 'This is Section 4 area', 'financial' )
    ) );

    genesis_register_sidebar( array(
        'id' => 'home-section-5',
        'name' => __( 'Home Section 5', 'financial' ),
        'description' => __( 'This is Section 5 area', 'financial' )
    ) );

     genesis_register_sidebar( array(
        'id' => 'home-section-6',
        'name' => __( 'Home Section 6', 'financial' ),
        'description' => __( 'This is Section 6 area', 'financial' )
    ) );

    genesis_register_sidebar( array(
        'id' => 'home-section-7',
        'name' => __( 'Home Section 7', 'financial' ),
        'description' => __( 'This is Section 7 area', 'financial' )
    ) );

      genesis_register_sidebar( array(
        'id' => 'after-content',
        'name' => __( 'After content section', 'financial' ),
        'description' => __( 'After Content', 'financial' )
    ) );

    genesis_register_sidebar( array(
        'id' => 'before-footer-1',
        'name' => __( 'Before Footer 1', 'financial' ),
        'description' => __( 'Before Footer Section 1', 'financial' )
    ) );

     genesis_register_sidebar( array(
        'id' => 'before-footer-2',
        'name' => __( 'Before Footer 2', 'financial' ),
        'description' => __( 'Before Footer Section 2', 'financial' )
    ) );

}
