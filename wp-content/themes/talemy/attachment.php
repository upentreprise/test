<?php
/**
 * Attachment template
 *
 * @package Talemy
 * @subpackage Templates
 */
get_header();

do_action( 'talemy_content_start' ); ?>

<div class="content-wrapper <?php echo esc_attr( talemy_get_setting( 'layout' ) ); ?>">

	<?php do_action( 'talemy_content_header' );

		do_action( 'talemy_container_start' );

	 	if ( have_posts() ) {

			do_action( 'talemy_before_main_content' );

			get_template_part( 'templates/content', 'loop' );

			do_action( 'talemy_after_main_content' );

			do_action( 'talemy_sidebar' );
	
		} else {

			get_template_part( 'templates/content', 'none' );
		}

		do_action( 'talemy_container_end' );

	?>
</div><?php

do_action( 'talemy_content_end' );

get_footer();