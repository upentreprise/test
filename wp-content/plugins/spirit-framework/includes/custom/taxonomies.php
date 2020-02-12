<?php
/**
 * Register Custom Taxonomies
 */

function sf_register_custom_taxonomies() {
    $custom_taxonomies = apply_filters( 'sf_custom_taxonomies', array() );

    if ( empty( $custom_taxonomies ) ) {
        return;
    }

    foreach ( $custom_taxonomies as $custom_taxonomy ) {
        if ( !empty( $custom_taxonomy['slug'] ) && !empty( $custom_taxonomy['post_type'] ) && !empty( $custom_taxonomy['args'] ) ) {
            register_taxonomy(
                $custom_taxonomy['slug'],
                $custom_taxonomy['post_type'],
                apply_filters( 'sf_taxonomy_args_'. $custom_taxonomy['slug'], $custom_taxonomy['args'] )
            );
        }
    }
}

add_action( 'init', 'sf_register_custom_taxonomies' );