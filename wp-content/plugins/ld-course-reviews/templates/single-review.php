<?php
/**
 * The template for displaying product content in the single-review.php template
 *
 * This template can be overridden by copying it to yourtheme/course-reviews/single-review.php.
 *
 * @package LearnDash Course Reviews/Templates
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

get_header();

/**
 * ldcr_before_main_content hook.
 *
 * @hooked ldcr_output_content_wrapper - 10 (outputs opening divs for the content)
 */
do_action( 'ldcr_before_main_content' );

while ( have_posts() ) : the_post();

    ldcr_get_template_part( 'content', 'single-review' );

    if ( comments_open() && !ldcr_get_setting( 'disable_comments', false ) ) {
        comments_template();
    }

endwhile; // end of the loop.

/**
 * ldcr_after_main_content hook.
 *
 * @hooked ldcr_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'ldcr_after_main_content' );

/**
 * ldcr_sidebar hook.
 *
 * @hooked ldcr_get_sidebar - 10
 */
do_action( 'ldcr_sidebar' );
    
get_footer();