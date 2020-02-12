<article id="post-<?php the_ID(); ?>" <?php post_class( talemy_get_setting( 'layout' ) . ' single-2' ); ?>>
	<?php get_template_part( 'templates/single/schema' ); ?>
	<div class="article-head">
		<div class="head-image-wrapper"<?php echo talemy_get_post_hero_style(); ?>></div>
		<div class="head-image-overlay"></div>
		<div class="post-header">
			<div class="container">
				<?php get_template_part( 'templates/breadcrumbs' ); ?>
				<?php get_template_part( 'templates/single/title' ); ?>
				<?php get_template_part( 'templates/single/meta' ); ?>
				<?php do_action( 'sf_post_share_buttons' ); ?>
			</div>
		</div>
	</div>
	<div class="article-content">
		<div class="container">
			<?php do_action( 'talemy_before_main_content' ); ?>
			<div class="post-content">
				<?php get_template_part( 'templates/content', 'media' ); ?>
				<?php get_template_part( 'templates/single/content' ); ?>
				<?php get_template_part( 'templates/single/tags' ); ?>
			</div>
			<?php
			get_template_part( 'templates/single/adjacent' );
			if ( talemy_get_setting( 'post_author_box' ) ) {
				get_template_part( 'templates/author-box' );
			}
			get_template_part( 'templates/single/related' );
			if ( talemy_get_setting( 'post_comments', true ) ) {
				comments_template();
			}
			do_action( 'talemy_after_main_content' );
			do_action( 'talemy_sidebar' );
			?>
		</div>
	</div>
</article>
