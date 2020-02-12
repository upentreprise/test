<?php
$author_id = get_the_author_meta( 'ID' );
$author_title = get_the_author_meta( 'sf_user_title', $author_id );
$course_id = get_the_ID();
$user_id = get_current_user_id();
$meta_data = get_post_meta( $course_id, '_ld_custom_meta', true );
$has_access = sfwd_lms_has_access( $course_id, $user_id );
?>
<div class="course-meta">
	<div class="post-meta-author">
		<div class="author-avatar"><?php echo get_avatar( $author_id, 50 ); ?></div>
		<div class="author-info">
			<span class="author-name" itemprop="name"><a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>"><?php the_author(); ?></a></span>
			<?php if ( !empty( $author_title ) ) : ?>
				<span class="author-title" itemprop="jobTitle"><?php echo esc_html( $author_title ); ?></span>
			<?php endif; ?>
		</div>
	</div>
	<div class="course-meta__buy">
		<?php if ( !$has_access ) : ?>
			<div class="learndash-wrapper">
				<?php echo do_shortcode( '[learndash_payment_buttons course_id="'. $course_id .'"]' ); ?>
			</div>
		<?php endif; ?>
		<span class="course-meta__price_lg"><?php echo talemy_get_ld_course_price( get_the_ID() ); ?></span>
	</div>
</div>