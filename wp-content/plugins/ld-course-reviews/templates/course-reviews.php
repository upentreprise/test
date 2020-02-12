<?php
/**
 * Course Reviews
 * 
 * $course_id       : (int) ID of the course
 * $title			: (string) title
 * 
 * This template can be overridden by copying it to yourtheme/course-reviews/course-reviews.php.
 *
 * @package LearnDash Course Reviews/Templates
 * @version 1.0.3
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

global $post;
$course_id = isset( $course_id ) ? $course_id : $post->ID;
?>
<?php do_action( 'ldcr_before_course_reviews' ); ?>
<div class="ldcr-reviews">
	<?php if ( !empty( $title ) ) : ?>
		<h3><?php echo wp_kses_post( $title ); ?></h3>
	<?php endif; ?>
	<?php ldcr_get_template( 'rating-summary-' . ldcr_get_setting( 'rating_summary_style', '1' ) . '.php', array( 'course_id' => $course_id ) ); ?>
	<?php ldcr_get_template( 'content-reviews.php', array( 'course_id' => $course_id ) ); ?>
	<?php ldcr_get_template( 'review-form.php', array( 'course_id' => $course_id ) ); ?>
</div>
<?php do_action( 'ldcr_after_course_reviews' ); ?>