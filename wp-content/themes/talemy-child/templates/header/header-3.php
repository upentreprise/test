<header id="header" class="header header-style-3">
	<?php if ( $show_topbar = talemy_get_option( 'topbar' ) ) : ?>
	<?php get_template_part( 'templates/header/topbar' ); ?>
	<?php endif; ?>
	<div class="header-wrapper">
		<div class="container">
			<?php get_template_part( 'templates/header/logo' ); ?>
			<?php get_template_part( 'templates/header/course-search-form' ); ?>
			<div class="nav-btns">
				<?php talemy_nav_wc_cart(); ?>
				<?php talemy_nav_wc_wishlist(); ?>
				<?php get_template_part( 'templates/header/search' ); ?>
				<?php talemy_nav_login(); ?>
				<?php get_template_part( 'templates/header/messages' ); ?>
				<?php get_template_part( 'templates/header/notifications' ); ?>
			</div>
		</div>
	</div>
	<div class="navbar-wrapper">
		<div class="navbar" data-sticky-style="<?php talemy_echo_option_attr( 'nav_sticky_style' ); ?>">
			<div class="container">
				<nav class="nav" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
					<?php get_template_part( 'templates/header/nav-logo' ); ?>
					<?php talemy_main_menu(); ?>
					<?php talemy_nav_course_category_list(); ?>
					<button type="button" class="hamburger">
						<span class="menu-icon" aria-hidden="true"><span></span><span></span><span></span></span>
					</button>
				</nav>
			</div>
		</div>
	</div>
</header>