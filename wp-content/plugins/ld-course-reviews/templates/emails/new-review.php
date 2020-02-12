<?php
/**
 * New review email
 *
 * $course_title   Course title
 * $headline       Review headline
 * $review         Review content
 * $review_author  Review author
 * $review_email   Review email
 * 
 * This template can be overridden by copying it to yourtheme/course-reviews/emails/new-review.php.
 *
 * @package 	LearnDash Course Reviews/Templates/Emails/Plain
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'ldcr_email_header' ); ?>

<p><?php printf( __( 'A new review has been submitted on %s.', 'course-reivews' ), date( 'F j, Y, g:i a' ) ); ?></p>

<p><?php printf( __( 'Rated %s out of 5 stars', 'course-reivews' ), $review_rating ); ?></p>

<h3><?php echo esc_html( $headline ); ?></h3>;

<p><?php echo wp_kses_post( $review ); ?></p>

<p><?php $review_author . '<' . $review_email . '>' ?></p>

<?php do_action( 'ldcr_email_footer' ); ?>