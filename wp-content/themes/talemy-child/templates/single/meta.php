<?php
$meta_data = talemy_get_setting( 'post_meta_data' );

if ( empty( $meta_data ) ) {
	return;
}

$date_format = get_option( 'date_format' );
$author_id = get_the_author_meta( 'ID' );
?>
<ul class="post-meta">

<?php if ( in_array( 'author', $meta_data ) ) : ?>
	<li class="meta-author">
		<?php if ( in_array( 'avatar', $meta_data ) ) : ?>
		<a class="author-avatar" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>"><?php echo get_avatar( $author_id, 30 ); ?></a>
		<?php endif; ?>
		<a href="<?php echo esc_url( get_author_posts_url( $author_id, get_the_author_meta( 'user_nicename' ) ) ); ?>"><?php if ( !in_array( 'avatar', $meta_data ) ) : ?><i class="fas fa-user-alt"></i><?php endif; ?><?php echo get_the_author(); ?></a>
	</li>
<?php endif; ?>

<?php if ( in_array( 'date', $meta_data ) ) :
	$archive_year  = get_the_time('Y');
	$archive_month = get_the_time('m');
	$archive_day   = get_the_time('d');
?>
	<li class="meta-date">
		<a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>"><i class="far fa-calendar-alt"></i><time datetime="<?php echo date( DATE_W3C, get_the_time( 'U' ) ); ?>"><?php echo get_the_date( $date_format ); ?></time></a>
	</li>
<?php endif; ?>

<?php if ( in_array( 'cats', $meta_data ) ) : ?>
	<li class="meta-cats">
		<i class="far fa-clone"></i>
		<?php echo talemy_get_post_categories(); ?>
	</li>
<?php endif; ?>

<?php if ( in_array( 'comment', $meta_data ) ) : ?>
	<li class="meta-comment">
		<a href="<?php echo esc_url( get_permalink() .'#comments' ); ?>"><i class="far fa-comment-alt"></i><?php echo get_comments_number(); ?></a>
	</li>
<?php endif; ?>

</ul>