<?php
/**
 * Course archive template
 *
 * @package Talemy
 * @subpackage Templates
 */
get_header();

talemy_set_template_settings( 'ld_courses' );

do_action( 'talemy_content_start' );

do_action( 'talemy_content_banner' ); ?>

<div class="content-wrapper <?php echo esc_attr( talemy_get_setting( 'layout' ) ); ?>">

	<?php do_action( 'talemy_container_start' );

		do_action( 'talemy_before_main_content' );

	 	if ( have_posts() ) {

			get_template_part( 'templates/content', 'loop' );
	
		} else {

			get_template_part( 'templates/content', 'none' );
		}

		do_action( 'talemy_after_main_content' );

		do_action( 'talemy_sidebar' );

		do_action( 'talemy_container_end' );

	?>
</div><?php

do_action( 'talemy_content_end' );

get_footer();