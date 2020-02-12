<?php global $post;
if ( have_posts() ) : the_post();
$author_id = get_the_author_meta( 'ID' );
$duration = talemy_get_ld_course_meta( 'duration' );
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
				<div class="row align-items-end">
					<div class="col-lg-4 order-lg-2">
						<?php get_template_part( 'templates/learndash/single/preview' ); ?>
					</div>
					<div class="col-lg-8 order-lg-1">
                        <div class="course-intro-content">
                            <h1 class="post-title"><?php the_title(); ?></h1>
                            <div class="course-meta">
                                <div class="course-meta__row">
                                    <?php if ( isset( $duration ) ) : ?>
                                        <div class="course-meta__item">
                                            <span class="meta__duration"><i class="far fa-clock"></i><?php esc_html( $duration ); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( lesson_hasassignments( $post ) ) : ?>
                                        <div class="course-meta__item">
                                            <span class="meta__assignment"><i class="fas fa-check"></i><?php esc_html_e( 'Assignments', 'talemy' ); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="course-meta__row">
                                    <div class="course-meta__item">
                                        <span class="course-meta__author"><i class="fas fa-user"></i><?php printf( __( 'Created by %s', 'talemy' ), '<a href="'. esc_url( get_author_posts_url( $author_id ) ) .'"><span itemprop="name">'. get_the_author() .'</span></a>' ); ?></span>
                                    </div>
                                    <div class="course-meta__item">
                                        <span class="meta__updated"><i class="far fa-calendar"></i><?php printf( __( 'Last updated %s', 'talemy' ), get_the_modified_date() ); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
		<div class="course-content">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<div class="post-content"><?php the_content(); ?></div>
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