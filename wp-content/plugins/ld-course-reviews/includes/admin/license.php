<?php

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

class LDCR_License {

	/**
	 * Static property to hold our singleton instance
	 *
	 */
	private static $instance = null;

	/**
	 * Is ld-course-reviews supported?
	 *
	 * @var boolean
	 */
	private static $theme_support = false;

	/**
	 * If an instance exists, this returns it.  If not, it creates one and
	 * retuns it.
	 *
	 * @return LDCR_License
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
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'ld-course-reviews' ), '1.0' );
	}

	/**
	 * Disable unserializing of the class.
	 *
	 * @access protected
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'ld-course-reviews' ), '1.0' );
	}

    /**
     * Define constants
     */
    public function constants() {
		define( 'LDCR_STORE_URL', 'https://themespirit.com' );
		define( 'LDCR_ITEM_NAME', 'LearnDash Course Reviews' );
		define( 'LDCR_ITEM_ID', 4138 );
		define( 'LDCR_PLUGIN_LICENSE_PAGE', 'edit.php?post_type=ldcr_review&page=ldcr_license' );
    }

    /**
     * Define constants
     */
    public function includes() {
		if ( !class_exists( 'LDCR_Plugin_Updater' ) ) {
			// load our custom updater
			include( dirname( __FILE__ ) . '/updater.php' );
		}
	}
	
	/**
	 * Hooks
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'plugin_updater' ), 0 );
		add_action( 'admin_init', array( $this, 'register_option' ) );
		add_action( 'admin_init', array( $this, 'activate_license' ) );
		add_action( 'admin_init', array( $this, 'deactivate_license' ) );
		add_action( 'admin_notices', array( $this, 'admin_notices' ) );
	}

	/**
	 * Run plugin updater
	 */
	public function plugin_updater() {
		// retrieve our license key from the DB
		$license_key = trim( get_option( 'ldcr_license_key' ) );
		// setup the updater
		$edd_updater = new LDCR_Plugin_Updater( LDCR_STORE_URL, LDCR_PLUGIN_FILE,
			array(
				'version' => LDCR_VERSION, // current version number
				'license' => $license_key, // license key (used get_option above to retrieve from DB)
				'item_id' => LDCR_ITEM_ID, // ID of the product
				'author'  => 'ThemeSpirit', // author of this plugin
				'beta'    => false
			)
		);
	}

	/**
	 * Register license option
	 */
	public function register_option() {
		// creates our settings in the options table
		register_setting( 'ldcr_license', 'ldcr_license_key', 'ldcr_sanitize_license' );
	}

	/**
	 * Sanitize license
	 */
	public function sanitize_license( $new ) {
		$old = get_option( 'ldcr_license_key' );
		if ( $old && $old != $new ) {
			delete_option( 'ldcr_license_status' ); // new license has been entered, so must reactivate
		}
		return $new;
	}

	/**
	 * Activate license
	 */
	public function activate_license() {

		// listen for our activate button to be clicked
		if ( isset( $_POST['ldcr_license_activate'] ) ) {

			// run a quick security check
			if ( ! check_admin_referer( 'ldcr_activate_nonce', 'ldcr_activate_nonce' ) )
				return; // get out if we didn't click the Activate button

			// get current license key
			$license = isset( $_POST['ldcr_license_key'] ) ? $_POST['ldcr_license_key'] : '';

			// data to send in our API request
			$api_params = array(
				'edd_action' => 'activate_license',
				'license'    => $license,
				'item_name'  => urlencode( LDCR_ITEM_NAME ), // the name of our product in EDD
				'url'        => home_url()
			);

			// Call the custom API.
			$response = wp_remote_post( LDCR_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

			// make sure the response came back okay
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

				if ( is_wp_error( $response ) ) {
					$message = $response->get_error_message();
				} else {
					$message = __( 'An error occurred, please try again.', 'ld-course-reviews' );
				}

			} else {

				$license_data = json_decode( wp_remote_retrieve_body( $response ) );

				if ( false === $license_data->success ) {
					update_option( 'ldcr_license_key', false );

					switch( $license_data->error ) {

						case 'expired' :

							$message = sprintf(
								__( 'Your license key expired on %s.', 'ld-course-reviews' ),
								date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
							);
							break;

						case 'disabled' :
						case 'revoked' :

							$message = __( 'Your license key has been disabled.', 'ld-course-reviews' );
							break;

						case 'missing' :

							$message = __( 'Invalid license.', 'ld-course-reviews' );
							break;

						case 'invalid' :
						case 'site_inactive' :

							$message = __( 'Your license is not active for this URL.', 'ld-course-reviews' );
							break;

						case 'item_name_mismatch' :

							$message = sprintf( __( 'This appears to be an invalid license key for %s.', 'ld-course-reviews' ), LDCR_ITEM_NAME );
							break;

						case 'no_activations_left':

							$message = __( 'Your license key has reached its activation limit.', 'ld-course-reviews' );
							break;

						default :

							$message = __( 'An error occurred, please try again.', 'ld-course-reviews' );
							break;
					}

				} else {
					update_option( 'ldcr_license_key', $license );
				}

			}

			// Check if anything passed on a message constituting a failure
			if ( ! empty( $message ) ) {
				$base_url = admin_url( LDCR_PLUGIN_LICENSE_PAGE );
				$redirect = add_query_arg( array( 'ldcr_activation' => 'false', 'message' => urlencode( $message ) ), $base_url );

				wp_redirect( $redirect );
				exit();
			}

			// $license_data->license will be either "valid" or "invalid"
			update_option( 'ldcr_license_status', $license_data->license );
			wp_redirect( admin_url( LDCR_PLUGIN_LICENSE_PAGE ) );
			exit();
		}
	}

