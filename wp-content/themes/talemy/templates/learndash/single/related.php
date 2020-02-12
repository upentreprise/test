<?php
if ( !talemy_get_option( 'ld_course_related' ) ) {
	return;
}

$course_id = get_the_ID();
$post_count = talemy_get_option( 'ld_course_related_count' );
$related_type = talemy_get_option( 'ld_course_related_type' );
$query_args = array(
	'post_type' => 'sfwd-courses',
	'post_status' => 'publish',
	'posts_per_page' => $post_count,
	'post__not_in' => array( $course_id ),
	'ignore_sticky_posts' => 1,
	'not_found_rows' => 1,
);

switch( $related_type ) {

	case 'cat': 
		$cats = wp_get_post_terms( $course_id, 'ld_course_category', array( 'fields' => 'ids' ) );
		if ( !empty( $cats ) ) {
			$query_args['tax_query'] = array(
				'relation' => 'OR',
				array(
					'taxonomy' => 'ld_course_category',
					'field' => 'id',
					'terms' => $cats,
				)
			);
		}
		break;

	case 'tag':
		$tags = wp_get_post_terms( $course_id, 'ld_course_tag', array( 'fields' => 'ids' ) );
		if ( !empty( $tags ) ) {
			$query_args['tax_query'] = array(
				'relation' => 'OR',
				array(
					'taxonomy' => 'ld_course_tag',
					'field' => 'id',
					'terms' => $tags,
				)
			);
		}
		break;

	case 'author':
		$query_args['author__in'] = get_the_author_meta( 'ID' );
		break;

	case 'cat_or_tag':
		$cats = wp_get_post_terms( $course_id, 'ld_course_category', array( 'fields' => 'ids' ) );
		$tags = wp_get_post_terms( $course_id, 'ld_course_tag', array( 'fields' => 'ids' ) );
		$query_args['tax_query'] = array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'ld_course_category',
				'field'    => 'id',
				'terms'    => $cats,
			),
			array(
				'taxonomy' => 'ld_course_tag',
				'field'    => 'id',
				'terms'    => $tags,
			)
		);
		break;
}

$query = new WP_Query( $query_args );

if ( $query->have_posts() ) : ?>
	<div class="post-related ld-related-courses">
		<h3 class="section-heading sh-2">
			<span class="title"><?php esc_html_e( 'You may also like', 'talemy' ); ?></span>
		</h3>
		<div class="post-list row columns-3 tablet-columns-3 mobile-columns-1">
		<?php talemy_set_setting( 'post_class', 'loop-post post-style-grid' ); ?>
		<?php talemy_set_setting( 'grid_meta_data', array( 'level', 'duration', 'language' ) ); ?>
		<?php while ( $query->have_posts() ): $query->the_post(); ?>
		<?php get_template_part( 'templates/learndash/loop/'. talemy_get_option( 'ld_courses_list_style' ) ); ?>
		<?php endwhile; ?>
		</div>
	</div>
<?php
endif;
wp_reset_postdata();