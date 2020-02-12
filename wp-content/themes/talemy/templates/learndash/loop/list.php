<?php
$course_id = get_the_ID();
$user_id = get_current_user_id();
$course_options = get_post_meta( $course_id, '_sfwd-courses', true );
$meta_data = get_post_meta( $course_id, '_ld_custom_meta', true );
$meta = talemy_get_setting( 'list_meta_data' );
$course_meta = talemy_get_ld_loop_course_meta( $meta, $meta_data );

$has_access   = sfwd_lms_has_access( $course_id, $user_id );
$is_completed = learndash_course_completed( $user_id, $course_id );
$is_wc_product = defined( 'WC_PLUGIN_FILE' ) && defined( 'LEARNDASH_WOOCOMMERCE_FILE' ) && !empty( $meta_data['related_product'] );

$badge_class = '';
$badge_text = '';

if ( $user_id ) {
	if ( $has_access && !$is_completed ) {
		$badge_class = 'post-badge enrolled';
		$badge_text = esc_html__( 'Enrolled', 'talemy' );
	} elseif ( $has_access && $is_completed ) {
		$badge_class = 'post-badge completed';
		$badge_text = esc_html__( 'Completed', 'talemy' );
	}
}

?>
<div <?php post_class( 'post '. talemy_get_setting( 'post_class' ) ); ?>>
	<div class="post-body">
		<?php echo talemy_get_ld_loop_thumb( talemy_get_setting( 'thumb_size' ) ); ?>
		<?php if ( !empty( $badge_text ) ) : ?>
			<div class="<?php echo esc_attr( $badge_class ); ?>"><?php echo esc_attr( $badge_text ); ?></div>
		<?php endif; ?>
		<div class="post-info"<?php if ( empty( $course_meta ) ) : ?> style="padding-bottom:30px;"<?php endif; ?>>
			<?php echo talemy_get_loop_title(); ?>
			<div class="course-meta">
				<span class="course-meta__author"><?php printf( esc_html__( 'by %s', 'talemy' ), '<a href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ) .'">' . get_the_author() . '</a>' ); ?></span>
				<span class="course-meta__price">
				<?php if ( $is_wc_product ) : ?>
				<?php echo talemy_get_wc_product_price( $meta_data['related_product'] ); ?>
				<?php else: ?>
				<?php echo talemy_get_ld_course_price( $course_id, $course_options ); ?>
				<?php endif; ?>
				</span>
			</div>
			<?php do_action( 'ldcr_course_rating', get_the_ID(), true, true ); ?>
			<?php if ( !empty( $meta_data['short_desc'] ) ) : ?>
				<div class="post-excerpt"><?php echo esc_html( $meta_data['short_desc'] ); ?></div>
			<?php endif; ?>
			<?php echo $course_meta; ?>
		</div>
	</div>
</div>
