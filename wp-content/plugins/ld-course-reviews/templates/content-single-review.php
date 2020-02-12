<?php
/**
 * The template for displaying product content in the single-review.php template
 *
 * This template can be overridden by copying it to yourtheme/course-reviews/content-single-review.php.
 *
 * @package LearnDash Course Reviews/Templates
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

$course_id = get_post_meta( get_the_ID(), '_ldcr_course_id', true );
$course    = get_post( $course_id );
$title     = apply_filters( 'ldcr_review_page_title', esc_html__( 'Course Review', 'ld-course-reviews' ) );
?>
<div id="ldcr-review-<?php the_ID(); ?>" class="ldcr-single-review">
    <?php if ( !empty( $title ) ) : ?>
        <h1><?php echo wp_kses_post( $title ); ?></h1>
    <?php endif; ?>
    <h4><a href="<?php echo esc_url( get_the_permalink( $course_id ) . '#review-item-' . get_the_ID() ); ?>">&larr; <?php echo wp_kses_post( $course->post_title ); ?></a></h4>
    <div class="ldcr-review__wrapper">
        <?php ldcr_get_template_part( 'loop', 'review' ); ?>
        <?php wp_nonce_field( 'ldcr_vote_nonce', 'ldcr_vote_nonce' ); ?>
    </div>
</div>