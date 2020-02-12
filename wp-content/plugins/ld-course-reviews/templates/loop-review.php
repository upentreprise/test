<?php
/**
 * Loop Review
 *
 * $course_id       : (int) ID of the course
 * 
 * This template can be overridden by copying it to yourtheme/course-reviews/loop-review.php.
 *
 * @package LearnDash Course Reviews/Templates
 * @version 1.0.4
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

$post_id 			= get_the_ID();
$score 				= get_post_meta( $post_id, '_ldcr_rating', true );
$upvotes 			= get_post_meta( $post_id, '_ldcr_upvotes', true );
$upvotes 			= !empty( $upvotes ) ? (int) $upvotes : 0;
$user_vote 			= get_user_meta( get_current_user_id(), "ldcr_vote_{$post_id}", true );
$user_vote 			= !empty( $user_vote ) ? $user_vote : '';
$upvote_action 		= 'up' == $user_vote ? 'undo' : 'up';
$downvote_action 	= 'down' == $user_vote ? 'undo' : 'down';
$login_redirect_url = isset( $course_id ) ? get_permalink( $course_id ) : get_permalink();
?>
<div class="ldcr-review__item" id="review-item-<?php echo esc_attr( $post_id ); ?>" data-id="<?php echo esc_attr( $post_id ); ?>">
	<?php if ( !ldcr_get_setting( 'review_hide_avatar' ) ) : ?>
		<div class="ldcr-review__avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?></div>
	<?php endif; ?>
	<div class="ldcr-review__content">
		<div class="ldcr-review__heading">
			<?php echo ldcr_get_rating_stars( $score ); ?>
			<a href="#review-item-<?php echo esc_attr( $post_id ); ?>" class="ldcr-review__headline"><?php the_title(); ?></a>
		</div>
		<div class="ldcr-review__meta">
			<span class="ldcr-review__author"><?php printf( __( 'by %s', 'ld-course-reviews' ), '<strong>' . get_the_author_meta( 'display_name' ) . '</strong>' ); ?></span>
			<span class="ldcr-review__separator"></span>
			<span class="ldcr-review__date"><?php echo get_the_date(); ?></span>
			<?php edit_post_link( esc_html__( 'Edit', 'ld-course-reviews' ), '<span class="ldcr-review__separator"></span><span class="ldcr-review__edit">', '</span>' ); ?></span>
		</div>
		<div class="ldcr-review__text">
			<?php the_content(); ?>
		</div>
		<?php if ( $upvotes > 0 ) : ?>
			<div class="ldcr-review__upvotes">
				<?php printf( _n( 'One person found this helpful', '%d people found this helpful', $upvotes, 'ld-course-reviews' ), $upvotes ); ?>
			</div>
		<?php endif; ?>
		<div class="ldcr-review__actions">
			<div class="ldcr-review__vote <?php echo esc_attr( $user_vote . 'voted' ); ?>">
				<a href="<?php echo wp_login_url( $login_redirect_url ); ?>" class="ldcr-btn-vote ldcr-upvote" data-action="<?php echo esc_attr( $upvote_action ); ?>">
					<?php _e( 'Helpful', 'ld-course-reviews' ); ?>
				</a>
				<a href="<?php echo wp_login_url( $login_redirect_url ); ?>" class="ldcr-btn-vote ldcr-downvote" data-action="<?php echo esc_attr( $downvote_action ); ?>">
					<?php _e( 'Not Helpful', 'ld-course-reviews' ); ?>
				</a>
				<div class="ldcr-message"></div>
			</div>
			<?php ldcr_comments_link(); ?>
		</div>
	</div>
</div>