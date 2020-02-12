<?php
/**
 * Tools Page
 *
 * Renders the tools page.
 *
 * @since 1.0
 * @return void
 */
function ldcr_tools_page() {
	?>
	<div id="ldcr-settings-page" class="wrap">
		<h1 class="page-title"><?php _e( 'Tools', 'ld-course-reviews' ); ?></h1>
		<div class="ldcr-card card">
			<h3><?php _e( 'Recount Stats', 'ld-course-reviews' ); ?></h3>
			<p><?php _e( 'LearnDash Course Reviews maintains an internal record of average rating and upvotes, this allows the plugin to retrieve data directly without negatively impacting performance when you have a lot of reviews.', 'ld-course-reviews' ); ?></p>
			<p><?php _e( 'If you suspect that the stats are incorrect (perhaps you have edited reviews directly in your database), you can recalculate them here.', 'ld-course-reviews' ); ?></p>
			<form method="post">
				<?php wp_nonce_field( 'ldcr_tools_recount', 'ldcr_recount_nonce' ); ?>
				<p class="submit">
					<button type="submit" class="button button-secondary" id="ldcr-btn-recount-stats">
						<span class="ldcr-btn-text"><?php _e( 'Recount Stats', 'ld-course-reviews' ); ?></span>
						<span class="ldcr-btn-loading-text"><?php _e( 'Recounting Stats', 'ld-course-reviews' ); ?></span>
					</button>
					<span class="spinner"></span>
				</p>
			</form>
		</div>
	</div>
	<?php
}

/**
 * Recount rating and upvote stats
 */
function ldcr_ajax_recount_stats() {
	check_admin_referer( 'ldcr_tools_recount', 'ldcr_recount_nonce' );

	$courses = get_posts( array(
		'post_type' => 'sfwd-courses',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'no_found_rows' => 1,
	) );
	if ( $courses ) {
		foreach ( $courses as $course ) {
			ldcr_update_course_meta( $course->ID );
		}
	}

	$reviews = get_posts( array(
		'post_type' => 'ldcr_review',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'no_found_rows' => 1,
	) );
	if ( $reviews ) {
		foreach ( $reviews as $review ) {
			ldcr_update_review_meta( $review->ID );
		}
	}

	wp_send_json_success();
	wp_die();
}

add_action( 'wp_ajax_ldcr_recount_stats', 'ldcr_ajax_recount_stats' );