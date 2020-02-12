<?php $embed_code = talemy_get_setting( 'post_embed_code' ); ?>
<?php $has_video = !empty( $embed_code ) && preg_match( '/http(s?)\:\/\//i', $embed_code ) ? true : false; ?>
<?php if ( $has_video ) : ?>
	<div class="course-intro__preview">
		<a data-fancybox data-width="1280" data-height="720" href="<?php echo esc_url( $embed_code ); ?>">
			<span class="video-play-button"><i class="icon-triangle"></i></span>
			<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'talemy_thumb_small' ); ?>
			<?php else: ?>
				<img src="<?php echo esc_url( TALEMY_THEME_URI . 'assets/images/thumbs/talemy_thumb_small.png' ); ?>" alt="thumbnail">
			<?php endif; ?>
		</a>
	</div>
<?php elseif ( has_post_thumbnail( ) ) : ?>
	<div class="course-intro__preview">
		<?php the_post_thumbnail( 'talemy_thumb_small' ); ?>
	</div>
<?php endif; ?>