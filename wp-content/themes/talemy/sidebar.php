<?php $sidebar_class = talemy_get_option( 'sticky_sidebar' ) ? ' sticky' : ''; ?>
<?php $sidebar_class = talemy_get_option( 'hide_sidebar_on_xs' ) ? $sidebar_class . ' hidden-xs' : $sidebar_class; ?>
<aside class="sidebar<?php echo esc_attr( $sidebar_class ); ?>">
	<div class="sidebar-wrapper"><?php
		$sidebar_id = talemy_get_setting( 'sidebar', 'default-sidebar' );
		if ( is_active_sidebar( $sidebar_id ) ) {
			dynamic_sidebar( $sidebar_id );
		}
	?></div>
</aside>