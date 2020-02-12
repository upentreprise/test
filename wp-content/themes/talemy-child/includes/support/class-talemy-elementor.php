<?php
/**
 * Elementor integration
 *
 * @since   1.1.7
 * @package Talemy/Classes
 */
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Talemy_Elementor {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_filter( 'sf_elementor_widgets', array( $this, 'elementor_widgets' ) );
		add_action( 'sf_elementor_editor_before_enqueue_styles', array( $this, 'elementor_editor_style' ) );
		add_filter( 'elementor/icons_manager/native', array( $this, 'add_theme_icons' ) );
	}

	/**
	 * Add theme widgets
	 * @param  array  $widgets widgets
	 * @return array $widgets
	 */
	public function elementor_widgets( $widgets = array() ) {
		$files = array(
			TALEMY_THEME_DIR . 'includes/elements/block-posts.php',
			TALEMY_THEME_DIR . 'includes/elements/info-boxes.php'
		);

		if ( defined( 'TRIBE_EVENTS_FILE' ) ) {
			$files[] = TALEMY_THEME_DIR . 'includes/elements/events-countdown.php';
			$files[] = TALEMY_THEME_DIR . 'includes/elements/events-slider.php';
		}

		if ( defined( 'LEARNDASH_VERSION' ) ) {
			$files[] = TALEMY_THEME_DIR . 'includes/elements/block-courses.php';
			$files[] = TALEMY_THEME_DIR . 'includes/elements/course-categories.php';
			$files[] = TALEMY_THEME_DIR . 'includes/elements/course-search.php';
		}

		return $files;
	}

	/**
	 * Add theme icons
	 *
	 * @param array $icons
	 * @return array $icons
	 */
	public function add_theme_icons( $icons ) {
		$icons['talemy_icons'] = [
			'name' => 'talemy-icons',
			'label' => 'Talemy',
			'prefix' => 'ticon-',
			'displayPrefix' => '',
			'labelIcon' => 'fab fa-font-awesome-flag',
			'ver' => '1.0.0',
			'fetchJson' => TALEMY_THEME_URI . 'assets/lib/js/talemy-icons.js',
			'native' => true
		];
		return $icons;
	}

	/**
	 * Enqueue theme icon style
	 */
	public function elementor_editor_style() {
		wp_enqueue_style( 'ticon', TALEMY_THEME_URI . 'assets/css/ticon.css', array(), TALEMY_THEME_VERSION );
	}
}

if ( defined( 'ELEMENTOR_VERSION' ) ) {
	new Talemy_Elementor();
}

