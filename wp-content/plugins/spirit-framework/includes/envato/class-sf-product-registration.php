<?php 

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'SF_Product_Registration' ) ) {
	/**
	 * SF Product Registration
	 *
	 * @class SF_Product_Registration
	 * @version 1.0.8
	 */
	class SF_Product_Registration {

		/**
		 * The single class instance.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var object
		 */
		private static $_instance = null;

		/**
		 * The setting option name.
		 *
		 * @access private
		 * @var string
		 */
		private $option_name = 'sf_product_data';

		/**
		 * The setting product data
		 *
		 * @access private
		 * @since 1.0.0
		 * @var array
		 */
		private $product_data = [];

		/**
		 * The Envato product ID
		 *
		 * @access private
		 * @since 1.0.0
		 * @var string
		 */
		private $product_id = '';

		/**
		 * The Envato API personal token.
		 *
		 * @access private
		 * @since 1.0.0
		 * @var string
		 */
		private $token = '';

		/**
		 * Envato API response as WP_Error object.
		 *
		 * @access private
		 * @since 1.0.0
		 * @var null|object WP_Error.
		 */
		private $error_log = null;

		/**
		 * Token input field name
		 *
		 * @access private
		 * @since 1.0.0
		 * @var string
		 */
		public $token_field_name = 'sf-input-envato-token';

		/**
		 * Main SF_Product_Registration Instance
		 *
		 * Ensures only one instance of this class exists in memory at any one time.
		 *
		 * @see SF_Product_Registration()
		 * @uses SF_Product_Registration::init_globals() Setup class globals.
		 * @uses SF_Product_Registration::init_includes() Include required files.
		 *
		 * @since 1.0.0
		 * @static
		 * @return SF_Product_Registration.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
				self::$_instance->init_globals();
				self::$_instance->init_includes();
			}
			return self::$_instance;
		}

		/**
		 * A dummy constructor to prevent this class from being loaded more than once.
		 *
		 * @see SF_Product_Registration::instance()
		 *
		 * @since 1.0.0
		 * @access private
		 */
		private function __construct() {
			/* We do nothing here! */
		}

		/**
		 * You cannot clone this class.
		 *
		 * @since 1.0.0
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'spirit' ), '1.0.0' );
		}

		/**
		 * You cannot unserialize instances of this class.
		 *
		 * @since 1.0.0
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'spirit' ), '1.0.0' );
		}

		/**
		 * Setup the variables
		 *
		 * @since 1.0.0
		 * @access private
		 */
		private function init_globals() { 
			$product_data 		= get_option( $this->option_name, [] );
			$this->product_data = !empty( $product_data ) && is_array( $product_data ) ? $product_data : [];
			$this->product_id	= apply_filters( 'sf_envato_item_id', $this->product_id );
			$this->token		= $this->get_option( 'token' );
			$this->plugin_dir	= SF_FRAMEWORK_DIR;
			$this->page_url     = admin_url( 'admin.php?page=sf_welcome' );
		}

		/**
		 * Include required files.
		 *
		 * @since 1.0.0
		 * @access private
		 */
		private function init_includes() {
			require $this->plugin_dir . 'includes/envato/class-sf-envato-api.php';
		}

		/**
		 * Set product registration data.
		 *
		 * @access public
		 * @return void
		 */
		public function set_product_data( $product_data = array() ) {
			if ( empty( $this->product_id ) ) {
				return;
			}

			$option_value = get_option( $this->option_name, [] );

			if ( isset( $option_value[ $this->product_id ] ) || is_array( $option_value ) ) {
				$option_value[ $this->product_id ] = $product_data;
			} else {
				$option_value = [ $this->product_id => $product_data ];
			}

			update_option( $this->option_name, $option_value );
		}

		/**
		 * Set product registration data.
		 *
		 * @access public
		 * @return void
		 */
		public function set_error_log( $error = '' ) {
			$this->error_log = $error;
		}

		/**
		 * Check if product is registered
		 *
		 * @param string $product_id
		 * @return boolean
		 */
		public function is_registered() {
			return ( 'registered' == $this->get_option( 'status' ) ) ? true : false;
		}

		/**
		 * Checks if the product is registered
		 *
		 * @access public
		 * @since 1.0.0
		 */
		public function check_registration() {
			if ( isset( $_POST[ $this->token_field_name ] ) ) {
				// Check security
				check_admin_referer( $this->option_name . '_' . $this->product_id );
				// Sanitize text input
				$token = sanitize_text_field( wp_unslash( $_POST[ $this->token_field_name ] ) );
				// Set new token
				$this->token = $token;
				// Update product data.
				$this->set_product_data( array(
					'token'  => $token,
					'status' => $this->product_exists( $token )
				) );
			}
		}

		/**
		 * Checks if the product has been purchased before
		 *
		 * @access private
		 * @since 1.0.0
		 * @param string $token A token to check.
		 * @param int    $page  The page number if one is necessary.
		 * @return bool
		 */
		private function product_exists( $token = '', $page = '' ) {
			if ( empty( $token ) && 32 !== strlen( $token ) ) {
				return false;
			}
			
			$this->api()->set_token( $token );
			$products = $this->api()->themes();
			
			if ( is_wp_error( $products ) ) {
				$this->error_log = $products;
				return false;
			}

			// Check if product exists in purchase list
			foreach ( $products as $product ) {
				if ( isset( $product['id'] ) && $product['id'] == $this->product_id ) {
					return true;
				}
			}

			// Check the next page if product cannot be found in the first page 
			if ( 100 === count( $products ) ) {
				$page = ( ! $page ) ? 2 : $page + 1;
				return $this->product_exists( $this->token, $page );
			}
			return false;
		}

		/**
		 * Returns the stored purchase code for the product.
		 *
		 * @access public
		 * @param string $product_id The product ID
		 * @return string purchase code.
		 */
		public function get_option( $key = '' ) {
			$data = get_option( $this->option_name, [] );
			return isset( $data[ $this->product_id ][ $key ] ) ? $data[ $this->product_id ][ $key ] : '';
		}

		/**
		 * Return the page URL.
		 *
		 * @since 1.0.0
		 *
		 * @return string
		 */
		public function get_page_url() {
			return $this->page_url;
		}

		/**
		 * Print product registration form
		 *
		 * @return void
		 */
		public function form() {
			$this->check_registration();
			$is_product_registered = $this->is_registered();
			?>
			<p class="about-description">
			<?php if ( $is_product_registered ) {
					esc_html_e( 'Congratulations! Your product is registered now.', 'spirit' );
				} else {
					esc_html_e( 'Please enter your Envato token to complete registration.', 'spirit' );	
				} ?>
			</p>
			<form id="sf-form-registration" class="<?php echo esc_attr( $is_product_registered ? 'is-registered' : '' ); ?>" method="post">
				<div class="sf-input-container">
					<input type="text" name="<?php echo esc_attr( $this->token_field_name ); ?>" class="sf-input-envato-token" value="<?php echo esc_attr( $this->get_option( 'token' ) ); ?>">
					<?php if ( $is_product_registered ) : ?>
						<span class="dashicons dashicons-yes"></span>
					<?php else: ?>
						<span class="dashicons dashicons-admin-network"></span>
					<?php endif; ?>
				</div>
				<?php submit_button( esc_attr__( 'Submit', 'spirit' ), array( 'primary', 'large' ) ); ?>
				<?php wp_nonce_field( $this->option_name . '_' . $this->product_id ); ?>
			</form>
			<?php if ( !$is_product_registered && !empty( $this->api()->get_token() ) ) : ?>
				<p class="error-invalid-token">
					<?php if ( $this->error_log ) : ?>
					<?php echo $this->error_log->get_error_message(); ?>
					<?php else: ?>
					<?php esc_html_e( 'Invalid token, or corresponding Envato account does not have a valid purchase.', 'spirit' ); ?>
					<?php endif; ?>
				</p>
			<?php endif; ?>
			<?php if ( !$is_product_registered ) : ?>
			<div style="font-size:16px;line-height:27px;">
				<hr>
				<h3><?php esc_html_e( 'Instructions For Generating A Token', 'spirit' ); ?></h3>
				<ol>
					<li><?php
						printf( // WPCS: XSS ok.
							__( 'Generate an Envato API Personal Token by %s.', 'spirit' ), // WPCS: XSS ok.
							'<a href="https://build.envato.com/create-token/?user:username=t&purchase:download=t&purchase:verify=t&purchase:list=t" target="_blank">'. esc_html__( 'clicking this link', 'spirit' ) .'</a>'
						);
					?></li>
					<li><?php _e( 'Enter a name for your token, then check the boxes for <strong>View Your Envato Account Username, Download Your Purchased Items, List Purchases You\'ve Made</strong> and <strong>Verify Purchases You\'ve Made</strong> from the permissions needed section. Check the box to agree to the terms and conditions, then click the <strong>Create Token button</strong>', 'spirit' ); // WPCS: XSS ok.
					?>
					</li>
					<li><?php _e( 'A new page will load with a token number in a box. Copy the token number then come back to this registration page and paste it into the field below and click the <strong>Submit</strong> button.', 'spirit' ); // WPCS: XSS ok.
					?>
					</li>
				</ol>
			</div>
			<?php endif;
		}

		/**
		 * SF Envato API class.
		 *
		 * @since 1.0.0
		 *
		 * @return SF_Envato_API
		 */
		public function api() {
			return SF_Envato_API::instance();
		}
	}
}

if ( ! function_exists( 'sf_product_registration' ) ) {
	/**
	 * The main function responsible for returning the one true
	 * SF_Product_Registration Instance to functions everywhere.
	 *
	 * Use this function like you would a global variable, except
	 * without needing to declare the global.
	 *
	 * Example: <?php $sf_product = sf_product_registration(); ?>
	 *
	 * @since 1.0.0
	 * @return SF_Product_Registration The one true SF_Product_Registration Instance
	 */
	function sf_product_registration() {
		return SF_Product_Registration::instance();
	}
}