	/**
	 * Deactivate license
	 */
	public function deactivate_license() {
		
		// listen for our activate button to be clicked
		if ( isset( $_POST['ldcr_license_deactivate'] ) ) {

			// run a quick security check
			if ( ! check_admin_referer( 'ldcr_activate_nonce', 'ldcr_activate_nonce' ) )
				return; // get out if we didn't click the Activate button

			// retrieve the license from the database
			$license = trim( get_option( 'ldcr_license_key' ) );


			// data to send in our API request
			$api_params = array(
				'edd_action' => 'deactivate_license',
				'license'    => $license,
				'item_name'  => urlencode( LDCR_ITEM_NAME ), // the name of our product in EDD
				'url'        => home_url()
			);

			// Call the custom API.
			$response = wp_remote_post( LDCR_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

			// make sure the response came back okay
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

				if ( is_wp_error( $response ) ) {
					$message = $response->get_error_message();
				} else {
					$message = __( 'An error occurred, please try again.', 'ld-course-reviews' );
				}

				$base_url = admin_url( LDCR_PLUGIN_LICENSE_PAGE );
				$redirect = add_query_arg( array( 'ldcr_activation' => 'false', 'message' => urlencode( $message ) ), $base_url );

				wp_redirect( $redirect );
				exit();
			}

			// decode the license data
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			// $license_data->license will be either "deactivated" or "failed"
			if ( $license_data->license == 'deactivated' ) {
				delete_option( 'ldcr_license_status' );
			}

			wp_redirect( admin_url( LDCR_PLUGIN_LICENSE_PAGE ) );
			exit();

		}
	}

	/**
	 * Check license
	 */
	public function check_license() {

		global $wp_version;

		$license = trim( get_option( 'ldcr_license_key' ) );

		$api_params = array(
			'edd_action' => 'check_license',
			'license' => $license,
			'item_name' => urlencode( LDCR_ITEM_NAME ),
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( LDCR_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		if ( is_wp_error( $response ) )
			return false;

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		if ( $license_data->license == 'valid' ) {
			echo 'valid'; exit;
		} else {
			echo 'invalid'; exit;
		}
	}

	/**
	 * Admin notices
	 */
	public function admin_notices() {

		if ( isset( $_GET['ldcr_activation'] ) && ! empty( $_GET['message'] ) ) {

			switch( $_GET['ldcr_activation'] ) {

				case 'false':
					$message = urldecode( $_GET['message'] );
					?>
					<div class="error">
						<p><?php echo $message; ?></p>
					</div>
					<?php
					break;

				case 'true':
				default:
					// Developers can put a custom success message here for when activation is successful if they way.
					break;

			}
		}
	}

	/**
	 * Display license form
	 */
	public function form() {
		$license = get_option( 'ldcr_license_key' );
		$status  = get_option( 'ldcr_license_status' );
		?>
		<div id="ldcr-license-page" class="wrap">
			<h1 class="page-title"><?php _e( 'License Option', 'ld-course-reviews' ); ?></h1>
				<form method="post" action="options.php">
					<div class="ldcr-card card" style="padding-bottom:30px;">
						<h3>
							<?php if ( false !== $license && $status !== false && $status == 'valid' ) : ?>
								<span style="color:green;"><?php _e( 'License Actived', 'ld-course-reviews' ); ?></span>
							<?php else: ?>
							<?php _e( 'Enter your license key', 'ld-course-reviews' ); ?>
							<?php endif; ?>
						</h3>
						<?php settings_fields( 'ldcr_license' ); ?>
	
						<p><input id="ldcr_license_key" name="ldcr_license_key" type="text" class="large-text code" value="<?php esc_attr_e( $license ); ?>" /><p>
	
						<?php if ( $status == 'valid' ) : ?>
							<input type="submit" class="button-secondary" name="ldcr_license_deactivate" value="<?php _e( 'Deactivate License', 'ld-course-reviews' ); ?>"/>
							<?php wp_nonce_field( 'ldcr_activate_nonce', 'ldcr_activate_nonce' ); ?>
						<?php else : ?>
							<input type="submit" class="button-primary" name="ldcr_license_activate" value="<?php _e( 'Activate License', 'ld-course-reviews' ); ?>"/>
							<?php wp_nonce_field( 'ldcr_activate_nonce', 'ldcr_activate_nonce' ); ?>
						<?php endif; ?>
	
					</div>
				</form>
			</div>
		</div>
		<?php
	}
}

LDCR_License::instance();

