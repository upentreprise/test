<?php
/**
 * Template used for single posts and other post-types
 * that don't have a specific template.
 *
 * @package Talemy
 * @subpackage Templates
 */

get_header();

talemy_set_post_settings();

do_action( 'talemy_content_start' );

if ( have_posts() ) : the_post();

	get_template_part( 'templates/single/single', talemy_get_setting( 'post_style' ) );

endif;

do_action( 'talemy_content_end' );

get_footer(); ?>