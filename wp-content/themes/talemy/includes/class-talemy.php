<?php
/**
 * Talemy
 *
 * @since   1.0.0
 * @package Talemy/Classes
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Talemy {

	/**
	 * Static property to hold our singleton instance
	 */
	private static $instance = null;

	/**
	 * If an instance exists, this returns it.  If not, it creates one and
	 * retuns it.
	 *
	 * @return Talemy
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Throw error on object clone.
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @access protected
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'talemy' ), '1.0' );
	}

	/**
	 * Disable unserializing of the class.
	 *
	 * @access protected
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'talemy' ), '1.0' );
	}
	
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->constants();
		$this->hooks();
	}

	/**
	 * Setup theme constants
	 */
	public function constants() {
		self::set_content_width();
	}

	/**
	 * Theme Hooks
	 */
	public function hooks() {
		add_action( 'after_setup_theme', array( $this, 'setup_theme' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_scripts' ) );
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );
	}

	/**
	 * Set global content width
	 *
	 * @return void
	 */
	public static function set_content_width() {
		global $content_width;
		if ( !isset( $content_width ) ) {
			$content_width = 1170;
		}
	}

	/**
	 * Theme Setup
	 */
	public function setup_theme() {
		// Localization.
		load_theme_textdomain( 'talemy', TALEMY_THEME_DIR . 'languages' );

		// Add theme features
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_theme_support( 'align-wide' );
 		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'woocommerce' );

		// Add image sizes
		add_image_size( 'talemy_thumb_x_small', 100, 70, true );
		add_image_size( 'talemy_thumb_small_s', 380, 380, true );
		add_image_size( 'talemy_thumb_small', 540, 360, true );
		add_image_size( 'talemy_thumb_small_x', 540, 9999, false );
		add_image_size( 'talemy_thumb_half', 585, 390, true );
		add_image_size( 'talemy_thumb_medium', 860, 486, true );
		add_image_size( 'talemy_thumb_medium_x', 860, 9999, false );
		add_image_size( 'talemy_thumb_large', 1170, 658, true );
		add_image_size( 'talemy_thumb_large_x', 1170, 9999, false );

		// Register menus
		register_nav_menus( array(
			'main' => esc_attr__( 'Main Menu', 'talemy' ),
			'side' => esc_attr__( 'Off-Canvas Left Menu', 'talemy' ),
			'side_right' => esc_attr__( 'Off-Canvas Right Menu', 'talemy' ),
			'footer' => esc_attr__( 'Footer Menu', 'talemy' ),
			'account' => esc_attr__( 'Account Menu', 'talemy' )
		) );
	}

	/**
	 * Enqueue Style & Scripts
	 *
	 */
	public function theme_scripts() {
		$suffix = !TALEMY_DEV_MODE ? '.min' : '';

		// stylesheets
		wp_register_style(
			'font-awesome-5-all',
			TALEMY_THEME_URI . 'assets/lib/font-awesome/css/all.min.css',
			false,
			'5.10.1'
		);

		wp_register_style(
			'font-awesome-5-shim',
			TALEMY_THEME_URI . 'assets/lib/font-awesome/css/v4-shims.min.css',
			false,
			'5.10.1'
		);
		
		wp_register_style(
			'fancybox',
			TALEMY_THEME_URI . 'assets/lib/css/fancybox.min.css'
		);

		wp_register_style(
			'talemy',
			TALEMY_THEME_URI . 'assets/css/style'. $suffix . '.css',
			false,
			TALEMY_THEME_VERSION
		);

		wp_enqueue_style( 'font-awesome-5-all' );
		wp_enqueue_style( 'font-awesome-5-shim' );
		wp_enqueue_style( 'talemy' );
		wp_style_add_data( 'talemy', 'rtl', 'replace' );

		// scripts

    	wp_register_script(
    		'fancybox',
    		TALEMY_THEME_URI . 'assets/lib/js/jquery.fancybox.min.js',
    		array( 'jquery' ),
    		TALEMY_THEME_VERSION,
    		true
    	);

		wp_register_script(
			'jquery-fitvids',
			TALEMY_THEME_URI . 'assets/lib/js/jquery.fitvids.min.js',
			array( 'jquery' ),
			'1.1',
			true
		);

		wp_register_script(
			'jquery-matchheight',
			TALEMY_THEME_URI . 'assets/lib/js/jquery.matchHeight.min.js',
			array( 'jquery' ),
			'0.7.0',
			true
		);

		wp_register_script(
			'jquery-placeholder',
			TALEMY_THEME_URI . 'assets/lib/js/jquery.placeholder.min.js',
			array( 'jquery' ),
			'2.3.1',
			true
		);

		wp_register_script(
			'jquery-requestanimationframe',
			TALEMY_THEME_URI . 'assets/lib/js/jquery.requestanimationframe.min.js',
			array( 'jquery' ),
			'0.2.3',
			true
		);

		wp_register_script(
			'jquery-selectric',
			TALEMY_THEME_URI . 'assets/lib/js/jquery.selectric.min.js',
			array( 'jquery' ),
			'1.13.0',
			true
		);

		wp_register_script(
			'jquery-superfish',
			TALEMY_THEME_URI . 'assets/lib/js/jquery.superfish.min.js',
			array( 'jquery' ),
			'1.7.10',
			true
		);

		wp_register_script(
			'jquery-throttle-debounce',
			TALEMY_THEME_URI . 'assets/lib/js/jquery.throttle-debounce.min.js',
			array( 'jquery' ),
			'1.1',
			true
		);

		wp_register_script(
			'resize-sensor',
			TALEMY_THEME_URI . 'assets/lib/js/ResizeSensor.min.js',
			array(),
			null,
			true
		);

		wp_register_script(
			'theia-sticky-sidebar',
			TALEMY_THEME_URI . 'assets/lib/js/theia-sticky-sidebar.min.js',
			array( 'jquery', 'resize-sensor' ),
			'1.7.0',
			true
		);

		wp_register_script(
			'talemy-modernizr',
			TALEMY_THEME_URI . 'assets/lib/js/modernizr.js',
			array(),
			'3.6.0',
			true
		);

		wp_register_script(
			'talemy-block',
			TALEMY_THEME_URI . 'assets/js/talemy-block.min.js',
			array( 'jquery', 'imagesloaded', 'jquery-matchheight' ),
			TALEMY_THEME_VERSION,
			true
		);

		wp_register_script(
			'talemy',
			TALEMY_THEME_URI . 'assets/js/talemy' . $suffix . '.js',
			array(
				'jquery',
				'imagesloaded',
				'jquery-fitvids',
				'jquery-superfish',
				'jquery-selectric',
				'jquery-throttle-debounce',
				'jquery-requestanimationframe',
				'jquery-matchheight',
				'jquery-placeholder',
				'theia-sticky-sidebar',
				'talemy-modernizr'
			),
			TALEMY_THEME_VERSION,
			true
		);

		wp_enqueue_script( 'jquery-fitvids' );
		wp_enqueue_script( 'jquery-superfish' );
		wp_enqueue_script( 'jquery-selectric' );
		wp_enqueue_script( 'jquery-throttle-debounce' );
		wp_enqueue_script( 'jquery-requestanimationframe' );
		wp_enqueue_script( 'jquery-matchheight' );
		wp_enqueue_script( 'jquery-placeholder' );
		wp_enqueue_script( 'theia-sticky-sidebar' );
		wp_enqueue_script( 'talemy-modernizr' );
		wp_enqueue_script( 'talemy' );
		wp_localize_script( 'talemy', 'talemy_js_data', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

		if ( is_single() ) {
			if ( talemy_get_option( 'post_comments' ) && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
			if ( is_singular( 'sfwd-courses' ) ) {
				wp_enqueue_style( 'fancybox' );
				wp_enqueue_script( 'fancybox' );
			} else {
				$in_focus_mode = false;
				if ( class_exists( 'LearnDash_Settings_Section' ) ) {
					$in_focus_mode = LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Theme_LD30', 'focus_mode_enabled' );
				}
				if ( !$in_focus_mode && in_array( get_post_type(), array( 'sfwd-lessons', 'sfwd-topic' ) ) ) {
					wp_enqueue_style( 'fancybox' );
					wp_enqueue_script( 'fancybox' );
				}
			}
		} else if ( is_page() && !is_front_page() ) {
			if ( talemy_get_option( 'page_comments' ) && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}
	}

	/**
	 * Register Sidebars
	 * 
	 */
	public function register_sidebars() {

		// Register default sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Default Sidebar', 'talemy' ),
			'id'            => 'default-sidebar',
			'description'   => esc_html__( 'The default sidebar for all templates.', 'talemy' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title"><span class="title">',
			'after_title'   => '</span></h4>',
		));

		// Register footer top widget areas
		$columns = 5; $i = 0;
		while ( $i < $columns ) { $i++;
			register_sidebar( array(
				'name'          => sprintf( esc_html__( 'Footer Area %s', 'talemy' ), $i ),
				'id'            => 'footer-' . $i,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title"><span class="title">',
				'after_title'   => '</span></h4>'
			) );
		}

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Gallery', 'talemy' ),
			'id'            => 'footer-gallery',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => ''
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area Top', 'talemy' ),
			'id'            => 'footer-top',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title"><span class="title">',
			'after_title'   => '</span></h4>'
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area Bottom', 'talemy' ),
			'id'            => 'footer-bottom',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title"><span class="title">',
			'after_title'   => '</span></h4>'
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Top Bar Left', 'talemy' ),
			'id'            => 'topbar-left',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title"><span class="title">',
			'after_title'   => '</span></h4>'
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Top Bar Right', 'talemy' ),
			'id'            => 'topbar-right',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title"><span class="title">',
			'after_title'   => '</span></h4>'
		) );

        // Register off-canvas left widget area
        register_sidebar( array(
			'name'          => esc_html__( 'Off-Canvas Left ( Mobile )', 'talemy' ),
			'id'            => 'side-sidebar',
			'before_widget' => '<div id="%1$s" class="%2$s off-canvas-widget widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title"><span class="title">',
			'after_title'   => '</span></h4>',
        ) );

        // Register off-canvas right widget area
        register_sidebar( array(
			'name'          => esc_html__( 'Off-Canvas Right', 'talemy' ),
			'id'            => 'off-canvas-right',
			'before_widget' => '<div id="%1$s" class="%2$s off-canvas-widget widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title"><span class="title">',
			'after_title'   => '</span></h4>',
        ) );
	}
}

/**
 * Main instance of Talemy.
 *
 * Returns the main instance of Talemy to prevent the need to use globals.
 *
 * @return Talemy
 */
function Talemy() {
	return Talemy::instance();
}

Talemy();