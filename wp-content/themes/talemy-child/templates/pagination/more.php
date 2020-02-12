<?php
$list_data = json_encode( array(
	'offset' => 0,
	'pagination' => 'more',
	'found_posts' => talemy_get_query()->found_posts,
	'query_args' => talemy_get_query()->query,
	'atts' => array(
		'layout' => talemy_get_setting( 'layout' ),
		'list_style' =>  talemy_get_setting( 'list_style' ),
		'columns' => talemy_get_setting( 'columns' ),
		'tablet_columns' => talemy_get_setting( 'tablet_columns' ),
		'mobile_columns' => talemy_get_setting( 'mobile_columns' ),
		'thumb_size' => talemy_get_setting( 'thumb_size' ),
		'ppp' => talemy_get_query()->get( 'posts_per_page' ),
		'ppl' => talemy_get_setting( 'ppl' ),
	)
));
?>
<div id="load-more" class="ajax-loader" data-list="<?php echo htmlspecialchars( $list_data, ENT_QUOTES, 'UTF-8' ); ?>">
	<div class="load-more btn btn-primary">
		<span class="load-text"><?php esc_html_e( 'Load more', 'talemy' ); ?></span>
		<span class="loading-text"><?php esc_html_e( 'Loading...', 'talemy' ); ?></span>
	</div>
</div>