<header id="header" class="header-style-8">
	<div class="navbar-wrapper">
		<div class="navbar" data-sticky-style="<?php talemy_echo_option_attr( 'nav_sticky_style' ); ?>">
			<div class="container-fluid">
				<nav class="nav" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
					<?php get_template_part( 'templates/header/nav-logo' ); ?>
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