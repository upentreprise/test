<?php
/**
 * 404 template
 *
 * @package Talemy
 * @subpackage Templates
 */
get_header(); ?>
<div id="content">
	<div id="error">
		<div class="container">
			<p class="error-suptitle"><?php esc_html_e( 'ERROR', 'talemy' ); ?></p>
			<h1 class="error-title"><?php esc_html_e( '404', 'talemy' ); ?></h1>
			<p class="error-message"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'talemy' ); ?></p>
			<?php get_search_form();?>
			<nav><a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html_e( 'Homepage', 'talemy' ); ?></a></nav>
		</div>
	</div>
</div>
<?php get_footer(); ?>