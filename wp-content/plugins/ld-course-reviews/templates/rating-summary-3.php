<?php
/**
 * Course Reviews
 *
 * $course_id       : (int) ID of the course
 * 
 * This template can be overridden by copying it to yourtheme/course-reviews/rating-summary-3.php.
 *
 * @package LearnDash Course Reviews/Templates
 * @version 1.0.3
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

global $post;
$course_id = isset( $course_id ) ? $course_id : $post->ID;
$rating_summary = new LDCR_Rating_Summary( $course_id );
$review_count = $rating_summary->get_total_count();
$average_score = $rating_summary->get_average_score();
if ( 0 === $review_count ) {
	return;
}
?>
<div class="ldcr-reviews__summary">
	<div class="ldcr-average-rating">
		<span class="ldcr-average-score"><?php echo esc_html( $average_score ); ?></span>
		<?php echo ldcr_get_rating_stars( $average_score ); ?>
		<span class="ldcr-review-count"><?php printf( __( '%d Reviews', 'ld-course-reviews' ), $review_count ); ?></span>
	</div>
	<div class="ldcr-stats">
	<?php for ( $score = 5; $score > 0; $score -- ) : ?>
		<?php $percentage = $rating_summary->get_rating_percent( $score ); ?>
		<div class="ldcr-stats__row<?php if ( $percentage == 0 ) { echo ' disabled'; } ?>" data-filter="<?php echo esc_attr( $score ); ?>">
			<span class="ldcr-rating-text">
				<a href="javascript:void(0)" class="ldcr-link"><?php printf( __( '%s star', 'ld-course-reviews' ), $score ); ?></a>
			</span>
			<span class="ldcr-meter">
				<span class="ldcr-meter--filled" style="width:<?php echo esc_attr( $percentage ); ?>%;"></span>
			</span>
			<span class="ldcr-percent">
				<a href="javascript:void(0)" class="ldcr-link"><?php printf( __( '%s %%', 'ld-course-reviews' ), $percentage ); ?></a>
			</span>
			<span class="ldcr-clear"><span class="ldcr-close"></span></span>
		</div>
	<?php endfor; ?>
	</div>
</div>