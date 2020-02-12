<?php
/**
 * SF Demo Manager
 * 
 */
class SF_Demo_Manager {

	protected static $_instance = null;

	/**
	 * Main instance
	 * Ensures only one instance of this class is loaded or can be loaded.
	 *
	 * @static
	 * @return Talemy_Elementor_Addon - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 * @param array $path demo content path
	 */
	function __construct() {
		add_action( 'wp_ajax_sf_demo_installer', array( $this, 'install_demo' ) );
	}

	/**
	 * install or remove demo content
	 */
	function install_demo() {
		set_time_limit( 300 );

		$action = isset( $_POST['demo_action'] ) ? sanitize_text_field( $_POST['demo_action'] ) : '';

		// reset demo progress
		delete_option( 'sf_demo_progress' );

		if ( $action == 'install' ) {
        	$form_data = array();
        	parse_str( $_POST['demo_data'], $form_data );

			$demo_id = isset( $_POST['demo_id'] ) ? sanitize_text_field( $_POST['demo_id'] ) : '';
			$demo_data = !empty( $form_data['content'] ) ? $form_data['content'] : 'all';
			$demo_data = is_array( $demo_data ) && in_array( 'all', $demo_data ) ? 'all' : $demo_data;
			
			if ( $demo_data != 'all' ) {
				$demo_history = get_option( 'sf_demo_history' );
				$content_installed = !empty( $demo_history['content'] ) ? $demo_history['content'] : array();
				$new_demo_data = array_merge( $demo_data, $content_installed );
			} else {
				$new_demo_data = $demo_data;
			}

			// demo dir
			$demo_dir = apply_filters( 'sf_config_demos_dir', '' );
			$demo_file = $demo_dir . '/' . $demo_id . '/content.php';
			// install demo
			SF_Demo_Installer::install_demo( $demo_file, $demo_data, $new_demo_data );
			// update demo id
			update_option( 'sf_demo_current', $demo_id );
		}

		elseif ( $action == 'uninstall' ) {
			SF_Demo_Installer::uninstall_demo();
		}

		exit;
	}
}

SF_Demo_Manager::instance();