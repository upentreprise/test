<?php
/**
 * Page template
 *
 * @package Talemy
 * @subpackage Templates
 */
get_header();

talemy_set_page_settings();

do_action( 'talemy_content_start' );

do_action( 'talemy_content_banner' );

if ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( talemy_get_setting( 'layout' ) ); ?>>
	
	<div class="article-content">

		<div class="container">

		<?php do_action( 'talemy_before_main_content' );

			get_template_part( 'templates/content', 'page' );

			do_action( 'talemy_after_main_content' );

			do_action( 'talemy_sidebar' );
			
		?>
		</div>
	
	</div>

</article>

<?php

endif;

do_action( 'talemy_content_end' );

get_footer();