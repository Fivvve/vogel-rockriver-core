<?php
/**
 * Plugin Name: Rock River Core
 * Description: Custom content for the Rock River Outfitters site.
 * Version: 1.0
 * Author: Travis Vogel
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Stop if this file is opened directly.
}

add_action( 'init', 'rockriver_register_content' );

function rockriver_register_content() {

    // 1. Post type
    register_post_type( 'trip', array(
        'labels'       => array(
            'name'          => 'Trips',
            'singular_name' => 'Trip',
            'add_new_item'  => 'Add New Trip',
            'edit_item'     => 'Edit Trip',
            'all_items'     => 'All Trips',
        ),
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'rewrite'      => array( 'slug' => 'trips' ),
        'menu_icon'    => 'dashicons-location-alt',
    ) );
}
