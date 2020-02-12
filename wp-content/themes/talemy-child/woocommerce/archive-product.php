<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

talemy_set_wc_settings( 'archive' );

do_action( 'talemy_content_start' );

get_template_part( 'templates/wc-content-banner' ); ?>

<div class="content-wrapper <?php echo esc_attr( talemy_get_setting( 'layout' ) ); ?>">

	<?php do_action( 'talemy_container_start' );

		do_action( 'talemy_before_main_content' );

		echo '<div class="main">';

		woocommerce_content();

		echo '</div>';

		do_action( 'talemy_after_main_content' );

		do_action( 'talemy_sidebar' );
		
		do_action( 'talemy_container_end' );

	?>
</div><?php

do_action( 'talemy_content_end' );

get_footer();
