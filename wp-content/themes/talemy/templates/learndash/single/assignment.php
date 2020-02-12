<?php global $post;
if ( have_posts() ) : the_post();
?>
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
                <div class="course-intro-content">
                    <h1 class="post-title"><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
		<div class="course-content">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<div class="post-content"><?php the_content(); ?></div>
						<?php comments_template(); ?>
					</div>
					<div class="col-lg-4">
                        <aside class="sidebar sticky">
                            <div class="sidebar-wrapper">
                                <?php $sidebar_id = talemy_get_setting( 'sidebar', 'default-sidebar' ); ?>
                                <?php if ( is_active_sidebar( $sidebar_id ) ) : ?>
                                <?php dynamic_sidebar( $sidebar_id ); ?>
                                <?php endif; ?>
                            </div>
                        </aside>
					</div>
				</div>
			</div>
		</div>
	</article>
<?php endif; ?>