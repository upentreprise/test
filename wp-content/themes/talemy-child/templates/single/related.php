<?php
if ( !talemy_get_setting( 'post_related', true ) ) {
	return;
}

$post_id = get_the_ID();
$post_count = talemy_get_setting( 'post_related_count', 3 );
$related_type = talemy_get_setting( 'post_related_type', '' );
$query_args['post_type'] = 'post';
$query_args['post__not_in'] = array( $post_id );
$query_args['ignore_sticky_posts'] = 1;
$qyery_args['not_found_rows'] = 1;
$query_args['posts_per_page'] = $post_count;

switch( $related_type ) {

	case 'cat': 
		$cats = wp_get_post_categories( $post_id, array( 'fields' => 'ids' ) );
		if ( !empty( $cats ) ) {
			$query_args['category__in'] = $cats;
		}
		break;

	case 'tag':
		$tags = wp_get_post_tags( $post_id, array( 'fields' => 'ids' ) );
		if ( !empty( $tags ) ) {
			$query_args['tag__in'] = $tags;
		}
		break;

	case 'author':
		$query_args['author__in'] = get_the_author_meta( 'ID' );
		break;

	case 'cat_or_tag':
		$cats = wp_get_post_categories( $post_id );
		$tags = wp_get_post_tags( $post_id, array( 'fields' => 'ids' ) );
		$query_args['tax_query'] = array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'category',
				'field'    => 'id',
				'terms'    => $cats,
			),
			array(
				'taxonomy' => 'post_tag',
				'field'    => 'id',
				'terms'    => $tags,
			)
		);
		break;
}
$query = new WP_Query( $query_args );

if ( $query->have_posts() ) : ?>
	<div class="post-related">
		<h4 class="section-heading">
			<span class="title"><?php esc_html_e( 'Related Posts', 'talemy' ); ?></span>
		</h4>
		<div class="post-list row columns-3 mobile-columns-1">
		<?php while ( $query->have_posts() ): $query->the_post(); ?>
			<div <?php post_class( 'col-md-4 post-style-grid loop-post' ); ?>>
				<div class="post-body equal-height">
					<?php echo talemy_get_loop_thumb( 'talemy_thumb_small' ); ?>
					<div class="post-info">
						<?php echo talemy_get_loop_category(); ?>
						<?php echo talemy_get_loop_title(); ?>
					</div>
					<?php echo talemy_get_loop_meta( array( 'date' ) ); ?>
				</div>
			</div>
		<?php endwhile; ?>
		</div>
	</div>
<?php
endif;
wp_reset_postdata();