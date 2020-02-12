<?php if ( talemy_get_option( 'nav_hamburger' ) ) : ?>
<div class="off-canvas off-canvas-right">
	<div class="off-canvas-wrapper">
		<?php talemy_off_canvas_right_menu(); ?>
		<?php if ( is_active_sidebar( 'off-canvas-right' ) ) : ?>
			<div class="off-canvas-widget-area">
				<?php dynamic_sidebar( 'off-canvas-right' ); ?>
			</div>
		<?php endif; ?>
		<a href="javascript:void(0)" class="off-canvas-close"><i class="ticon-close"></i></a>
	</div>
</div>
<?php endif; ?>
