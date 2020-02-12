<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="sf-input" name="s" value="<?php echo get_search_query() ?>" placeholder="<?php echo esc_attr_x( 'chercher..', 'text input', 'talemy' ); ?>">
	<button type="submit" class="sf-submit" aria-label="<?php esc_attr_x( 'search', 'submit button', 'talemy' ); ?>"><i class="fas fa-search"></i></button>
</form>