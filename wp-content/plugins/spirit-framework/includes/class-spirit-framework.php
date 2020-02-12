<?php
/**
* Spirit Framework
* 
*/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( !class_exists( 'Spirit_Framework' ) ) {

	final class Spirit_Framework {

		/**
		 * Static property to hold our singleton instance
		 */
		private static $instance = null;

		/**
		 * If an instance exists, this returns it.  If not, it creates one and
		 * retuns it.
		 *
		 * @return Spirit_Framework
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self;
				self::$instance->constants();
				self::$instance->includes();
				self::$instance->hooks();
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
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'spirit' ), '1.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access protected
		 * @return void
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'spirit' ), '1.0' );
		}

		/**
		 * Constants
		 */
		private function constants() {
			global $sf_global_settings;
	        $sf_global_settings = get_option( 'sf_settings' );
	        $sf_global_settings = !empty( $sf_global_settings ) && is_array( $sf_global_settings ) ? $sf_global_settings : array();
		}

		/**
		 * Include files
		 */
		private function includes() {
			// load required files
			require_once SF_FRAMEWORK_DIR . 'includes/libs/kirki/kirki.php';
			require_once SF_FRAMEWORK_DIR . 'includes/formatting.php';
			require_once SF_FRAMEWORK_DIR . 'includes/core-functions.php';
			require_once SF_FRAMEWORK_DIR . 'includes/helpers.php';
			require_once SF_FRAMEWORK_DIR . 'includes/template-hooks.php';
			require_once SF_FRAMEWORK_DIR . 'includes/custom/post-types.php';
			require_once SF_FRAMEWORK_DIR . 'includes/custom/taxonomies.php';
			require_once SF_FRAMEWORK_DIR . 'includes/admin/class-sf-admin.php';

			if ( SF()->get_setting( 'enable_custom_sidebars' ) ) {
				SF_Custom_Sidebars::instance();
			}
			
			if ( SF()->get_setting( 'enable_login_registration' ) ) {
				SF_Login::instance();
			}

			if ( defined( 'ELEMENTOR_VERSION' ) ) {
				SF_Elementor_Addon::instance();
			}
		}

		/**
		 * Hooks
		 */
		private function hooks() {
			register_activation_hook( SF_FRAMEWORK_FILE, array( 'Spirit_Framework', 'install' ) );

			add_action( 'plugins_loaded', array( self::$instance, 'load_plugin_textdomain' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );
			add_filter( 'kirki_enqueue_google_fonts', 'sf_custom_google_fonts' );
			add_action( 'widgets_init', array( $this, 'register_widgets' ) );
		}

		/**
		 * Load textdomain
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'spirit', false, SF_FRAMEWORK_DIR . 'languages' );
		}

		/**
		 * Get setting
		 */
		public function get_setting( $key, $default = false ) {
			global $sf_global_settings;
			$value = isset( $sf_global_settings[ $key ] ) ? $sf_global_settings[ $key ] : $default;
			return $value;
		}

		/**
		 * Front end scripts
		 */
		public function frontend_scripts() {
			$suffix = defined( 'SF_SCRIPT_DEBUG' ) && SF_SCRIPT_DEBUG ? '' : '.min';

			wp_register_style( 'fancybox', SF_FRAMEWORK_URI .'assets/lib/fancybox/css/fancybox.min.css' );
        	
			wp_register_style( 'font-awesome-5-all', SF_FRAMEWORK_URI . 'assets/lib/font-awesome/css/all.min.css', [], '5.10.1' );
			wp_register_style( 'font-awesome-4-shim', SF_FRAMEWORK_URI . 'assets/lib/font-awesome/css/v4-shims.min.css', [], '5.10.1' );

        	wp_register_script( 'fancybox', SF_FRAMEWORK_URI .'assets/lib/fancybox/js/jquery.fancybox.min.js', [ 'jquery' ], SF_FRAMEWORK_VERSION, true );
			
			wp_register_script( 'isotope', SF_FRAMEWORK_URI .'assets/lib/isotope/isotope.pkgd.min.js', [ 'jquery' ], SF_FRAMEWORK_VERSION, true );
			
			wp_register_script( 'jquery-throttle-debounce', SF_FRAMEWORK_URI . 'assets/lib/jquery/jquery.throttle-debounce.min.js', [ 'jquery' ], '1.1', true );

			wp_register_script( 'jquery-animate-number', SF_FRAMEWORK_URI .'assets/lib/jquery/jquery.animateNumber.min.js', [ 'jquery' ], '0.0.14', true );

			wp_register_script( 'jquery-swiper', SF_FRAMEWORK_URI .'assets/lib/swiper/swiper.min.js', [], '4.4.2', true );

			wp_register_script( 'sf-frontend', SF_FRAMEWORK_URI .'assets/js/frontend/frontend' . $suffix . '.js', array( 'jquery', 'jquery-throttle-debounce' ), SF_FRAMEWORK_VERSION, true );
			
			wp_enqueue_style( 'font-awesome-5-all' );
			if ( apply_filters( 'sf_config_load_fa4_shim', false ) ) {
				wp_enqueue_style( 'font-awesome-4-shim' );
			}

			wp_enqueue_script( 'imagesloaded' );
			wp_enqueue_script( 'sf-frontend' );
			wp_localize_script( 'sf-frontend', 'sf_js_data', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

			wp_enqueue_style( 'sf-frontend', SF_FRAMEWORK_URI .'assets/css/frontend.min.css', false, SF_FRAMEWORK_VERSION );
			wp_style_add_data( 'sf-frontend', 'rtl', 'replace' );
		}

		/**
		 * Register widgets
		 */
		public function register_widgets() {
			register_widget( 'SF_Widget_About' );
			register_widget( 'SF_Widget_About_Site' );
			register_widget( 'SF_Widget_Contact_Info' );
			register_widget( 'SF_Widget_Popular_Categories' );
			register_widget( 'SF_Widget_Popular_Posts' );
			register_widget( 'SF_Widget_Social_Icons' );
		}


		/**
		 * Get the template path.
		 *
		 * @return string
		 */
		public function template_path() {
			return apply_filters( 'sf_template_path', 'spirit/' );
		}

		/**
		 * Get the plugin path.
		 *
		 * @return string
		 */
		public function plugin_path() {
			return SF_FRAMEWORK_DIR;
		}

		/**
		 * Runs on plugin activation
		 *
		 * @return string
		 */
		public static function install() {
			// remove kirki admin notice
			update_option( 'kirki_telemetry_no_consent', 1 );
		}
	}
}