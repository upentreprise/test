<header id="header" class="header header-style-4">
	<?php if ( talemy_get_option( 'topbar' ) ) : ?>
	<?php get_template_part( 'templates/header/topbar' ); ?>
	<?php endif; ?>
	<div class="header-wrapper">
		<div class="container">
			<?php get_template_part( 'templates/header/logo' ); ?>
			<?php if ( !empty( ( $header_ads_code = talemy_get_option( 'header_ads_code' ) ) ) ) : ?>
				<div class="header-ads">
					<?php echo wp_kses( $header_ads_code, talemy_get_allowed_html_for_ads() ); ?>
				</div>
			<?php else : ?>
				<ul class="contact-info">
				<?php $info_address = talemy_get_option( 'header_info_address' ); ?>
				<?php $info_email = talemy_get_option( 'header_info_email' ); ?>
				<?php $info_phone = talemy_get_option( 'header_info_phone' ); ?>
				<?php if ( !empty( $info_address ) ) : ?>
					<li>
						<i class="fas fa-map-marker-alt" aria-hidden="true"></i>
						<p class="info"><?php echo wp_kses_post( $info_address ); ?></p>
					</li>
				<?php endif; ?>
				<?php if ( !empty( $info_email ) ) : ?>
					<li>
						<i class="fas fa-envelope" aria-hidden="true"></i>
						<p class="info"><?php echo wp_kses_post( $info_email ); ?></p>
					</li>
				<?php endif; ?>
				<?php if ( !empty( $info_phone ) ) : ?>
					<li>
						<i class="fas fa-phone" aria-hidden="true"></i>
						<p class="info"><?php echo wp_kses_post( $info_phone ); ?></p>
					</li>
				<?php endif; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
	<div class="navbar-wrapper">
		<div class="navbar" data-sticky-style="<?php talemy_echo_option_attr( 'nav_sticky_style' ); ?>">
			<div class="container">
				<nav class="nav" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
					<?php get_template_part( 'templates/header/nav-logo' ); ?>
					<?php talemy_main_menu(); ?>
					<div class="nav-btns">
						<?php talemy_nav_wc_cart(); ?>
						<?php talemy_nav_wc_wishlist(); ?>
						<?php get_template_part( 'templates/header/search' ); ?>
						<?php talemy_nav_login(); ?>
						<?php get_template_part( 'templates/header/messages' ); ?>
						<?php get_template_part( 'templates/header/notifications' ); ?>
						<?php if ( talemy_get_option( 'nav_hamburger' ) ) : ?>
							<button type="button" class="hamburger-2">
								<span class="menu-icon" aria-hidden="true"><span></span><span></span><span></span></span>
							</button>
						<?php endif; ?>
						<?php talemy_nav_cta_button(); ?>
						<button type="button" class="hamburger">
							<span class="menu-icon" aria-hidden="true"><span></span><span></span><span></span></span>
						</button>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>