<div class="off-canvas off-canvas-left">
	<div class="off-canvas-wrapper">
		<?php talemy_off_canvas_left_menu(); ?>
		<?php if ( is_active_sidebar( 'side-sidebar' ) ): ?>
			<div class="off-canvas-widget-area">
				<?php dynamic_sidebar( 'side-sidebar' ); ?>
			</div>
		<?php endif; ?>
		<?php do_action( 'sf_site_social_links', 'side-social' ); ?>
		<a href="javascript:void(0)" class="off-canvas-close"><i class="ticon-close"></i></a>
	</div>
</div>