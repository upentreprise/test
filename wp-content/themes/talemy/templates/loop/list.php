<div <?php post_class( 'post-style-list' ); ?>>
	<div class="post-body">
		<?php echo talemy_get_loop_thumb( 'talemy_thumb_small', talemy_get_loop_category( talemy_get_setting( 'list_category', true ) ) ); ?>
		<div class="post-info">
			<?php echo talemy_get_loop_title(); ?>
			<?php echo talemy_get_loop_excerpt( talemy_get_setting( 'list_excerpt_limit', 100 ) ); ?>
			<?php echo talemy_get_loop_meta( talemy_get_setting( 'list_meta_data', array( 'author', 'date', 'comment' ) ) ); ?>
		</div>
	</div>
</div>