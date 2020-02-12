<?php $theme_config = apply_filters( 'sf_config_theme', array() ); ?>
<div id="sf-welcome">
	<br>
	<div class="sf-two-columns sf-sm-gutters">
		<div class="sf-column">
			<div class="sf-card-alt">
				<h3><?php esc_html_e( 'Theme Support', 'spirit' ); ?></h3>
				<div class="sf-card-inner">
					<?php if ( !empty( $theme_config['doc_url'] ) ) : ?>
						<div class="sf-card-item">
							<h3><span class="dashicons dashicons-book"></span><?php esc_html_e( 'Documentation', 'spirit' ); ?></h3>
							<p><?php esc_html_e( 'Want step by step how to guides? Our online documentation is the great place to start learning all the in and outs of the theme.', 'spirit' ); ?></p>
							<a class="button button-primary" href="<?php echo esc_url( $theme_config['doc_url'] ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'spirit' ); ?></a>
						</div>
					<?php endif; ?>
					<?php if ( !empty( $theme_config['video_url'] ) ) : ?>
						<div class="sf-card-item">
							<h3><span class="dashicons dashicons-format-video"></span><?php esc_html_e( 'Video Tutorials', 'spirit' ); ?></h3>
							<p><?php esc_html_e( 'Nothing is better than watching a video to learn. We have a growing number of high-definititon video tutorials to help you know the different aspects of the theme.', 'spirit' ); ?></p>
							<a class="button button-primary" href="<?php echo esc_url( $theme_config['video_url'] ); ?>" target="_blank"><?php esc_html_e( 'Watch Videos', 'spirit' ); ?></a>
						</div>
					<?php endif; ?>
					<div class="sf-card-item">
						<h3><span class="dashicons dashicons-sos"></span><?php esc_html_e( 'Submit A Ticket', 'spirit' ); ?></h3>
						<p><?php esc_html_e( 'We offer outstanding support through our support center. To get submit a ticket first you need to register an account and verify your purchase.', 'spirit' ); ?></p>
						<a class="button button-primary" href="https://themespirit.com/support" target="_blank"><?php esc_html_e( 'Support Center', 'spirit' ); ?></a>
					</div>
				</div>
			</div>
		</div>
		<div class="sf-column">
			<div class="sf-card-alt">
				<h3><?php esc_html_e( 'Appearance', 'spirit' ); ?></h3>
				<div class="sf-card-inner">
					<div class="sf-icon-box-wrapper">
						<a class="sf-icon-box" href="<?php echo wp_customize_url(); ?>">
							<span class="dashicons dashicons-admin-customizer"></span>
							<h4 class="sf-icon-box-title"><?php esc_html_e( 'Customize', 'spirit' ); ?></h4>
						</a>
						<a class="sf-icon-box" href="<?php echo admin_url( 'nav-menus.php' ); ?>">
							<span class="dashicons dashicons-menu"></span>
							<h4 class="sf-icon-box-title"><?php esc_html_e( 'Menus', 'spirit' ); ?></h4>
						</a>
						<a class="sf-icon-box" href="<?php echo admin_url( 'nav-menus.php' ); ?>">
							<span class="dashicons dashicons-admin-tools"></span>
							<h4 class="sf-icon-box-title"><?php esc_html_e( 'Widgets', 'spirit' ); ?></h4>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>