<?php
$course_id = get_the_ID();
$user_id = get_current_user_id();
$course_options = get_post_meta( $course_id, '_sfwd-courses', true );
$meta_data = get_post_meta( $course_id, '_ld_custom_meta', true );
$meta = talemy_get_setting( 'grid_meta_data' );

$has_access = sfwd_lms_has_access( $course_id, $user_id );
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
	<div class="post-body has-popover">
		<?php echo talemy_get_loop_thumb( talemy_get_setting( 'thumb_size' ) ); ?>
		<?php if ( !empty( $badge_text ) ) : ?>
			<div class="<?php echo esc_attr( $badge_class ); ?>"><?php echo esc_attr( $badge_text ); ?></div>
		<?php endif; ?>
		<div class="post-info">
			<?php echo talemy_get_loop_title(); ?>
			<div class="post-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><?php the_author(); ?></a></div>
			<?php do_action( 'ldcr_course_rating', $course_id, true, true, true ); ?>
		</div>
		<div class="post-meta">
			<?php if ( !$has_access ) : ?>
				<span class="course-meta__price">
				<?php if ( $is_wc_product ) : ?>
				<?php echo talemy_get_wc_product_price( $meta_data['related_product'] ); ?>
				<?php else: ?>
				<?php echo talemy_get_ld_course_price( $course_id, $course_options ); ?>
				<?php endif; ?>
				</span>
			<?php else : ?>
			<?php echo do_shortcode( '[learndash_course_progress course_id="'. $course_id .'"]' ); ?>
			<?php endif; ?>
		</div>
		<div class="post-popover">
			<div class="popover-body">
				<?php echo talemy_get_ld_course_categories(); ?>
				<?php echo talemy_get_loop_title(); ?>
				<?php echo talemy_get_ld_loop_course_meta( $meta, $meta_data ); ?>
				<?php if ( !empty( $meta_data['short_desc'] ) ) : ?>
					<div class="post-excerpt"><?php echo wp_kses_post( $meta_data['short_desc'] ); ?></div>
				<?php endif; ?>
				<?php if ( !$has_access ) : ?>
					<?php if ( $is_wc_product ) : ?>
					<?php echo do_shortcode( '[add_to_cart id="'. $meta_data['related_product'] .'" show_price="FALSE" style="margin-top:30px;margin-bottom:0;" class="ld-add-to-cart"]' ); ?>
					<?php else : ?>
					<div class="learndash-wrapper">
						<?php echo do_shortcode( '[learndash_payment_buttons course_id="'. $course_id .'"]' ); ?>
					</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
