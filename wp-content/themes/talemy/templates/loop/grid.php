<div <?php post_class( talemy_get_setting( 'post_class' ) ); ?>>
	<div class="post-body">
		<?php echo talemy_get_loop_thumb( talemy_get_setting( 'thumb_size' ) ); ?>
		<div class="post-info">
			<?php echo talemy_get_loop_category( talemy_get_setting( 'grid_category', true ) ); ?>
			<?php echo talemy_get_loop_title(); ?>
			<?php echo talemy_get_loop_excerpt( talemy_get_setting( 'grid_excerpt_limit', 120 ) ); ?>
		</div>
		<?php echo talemy_get_loop_meta( talemy_get_setting( 'grid_meta_data', array( 'author', 'date' ) ) ); ?>
	</div>
</div>