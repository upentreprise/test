<header id="header" class="header header-style-1">
	<?php if ( talemy_get_option( 'topbar' ) ) : ?>
	<?php get_template_part( 'templates/header/topbar' ); ?>
	<?php endif; ?>
	<div class="navbar-wrapper">
		<div class="navbar" data-sticky-style="<?php talemy_echo_option_attr( 'nav_sticky_style' ); ?>">
			<div class="container">
				<nav class="nav" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
					<?php get_template_part( 'templates/header/nav-logo' ); ?>
					<div class="nav-menu-wrapper <?php talemy_echo_option_attr( 'menu_alignment', 'center' ); ?>"><?php talemy_main_menu(); ?></div>
					<div class="nav-btns">
						<?php talemy_nav_wc_cart(); ?>
						<?php talemy_nav_wc_wishlist(); ?>
						<?php get_template_part( 'templates/header/search' ); ?>
						<?php talemy_nav_login(); ?>
						<?php get_template_part( 'templates/header/messages' ); ?>
						<?php get_template_part( 'templates/header/notifications' ); ?>
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