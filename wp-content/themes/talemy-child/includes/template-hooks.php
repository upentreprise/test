<?php
/**
 * ThemeSpirit Template Hooks
 *
 * Action/filter hooks used for ThemeSpirit functions/templates.
 *
 * @author 		ThemeSpirit
 * @category 	Core
 * @package 	templates
 * @version     1.0.0
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter( 'body_class', 'talemy_body_class' );

/**
 * Content wrapper.
 *
 * @see talemy_output_content_wrapper_start()
 * @see talemy_output_content_wrapper_end()
 */
add_action( 'talemy_content_start', 'talemy_output_content_wrapper_start' );
add_action( 'talemy_content_end', 'talemy_output_content_wrapper_end' );

/**
 * Container.
 *
 * @see talemy_output_container_start()
 * @see talemy_output_container_end()
 */
add_action( 'talemy_container_start', 'talemy_output_container_start' );
add_action( 'talemy_container_end', 'talemy_output_container_end' );

/**
 * Main content.
 *
 * @see talemy_output_before_main_content()
 * @see talemy_output_after_main_content()
 * @see talemy_output_sidebar()
 * @see talemy_output_after_main_content()
 */
add_action( 'talemy_before_main_content', 'talemy_output_before_main_content' );
add_action( 'talemy_after_main_content', 'talemy_output_after_main_content' );
add_action( 'talemy_sidebar', 'talemy_output_sidebar' );

/**
 * Page header.
 *
 * @see talemy_output_content_banner()
 */
add_action( 'talemy_content_banner', 'talemy_output_content_banner', 10, 1 );

/**
 * Before & after loop.
 *
 * @see talemy_output_before_content_loop()
 * @see talemy_output_after_content_loop()
 */
add_action( 'talemy_before_content_loop', 'talemy_output_before_content_loop', 10 );
add_action( 'talemy_after_content_loop', 'talemy_output_after_content_loop', 10 );

/**
 * Post
 *
 * @see talemy_output_post_subtitle()
 * @see talemy_output_post_share()
 */
add_action( 'talemy_post_subtitle', 'talemy_output_post_subtitle', 10 );
add_action( 'talemy_post_share', 'talemy_output_post_share', 10 );

/**
 * Before account menu
 *
 * @see talemy_output_before_account_menu()
 */
add_action( 'talemy_before_account_menu', 'talemy_output_before_account_menu', 10 );