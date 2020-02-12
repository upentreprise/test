<?php

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( !function_exists( 'talemy_body_class' ) ) {
    /**
     * Add extra body class
     */
    function talemy_body_class( $classes ) {
        $menu_icons_position = talemy_get_option( 'menu_icons_position' );
        $classes[] = 'menu-icons-pos-' . $menu_icons_position;
        $classes[] = 'header-v' . talemy_get_option( 'header_style' );
        
        $global_header_position = talemy_get_option( 'header_position' );
        $page_header_position   = is_page() ? get_post_meta( get_the_ID(), '_sf_header_position', true ) : '';

        if ( 'default' != $page_header_position && ( 'absolute' == $page_header_position || 'absolute' == $global_header_position ) ) {
            $classes[] = 'header-position-absolute';
        }

        $loader_style = talemy_get_option( 'page_loader' );
        if ( !empty( $loader_style ) && $loader_style != 'none' ) {
            $classes[] = 'page-loading';
        }

        $corner_style = talemy_get_option( 'corner_style' );
        if ( !empty( $corner_style ) ) {
            $classes[] = 'style-'. $corner_style .'-corner';
        }

        if ( talemy_get_option( 'loop_thumb_placeholder' ) ) {
            $classes[] = 'thumb-placeholder-active';
        }

        $footer_title_style = talemy_get_option( 'footer_title_style' );
        if ( !empty( $footer_title_style ) ) {
            $classes[] = 'footer-title-style-'. $footer_title_style;
        }

        return $classes;
    }
}

if ( !function_exists( 'talemy_output_content_wrapper_start' ) ) {
    /**
     * Output the start of the page wrapper.
     */
    function talemy_output_content_wrapper_start() {
        get_template_part( 'templates/global/wrapper-start' );
    }
}

if ( !function_exists( 'talemy_output_content_wrapper_end' ) ) {
    /**
     * Output the end of the page wrapper.
     */
    function talemy_output_content_wrapper_end() {
        get_template_part( 'templates/global/wrapper-end' );
    }
}

if ( !function_exists( 'talemy_output_container_start' ) ) {
    /**
     * Output the start of the page wrapper.
     */
    function talemy_output_container_start() {
        if ( 'container' == talemy_get_setting( 'container' ) ) {
            echo '<div class="container">';
        }
    }
}

if ( !function_exists( 'talemy_output_container_end' ) ) {
    /**
     * Output the end of the page wrapper.
     */
    function talemy_output_container_end() {
        if ( 'container' == talemy_get_setting( 'container' ) ) {
            echo '</div>';
        }
    }
}

if ( !function_exists( 'talemy_output_before_main_content' ) ) {
    /**
     * Output before the main content.
     */
    function talemy_output_before_main_content() {
        switch ( talemy_get_setting( 'layout' ) ) {
            case 'sidebar-left':
                echo '<div class="row flex-row-reverse">';
                echo '<div class="col-lg-9">';
                break;
            case 'sidebar-right':
                echo '<div class="row">';
                echo '<div class="col-lg-9">';
                break;
        }
        if ( 'author' == talemy_get_setting( 'template' ) ) {
            get_template_part( 'templates/author-box' );
        }
    }
}

if ( !function_exists( 'talemy_output_after_main_content' ) ) {
    /**
     * Output after the main content.
     */
    function talemy_output_after_main_content() {
        switch ( talemy_get_setting( 'layout' ) ) {
            case 'sidebar-left':
            case 'sidebar-right':
                echo '</div>';
                break;
        }
    }
}

if ( !function_exists( 'talemy_output_sidebar' ) ) {
    /**
     * Output the sidebar.
     */
    function talemy_output_sidebar() {
        switch ( talemy_get_setting( 'layout' ) ) {
            case 'sidebar-left':
            case 'sidebar-right':
                echo '<div class="col-lg-3">';
                get_sidebar();
                echo '</div>';
                echo '</div>';
                break;
        }
    }
}

if ( !function_exists( 'talemy_output_content_banner' ) ) {
    /**
     * Output the content banner.
     */
    function talemy_output_content_banner() {
        get_template_part( 'templates/content-banner' );
    }
}

if ( !function_exists( 'talemy_output_before_content_loop' ) ) {
    /**
     * Output before the content loop.
     */
    function talemy_output_before_content_loop() {
        talemy_set_list_settings();
        echo '<div class="' . esc_attr( talemy_get_setting( 'list_class' ) ) . '">';
    }
}

if ( !function_exists( 'talemy_output_after_content_loop' ) ) {
    /**
     * Output after the content loop.
     */
    function talemy_output_after_content_loop() {
        echo '</div>';
        
        if ( talemy_get_query()->max_num_pages > 1 ) {
            get_template_part( 'templates/pagination/'. talemy_get_setting( 'pagination' ) );
        }

        wp_reset_postdata();
        // reset global query
        global $talemy_global_query;
        $talemy_global_query = NULL;
    }
}

if ( !function_exists( 'talemy_output_post_subtitle' ) ) {
    /**
     * Output post subtitle
     */
    function talemy_output_post_subtitle() {
        $subtitle = talemy_get_post_meta( '_sf_subtitle', '' );
        if ( !empty( $subtitle ) ) : ?>
        <h2 itemprop="description" class="post-subtitle"><?php echo esc_html( $subtitle ); ?></h2>
        <?php endif;
    }
}

if ( !function_exists( 'talemy_output_before_account_menu' ) ) {
    /**
     * Output before account menu
     *
     * @param object $user_data
     * @return void
     */
    function talemy_output_before_account_menu( $user_data ) {
        $user_link = function_exists( 'bp_core_get_user_domain' ) ? bp_core_get_user_domain( $user_data->ID ) : '#';
        $user_link = apply_filters( 'talemy_user_link', $user_link );
        ?>
        <a class="user-link" href="<?php echo esc_url( $user_link ); ?>">
            <?php echo get_avatar( $user_data->ID, 30 ); ?>
            <span>
                <span class="user-name"><?php echo esc_html( $user_data->first_name ); ?></span>
                <span class="user-mention"><?php echo esc_html( $user_data->user_login ); ?></span>
            </span>
        </a>
        <?php
    }
}
