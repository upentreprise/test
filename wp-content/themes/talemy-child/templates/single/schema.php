<link itemscope itemprop="mainEntityOfPage" href="<?php echo esc_url( get_the_permalink() ); ?>">
<?php
$image_url = $image_width = $image_height = '';
if ( has_post_thumbnail( get_the_ID() ) ) {
	$image_id = get_post_thumbnail_id( get_the_ID() );
	$image = wp_get_attachment_image_src( $image_id, 'talemy_thumb_large_x' );
	$image_url = $image[0];
	$image_width = $image[1];
	$image_height = $image[2];
}
?>
<div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
	<meta itemprop="url" content="<?php echo esc_url( $image_url ); ?>">
	<meta itemprop="width" content="<?php echo esc_attr( $image_width ); ?>">
	<meta itemprop="height" content="<?php echo esc_attr( $image_height ); ?>">
</div>
<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
	<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
		<meta itemprop="url" content="<?php echo esc_url( talemy_get_option( 'logo' ) ); ?>">
	</div>
	<meta itemprop="name" content="<?php bloginfo( 'name' ); ?>">
</div>