<?php
/**
 * Review Form
 *
 * $course_id       : (int) ID of the course
 * 
 * This template can be overridden by copying it to yourtheme/course-reviews/review-form.php.
 *
 * @package LearnDash Course Reviews/Templates
 * @version 1.0.3
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

global $post;
$course_id = isset( $course_id ) ? $course_id : $post->ID;

// print nothing if user not logged in or course review is disabled
if ( !is_user_logged_in() || !ldcr_is_course_review_enabled( $course_id ) ) {
	return;
}

$review_allowed = ldcr_is_course_review_allowed( $course_id );

if ( !$review_allowed ) {
	return;
}

?>
<?php do_action( 'ldcr_before_review_form' ); ?>
<div class="ldcr-reviews__new">
	<h4><?php esc_html_e( 'Write a review', 'ld-course-reviews' ); ?></h4>

	<?php if ( !is_wp_error( $review_allowed ) && $review_allowed ) : ?>
	
	<div class="ldcr-message"></div>
	<form class="ldcr-review__form" method="POST" action="" data-course-id="<?php echo esc_attr( $course_id ); ?>">
		<div class="ldcr-loader"></div>
		<div class="ldcr-form__row">
			<p><?php esc_html_e( 'How would you rate this course?', 'ld-course-reviews' ); ?></p>
			<div class="ldcr-input__stars<?php if ( ldcr_get_setting( 'full_star_rating' ) ) { echo ' full-star-only'; } ?>">
				<label for="ldcr-input--0.5" class="ldcr-input__star filled">
					<input type="radio" name="ldcr-input__star" class="sr-only" id="ldcr-input--0.5" value="1" aria-label="0.5">
				</label>
				<label for="ldcr-input--1" class="ldcr-input__star filled active">
					<input type="radio" name="ldcr-input__star" class="sr-only" id="ldcr-input--1" value="1" aria-label="1" checked />
				</label>
				<label for="ldcr-input--1.5" class="ldcr-input__star">
					<input type="radio" name="ldcr-input__star" class="sr-only" id="ldcr-input--1.5" value="1.5" aria-label="1.5" />
				</label>
				<label for="ldcr-input--2" class="ldcr-input__star">
					<input type="radio" name="ldcr-input__star" class="sr-only" id="ldcr-input--2" value="2" aria-label="2" />
				</label>
				<label for="ldcr-input--2.5" class="ldcr-input__star">
					<input type="radio" name="ldcr-input__star" class="sr-only" id="ldcr-input--2.5" value="2.5" aria-label="2.5" />
				</label>
				<label for="ldcr-input--3" class="ldcr-input__star">
					<input type="radio" name="ldcr-input__star" class="sr-only" id="ldcr-input--3" value="3" aria-label="3" />
				</label>
				<label for="ldcr-input--3.5" class="ldcr-input__star">
					<input type="radio" name="ldcr-input__star" class="sr-only" id="ldcr-input--3.5" value="3.5" aria-label="3.5" />
				</label>
				<label for="ldcr-input--4" class="ldcr-input__star">
					<input type="radio" name="ldcr-input__star" class="sr-only" id="ldcr-input--4" value="4" aria-label="4" />
				</label>
				<label for="ldcr-input--4.5" class="ldcr-input__star">
					<input type="radio" name="ldcr-input__star" class="sr-only" id="ldcr-input--4.5" value="4.5" aria-label="4.5" />
				</label>
				<label for="ldcr-input--5" class="ldcr-input__star">
					<input type="radio" name="ldcr-input__star" class="sr-only" id="ldcr-input--5" value="5" aria-label="5" />
				</label>
			</div>
		</div>
		<div class="ldcr-new__review">
			<div class="ldcr-form__row">
				<input type="text" id="ldcr-input__headline" class="ldcr-input" placeholder="<?php esc_html_e( 'Headline', 'ld-course-reviews' ); ?>" required>
			</div>
			<div class="ldcr-form__row">
				<textarea id="ldcr-input__review" class="ldcr-input" rows="4" placeholder="<?php esc_html_e( 'Write your review here.', 'ld-course-reviews' ); ?>" required></textarea>
			</div>
			<input type="submit" id="ldcr-btn-submit" class="btn btn-outline-dark" value="<?php esc_html_e( 'Submit', 'ld-course-reviews' ); ?>">
			<?php wp_nonce_field( 'ldcr_review_nonce', 'ldcr_review_nonce' ) ?>
		</div>
	</form>

<?php else: ?>

	<div class="ldcr-message"><?php echo $review_allowed->get_error_message(); ?></div>

<?php endif; ?>

</div>
<?php do_action( 'ldcr_after_review_form' ); ?>