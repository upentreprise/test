<?php
/**
 * Template used for single quiz post type
 *
 * @package Talemy
 * @subpackage Templates
 */

get_header();

talemy_set_ld_single_settings();

do_action( 'talemy_content_start' );

get_template_part( 'templates/content-breadcrumbs' );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( talemy_get_setting( 'layout' ) ); ?>>

	<?php get_template_part( 'templates/single/schema' ); ?>

	<div class="article-content">
		
		<div class="container">

		<?php if ( have_posts() ) : the_post(); ?>

			<?php do_action( 'talemy_before_main_content' ); ?>

			<div class="post-header"><?php get_template_part( 'templates/single/title' ); ?></div>
			
			<?php get_template_part( 'templates/content', 'media' ); ?>
			
			<div class="post-content"><?php the_content(); ?></div>

			<?php do_action( 'talemy_after_main_content' ); ?>
			
			<?php do_action( 'talemy_sidebar' ); ?>

		<?php endif; ?>

		</div>
	</div>
</article>

<?php do_action( 'talemy_content_end' ); ?>

<?php get_footer(); ?>
