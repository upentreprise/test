<header id="header" class="header header-style-6">
	<div class="navbar-wrapper">
		<div class="navbar fixed-height" data-sticky-style="<?php talemy_echo_option_attr( 'nav_sticky_style' ); ?>">
			<div class="container">
				<nav class="nav" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
					<?php get_template_part( 'templates/header/nav-logo' ); ?>
					<div class="nav-menu-wrapper"><?php talemy_main_menu(); ?></div>
					<div class="nav-btn-group d-flex">
						<?php get_template_part( 'templates/header/search' ); ?>
						<div class="d-flex">
							<?php talemy_nav_login(); ?>
							<?php talemy_nav_wc_cart(); ?>
						</div>
						<button type="button" class="hamburger">
							<span class="menu-icon" aria-hidden="true"><span></span><span></span><span></span></span>
						</button>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>