<?php

do_action( 'talemy_before_content_loop' );

while ( have_posts() ) : the_post();

	if ( 'sfwd-courses' == get_post_type() ) {

		get_template_part( 'templates/learndash/loop/' . talemy_get_setting( 'list_style' ) );

	} else {
		
		get_template_part( 'templates/loop/' . talemy_get_setting( 'list_style' ) );
	}
	
endwhile;

do_action( 'talemy_after_content_loop' );
