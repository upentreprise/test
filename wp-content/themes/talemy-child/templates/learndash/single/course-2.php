<?php if ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( talemy_get_setting( 'layout' ) ); ?>>
		<?php get_template_part( 'templates/single/schema' ); ?>
		<div class="course-intro">
			<?php if ( function_exists( 'bcn_display' ) ) : ?>
				<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
					<div class="container">
						<?php bcn_display(); ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="container">
				<div class="row align-items-end">
					<div class="col-md-4 order-md-2">
						<?php get_template_part( 'templates/learndash/single/preview' ); ?>
					</div>
					<div class="col-md-8 order-md-1">
						<?php get_template_part( 'templates/learndash/single/intro' ); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="course-content course-sections--style-<?php echo esc_attr( talemy_get_option( 'ld_course_sections_layout' ) ); ?>">
			<div class="container">
				<div class="row">
					<div class="col-md-8 order-md-1">
						<div class="post-content"><?php the_content(); ?></div>
						<?php get_template_part( 'templates/learndash/single/related' ); ?>
					</div>
					<div class="col-md-4 order-md-2">
						<?php get_template_part( 'templates/learndash/single/sidebar' ); ?>
					</div>
				</div>
			</div>
		</div>
	</article>
<?php endif; ?>