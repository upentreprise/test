<?php
/**
 * Template Name: Page Builder
 *
 * @package Talemy
 * @subpackage Templates
 */
get_header();

talemy_set_page_settings();

do_action( 'talemy_content_start' );

do_action( 'talemy_content_banner' );

if ( have_posts() ) : the_post();

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( talemy_get_setting( 'layout' ) ); ?>>
	
	<?php do_action( 'talemy_container_start' ); ?>
	
	<?php the_content(); ?>
	
	<?php do_action( 'talemy_container_end' ); ?>

</article>
<?php

endif;

do_action( 'talemy_content_end' );

get_footer();