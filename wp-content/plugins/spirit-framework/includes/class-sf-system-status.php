<?php 
/**
 * SF System Status
 *
 * Helper class for outputing system info
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

class SF_System_Status {

	/**
	 * Get info on the current active theme and parent theme (if present)
	 * 
	 * @return array
	 */
	public function get_theme_info() {
		$active_theme = wp_get_theme();
		
		if ( is_child_theme() ) {
			$parent_theme      = wp_get_theme( $active_theme->Template );
			$parent_theme_info = array(
				'parent_name'      => $parent_theme->Name,
				'parent_version'   => $parent_theme->Version,
			);
		} else {
			$parent_theme_info = array( 'parent_name' => '', 'parent_version' => '' );
		}

		$active_theme_info = array(
			'version'         => $active_theme->Version,
			'is_child_theme'  => is_child_theme(),
		);

		return array_merge( $active_theme_info, $parent_theme_info );
	}

	/**
	 * Get array of environment information
	 * 
	 * @return array
	 */
	public function get_environment() {
		global $wpdb;

		// WP memory limit
		$wp_memory_limit = sf_let_to_num( WP_MEMORY_LIMIT );
		if ( function_exists( 'memory_get_usage' ) ) {
			$wp_memory_limit = max( $wp_memory_limit, sf_let_to_num( @ini_get( 'memory_limit' ) ) );
		}

		// Test POST request
		$post_response = wp_safe_remote_post(
			'https://www.google.com/recaptcha/api/siteverify', array(
				'decompress' => false,
				'user-agent' => 'sf-remote-get-test',
		));
		$post_response_successful = false;
		if ( !is_wp_error( $post_response ) && $post_response['response']['code'] >= 200 && $post_response['response']['code'] < 300 ) {
			$post_response_successful = true;
		}

		// Test GET request
		$get_response = wp_safe_remote_get(
			'https://build.envato.com/api/', array(
				'decompress' => false,
				'user-agent' => 'sf-remote-get-test',
		));
		$get_response_successful = false;
		if ( !is_wp_error( $post_response ) && $post_response['response']['code'] >= 200 && $post_response['response']['code'] < 300 ) {
			$get_response_successful = true;
		}

		// Return all environment info.
		return array(
			'home_url'                  => get_option( 'home' ),
			'site_url'                  => get_option( 'siteurl' ),
			'wp_version'                => get_bloginfo( 'version' ),
			'wp_multisite'              => is_multisite(),
			'wp_memory_limit'           => $wp_memory_limit,
			'wp_debug_mode'             => ( defined( 'WP_DEBUG' ) && WP_DEBUG ),
			'wp_cron'                   => ! ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ),
			'language'                  => get_locale(),
			'server_info'               => $_SERVER['SERVER_SOFTWARE'],
			'php_version'               => phpversion(),
			'php_post_max_size'         => sf_let_to_num( ini_get( 'post_max_size' ) ),
			'php_max_execution_time'    => ini_get( 'max_execution_time' ),
			'php_max_input_vars'        => ini_get( 'max_input_vars' ),
			'suhosin_installed'         => extension_loaded( 'suhosin' ),
			'max_upload_size'           => wp_max_upload_size(),
			'mysql_version'             => ( !empty( $wpdb->is_mysql ) ? $wpdb->db_version() : '' ),
			'mysql_info'                => $wpdb->get_var("SELECT VERSION()"),
			'default_timezone'          => date_default_timezone_get(),
			'fsockopen_or_curl_enabled' => ( function_exists( 'fsockopen' ) || function_exists( 'curl_init' ) ),
			'soapclient_enabled'        => class_exists( 'SoapClient' ),
			'domdocument_enabled'       => class_exists( 'DOMDocument' ),
			'ziparchive_enabled'        => class_exists( 'ZipArchive' ),
			'mbstring_enabled'          => extension_loaded( 'mbstring' ),
			'remote_post_successful'    => $post_response_successful,
			'remote_post_response'      => ( is_wp_error( $post_response ) ? $post_response->get_error_message() : $post_response['response']['code'] ),
			'remote_get_successful'     => $get_response_successful,
			'remote_get_response'       => ( is_wp_error( $get_response ) ? $get_response->get_error_message() : $get_response['response']['code'] ),
		);
	}

	/**
	 * Get a list of plugins active on the site.
	 *
	 * @return array
	 */
	public function get_active_plugins() {
		$all_plugins = get_plugins();
		$active_plugins_path = get_option( 'active_plugins' );
		$active_plugins_data = array();

		foreach ( $active_plugins_path as $path ) {
		    if ( isset( $all_plugins[ $path ] ) ){
		        array_push( $active_plugins_data, $all_plugins[ $path ] );
		    }
		}
		return $active_plugins_data;
	}
}