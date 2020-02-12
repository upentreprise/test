<?php
/**
 * BuddyPress template
 *
 * @package Talemy
 * @subpackage Templates
 */
get_header();

talemy_set_template_settings( 'bp' );

do_action( 'talemy_content_start' );

do_action( 'talemy_content_banner' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( talemy_get_setting( 'layout' ) ); ?>>
	<div class="article-content">
		<div class="container">

			<?php do_action( 'talemy_before_main_content' ); ?>

			<?php if ( have_posts() ) : the_post(); ?>

			<div class="main">

				<?php if ( '' !== talemy_get_setting( 'banner' ) && !bp_is_group_single() ) : ?>

					<div class="post-header">
						<h1 class="post-title"><?php the_title(); ?></h1>
					</div>

				<?php endif; ?>

				<div class="post-content">
					<div class="content"><?php the_content(); ?></div>
				</div>

			</div>

			<?php endif; ?>

			<?php do_action( 'talemy_after_main_content' ); ?>

			<?php do_action( 'talemy_sidebar' ); ?>
		
		</div>
	</div>
</article>

<?php do_action( 'talemy_content_end' ); ?>

<?php get_footer(); ?>