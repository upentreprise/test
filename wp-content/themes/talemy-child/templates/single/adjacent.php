<?php
if ( !talemy_get_option( 'post_adjacent' ) ) {
	return;
}

$prev = get_previous_post();
$next = get_next_post();

if ( empty( $prev ) && empty( $next ) ) {
	return;
}
?>
<div class="post-adjacent">
	<div class="row">
	<?php if ( !empty( $prev ) ) : ?>
		<div class="col-sm-6 position-relative">
			<a class="previous-post" href="<?php echo esc_url( get_permalink( $prev->ID ) ); ?>">
				<span><?php echo esc_html_e( 'Previous Post', 'talemy' ); ?></span>
				<h4 class="post-title"><?php echo wp_kses_post( $prev->post_title ); ?></h4>
				<i class="fas fa-long-arrow-alt-left"></i>
			</a>
		</div>
	<?php endif; ?>
	<?php if ( !empty( $next ) ) : ?>
		<div class="col-sm-6 position-relative">
			<a class="next-post" href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>">
				<span><?php echo esc_html_e( 'Next Post', 'talemy' ); ?></span>
				<h4 class="post-title"><?php echo wp_kses_post( $next->post_title ); ?></h4>
				<i class="fas fa-long-arrow-alt-right"></i>
			</a>
		</div>
	<?php endif; ?>
	</div>
</div>
