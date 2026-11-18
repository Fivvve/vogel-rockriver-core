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

    // 2. Taxonomy
    register_taxonomy( 'difficulty', 'trip', array(
        'labels'            => array(
            'name'          => 'Difficulty Levels',
            'singular_name' => 'Difficulty Level',
            'add_new_item'  => 'Add New Difficulty Level',
        ),
        'hierarchical'      => false,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => array( 'slug' => 'difficulty' ),
    ) );

    // 3. Custom fields (key => type, from my content model)
    $fields = array(
        'launch_site'    => 'string',
        'takeout_site'   => 'string',
        'distance_miles' => 'number',
        'paddle_time'    => 'string',
        'price'          => 'number',
        'min_age'        => 'number',
        'start_times'    => 'string',
        'season'         => 'string',
        'is_guided'      => 'boolean',
    );

    foreach ( $fields as $key => $type ) {
        $sanitize = 'sanitize_text_field';
        if ( 'number' === $type ) {
            $sanitize = 'rockriver_sanitize_number';
        } elseif ( 'boolean' === $type ) {
            $sanitize = 'rockriver_sanitize_yes_no';
        }

        register_post_meta( 'trip', $key, array(
            'type'              => $type,
            'single'            => true,
            'show_in_rest'      => true,
            'sanitize_callback' => $sanitize,
        ) );
    }
}

// Numbers like price and distance. Anything that isn't a number saves as 0.
function rockriver_sanitize_number( $value ) {
    return is_numeric( $value ) ? $value + 0 : 0;
}

// Saves is_guided as 1 or 0 so it shows up clearly in the Custom Fields panel.
function rockriver_sanitize_yes_no( $value ) {
    return rest_sanitize_boolean( $value ) ? '1' : '0';
}
