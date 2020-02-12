<?php if ( talemy_get_option( 'nav_search' ) ) : ?>
	<div class="nav-item-wrap">
		<button type="button" class="nav-btn btn-search btn-has-dropdown">
			<i class="ticon-search-alt" aria-hidden="true"></i>
			<i class="ticon-close" aria-hidden="true"></i>
		</button>
		<form role="search" class="nav-search-form nav-dropdown" method="get" action="<?php echo esc_url( home_url('/') ); ?>">
			<input type="text" name="s" class="nav-sf-input" placeholder="<?php esc_attr_e( 'Search..', 'talemy' ); ?>">
			<button type="submit" class="nav-sf-submit"><i class="fas fa-long-arrow-alt-right"></i></button>
		</form>
	</div>
<?php endif; ?>