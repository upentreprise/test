<?php
/**
 * Register Custom Post Types
 */

 function sf_register_custom_post_types() {
    $custom_post_types = apply_filters( 'sf_custom_post_types', array() );

    if ( empty( $custom_post_types ) ) {
        return;
    }

    foreach ( $custom_post_types as $custom_post_type ) {
        if ( !empty( $custom_post_type['slug'] ) && !empty( $custom_post_type['args'] ) ) {
            register_post_type( $custom_post_type['slug'], apply_filters( 'sf_post_type_args_'. $custom_post_type['slug'], $custom_post_type['args'] ) );
        }
    }
}

add_action( 'init', 'sf_register_custom_post_types' );