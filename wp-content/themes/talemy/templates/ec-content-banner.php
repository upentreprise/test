<?php if ( '' === talemy_get_option( 'ec_banner' ) ) : ?>
	<?php $banner_image = talemy_get_option( 'ec_banner_image' ); ?>
	<div class="content-banner"<?php if (!empty( $banner_image ) ) { echo ' style="background-image:url('. esc_url( $banner_image ) .');"'; } ?>>
		<div class="container">
			<h1 class="page-title"><?php echo tribe_get_events_title(); ?></h1>
			<?php get_template_part( 'templates/breadcrumbs' ); ?>
		</div>
		<div class="banner-overlay"></div>
	</div>
<?php elseif ( 'shortcode' === talemy_get_option( 'ec_banner' ) ) :
	echo do_shortcode( html_entity_decode( talemy_get_option( 'ec_banner_shortcode' ) ) );
endif;