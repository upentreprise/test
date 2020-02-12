<?php

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

/* -----------------------------------------------------------------------------
 * Post Metaboxes
 * ----------------------------------------------------------------------------- */
function talemy_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Post Settings', 'talemy' ),
        'post_types' => 'post',
        'fields'     => array(
            array(
                'id'   => '_sf_post_style',
                'name' => esc_html__( 'Post Style', 'talemy' ),
                'type' => 'image_select',
                'std' => '',
                'options' => array(
                    ''  => TALEMY_THEME_URI . 'includes/admin/assets/images/post/p0.png',
                    '1' => TALEMY_THEME_URI . 'includes/admin/assets/images/post/p1.png',
                    '2' => TALEMY_THEME_URI . 'includes/admin/assets/images/post/p2.png',
                )
            ),
            array(
                'id'   => '_sf_layout',
                'name' => esc_html__( 'Content Layout', 'talemy' ),
                'type' => 'image_select',
                'std' => 'sidebar-right',
                'options' => array(
                    ''              => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l0.png',
                    'sidebar-right' => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l1.png',
                    'sidebar-left'  => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l2.png',
                    'full-width'    => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l3.png',
                    'thin-width'    => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l4.png'
                )
            ),
            array(
                'id'   => '_sf_sidebar',
                'name' => esc_html__( 'Sidebar', 'talemy' ),
                'class' => 'sf_page_sidebar',
                'type' => 'select_advanced',
                'placeholder' => esc_html__( 'Default', 'talemy' ),
                'std' => '',
                'options' => talemy_get_option_sidebars()
            ),
            array(
                'id'   => '_sf_primary_category',
                'name' => esc_html__( 'Primary Category', 'talemy' ),
                'type' => 'select_advanced',
                'placeholder' => esc_html__( 'Default', 'talemy' ),
                'std' => '',
                'options' => talemy_get_option_cats()
            ),
            array(
                'id'   => '_sf_embed_code',
                'name' => esc_html__( 'Media Embed', 'talemy' ),
                'type' => 'oembed',
                'std' => ''
            ),
            array(
                'id'   => '_sf_hero_image',
                'name' => esc_html__( 'Hero Image ( Post Style 2 )', 'talemy' ),
                'type' => 'background',
            ),
            array(
                'id'   => '_sf_hide_featured',
                'name' => esc_html__( 'Disable Featured Image', 'talemy' ),
                'type' => 'switch',
            )
        )
    );

    $meta_boxes[] = array(
        'title'        => esc_html__( 'Page Settings', 'talemy' ),
        'post_types'   => array( 'page' ),
        'tabs'         => array(
            'general'  => array(
                'label' => esc_html__( 'General', 'talemy' )
            ),
            'header'   => array(
                'label' => esc_html__( 'Header', 'talemy' )
            )
        ),
        'tab_style' => 'default',
        'tab_wrapper' => false,
        'fields'     => array(
            array(
                'id'   => '_sf_banner',
                'name' => esc_html__( 'Banner', 'talemy' ),
                'type' => 'select',
                'std' => 'inherit',
                'options' => talemy_get_option_page_banner_options(),
                'tab'  => 'general'
            ),
            array(
                'id'   => '_sf_banner_image',
                'name' => esc_html__( 'Banner Image', 'talemy' ),
                'type' => 'image_advanced',
                'max_file_uploads' => 1,
                'max_status' => false,
                'hidden' => array( '_sf_banner', '!=', '' ),
                'tab'  => 'general'
            ),
            array(
                'id'   => '_sf_banner_shortcode',
                'name' => esc_html__( 'Banner Shortcode', 'talemy' ),
                'type' => 'text',
                'std' => '',
                'size' => 50,
                'visible' => array( '_sf_banner', '=', 'shortcode' ),
                'tab'  => 'general'
            ),
            array(
                'id'   => '_sf_layout',
                'name' => esc_html__( 'Layout', 'talemy' ),
                'type' => 'image_select',
                'class' => 'sf_layout',
                'std' => '',
                'options' => array(
                    ''              => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l0.png',
                    'sidebar-right' => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l1.png',
                    'sidebar-left'  => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l2.png',
                    'full-width'    => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l3.png',
                    'thin-width'    => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l4.png'
                ),
                'tab'  => 'general'
            ),
            array(
                'id'   => '_sf_sidebar',
                'name' => esc_html__( 'Sidebar', 'talemy' ),
                'class' => 'sf_sidebar',
                'type' => 'select_advanced',
                'placeholder' => esc_html__( 'Default', 'talemy' ),
                'std' => '',
                'options' => talemy_get_option_sidebars(),
                'tab'  => 'general'
            ),
            array(
                'id'   => '_sf_container',
                'name' => esc_html__( 'Container', 'talemy' ),
                'class' => 'sf_container',
                'type' => 'select',
                'std' => 'no_container',
                'options' => array(
                    'container' => esc_html__( 'Container', 'talemy' ),
                    'no_container' => esc_html__( 'No Container', 'talemy' ),
                ),
                'tab'  => 'general'
            ),
            array(
                'id'   => '_sf_header_position',
                'name' => esc_html__( 'Header Position', 'talemy' ),
                'type' => 'select',
                'std' => '',
                'options' => array(
                    '' => esc_html__( 'Default ( Global )', 'talemy' ),
                    'default' => esc_html__( 'Default', 'talemy' ),
                    'absolute' => esc_html__( 'Merge with content', 'talemy' )
                ),
                'tab'  => 'header'
            ),
            array(
                'id'   => '_sf_menu',
                'name' => esc_html__( 'Custom Nav Menu', 'talemy' ),
                'class' => 'sf_page_menu',
                'type' => 'select_advanced',
                'placeholder' => esc_html__( 'Default', 'talemy' ),
                'std' => '',
                'options' => talemy_get_option_menus(),
                'tab'  => 'header'
            ),
            array(
                'id'   => '_sf_page_logo',
                'name' => esc_html__( 'Custom Logo', 'talemy' ),
                'type' => 'switch',
                'default' => false,
                'tab'  => 'header'
            ),
            array(
                'id'   => '_sf_logo',
                'name' => esc_html__( 'Logo', 'talemy' ),
                'type' => 'image_advanced',
                'max_file_uploads' => 1,
                'max_status' => false,
                'visible' => array( '_sf_page_logo', '=', 1 ),
                'tab'  => 'header'
            ),
            array(
                'id'   => '_sf_logo_retina',
                'name' => esc_html__( 'Retina Logo', 'talemy' ),
                'type' => 'image_advanced',
                'max_file_uploads' => 1,
                'max_status' => false,
                'visible' => array( '_sf_page_logo', '=', 1 ),
                'tab'  => 'header'
            ),
            array(
                'id'   => '_sf_logo_width',
                'name' => esc_html__( 'Logo Width', 'talemy' ),
                'type' => 'number',
                'visible' => array( '_sf_page_logo', '=', 1 ),
                'tab'  => 'header'
            ),
            array(
                'id'   => '_sf_logo_height',
                'name' => esc_html__( 'Logo Height', 'talemy' ),
                'type' => 'number',
                'visible' => array( '_sf_page_logo', '=', 1 ),
                'tab'  => 'header'
            ),
            array(
                'id'   => '_sf_logo_alt',
                'name' => esc_html__( 'Mobile & Sticky Logo', 'talemy' ),
                'type' => 'image_advanced',
                'max_file_uploads' => 1,
                'max_status' => false,
                'visible' => array( '_sf_page_logo', '=', 1 ),
                'tab'  => 'header'
            ),
            array(
                'id'   => '_sf_logo_alt_retina',
                'name' => esc_html__( 'Mobile & Sticky Retina Logo', 'talemy' ),
                'type' => 'image_advanced',
                'max_file_uploads' => 1,
                'max_status' => false,
                'visible' => array( '_sf_page_logo', '=', 1 ),
                'tab'  => 'header'
            )
        )
    );

    $meta_boxes[] = array(
        'title'      => esc_html__( 'Page Settings', 'talemy' ),
        'post_types' => array( 'product' ),
        'fields'     => array(
            array(
                'id'   => '_sf_layout',
                'name' => esc_html__( 'Layout', 'talemy' ),
                'type' => 'image_select',
                'class' => 'sf_layout',
                'std' => '',
                'options' => array(
                    ''              => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l0.png',
                    'sidebar-right' => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l1.png',
                    'sidebar-left'  => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l2.png',
                    'full-width'    => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l3.png'
                )
            ),
            array(
                'id'   => '_sf_sidebar',
                'name' => esc_html__( 'Sidebar', 'talemy' ),
                'class' => 'sf_sidebar',
                'type' => 'select_advanced',
                'placeholder' => esc_html__( 'Default', 'talemy' ),
                'std' => '',
                'options' => talemy_get_option_sidebars()
            )
        )
    );

    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'talemy_meta_boxes' );

function talemy_taxonomy_meta_boxes( $meta_boxes ){
    $meta_boxes[] = array(
        'title' => esc_html__( 'Taxonomy Options', 'talemy' ),
        'taxonomies' => array( 'category', 'tag', 'ld_course_category', 'ld_course_tag' ),
        'fields' => array(
            array(
                'id'   => '_sf_icon',
                'name' => esc_html__( 'Icon', 'talemy' ),
                'type' => 'icon',
                'std' => '',
            ),
            array(
                'name' => esc_html__( 'Image Icon', 'talemy' ),
                'id'   => '_sf_image_icon',
                'type' => 'image_advanced',
                'max_file_uploads' => 1,
                'max_status' => false
            ),
            array(
                'name' => esc_html__( 'Banner Image', 'talemy' ),
                'id'   => '_sf_banner_image',
                'type' => 'image_advanced',
                'max_file_uploads' => 1,
                'max_status' => false
            ),
            array(
                'name' => esc_html__( 'Featured Image', 'talemy' ),
                'id'   => '_sf_featured_image',
                'type' => 'image_advanced',
                'max_file_uploads' => 1,
                'max_status' => false
            )
        )
    );

    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'talemy_taxonomy_meta_boxes' );
