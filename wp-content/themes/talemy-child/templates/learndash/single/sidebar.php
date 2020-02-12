<?php
$current_user_id	= get_current_user_id();
$course_id			= get_the_ID();
$meta_data			= get_post_meta( $course_id, '_ld_custom_meta', true );
$has_access			= sfwd_lms_has_access( $course_id, $current_user_id );
$course_status		= learndash_course_status( $course_id, $current_user_id );
$price_type			= learndash_get_course_meta_setting( $course_id, 'course_price_type' );
$is_wc_product		= defined( 'WC_PLUGIN_FILE' ) && defined( 'LEARNDASH_WOOCOMMERCE_FILE' ) && !empty( $meta_data['related_product'] );
$sidebar_id			= talemy_get_setting( 'sidebar', 'default-sidebar' );
$course_progress 	= learndash_course_progress( array( 'user_id' => $current_user_id, 'course_id' => $course_id, 'array' => true ) );
$ajax_login_class	= defined( 'SF_FRAMEWORK_VERSION' ) && SF()->get_setting( 'enable_login_registration' ) ? ' sf-ajax-login' : '';
?>
<aside class="sidebar sticky">
	<div class="sidebar-wrapper">
		<div class="course-sidebar">
			<div class="course-sidebar__inner">
				<?php if ( !$has_access ) : ?>
					<div class="course-sidebar__price">
						<?php if ( $is_wc_product ) : ?>
						<?php echo talemy_get_wc_product_price( $meta_data['related_product'] ); ?>
						<?php else: ?>
						<div class="display-flex flex-row flex-start">
							<?php echo talemy_get_ld_course_price( $course_id ); ?>
						</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if ( is_user_logged_in() ) : ?>
					<?php if ( $has_access ) : ?>
						<?php if ( $course_progress['percentage'] > 0 ) : ?>
							<div class="course-sidebar__status">
								<div class="learndash-wrapper">
									<?php learndash_status_bubble( $course_status ); ?>
								</div>
							</div>
						<?php endif; ?>
					<?php else : ?>
						<div class="course-sidebar__status">
							<div class="learndash-wrapper">
								<div class="ld-status ld-status-incomplete ld-third-background"><?php esc_html_e( 'Not Enrolled', 'talemy' ); ?></div>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>
				<div class="course-sidebar__buttons">
					<?php if ( !$has_access && $is_wc_product ) : ?>
						<?php echo do_shortcode( '[add_to_cart id="'. $meta_data['related_product'] .'" show_price="FALSE" style="margin-bottom:10px;margin-top:0;" class="ld-add-to-cart"]' ); ?>
						<?php echo talemy_get_ld_wc_payment_button( $course_id, $meta_data['related_product'] ); ?>
					<?php endif; ?>
					<?php
					if ( !$has_access ) :
						if ( !is_user_logged_in() ) :
							if ( 'free' == $price_type || 'open' == $price_type ) :
								if ( defined( 'LEARNDASH_VERSION' ) ) {
									$login_model = LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Theme_LD30', 'login_mode_enabled' );
									$login_url = apply_filters( 'learndash_login_url', ( $login_model === 'yes' ? '#login' : wp_login_url( get_permalink() ) ) );
								} else {
									$login_url = apply_filters( 'talemy_login_url', wp_login_url( get_permalink() ) );
								}
					?>
								<a href="<?php echo esc_url( $login_url ); ?>" class="btn btn-lg btn-block btn-primary<?php echo esc_attr( $ajax_login_class ); ?>"><?php esc_html_e( 'Login to Enroll', 'talemy' ); ?></a>
							<?php endif; ?>
						<?php endif; ?>
						<?php if ( 'free' != $price_type && 'open' != $price_type && !$is_wc_product || ( 'free' == $price_type && is_user_logged_in() ) ) : ?>
							<div class="learndash-wrapper">
								<?php echo do_shortcode( '[learndash_payment_buttons course_id="'. $course_id .'"]' ); ?>
							</div>
						<?php endif; ?>
					<?php else: ?>
						<?php if ( $course_progress['percentage'] == 0 ) : ?>
							<a href="<?php echo talemy_get_ld_course_resume_link( $course_id ); ?>" class="btn btn-block btn-primary"><?php printf( esc_html__( 'Start %s', 'talemy' ), LearnDash_Custom_Label::get_label( 'course' ) ); ?></a>
						<?php elseif ( $course_progress['percentage'] < 100 ) : ?>
							<a href="<?php echo talemy_get_ld_course_resume_link( $course_id ); ?>" class="btn btn-block btn-primary"><?php esc_html_e( 'Continue', 'talemy' ); ?></a>
						<?php endif; ?>
					<?php endif; ?>
				</div>
				<div class="course-sidebar__share">
					<button class="btn btn-light btn-block" id="course-sidebar__share-btn">
						<span class="btn-text-wrapper">
							<span class="btn-icon btn-align-icon-right"><i class="fas fa-share"></i></span>
							<span class="btn-text"><?php esc_html_e( 'Share', 'talemy' ); ?></span>
						</span>
					</button>
					<?php do_action( 'sf_post_share_buttons' ); ?>
				</div>
			</div>
		</div>
		<?php if ( is_active_sidebar( $sidebar_id ) ) : ?>
		<?php dynamic_sidebar( $sidebar_id ); ?>
		<?php endif; ?>
	</div>
</aside>