<?php
$author_id = get_the_author_meta( 'ID' );
$course_id = get_the_ID();
$meta_data = get_post_meta( $course_id, '_ld_custom_meta', true );
$has_access = sfwd_lms_has_access( $course_id, get_current_user_id() );
$enrolled_base = !empty( $meta_data['enrolled'] ) ? $meta_data['enrolled'] : 0;
$enrolled = talemy_get_ld_course_student_count( $course_id, $enrolled_base );
$course_category_html = talemy_get_ld_course_categories();
if ( function_exists( 'ldcr_get_course_rating' ) ) {
	$course_rating_html = ldcr_get_course_rating( $course_id, true, true, true );
}
?>
<div class="course-intro-content">
	<h1 class="post-title"><?php the_title(); ?></h1>
	<?php if ( !empty( $meta_data['headline'] ) ) : ?>
		<p class="course-headline" itemprop="headline"><?php echo wp_kses_post( $meta_data['headline'] ); ?></p>
	<?php endif; ?>
	<div class="course-meta">
		<div class="course-meta__row">
			<?php if ( !empty( $course_rating_html ) ) : ?>
				<div class="course-meta__item">
					<a href="#"><?php do_action( 'ldcr_course_rating', $course_id, true, true, true ); ?></a>
				</div>
			<?php endif; ?>
			<div class="course-meta__item">
				<span class="meta__enrolled"><i class="fas fa-user-friends"></i><?php printf( _n( '%s student enrolled', '%s students enrolled', $enrolled, 'talemy' ), $enrolled ) ?></span>
			</div>
		</div>
		<div class="course-meta__row">
			<div class="course-meta__item">
				<span class="course-meta__author"><i class="fas fa-user"></i><?php printf( __( 'Conçu par %s', 'talemy' ), '<a href="'. esc_url( get_author_posts_url( $author_id ) ) .'"><span itemprop="name">'. get_the_author() .'</span></a>' ); ?></span>
			</div>
			<div class="course-meta__item">
				<span class="meta__updated"><i class="far fa-calendar"></i><?php printf( __( 'Last updated %s', 'talemy' ), get_the_modified_date() ); ?></span>
			</div>
		</div>
		<div class="course-meta__row">
			<?php if ( !empty( $meta_data['language'] ) ) : ?>
				<div class="course-meta__item">
					<span class="course-meta__language"><i class="fas fa-globe"></i><?php echo esc_html( $meta_data['language'] ); ?></span>
				</div>
			<?php endif; ?>
			<?php if ( !empty( $meta_data['level'] ) ) : ?>
				<div class="course-meta__item">
					<span class="course-meta__level"><i class="fas fa-signal"></i><?php echo esc_html( $meta_data['level'] ); ?></span>
				</div>
			<?php endif; ?>
			<?php if ( !empty( $course_category_html ) ) : ?>
				<div class="course-meta__item">
					<span class="course-meta__categories"><i class="fas fa-tag"></i><?php echo wp_kses_post( $course_category_html ); ?></span>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>