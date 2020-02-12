<?php
/**
 * Content Reviews
 *
 * $course_id       : (int) ID of the course
 * 
 * This template can be overridden by copying it to yourtheme/course-reviews/content-reviews.php.
 *
 * @package LearnDash Course Reviews/Templates
 * @version 1.0.3
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

global $post;
$course_id 		= isset( $course_id ) ? $course_id : $post->ID;
$query 	   		= ldcr_get_course_reviews_query( $course_id );
$pending_review = ldcr_get_pending_review( $course_id );
?>
<div class="ldcr-reviews__list">
	<h4><?php esc_html_e( 'Reviews', 'ld-course-reviews' ); ?></h4>
	<?php if ( $query->have_posts() ) : ?>
		<div class="ldcr-reviews__items" data-course-id="<?php echo esc_attr( $course_id ); ?>" data-count="<?php echo esc_attr( $query->get( 'posts_per_page' ) ); ?>">
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		<?php ldcr_get_template( 'loop-review.php', array( 'course_id' => $course_id ) ); ?>
		<?php endwhile; ?>
		</div>
		<div class="ldcr-loader">
			<div class="ldcr-dot1"></div>
			<div class="ldcr-dot2"></div>
		</div>
		<?php echo ldcr_get_pagination( $query ); ?>
		<?php wp_nonce_field( 'ldcr_vote_nonce', 'ldcr_vote_nonce' ); ?>
	<?php endif; ?>
	<?php if ( !empty( $pending_review ) ) : ?>
		<div class="ldcr-message__box"><?php esc_html_e( 'Your review is awaiting approval.', 'ld-course-reviews' ); ?></div>
	<?php elseif ( !$query->have_posts() ) : ?>
		<div class="ldcr-message__box"><?php esc_html_e( 'There are no reviews yet. Be the first to review.', 'ld-course-reviews' ); ?></div>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
</div>