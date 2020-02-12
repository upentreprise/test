<?php
$post_url = get_the_permalink();
$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
$query_title = preg_replace( '/\s/', '%20', get_the_title() );
$twitter_via = get_theme_mod( 'social_twitter_at', get_bloginfo( 'name' ) );
?>
<div class="post-share">
	<div class="social-list">
		<a class="f-share" href="<?php echo esc_url( 'http://www.facebook.com/sharer.php?u='. rawurlencode( $post_url ) ); ?>" title="<?php esc_html_e( 'Share on Facebook', 'spirit' ); ?>"><i class="fab fa-facebook-f"></i><span><?php esc_html_e( 'Share', 'spirit' ); ?></span></a>
		<a class="t-tweet" href="<?php echo esc_url( 'http://twitter.com/intent/tweet?url=' . rawurlencode( $post_url ) . '&amp;text=' . $query_title . '&amp;via=' . $twitter_via ); ?>" title="Tweet it"><i class="fab fa-twitter"></i><span><?php esc_html_e( 'Tweet', 'spirit' ); ?></span></a>
		<a class="p-pin" href="<?php echo esc_url( 'http://pinterest.com/pin/create/button/?url='. rawurlencode( $post_url ) .'&amp;media=' . $image[0] . '&amp;description=' . $query_title ); ?>" title="Pin it on Pinterest"><i class="fab fa-pinterest"></i><span><?php esc_html_e( 'Pin it', 'spirit' ); ?></span></a>
		<div class="share-links">
			<a href="<?php echo esc_url( 'https://plus.google.com/share?url='. rawurlencode( $post_url ) ); ?>" title="Share on Google Plus"><i class="fab fa-google-plus-g"></i></a>
			<a href="<?php echo esc_url( 'http://www.linkedin.com/shareArticle?mini=true&amp;url=' . rawurlencode( $post_url ) . '&amp;title=' . $query_title ); ?>" title="Share on LinkedIn"><i class="fab fa-linkedin-in"></i></a>
			<a href="<?php echo esc_url( 'mailto:?subject=' . $query_title . '&amp;body=' . rawurlencode( $post_url ) ); ?>" title="Share via email"><i class="far fa-envelope"></i></a>
		</div>
		<button class="btn-expand"><i class="fas fa-plus"></i><i class="fas fa-minus"></i></button>
	</div>
</div>
