<?php
$embed_code = talemy_get_setting( 'post_embed_code' );
$embed_code = !empty( $embed_code ) ? $embed_code : '';
if ( !empty( $embed_code ) ) {
	// Retrive oembed HTML if URL provided
	if ( preg_match( '/http(s?)\:\/\//i', $embed_code ) ) { ?>
		<div class="post-media media-embed"><?php echo wp_oembed_get( $embed_code, array( 'height' => 600, 'width' => 400 ) ); ?></div>
	<?php
	}
} else {
	if ( has_post_thumbnail() && !talemy_get_post_meta( '_sf_disable_featured' ) && '' == get_post_format() && '2' != talemy_get_setting( 'post_style' ) ) {
		$enable_lightbox = talemy_get_option( 'enable_lightbox' );
		?>
		<figure class="post-media featured-image">
			<?php if ( $enable_lightbox ) : ?>
				<a data-fancybox="gallery-<?php the_ID(); ?>" href="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>">
			<?php endif; ?>
			<?php the_post_thumbnail( talemy_get_setting( 'post_thumb_size' ) ); ?>
			<?php if ( $enable_lightbox ) : ?>
				</a>
			<?php endif; ?>
		</figure>
		<?php
	}
}
