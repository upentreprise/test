<?php get_template_part( 'templates/content-breadcrumbs' ); ?>
<?php if ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( talemy_get_setting( 'layout' ) ); ?>>
		<?php get_template_part( 'templates/single/schema' ); ?>
		<div class="article-content">
			<div class="container">
				<?php do_action( 'talemy_before_main_content' ); ?>
				<div class="post-header">
					<?php get_template_part( 'templates/single/title' ); ?>
					<?php get_template_part( 'templates/learndash/single/meta' ); ?>
				</div>
				<?php get_template_part( 'templates/content', 'media' ); ?>
				<div class="post-content">
					<?php get_template_part( 'templates/learndash/single/meta-box' ); ?>
					<?php the_content(); ?>
				</div>
				<?php
					get_template_part( 'templates/learndash/single/related' );
					do_action( 'talemy_after_main_content' );
					do_action( 'talemy_sidebar' );
				?>
			</div>
		</div>
	</article>
<?php endif; ?>