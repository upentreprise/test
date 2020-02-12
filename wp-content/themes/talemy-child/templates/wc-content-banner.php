<?php if ( '' === talemy_get_setting( 'banner' ) ) : ?>
	<?php $banner_image = talemy_get_setting( 'banner_image' ); ?>
	<div class="content-banner"<?php if (!empty( $banner_image ) ) { echo ' style="background-image:url('. esc_url( $banner_image ) .');"'; } ?>>
		<div class="container">
			<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
			<?php get_template_part( 'templates/breadcrumbs' ); ?>
		</div>
		<div class="banner-overlay"></div>
	</div>
<?php elseif ( 'breadcrumbs' === talemy_get_setting( 'banner' ) ) : ?>
<?php get_template_part( 'templates/content-breadcrumbs' ); ?>
<?php elseif ( 'shortcode' === talemy_get_setting( 'banner' ) ) : ?>
<?php echo do_shortcode( html_entity_decode( talemy_get_setting( 'banner_shortcode' ) ) ); ?>
<?php endif; ?>
<?php if ( 'disable' !== talemy_get_setting( 'banner' ) ) : ?>
<?php add_filter( 'woocommerce_show_page_title', '__return_false' ); ?>
<?php endif; ?>