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
 * This template can be overridden by copying it to yourtheme/course-reviews/emails/plain/new-review.php.
 *
 * @package 	LearnDash Course Reviews/Templates/Emails/Plain
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

echo sprintf( __( 'A new review has been submitted on %s.', 'course-reivews' ), date( 'F j, Y, g:i a' ) ) . "\n\n";

echo sprintf( __( 'Rated %s out of 5 stars', 'course-reivews' ), $review_rating ) . "\n\n";

echo $headline . "\n\n";

echo $review . "\n\n";

echo $review_author . '<' . $review_email . '>' . "\n\n";

echo "\n=====================================================================\n\n";
