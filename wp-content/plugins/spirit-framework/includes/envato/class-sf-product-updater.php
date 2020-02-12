<?php 

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if( ! class_exists( 'SF_Product_Updater' ) ) {
	/**
	 * SF Product Updater
	 *
	 * @class SF_Envato_API
	 * @version 1.0.0
	 */
	class SF_Product_Updater {

		/**
		 * 
		 * @param string $slug
		 * @param string $purchase_code
		 * @param string $access_token
		 * @param boolean $debug
		 */
		function __construct() {
			// Check for theme & plugin updates.
			add_filter( 'http_request_args', [ $this, 'update_check' ], 5, 2 );
			// Inject theme updates into the response array.
			add_filter( 'pre_set_site_transient_update_themes', [ $this, 'update_themes' ] );
			add_filter( 'pre_set_transient_update_themes', [ $this, 'update_themes' ] );
			// Deferred download.
			add_action( 'upgrader_package_options', [ $this, 'deferred_download' ], 99 );
		}
		
		/**
		 * Disables requests to the wp.org repository for premium themes.
		 *
		 * @since 1.0.0
		 *
		 * @param array  $request An array of HTTP request arguments.
		 * @param string $url The request URL.
		 * @return array
		 */
		public function update_check( $request, $url ) {

			// Theme update request.
			if ( false !== strpos( $url, '//api.wordpress.org/themes/update-check/1.1/' ) ) {

				/**
				 * Excluded theme slugs that should never ping the WordPress API.
				 * We don't need the extra http requests for themes we know are premium.
				 */
				$slug = get_template();

				// Decode JSON so we can manipulate the array.
				$data = json_decode( $request['body']['themes'] );

				// Remove the excluded themes.
				unset( $data->themes->$slug );

				// Encode back into JSON and update the response.
				$request['body']['themes'] = wp_json_encode( $data );
			}

			return $request;
		}

		/**
		 * Update themes
		 *
		 * @return void
		 */
		public function update_themes( $transient ) {
			
			if ( empty( $transient->checked ) || !sf_product_registration()->is_registered() ) {
				return $transient;
			}

			$current_theme_name	=	'';
			$current_theme_version	=	'';
			$theme = wp_get_theme();
			$slug = $theme->get_template();
			
			if( $theme->parent() ) {
				$current_theme_name		= $theme->parent()->get('Name');
				$current_theme_version	= $theme->parent()->get('Version');
			} else {
				$current_theme_name		= $theme->get('Name');
				$current_theme_version	= $theme->get('Version');
			}
			
			$changelog_url = get_template_directory() . '/changelog.txt';

			$themes = sf_product_registration()->api()->themes();

			foreach ( $themes as $theme ) {
				if ( isset( $theme['name'] ) && $current_theme_name == $theme['name'] ) {
					if ( version_compare( $current_theme_version, $theme['version'], '<' ) ) {
						$transient->response[ $slug ] = [
							'theme'       => $slug,
							'new_version' => $theme['version'],
							'url'         => $changelog_url,
							'package'     => sf_product_registration()->api()->deferred_download( $theme['id'] )
						];
					}
					break;
				}
			}

			return $transient;
		}

		/**
		 * Filters the package options before running an update.
		 *
		 * @since 1.0.0
		 *
		 * @param array $options {
		 *     Options used by the upgrader.
		 *
		 *     @type string $package                     Package for update.
		 *     @type string $destination                 Update location.
		 *     @type bool   $clear_destination           Clear the destination resource.
		 *     @type bool   $clear_working               Clear the working resource.
		 *     @type bool   $abort_if_destination_exists Abort if the Destination directory exists.
		 *     @type bool   $is_multi                    Whether the upgrader is running multiple times.
		 *     @type array  $hook_extra {
		 *         Extra hook arguments.
		 *
		 *         @type string $action               Type of action. Default 'update'.
		 *         @type string $type                 Type of update process. Accepts 'plugin', 'theme', or 'core'.
		 *         @type bool   $bulk                 Whether the update process is a bulk update. Default true.
		 *         @type string $plugin               Path to the plugin file relative to the plugins directory.
		 *         @type string $theme                The stylesheet or template name of the theme.
		 *         @type string $language_update_type The language pack update type. Accepts 'plugin', 'theme',
		 *                                            or 'core'.
		 *         @type object $language_update      The language pack update offer.
		 *     }
		 */
		public function deferred_download( $options ) {
			$package = $options['package'];
			if ( false !== strrpos( $package, 'deferred_download' ) && false !== strrpos( $package, 'item_id' ) ) {
				parse_str( wp_parse_url( $package, PHP_URL_QUERY ), $args );
				if ( !empty( $args['item_id'] ) ) {
					$options['package'] = sf_product_registration()->api()->download( $args['item_id'] );
				}
			}
			return $options;
		}
	}
}

new SF_Product_Updater();