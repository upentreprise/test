<?php

/**
 * Search 
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form role="search" method="get" id="bbp-search-form" class="search-form widget_search" action="<?php bbp_search_url(); ?>">
	<div>
		<label class="screen-reader-text hidden" for="bbp_search"><?php _e( 'Search for:', 'talemy' ); ?></label>
		<input type="hidden" name="action" value="bbp-search-request" />
		<input tabindex="<?php bbp_tab_index(); ?>" type="text" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" name="bbp_search" id="bbp_search" class="sf-input" />
        <button tabindex="<?php bbp_tab_index(); ?>" type="submit" id="bbp_search_submit" class="sf-submit" aria-label="<?php esc_attr_x( 'Search', 'submit button', 'talemy' ); ?>"><i class="fas fa-search"></i></button>
    </div>
</form>
