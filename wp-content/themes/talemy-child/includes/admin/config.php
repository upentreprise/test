<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'sf_config_theme', 'talemy_theme_config' );

function talemy_theme_config() {
	return array(
		'doc_url' => 'https://themespirit.com/documentation/talemy/',
		'video_url' => 'https://www.youtube.com/watch?v=HIEQjHAa4Fs&list=PLQTu2PJqDRfuJKkWiNkocJPD77dTclsog'
	);
}


add_filter( 'sf_config_theme_fonts', 'talemy_config_theme_fonts' );

function talemy_config_theme_fonts() {
	return array(
		array(
			'family' => 'Poppins',
			'variants' => '300,regular,italic,500,600,600italic,700',
			'source' => 'Google'
		)
	);
}


add_filter( 'sf_config_plugins', 'talemy_theme_plugins' );

if ( !function_exists( 'talemy_theme_plugins' ) ) {
	function talemy_theme_plugins( $data = array() ) {
		$data = array(
			array(
	            'name'      => 'Spirit Framework',
	            'slug'      => 'spirit-framework',
	            'source'    => 'https://themespirit.s3.amazonaws.com/plugins/spirit-framework.zip',
	            'required'  => true,
	            'version'   => '1.1.3'
	        ),
	        array(
	            'name'      => 'Elementor',
	            'slug'      => 'elementor',
	            'required'  => true
	        ),
			array(
	            'name'      => 'LearnDash Custom Meta',
	            'slug'      => 'ld-custom-meta',
	            'source'    => TALEMY_THEME_DIR . 'includes/plugins/ld-custom-meta.zip',
	            'required'  => true,
	            'version'   => '1.0.1'
	        ),
			array(
	            'name'      => 'LearnDash Course Reviews',
	            'slug'      => 'ld-course-reviews',
	            'source'    => TALEMY_THEME_DIR . 'includes/plugins/ld-course-reviews.zip',
	            'required'  => false,
	            'version'   => '1.0.4'
	        ),
	        array(
	        	'name'      => 'Breadcrumb NavXT',
	        	'slug'      => 'breadcrumb-navxt',
	        	'required'  => false
	        ),
	        array(
	            'name'      => 'Contact Form 7',
	            'slug'      => 'contact-form-7',
	            'required'  => false
	        ),
	        array(
	            'name'      => 'Slider Revolution',
	            'slug'      => 'revslider',
	            'source'    => TALEMY_THEME_DIR . 'includes/plugins/revslider.zip',
				'required'  => false,
				'version'   => '6.1.5'
			),
			array(
	            'name'      => 'The Events Calendar',
	            'slug'      => 'the-events-calendar',
	            'required'  => false,
	            'version'   => '4.7.0'
	        ),
	        array(
	            'name'      => 'Talemy Demo Data',
	            'slug'      => 'talemy-demo-data',
	            'source'    => 'https://themespirit.s3.amazonaws.com/plugins/talemy-demo-data.zip',
	            'required'  => false,
	            'version'   => '1.0.9'
	        ),
	        array(
	            'name'      => 'WooCommerce',
	            'slug'      => 'woocommerce',
	            'required'  => false,
	            'version'   => '3.7.0'
	        ),
	        array(
	        	'name'      => 'WooCommerce Wishlist Plugin',
	        	'slug'      => 'ti-woocommerce-wishlist',
	        	'required'  => false
	        ),
	        array(
	        	'name'      => 'Smash Balloon Social Photo Feed',
	        	'slug'      => 'instagram-feed',
	        	'required'  => false
	        ),
	        array(
	        	'name'      => 'WP Video Popup',
	        	'slug'      => 'responsive-youtube-vimeo-popup',
	        	'required'  => false
	        )
		);
		return $data;
	}
}


add_filter( 'sf_envato_item_id', 'talemy_envato_item_id' );

function talemy_envato_item_id( $product_id ) {
	return '23064542';
}
