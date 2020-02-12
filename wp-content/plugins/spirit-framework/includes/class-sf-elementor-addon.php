<?php
/**
 * SF Elementor Addon
 * 
 * @package  Spirit_Framework
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

class SF_Elementor_Addon {
	
	/**
	 * Static property to hold our singleton instance
	 */
	protected static $_instance = null;

	/**
	 * Main instance
	 * Ensures only one instance of this class is loaded or can be loaded.
	 *
	 * @static
	 * @return SF_Elementor_Addon - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	function __construct() {
		require_once SF_FRAMEWORK_DIR . 'includes/elementor/functions.php';
		add_action( 'elementor/init', [ $this, 'add_elementor_category' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'include_controls' ] );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'include_widgets' ] );
		add_action( 'elementor/editor/before_enqueue_styles', [ $this, 'editor_before_styles' ] );
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_after_styles' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'editor_before_scripts' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'frontend_after_styles' ] );
		// add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'frontend_after_scripts' ] );
	}

	/**
	 * Before editor styles
	 */
	function editor_before_styles() {
		wp_register_style( 'sf-editor', SF_FRAMEWORK_URI . 'assets/css/editor.min.css' );
		wp_register_style( 'font-awesome-5-all', SF_FRAMEWORK_URI . 'assets/lib/font-awesome/css/all.min.css', [], '5.10.1' );
		wp_register_style( 'font-awesome-4-shim', SF_FRAMEWORK_URI . 'assets/lib/font-awesome/css/v4-shims.min.css', [], '5.10.1' );
		wp_register_style( 'fonticonpicker', SF_FRAMEWORK_URI . 'assets/lib/fonticonpicker/css/iconpicker.min.css' );
		
		wp_enqueue_style( 'sf-editor' );
		wp_style_add_data( 'sf-editor', 'rtl', 'replace' );

		$default_icon_control = apply_filters( 'sf_elementor_default_icon_control', false );

		if ( !$default_icon_control ) {
			wp_enqueue_style( 'font-awesome-5-all' );
			wp_enqueue_style( 'font-awesome-4-shim' );
			wp_enqueue_style( 'fonticonpicker' );
		}
		
		do_action( 'sf_elementor_editor_before_enqueue_styles' );
	}

	/**
	 * Before editor scripts
	 */
	function editor_before_scripts() {
        wp_register_script( 'fonticonpicker', SF_FRAMEWORK_URI . 'assets/lib/fonticonpicker/js/jquery.fonticonpicker.min.js', [ 'jquery' ], SF_FRAMEWORK_VERSION, true );
        wp_register_script( 'sf-editor', SF_FRAMEWORK_URI . 'assets/js/admin/editor.min.js', [ 'jquery', 'fonticonpicker' ], SF_FRAMEWORK_VERSION, true );

		$default_icon_control = apply_filters( 'sf_elementor_default_icon_control', false );
		
		if ( !$default_icon_control ) {
			wp_enqueue_script( 'fonticonpicker' );
			wp_enqueue_script( 'sf-editor' );
			wp_localize_script( 'sf-editor', 'SF_Editor', [ 'fontawesomeicons' => sf_get_font_icons() ] );
		}
	}

	/**
	 * After frontend scripts
	 */
	function frontend_after_styles() {
		wp_dequeue_style( 'font-awesome' );
	}

	/**
	 * Include custom controls
	 * @param  array $element elements array
	 */
	function include_controls( $element ) {
		require_once SF_FRAMEWORK_DIR . 'includes/elementor/controls/icon.php';
		$element->register_control( 'sf_icon', new SF_Icon_Control );
	}
	
	/**
	 * Add element category
	 */
	function add_elementor_category() {
        \Elementor\Plugin::instance()->elements_manager->add_category(
	        'sf-addons',
            array(
	            'title' => esc_attr__( 'Theme', 'spirit' ),
	            'icon' => 'far fa-plug'
            ),
	        0
    	);
	}

	/**
	 * Include custom widgets
	 * @param  object $widgets_manager
	 */
	function include_widgets( $widgets_manager ) {
		$widgets = [
			'accordion',
			'button',
			'buttons',
			'countdown',
			'heading',
			'icon-box',
			'gallery',
			'number-counter',
			'price-table',
			'progress-bars',
			'search-form',
			'team-members',
			'testimonials'
		];
		
		foreach ( $widgets as $widget ) {
			require_once SF_FRAMEWORK_DIR . 'includes/elementor/widgets/' . $widget . '.php';
		}

		if ( class_exists( 'WooCommerce' ) ) {
			require_once SF_FRAMEWORK_DIR . 'includes/elementor/widgets/products.php';
		}

		$theme_widgets = apply_filters( 'sf_elementor_widgets', [] );
		foreach ( $theme_widgets as $widget ) {
			if ( file_exists( $widget ) ) {
				require_once $widget;
			}
		}
	}
}