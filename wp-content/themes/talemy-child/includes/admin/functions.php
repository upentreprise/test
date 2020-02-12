<?php

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

function talemy_get_option_sidebars( $empty_option = false ) {
    global $wp_registered_sidebars, $talemy_option_sidebars;

    if ( isset( $talemy_option_sidebars ) ) {
        return $talemy_option_sidebars;
    }

    $sidebars = array();

    if ( $empty_option ) {
    	$sidebars[''] = esc_html__( 'Default', 'talemy' );
    }

    if ( !empty( $wp_registered_sidebars ) ) {
        foreach ( $wp_registered_sidebars as $sidebar ) {
            if ( $sidebar['id'] == 'footer-1'
                || $sidebar['id'] == 'footer-2'
                || $sidebar['id'] == 'footer-3'
                || $sidebar['id'] == 'footer-4'
                || $sidebar['id'] == 'footer-5' ) {
            	continue;
            }
            $sidebars[$sidebar['id']] = $sidebar['name'];
        }
    } else {
        $sidebars['default-sidebar'] = esc_html__( 'Default Sidebar', 'talemy' );
    }
    $talemy_option_sidebars = $sidebars;

    return $sidebars;
}

function talemy_get_option_menus() {
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	$options = array( '' => esc_html__( 'Default', 'talemy' ) );
	if ( $menus ) {
		foreach ( $menus as $menu ) {
			$options[ $menu->term_id ] = $menu->name;
		}
	}
	return $options;
}

function talemy_get_option_cats() {
	$cats = get_categories( 'hide_empty=0' );
	$cats_array = array();
	foreach ( $cats as $cat ) {
		$cats_array[ $cat->term_id ] = wp_specialchars_decode( $cat->cat_name );
	}
	return $cats_array;
}

function talemy_get_cat_count() {
	$cats = get_categories( 'hide_empty=0' );
	return count( $cats );
}

function talemy_get_option_layouts() {
	return array(
		'sidebar-right' => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l1.png',
		'sidebar-left' => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l2.png',
		'full-width' => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l3.png'
	);
}

function talemy_get_option_post_styles() {
	return array(
		'1' => TALEMY_THEME_URI . 'includes/admin/assets/images/post/p1.png',
		'2' => TALEMY_THEME_URI . 'includes/admin/assets/images/post/p2.png'
	);
}

function talemy_get_option_post_layouts() {
	return array(
		'sidebar-right' => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l1.png',
		'sidebar-left' => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l2.png',
		'full-width' => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l3.png',
		'thin-width' => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l4.png'
	);
}

function talemy_get_option_list_styles() {
	return array(
		'grid' => esc_html__( 'Grid', 'talemy' ),
		'list' => esc_html__( 'List', 'talemy' ),
		'masonry' => esc_html__( 'Masonry', 'talemy' )
	);
}

function talemy_get_option_course_list_styles() {
	return array(
		'grid' => esc_html__( 'Grid 1', 'talemy' ),
		'grid2' => esc_html__( 'Grid 2', 'talemy' ),
		'list' => esc_html__( 'List', 'talemy' ),
		'masonry' => esc_html__( 'Masonry', 'talemy' )
	);
}

function talemy_get_option_header_styles() {
	return array(
		'1' => esc_html__( 'Style 1', 'talemy' ),
		'2' => esc_html__( 'Style 2', 'talemy' ),
		'3' => esc_html__( 'Style 3', 'talemy' ),
		'4' => esc_html__( 'Style 4', 'talemy' ),
		'5' => esc_html__( 'Style 5', 'talemy' ),
		'6' => esc_html__( 'Style 6', 'talemy' ),
		'7' => esc_html__( 'Style 7', 'talemy' ),
		'8' => esc_html__( 'Style 8', 'talemy' ),
		'9' => esc_html__( 'Style 9', 'talemy' )
	);
}

function talemy_get_option_page_banner_options() {
	return array(
		'' => esc_html__( 'Default', 'talemy' ),
		'breadcrumbs' => esc_html__( 'Breadcrumbs', 'talemy' ),
		'shortcode' => esc_html__( 'Shortcode', 'talemy' ),
		'disable' => esc_html__( 'Disable', 'talemy' ),
	);
}

function talemy_get_option_page_banner_options_page() {
	return array(
		'inherit' => esc_html__( 'Global', 'talemy' ),
		'' => esc_html__( 'Default', 'talemy' ),
		'shortcode' => esc_html__( 'Shortcode', 'talemy' ),
		'disable' => esc_html__( 'Disable', 'talemy' ),
	);
}

function talemy_get_option_pagination_type() {
	return array(
		'numeric' => esc_html__( 'Numeric', 'talemy' ),
		'more' => esc_html__( 'Load More', 'talemy' ),
		'scroll' => esc_html__( 'Infinite Scroll', 'talemy' )
	);
}

function talemy_get_option_columns() {
	return array(
		'1' => esc_html__( '1', 'talemy' ),
		'2' => esc_html__( '2', 'talemy' ),
		'3' => esc_html__( '3', 'talemy' ),
		'4' => esc_html__( '4', 'talemy' ),
		'5' => esc_html__( '5', 'talemy' ),
		'6' => esc_html__( '6', 'talemy' ),
	);
}

function talemy_get_option_tablet_columns() {
	return array(
		'1' => esc_html__( '1', 'talemy' ),
		'2' => esc_html__( '2', 'talemy' ),
		'3' => esc_html__( '3', 'talemy' ),
		'4' => esc_html__( '4', 'talemy' ),
	);
}

function talemy_get_option_mobile_columns() {
	return array(
		'1' => esc_html__( '1', 'talemy' ),
		'2' => esc_html__( '2', 'talemy' ),
		'3' => esc_html__( '3', 'talemy' ),
	);
}

/**
 * Get all image sizes
 * @return array
 */
function talemy_get_option_image_sizes() {
	global $_wp_additional_image_sizes, $talemy_option_image_sizes;

	if ( isset( $talemy_option_image_sizes ) ) {
		return $talemy_option_image_sizes;
	}

	$default_image_sizes = [ 'thumbnail', 'medium', 'medium_large', 'large' ];

	$image_sizes = [];
	$options = [];

	foreach ( $default_image_sizes as $size ) {
		$image_sizes[ $size ] = [
			'width' => (int) get_option( $size . '_size_w' ),
			'height' => (int) get_option( $size . '_size_h' ),
			'crop' => (bool) get_option( $size . '_crop' ),
		];
	}

	if ( $_wp_additional_image_sizes ) {
		$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
	}

	foreach ( $image_sizes as $size_key => $size_attributes ) {
		$label = ucwords( str_replace( '_', ' ', $size_key ) );
		if ( is_array( $size_attributes ) ) {
			$label .= sprintf( ' - %d x %d', $size_attributes['width'], $size_attributes['height'] );
		}

		$options[ $size_key ] = $label;
	}

	$options['full'] = _x( 'Full', 'Image Size', 'talemy' );
	$talemy_option_image_sizes = $options;
	
	return $options;
}

if ( !function_exists( 'talemy_get_option_events' ) ) {
	/**
	 * Get a list of posts
	 * @return array  post options
	 */
	function talemy_get_option_events() {
		$options = array();
	    $events = tribe_get_events( array(
	        'posts_per_page' => -1,
	        'start_date' => date( 'Y-m-d H:i:s' )
	    ));
	    foreach( $events as $event ) {
	        $options[ $event->ID ] = strip_tags( $event->post_title ) .' - '. esc_html( tribe_format_date( $event->EventStartDate, false, 'm/d/Y' ) );
	    }
	    return $options;
	}
}