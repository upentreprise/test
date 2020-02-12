<div class="logo-wrapper">
<?php
$site_title = get_bloginfo( 'name' );
$page_logo = talemy_get_post_meta( '_sf_page_logo' );
$attr_data = $attr_dimension = $attr_class = $small_attr_data = $small_attr_class = '';

if ( $page_logo ) {
	$logo_url = wp_get_attachment_image_url( talemy_get_post_meta( '_sf_logo' ) );
	$logo_r_url = wp_get_attachment_image_url( talemy_get_post_meta( '_sf_logo_retina' ) );
	$logo_alt_url = wp_get_attachment_image_url( talemy_get_post_meta( '_sf_logo_alt' ) );
	$logo_alt_r_url = wp_get_attachment_image_url( talemy_get_post_meta( '_sf_logo_alt_retina' ) );
	$logo_dimensions = array(
		'width' => talemy_get_post_meta( '_sf_logo_width' ),
		'height' => talemy_get_post_meta( '_sf_logo_height' )
	);
} else {
	$logo_url = talemy_get_option( 'logo' );
	$logo_r_url = talemy_get_option( 'logo_retina' );
	$logo_dimensions = talemy_get_option( 'logo_dimensions' );
	$logo_alt_url = talemy_get_option( 'logo_alt' );
	$logo_alt_r_url = talemy_get_option( 'logo_alt_retina' );
}

// logo width and height attribute
if ( !empty( $logo_dimensions['width'] ) ) {
	$logo_width = filter_var( $logo_dimensions['width'], FILTER_SANITIZE_NUMBER_INT );
	$attr_dimension .= ' width="' . esc_attr( $logo_width ) . '"';
}

if ( !empty( $logo_dimensions['height'] ) ) {
	$logo_height = filter_var( $logo_dimensions['height'], FILTER_SANITIZE_NUMBER_INT );
	$attr_dimension .= ' height="' . esc_attr( $logo_height ) . '"';
}

// retina logo url
if ( !empty( $logo_r_url ) ) {
	$attr_data = ' data-retina="'. esc_url( $logo_r_url ) .'"';

	if ( empty( $logo_url ) ) {
		$logo_url = $logo_r_url;

	} else {
		$attr_class = ' class="logo-retina"';
	}
}

if ( empty( $logo_alt_url ) ) {
	$logo_alt_url = $logo_url;
}

// small retina logo url
if ( !empty( $logo_alt_r_url ) ) {
	$small_attr_data = ' data-retina="'. esc_url( $logo_alt_r_url ) .'"';

	if ( empty( $logo_alt_url ) ) {
		$logo_alt_url = $logo_alt_r_url;

	} else {
		$small_attr_class = ' class="logo-retina"';
	}
}

if ( !empty( $logo_url ) ) : ?>
	
	<a itemprop="url" class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<img<?php echo $attr_class . $attr_dimension . $attr_data; // WPCS: XSS ok. ?>  src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $site_title ); ?>">
	</a>

<?php else : ?>
	
	<a itemprop="url" class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( $site_title );?>"><?php echo esc_html( $site_title ); ?></a>

<?php endif; ?>

<?php if ( !empty( $logo_alt_url ) ) : ?>
	
	<a itemprop="url" class="logo-alt" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<img<?php echo $attr_class . $attr_dimension . $small_attr_data; // WPCS: XSS ok. ?>  src="<?php echo esc_url( $logo_alt_url ); ?>" alt="<?php echo esc_attr( $site_title ); ?>">
	</a>
	
<?php endif; ?>
	
	<meta itemprop="name" content="<?php echo esc_attr( $site_title ); ?>">
</div>