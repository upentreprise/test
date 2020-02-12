<div class="main">
	<?php if ( '' !== talemy_get_setting( 'banner' ) ) : ?>
		<div class="post-header">
			<h1 class="post-title"><?php the_title(); ?></h1>
		</div>
	<?php endif; ?>
	<div class="post-content">
		<div class="content"><?php the_content(); ?></div>
		<?php talemy_link_pages(); ?>
	</div>
	<?php if ( !is_front_page() && talemy_get_option( 'page_comments' ) && ( !defined( 'WC_PLUGIN_FILE' ) || !is_cart() && !is_checkout() ) ) : ?>
	<?php comments_template(); ?>
	<?php endif; ?>
</div>