<?php
/**
 * AJAX hooks
 *
 * @since   1.1.7
 * @package Talemy/Classes
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Talemy_AJAX {
    
    /**
     * AJAX hooks
     */
    public static function init() {
        add_action( 'wp_ajax_talemy_ajax_posts', array( __CLASS__, 'load_posts' ) );
        add_action( 'wp_ajax_nopriv_talemy_ajax_posts', array( __CLASS__, 'load_posts' ) );
        add_action( 'wp_ajax_talemy_ajax_more_button', array( __CLASS__, 'load_more_button' ) );
        add_action( 'wp_ajax_nopriv_talemy_ajax_more_button', array( __CLASS__, 'load_more_button' ) );
        add_action( 'wp_ajax_talemy_block_ajax_posts', array( __CLASS__, 'load_block_posts' ) );
        add_action( 'wp_ajax_nopriv_talemy_block_ajax_posts', array( __CLASS__, 'load_block_posts' ) );
    }

    /**
     * Load posts
     */
    public static function load_posts() {
        $page_number    = isset( $_POST['page_number'] ) ? $_POST['page_number'] : 1;
        $query_args     = isset( $_POST['query_args'] ) ? $_POST['query_args'] : array();
        $atts           = isset( $_POST['atts'] ) ? $_POST['atts'] : array();
        $layout         = isset( $atts['layout'] ) ? $atts['layout'] : 'sidebar-right';
        $list_style     = isset( $atts['list_style'] ) ? $atts['list_style'] : '1';
        $columns        = isset( $atts['columns'] ) ? $atts['columns'] : 3;
        $tablet_columns = isset( $atts['tablet_columns'] ) ? $atts['tablet_columns'] : 2;
        $mobile_columns = isset( $atts['mobile_columns'] ) ? $atts['mobile_columns'] : 1;
        $thumb_size     = isset( $atts['thumb_size'] ) ? $atts['thumb_size'] : 1;
        $ppp            = !empty( $atts['ppp'] ) ? absint( $atts['ppp'] ) : get_option( 'posts_per_page' );
        $ppl            = !empty( $atts['ppl'] ) ? absint( $atts['ppl'] ) : 5;
        $post_type      = isset( $query_args['post_type'] ) ? $query_args['post_type'] : '';
        $offset         = isset( $query_args['offset'] ) ? $query_args['offset'] : 0;
        $posts_loaded   = $ppp + $ppl*( $page_number - 1 ) + $offset;

        if ( is_array( $query_args ) ) {
            $query_args['offset']         = $posts_loaded;
            $query_args['posts_per_page'] = $ppl;
            $query_args['no_found_rows']  = 1;
            $query_args['post_status']    = 'publish';
        }

        $query = new WP_Query( $query_args );

        if ( $query->have_posts() ) {
            talemy_set_setting( 'layout', $layout );
            talemy_set_setting( 'list_style', $list_style );
            talemy_set_setting( 'columns', $columns );
            talemy_set_setting( 'tablet_columns', $tablet_columns );
            talemy_set_setting( 'mobile_columns', $mobile_columns );
            talemy_set_setting( 'thumb_size', $thumb_size );
            talemy_set_list_settings();

            while ( $query->have_posts() ) {
                $query->the_post();

                if ( 'sfwd-courses' == $post_type ) {
                    get_template_part( 'templates/learndash/loop/'. $list_style );
                } else {
                    get_template_part( 'templates/loop/'. $list_style );
                }
            }

            wp_reset_postdata();
        }
        
        exit;
    }

    /**
     * Load more button
     */
    public static function load_more_button() {
        ?>
        <div class="load-more btn btn-primary">
            <span class="load-text"><?php esc_html_e( 'Load more', 'talemy' ); ?></span>
            <span class="loading-text"><?php esc_html_e( 'Loading...', 'talemy' ); ?></span>
        </div>
        <?php
        exit;
    }

    /**
     * Load block posts
     */
    public static function load_block_posts() {
        $action_type = isset( $_POST['action_type'] ) ? $_POST['action_type'] : '';
        $atts        = isset( $_POST['atts'] ) ? $_POST['atts'] : array();
        $block_id    = isset( $_POST['block_id'] ) ? $_POST['block_id'] : 'Block_Posts';
        $page_number = isset( $_POST['page_number'] ) ? $_POST['page_number'] : 1;
        $query_args  = isset( $_POST['query_args'] ) ? $_POST['query_args'] : array();
        $tab_id      = isset( $_POST['tab_id'] ) ? $_POST['tab_id'] : 0;
        $post_count  = !empty( $atts['count'] ) ? $atts['count'] : 5;
        $tab_type    = isset( $atts['tab_type'] ) ? $atts['tab_type'] : '';
        $pagination  = isset( $atts['pagination'] ) ? $atts['pagination'] : '';
        $list_style  = isset( $atts['list_style'] ) ? $atts['list_style'] : 'grid';
        $ppl         = isset( $atts['ppl'] ) ? $atts['ppl'] : 5;
    
        $atts['current_tab_id'] = $tab_id;
        $block_class            = 'Talemy_';
    
        if ( 0 != $tab_id ) {
            if ( 'Block_Courses' == $block_id ) {
    
                switch ( $tab_type ) {
                    case 'subcat':
                    case 'cat':
                        $query_args['tax_query'] = array(
                            array(
                                'taxonomy' => 'ld_course_category',
                                'terms'    => $tab_id,
                            )
                        );
                        break;

                    case 'tag':
                        $query_args['tax_query'] = array(
                            array(
                                'taxonomy' => 'ld_course_tag',
                                'terms'    => $tab_id,
                            )
                        );
                        break;

                    case 'author':
                        $query_args['author'] = $tab_id;
                        break;
                    
                }
            } else {
                switch ( $tab_type ) {
                    case 'subcat':
                    case 'cat': $query_args['cat']       = $tab_id; break;
                    case 'tag': $query_args['tag']       = $tab_id; break;
                    case 'author': $query_args['author'] = $tab_id; break;
                }
            }
        }
    
        if ( 'next' == $action_type || 'prev' == $action_type ) {
            $ppl = $post_count;
        }
    
        if ( 'tab' != $action_type ) {
            $offset                       = isset( $query_args['offset'] ) ? $query_args['offset'] : 0;
            $query_args['offset']         = $post_count + $ppl*( $page_number - 1 ) + (int) $offset;
            $query_args['posts_per_page'] = $ppl;
        }
    
        $atts['query_args'] = $query_args;
    
        if ( !empty( $block_id ) ) {
            $block_class = 'Talemy_' . $block_id;
        }
    
        $block = new $block_class( $atts );
    
        echo json_encode(array(
            'found_posts' => $block->query->found_posts,
            'html'        => $block->get_content()
        ));
    
        exit;
    }
}

Talemy_AJAX::init();