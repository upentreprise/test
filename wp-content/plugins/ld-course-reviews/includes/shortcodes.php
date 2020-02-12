<?php

defined( 'ABSPATH' ) || exit;

add_shortcode( 'ldcr_course_reviews', 'ldcr_shortcode_course_reviews' );
add_shortcode( 'ldcr_course_rating', 'ldcr_shortcode_course_rating' );
add_shortcode( 'ldcr_course_rating_summary', 'ldcr_shortcode_course_rating_summary' );

if ( !function_exists( 'ldcr_shortcode_course_reviews' ) ) {
	/**
     * Course Reviews shortcode - [ldcr_course_reviews]
     *
     * @param array $atts
     * @return string
     */
	function ldcr_shortcode_course_reviews( $atts ) {
        global $post;

        // Make sure that course exist
        $course_id = isset( $atts['course_id'] ) ? (int) $atts['course_id'] : $post->ID;
        if ( 'sfwd-courses' !== get_post_type( $course_id ) ) {
            return '';
        }
        
        return ldcr_get_template_html(
            'course-reviews.php',
            array(
                'course_id' => $course_id,
                'title' => isset( $atts['title'] ) ? $atts['title'] : ''
            )
        );
	}
}

if ( !function_exists( 'ldcr_shortcode_course_rating' ) ) {
	/**
     * Course Rating shortcode - [ldcr_course_rating]
     *
     * @param array $atts
     * @return string
     */
	function ldcr_shortcode_course_rating( $atts ) {
		$args = shortcode_atts( array(
            'course_id' => 0,
            'show_count' => false,
            'show_score' => false,
            'show_stars' => true
        ), $atts );

        if ( !isset( $args['course_id'] ) ) {
            return '';
        }

        if ( $args['show_count'] === 'false' ) {
            $show_count = 0;
        } else {
            $show_count = (bool) $args['show_count'];
        }

        if ( $args['show_score'] === 'false' ) {
            $show_score = 0;
        } else {
            $show_score = (bool) $args['show_score'];
        }

        if ( $args['show_stars'] === 'false' ) {
            $show_stars = 0;
        } else {
            $show_stars = (bool) $args['show_stars'];
        }

        return ldcr_get_course_rating( $args['course_id'], $show_count, $show_score, $show_stars );
	}
}

if ( !function_exists( 'ldcr_shortcode_course_rating_summary' ) ) {
	/**
     * Course Rating shortcode - [ldcr_course_rating_summary]
     *
     * @param array $atts
     * @return string
     */
	function ldcr_shortcode_course_rating_summary( $atts ) {
        global $post;
        // Make sure that course exist
        $course_id = isset( $atts['course_id'] ) ? (int) $atts['course_id'] : $post->ID;
        if ( 'sfwd-courses' !== get_post_type( $course_id ) ) {
            return '';
        }
        
        $style = isset( $atts['style'] ) && in_array( $atts['style'], array( '1', '2', '3' ) ) ? $atts['style'] : ldcr_get_setting( 'rating_summary_style', '1' ); 

        return ldcr_get_template_html( 'rating-summary-' . $style . '.php', array( 'course_id' => $course_id ) );
	}
}