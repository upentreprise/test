<?php

if ( get_query_var( 'author_name' ) ) {
    $author = get_user_by( 'slug', get_query_var( 'author_name' ) );
    $author_id = $author->ID;
} else {
    $author_id = get_the_author_meta( 'ID' );
}
$author_email = get_the_author_meta( 'email', $author_id );
$author_url = get_the_author_meta( 'url', $author_id );
$author_title = get_the_author_meta( 'sf_user_title', $author_id );
$author_desc = get_the_author_meta( 'description', $author_id );

if ( empty( $author_desc ) ) {
	return;
}
?>
<div class="author-box">
	<a class="author-portray" itemprop="author" href="<?php echo get_author_posts_url( $author_id ); ?>">
		<?php echo get_avatar( $author_email, 120 ); ?>
	</a>
	<div class="author-description">
		<a class="author-name" itemprop="author" href="<?php echo get_author_posts_url( $author_id ); ?>"><?php echo get_the_author_meta( 'display_name', $author_id ); ?></a>
		<?php if ( !empty( $author_title ) ) : ?>
			<span class="author-title"><?php echo esc_html( $author_title ); ?></span>
		<?php endif; ?>
		<?php if ( !empty( $author_url ) ) : ?>
		<div class="author-url"><a href="<?php echo esc_url( $author_url ); ?>" target="_blank"><?php echo esc_url( $author_url ); ?></a></div>
		<?php endif; ?>
		<div class="author-bio"><?php echo esc_html( $author_desc ); ?></div>
		<?php do_action( 'sf_author_social_links', $author_id ); ?>
	</div>
</div>