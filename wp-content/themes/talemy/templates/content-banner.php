<?php if ( '' === talemy_get_setting( 'banner' ) ) : ?>
	<?php $banner_image = talemy_get_setting( 'banner_image' ); ?>
	<div class="content-banner"<?php if ( !empty( $banner_image ) ) { echo ' style="background-image:url('. esc_url( $banner_image ) .');"'; } ?>>
		<div class="container">
			<h1 class="page-title"><?php
				if ( is_home() ) {
					echo wp_kses_post( talemy_get_option( 'home_title' ) );
				} else if ( is_singular() ) {
					if ( is_singular( 'post' ) ) {
						echo wp_kses_post( talemy_get_option( 'home_title' ) );
					} else {
						the_title();
					}
				} else if ( is_search() ) {
					if ( talemy_get_query()->have_posts() ) {
						printf( esc_html__( 'Search Results for "%s"', 'talemy' ), get_search_query() );
					} else {
						printf( esc_html__( 'No results found for "%s"', 'talemy' ), get_search_query() );
					}
				} else if ( is_archive() ) {
					echo talemy_get_archive_title();
				}
			?>
			</h1>
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
			    <?php if ( function_exists( 'bcn_display' ) ) : ?>
			    <?php bcn_display(); ?>
			   	<?php endif; ?>
			</div>
		</div>
		<div class="banner-overlay"></div>
	</div>
<?php elseif ( 'breadcrumbs' === talemy_get_setting( 'banner' ) ) : ?>
<?php get_template_part( 'templates/content-breadcrumbs' ); ?>
<?php elseif ( 'shortcode' === talemy_get_setting( 'banner' ) ) : ?>
<?php echo do_shortcode( html_entity_decode( talemy_get_setting( 'banner_shortcode' ) ) ); ?>
<?php endif; ?>