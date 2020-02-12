<?php if ( '' === talemy_get_setting( 'banner' ) ) : ?>
	<?php $banner_image = talemy_get_setting( 'banner_image' ); ?>
	<div class="content-banner"<?php if (!empty( $banner_image ) ) { echo ' style="background-image:url('. esc_url( $banner_image ) .');"'; } ?>>
		<div class="container">
			<h1 class="page-title"><?php
				if ( is_singular() ) {
					$labels = get_option( 'learndash_settings_custom_labels' );
					if ( is_singular( 'sfwd-courses' ) ) {
						$title = !empty( $labels['course'] ) ? $labels['course'] : esc_html__( 'Single Course', 'talemy' );
					} elseif ( is_singular( 'sfwd-lessons' ) ) {
						$title = !empty( $labels['lesson'] ) ? $labels['lesson'] : esc_html__( 'Lesson', 'talemy' );
					} elseif ( is_singular( 'sfwd-topic' ) ) {
						$title = !empty( $labels['topic'] ) ? $labels['topic'] : esc_html__( 'Topic', 'talemy' );
					}
					echo esc_html( $title );
				}
			?>
			</h1>
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
			    <?php if ( function_exists( 'bcn_display' ) ) : ?>
			    <?php bcn_display(); ?>
			   	<?php endif; ?>
			</div>
		</div>
		<div class="banner-overlay"></div>
	</div>
<?php elseif ( 'shortcode' === talemy_get_setting( 'banner' ) ) : ?>
<?php echo do_shortcode( html_entity_decode( talemy_get_setting( 'banner_shortcode' ) ) ); ?>
<?php endif; ?>