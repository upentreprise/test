<?php
/**
 * Add course rating metabox to LearnDash Course edit screen
 */
function ldcr_add_course_review_meta_box() {
	add_meta_box(
		'ldcr-review-settings',
		__( 'Review Settings', 'ld-course-reviews' ),
		'ldcr_review_settings_meta_box',
		'sfwd-courses',
		'side',
		'default'
	);

	add_meta_box(
		'ldcr-course-rating',
		__( 'Course Rating', 'ld-course-reviews' ),
		'ldcr_course_rating_meta_box',
		'sfwd-courses',
		'side',
		'default'
	);

	add_meta_box(
		'ldcr-review-details',
		__( 'Review Details', 'ld-course-reviews' ),
		'ldcr_review_details_meta_box',
		'ldcr_review',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'ldcr_add_course_review_meta_box' );

/**
 * Course review metabox callback
 * 
 * @param  object $post WP_Post
 */
function ldcr_review_settings_meta_box( $post ) {
	$review_enabled = get_post_meta( $post->ID, '_ldcr_enable', true );
	$review_enabled = isset( $review_enabled ) && '' !== $review_enabled ? (bool) $review_enabled : 1;
	$review_after = get_post_meta( $post->ID, '_ldcr_review_after', true );
	$review_after = isset( $review_after ) && '' !== $review_after ? $review_after : $post->ID;
	$lessons = learndash_get_course_lessons_list( $post );
	?>
	<p>
		<label for="ldcr_enable">
			<input type="checkbox" id="ldcr_enable" name="ldcr_enable" value="1" <?php checked( '1', $review_enabled ); ?> />
			<?php esc_html_e( 'Enable course rating and review', 'ld-course-reviews' ); ?>
		</label>
	</p>
	<p>
		<label for="ldcr_review_after" style="display: block; margin-bottom: 5px;"><?php esc_html_e( 'Allow rating and review after', 'ld-course-reviews' ); ?></label>
		<select name="ldcr_review_after" id="ldcr_review_after">
			<option value="<?php echo esc_attr( $post->ID ); ?>" <?php selected( $post->ID, $review_after ); ?>><?php esc_html_e( 'Course Completion', 'ld-course-reviews' ); ?></option>
			<option value="0" <?php selected( 0, $review_after ); ?>><?php esc_html_e( 'Course Enrollment', 'ld-course-reviews' ); ?></option>
			<?php
				if ( $lessons ) {
					foreach ( $lessons as $lesson ) {
						$post_obj = $lesson['post'];
						echo '<option value="' . esc_attr( $post_obj->ID ) . '" ' . selected( $post_obj->ID, $review_after, false ) . '>' . esc_html( $post_obj->post_title ) . '</option>';
					}
				}
			?>
		</select>
	</p>
	<?php wp_nonce_field( 'ldcr_settings_nonce', 'ldcr_settings_nonce' );
}

/**
 * Course rating metabox callback
 * 
 * @param  object $post WP_Post
 */
function ldcr_course_rating_meta_box( $post ) {
	$course_rating = new LDCR_Rating_Summary( $post->ID );
	$avg_score = $course_rating->get_average_score();
	?>
	<p><?php printf( __( 'Average Rating: %s', 'ld-course-reviews' ), $avg_score ); ?></p>
	<p><?php printf( __( 'Total Reviews: %s', 'ld-course-reviews' ), $course_rating->get_total_count() ); ?></p>
	<p><?php echo ldcr_get_rating_stars( $avg_score ); ?></p>
	<p><a href="<?php echo admin_url( 'edit.php?post_type=ldcr_review&ldcr_course_id='. $post->ID ); ?>"><?php esc_html_e( 'See all reviews of this course', 'ld-course-reviews' ); ?></a></p>
	<?php
}

/**
 * Review rating metabox callback
 * 
 * @param  object $post WP_Post
 */
function ldcr_review_details_meta_box( $post ) {
	$rating = get_post_meta( $post->ID, '_ldcr_rating', true );
	$course_id = get_post_meta( $post->ID, '_ldcr_course_id', true );
	$course_id = !empty( $course_id ) ? $course_id : 0;
	$upvotes = ldcr_get_upvote_count( $post->ID );
	?>
	<p><?php _e( 'Rating', 'ld-course-reviews' ); ?>&nbsp;&nbsp;&nbsp;<?php echo ldcr_get_rating_stars( $rating ); ?></p>
	<?php if ( $upvotes > 0 ) : ?>
	<p><?php printf( _n( 'One person found this helpful', '%d people found this helpful', $upvotes, 'ld-course-reviews' ), $upvotes ); ?></p>
	<?php endif; ?>
	<p><a href="<?php echo admin_url( 'edit.php?post_type=ldcr_review&ldcr_course_id='. $course_id ); ?>"><?php echo get_the_title( $course_id ); ?></a></p>
	<?php
}

/**
 * Save course review settings
 * 
 * @param  object $post WP_Post
 */
function ldcr_save_review_settings_meta_box( $post_id ) {
	global $post_type;
	
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( 'sfwd-courses' != $post_type ) {
		return;
	}
	
	if ( !isset( $_POST['ldcr_settings_nonce'] ) || ! wp_verify_nonce( $_POST['ldcr_settings_nonce'], 'ldcr_settings_nonce' ) ) {
		return;
	}
	
	if ( !current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$enabled = isset( $_POST['ldcr_enable'] ) && $_POST['ldcr_enable'] ? 1 : 0;
	update_post_meta( $post_id, '_ldcr_enable', $enabled );

	if ( isset( $_POST['ldcr_review_after'] ) ) {
		update_post_meta( $post_id, '_ldcr_review_after', esc_attr( $_POST['ldcr_review_after'] ) );
	}
}
add_action( 'save_post', 'ldcr_save_review_settings_meta_box' );