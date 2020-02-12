<?php
/**
 * Block Courses
 *
 * @since   1.0.0
 * @package Talemy/Classes
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Talemy_Block_Courses extends Talemy_Block {

    /**
     * Tab ids
     */
    var $tab_ids = array();

    /**
     * Constructor 
     * 
     * @param array  $atts
     */
    function __construct( $atts ) {
        parent::__construct( $atts );
        $this->block_id = 'Block_Courses';
    }

    /**
     * Get tabs
     * @return string
     */
    public function get_tabs() {
        $out = $tabs = '';

        if ( empty( $this->atts['tab_type'] ) ) {
            return $out;
        }

        if ( 'subcat' !== $this->atts['tab_type'] && ( empty( $this->atts['tab_categories'] ) && empty( $this->atts['tab_tags'] ) && empty( $this->atts['tab_authors'] ) ) ) {
            return $out;
        }

        if ( 'author' == $this->atts['tab_type'] ) {
            foreach ( $this->atts['tab_authors'] as $id ) {
                if ( count_user_posts( $id ) > 0 ) {
                    $author_name = get_the_author_meta( 'display_name', $id );
                    $tabs .= '<a class="tab-item" href="javascript:void(0)" data-tab-id="' . esc_attr( $id ) . '">' . esc_attr( $author_name ) . '</a>';
                    $this->tab_ids[] = $id;
                }
            }
        } else {
            $args = array( 'hide_empty' => 1 );
            
            if ( 'subcat' == $this->atts['tab_type'] ) {
                $args['taxonomy'] = 'ld_course_category';

                if ( !empty( $this->atts['course_categories'] ) ) {
                    $args['child_of'] = is_array( $this->atts['course_categories'] ) ? $this->atts['course_categories'][0] : '';
                }
            }

            if ( 'cat' == $this->atts['tab_type'] ) {
                $args['taxonomy'] = 'ld_course_category';

                if ( !empty( $this->atts['tab_categories'] ) ) {
                    $args['include'] = $this->atts['tab_categories'];
                }
            }

            if ( 'tag' == $this->atts['tab_type'] ) {
                $args['taxonomy'] = 'ld_course_tag';

                if ( !empty( $this->atts['tab_tags'] ) ) {
                    $args['include'] = $this->atts['tab_tags'];
                }
            }

            if ( !empty( $this->atts['tab_orderby'] ) ) {
                $args['orderby'] = $this->atts['tab_orderby'];
            }

            if ( !empty( $this->atts['tab_order'] ) ) {
                $args['order'] = $this->atts['tab_order'];
            }
            
            $terms = get_terms( $args );
            if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
                foreach ( $terms as $term ) {
                    $tabs .= '<a class="tab-item" href="javascript:void(0)" data-tab-id="' . esc_attr( $term->term_id ) . '">' . esc_attr( $term->name ) . '</a>';
                    $this->tab_ids[] = $term->term_id;
                }
            }
        }

        if ( !empty( $tabs ) ) {
            $out .= '<div class="block-nav">';
            $out .= '<div class="tabs-wrapper">';
            if ( $this->atts['tab_show_all'] ) {
                $out .= '<a class="tab-item" href="javascript:void(0)" data-tab-id="0">' . esc_html__( 'All', 'talemy' ) . '</a>';
            }
            $out .= $tabs;
            $out .= '</div>';
            $out .= '<div class="more-tabs">';
            $out .= '<a href="javascript:void(0)" class="more-tab"><span>' . esc_html__( 'More', 'talemy' ) . '</span><i class="ticon-angle-down"></i></a>';
            $out .= '<div class="tabs-dropdown"></div>';
            $out .= '</div></div>';
        }

        return $out;
    }

    /**
     * Get block content
     * @return string
     */
	public function get_content() {
        $this->query = talemy_block_get_query( $this->atts, $this->tab_ids );

        if ( !$this->query->have_posts() ) {
            return '';
        }

        ob_start();
        
        talemy_set_block_settings( $this->atts );
        
        echo '<div class="block-content">';
        echo '<div class="' . talemy_get_setting( 'list_class' ) . '">';

        while( $this->query->have_posts() ) {
            $this->query->the_post();
            get_template_part( 'templates/learndash/loop/'. $this->atts['list_style'] );
        }

        echo '</div>';
        echo '</div>';

        wp_reset_postdata();

        return ob_get_clean();
	}

    /**
     * Get preloaded content
     * @return string
     */
    public function get_preload_content() {
        if ( 'preload' == $this->atts['preload_content'] && !empty( $this->tab_ids ) ) {
            
            ob_start();
            
            echo '<div class="block-preload-content">';

            foreach ( $this->tab_ids as $tab_id ) {
                $query_args = $this->query->query;
                switch ( $this->atts['tab_type'] ) {
                    case 'subcat':
                    case 'cat':
                        $query_args['tax_query'] = array(
                            array(
                                'taxonomy' => 'ld_course_category',
                                'terms' => $tab_id,
                            )
                        );
                        break;
                    case 'tag':
                        $query_args['tax_query'] = array(
                            array(
                                'taxonomy' => 'ld_course_tag',
                                'terms' => $tab_id,
                            )
                        );
                        break;
                    case 'author':
                        $query_args['author'] = $tab_id;
                        break;
                }
                $query = new WP_Query( $query_args );

                if ( $query->have_posts() ) {
                    talemy_set_block_settings( $this->atts );

                    echo '<div class="block-content" data-content-id="' . esc_attr( $tab_id ) . '" data-max-pages="' . esc_attr( $query->max_num_pages - 1 ) . '">';
                    echo '<div class="' . talemy_get_setting( 'list_class' ) . '">';

                    while( $query->have_posts() ) {
                        $query->the_post();
                        get_template_part( 'templates/learndash/loop/'. $this->atts['list_style'] );
                    }

                    echo '</div>';
                    echo '</div>';
                }
                wp_reset_postdata();
            }

            echo '</div>';
            return ob_get_clean();
        }
        return '';
    }
}