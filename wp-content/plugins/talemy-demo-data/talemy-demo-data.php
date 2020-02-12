<?php
/**
 * Plugin Name: Talemy Demo Data
 * Plugin URI: https://themespirit.com
 * Description: Demo data for Talemy theme
 * Author: ThemeSpirit
 * Author URI: https://themespirit.com
 * Version: 1.0.9
 * Text Domain: talemy-demo
 * Domain Path: languages
 */

if ( !defined( 'TALEMY_DEMO_DIR' ) ) define( 'TALEMY_DEMO_DIR', plugin_dir_path( __FILE__ ) );
if ( !defined( 'TALEMY_DEMO_URL' ) ) define( 'TALEMY_DEMO_URL', plugin_dir_url( __FILE__ ) );


add_filter( 'sf_config_demos_dir', 'talemy_theme_demos_dir' );

if ( !function_exists( 'talemy_theme_demos_config' ) ) {
	function talemy_theme_demos_dir( $path ) {
		return TALEMY_DEMO_DIR . 'demos';
	}
}


add_filter( 'sf_config_demos', 'talemy_theme_demos_config' );

if ( !function_exists( 'talemy_theme_demos_config' ) ) {
	function talemy_theme_demos_config( $demo_id = '' ) {
		$demo_data = array(
			'demo-1' => array(
				'thumbnail'  => 'https://talemy.themespirit.com/wp-content/uploads/demo/thumbnail_demo_1.jpg',
				'id'         => 'demo-1',
				'label'      => esc_html__( 'Default', 'talemy-demo' ),
				'preview'    => 'https://talemy.themespirit.com/',
				'content'    => array( 'pages', 'posts', 'images', 'widgets', 'options', 'sliders', 'courses', 'events' )
			),
			'university' => array(
				'thumbnail'  => 'https://talemy.themespirit.com/wp-content/uploads/demo/thumbnail_university.jpg',
				'id'         => 'university',
				'label'      => esc_html__( 'University', 'talemy-demo' ),
				'preview'    => 'https://talemy.themespirit.com/university/',
				'content'    => array( 'pages', 'posts', 'images', 'widgets', 'options', 'sliders', 'courses', 'events' )
			),
			'high-school' => array(
				'thumbnail'  => 'https://talemy.themespirit.com/wp-content/uploads/demo/thumbnail_high_school.jpg',
				'id'         => 'high-school',
				'label'      => esc_html__( 'High School', 'talemy-demo' ),
				'preview'    => 'https://talemy.themespirit.com/high-school/',
				'content'    => array( 'pages', 'posts', 'images', 'widgets', 'options', 'sliders', 'courses', 'events' )
			),
			'online-learning' => array(
				'thumbnail'  => 'https://talemy.themespirit.com/wp-content/uploads/demo/thumbnail_online_learning.jpg',
				'id'         => 'online-learning',
				'label'      => esc_html__( 'Online Learning', 'talemy-demo' ),
				'preview'    => 'https://talemy.themespirit.com/online-learning/',
				'content'    => array( 'pages', 'posts', 'images', 'widgets', 'options', 'courses', 'events' )
			),
			'one-course' => array(
				'thumbnail'  => 'https://talemy.themespirit.com/wp-content/uploads/demo/thumbnail_one_course.jpg',
				'id'         => 'one-course',
				'label'      => esc_html__( 'One Course', 'talemy-demo' ),
				'preview'    => 'https://talemy.themespirit.com/one-course/',
				'content'    => array( 'pages', 'posts', 'images', 'widgets', 'options', 'courses', 'events' )
			),
			'one-instructor' => array(
				'thumbnail'  => 'https://talemy.themespirit.com/wp-content/uploads/demo/thumbnail_one_instructor.jpg',
				'id'         => 'one-instructor',
				'label'      => esc_html__( 'One Instructor', 'talemy-demo' ),
				'preview'    => 'https://talemy.themespirit.com/one-instructor/',
				'content'    => array( 'pages', 'posts', 'images', 'widgets', 'options', 'courses', 'events' )
			),
			'kindergarten' => array(
				'thumbnail'  => 'https://talemy.themespirit.com/wp-content/uploads/demo/thumbnail_kindergarten.jpg',
				'id'         => 'kindergarten',
				'label'      => esc_html__( 'Kindergarten', 'talemy-demo' ),
				'preview'    => 'https://talemy.themespirit.com/kindergarten/',
				'content'    => array( 'pages', 'posts', 'images', 'widgets', 'options', 'courses', 'events' )
			),
			'demo-2' => array(
				'thumbnail'  => 'https://talemy.themespirit.com/wp-content/uploads/demo/thumbnail_demo_2.jpg',
				'id'         => 'demo-2',
				'label'      => esc_html__( 'Demo 2', 'talemy-demo' ),
				'preview'    => 'https://talemy.themespirit.com/demo-2/',
				'content'    => array( 'pages', 'posts', 'images', 'widgets', 'options', 'courses', 'events' )
			),
			'demo-3' => array(
				'thumbnail'  => 'https://talemy.themespirit.com/wp-content/uploads/demo/thumbnail_demo_3.jpg',
				'id'         => 'demo-3',
				'label'      => esc_html__( 'Demo 3', 'talemy-demo' ),
				'preview'    => 'https://talemy.themespirit.com/demo-3/',
				'content'    => array( 'pages', 'posts', 'images', 'widgets', 'options', 'sliders', 'courses', 'events' )
			),
			'demo-5' => array(
				'thumbnail'  => 'https://talemy.themespirit.com/wp-content/uploads/demo/thumbnail_demo_5.jpg',
				'id'         => 'demo-5',
				'label'      => esc_html__( 'Demo 5', 'talemy-demo' ),
				'preview'    => 'https://talemy.themespirit.com/demo-5/',
				'content'    => array( 'pages', 'posts', 'images', 'widgets', 'options', 'courses', 'events' )
			)
		);

		if ( !empty( $demo_id ) && isset( $demo_data[ $demo_id ] ) ) {
			return $demo_data[ $demo_id ];
		}
		return $demo_data;
	}
}