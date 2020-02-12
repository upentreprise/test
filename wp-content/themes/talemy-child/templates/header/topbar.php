<div class="topbar">
	<div class="container">
		<div class="row">
			<div class="topbar-left col-md-auto">
			<?php if ( is_active_sidebar( 'topbar-left' ) ) : ?>
			<?php dynamic_sidebar( 'topbar-left' ); ?>
			<?php endif; ?>
			</div>
			<div class="topbar-right col-md">
			<?php if ( is_active_sidebar( 'topbar-right' ) ) : ?>
			<?php dynamic_sidebar( 'topbar-right' ); ?>
			<?php endif; ?>
			</div>
			<?php if ( talemy_get_option( 'topbar_cta_btn' ) ) : ?>
			<div class="topbar-btn-wrapper"><?php talemy_topbar_cta_button(); ?></div>
			<?php endif; ?>
		</div>
	</div>
</div>