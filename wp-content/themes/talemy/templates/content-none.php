<?php if ( is_search() ): ?>
	
	<div class="post-content">
		<h3><?php esc_html_e( 'Try adjusting your search. Here are some ideas:', 'talemy' ); ?></h3>
		<ul class="search-tips">
			<li><?php esc_html_e( 'Make sure all words are spelled correctly', 'talemy' ); ?></li>
			<li><?php esc_html_e( 'Try other keywords', 'talemy'); ?></li>
			<li><?php esc_html_e( 'Try more general keywords', 'talemy'); ?></li>
		</ul>
	</div>

<?php else: ?>

	<article class="no-posts">
		<div class="post-content">
			<h2><?php esc_html_e( 'No posts to display.', 'talemy' ); ?></h2>
			<?php if ( current_user_can( 'publish_posts' ) ) : ?>
				<a class="btn btn-outline-dark" href="<?php echo network_admin_url( 'post-new.php' ); ?>"><span><?php esc_html_e( 'Add new post', 'talemy' ) ;?></span><i class="fas fa-caret-right"></i></a>
			<?php endif; ?>
		</div>
	</article>

<?php endif; ?>