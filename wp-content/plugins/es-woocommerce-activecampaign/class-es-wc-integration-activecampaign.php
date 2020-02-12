<?php
namespace ESWC;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * ActiveCampaign Integration
 *
 * Allows integration with ActiveCampaign
 *
 * @class 		ES_WC_Integration_ActiveCampaign
 * @extends		WC_Integration
 * @version		1.9.13
 * @package		WooCommerce ActiveCampaign
 * @author 		EqualServing
 */

class ES_WC_Integration_ActiveCampaign extends \WC_Integration {

	protected $activecampaign_lists, $product_lists;

	/**
	 * Init and hook in the integration.
	 *
	 * @access public
	 * @return void
	 */

	public function __construct() {

		$this->id					= 'activecampaign';
		$this->method_title     	= __( 'ActiveCampaign', 'es_wc_activecampaign' );
		$this->method_description	= __( 'ActiveCampaign is a marketing automation service.', 'es_wc_activecampaign' );
		$this->error_msg            = '';
		$this->dependencies_found = 1;

		if ( !class_exists( '\ESWC\AC\ActiveCampaign' ) ) {
			include_once( 'includes/ActiveCampaign.class.php' );
		}

		$this->activecampaign_url = "";
		$this->activecampaign_key  = "";
		$this->set_url();
		$this->set_key();

		$this->activecampaign_lists = array();
		$this->activecampaign_tags_list = array();

		// Get setting values
		$this->enabled        = $this->get_option( 'enabled' );
		$this->logdata        = $this->get_option( 'logdata' );
		$this->get_ac_lists();
		$this->get_ac_tags_list();

		// Load the settings
		$this->init_form_fields();
		$this->init_settings();

		$this->occurs         = $this->get_option( 'occurs' );

		$this->list           = $this->get_option( 'list' );
		$this->double_optin   = $this->get_option( 'double_optin' );
		$this->groups         = $this->get_option( 'groups' );
		$this->display_opt_in = $this->get_option( 'display_opt_in' );
		$this->opt_in_label   = $this->get_option( 'opt_in_label' );
		$this->opt_in_position   = $this->get_option( 'opt_in_position' );
		$this->tag_purchased_products	= $this->get_option( 'tag_purchased_products' );
		$this->purchased_product_tag_prefix = $this->get_option('purchased_product_tag_prefix');
		$this->purchased_product_tag_add = $this->get_option('purchased_product_tag_add');

		$this->contact_tag = $this->get_option('contact_tag');

		// Hooks
		add_action( 'admin_notices', array( &$this, 'checks' ) );
		add_action( 'woocommerce_update_options_integration', array( $this, 'process_admin_options') );

		// We would use the 'woocommerce_new_order' action but first name, last name and email address (order meta) is not yet available,
		// so instead we use the 'woocommerce_checkout_update_order_meta' action hook which fires at the end of the checkout process after the order meta has been saved
		add_action( 'woocommerce_checkout_update_order_meta', array( &$this, 'order_status_changed' ), 10, 1 );

		// hook into woocommerce order status changed hook to handle the desired subscription event trigger
		add_action( 'woocommerce_order_status_changed', array( &$this, 'order_status_changed' ), 10, 3 );

		if ($this->enabled == 'yes') {
			if ( 'yes' == $this->display_opt_in || 'uncheck' == $this->display_opt_in ) {
				if ($this->opt_in_position == 'yes') {
					add_action( 'woocommerce_before_order_notes', array( &$this, 'subscribe_checkbox') );
				} elseif ($this->opt_in_position == 'before_place_order') {
					add_action( 'woocommerce_review_order_before_submit', array( &$this, 'subscribe_checkbox') );
				} else {
					add_action( 'woocommerce_after_order_notes', array( &$this, 'subscribe_checkbox') );
				}
			}
		}

		// Maybe save the "opt-in" field on the checkout
		add_action( 'woocommerce_checkout_update_order_meta', array( &$this, 'maybe_save_checkout_fields' ) );

		// Display field value on the order edit page
		add_action( 'woocommerce_admin_order_data_after_billing_address', array( &$this, 'checkout_field_display_admin_order_meta') );

	}

	/**
	 * Check if the user has enabled the plugin functionality, but hasn't provided an api key.
	 *
	 * @access public
	 * @return void
	 */

	public function checks() {
		global $pagenow;

		if ( $error = get_transient( "es_wc_activecampaign_errors" ) ) { ?>
		    <div class="error">
		        <p><strong>ActiveCampaign error</strong>: <?php echo $error; ?></p>
		    </div><?php

		    delete_transient("es_wc_activecampaign_errors");
		}

		if ($pagenow == "admin.php" && isset($_REQUEST["page"]) && $_REQUEST["page"] == "wc-settings" && isset($_REQUEST["tab"]) && $_REQUEST["tab"] == "integration") {
			if ( $this->enabled == 'yes' ) {
				// Check required fields
				if(!$this->has_api_info()) {
					if (!$this->has_key() && !$this->has_url()) {
						echo '<div class="error"><p>' . sprintf( __('<strong>ActiveCampaign error</strong>: Please enter your API URL and Key <a href="%s">here</a>', 'es_wc_activecampaign'), admin_url('options-general.php?page=activecampaign' ) ) . '</p></div>';
					} elseif (!$this->has_key() ) {
						echo '<div class="error"><p>' . sprintf( __('<strong>ActiveCampaign error</strong>: Please enter your API Key <a href="%s">here</a>', 'es_wc_activecampaign'), admin_url('options-general.php?page=activecampaign' ) ) . '</p></div>';
					} elseif (!$this->has_url()) {
						echo '<div class="error"><p>' . sprintf( __('<strong>ActiveCampaign error</strong>: Please enter your API Key <a href="%s">here</a>', 'es_wc_activecampaign'), admin_url('options-general.php?page=activecampaign' ) ) . '</p></div>';
					}
					return;
				} else {
					$this->set_url();
					$this->set_key();
					$api = new AC\ActiveCampaign($this->activecampaign_url, $this->activecampaign_key);
            	    if (!$api->credentials_test()) {
						//echo '<div class="error"><p>' . sprintf(__('<strong>ActiveCampaign error</strong>: <strong>%s</strong>.<br />Access denied - Invalid credentials (API URL and/or API key).', 'es_wc_activecampaign'),$api->curl_response_error->error) . '</p><p>' . __('If you verified your credentials and you know they are correct, there may be a problem with the ActiveCampaign API. Please check <a href="http://status.activecampaign.com/" target="_blank">http://status.activecampaign.com/</a> for more information.', 'es_wc_activecampaign')."</p></div>";
						$msg = "<p>".sprintf("ActiveCampaign error results: \n\t result_code: %s\n\t result_message: %s\n\t result_output: %s\n\t http_code: %s\n\t success: %s\n\t error: %s\n",
							$api->curl_response_error->result_code,
							$api->curl_response_error->result_message,
							$api->curl_response_error->result_output,
							$api->curl_response_error->http_code,
							$api->curl_response_error->success,
							$api->curl_response_error->error)."</p>";

						$this->log_this("error", strip_tags($msg));
						$this->error_msg = $msg;
						set_transient("es_wc_activecampaign_errors", $error_msg, 45);
					}
				}
			}
			if ($this->error_msg)
				echo '<div class="error">'.$this->error_msg.'</div>';
		}
	}

	/**
	 * order_status_changed function.
	 *
	 * @access public
	 * @return void
	 */

	public function order_status_changed( $id, $status = 'new', $new_status = 'pending' ) {

		if ($this->logdata == 'yes') {
			$this->log_this("debug", "order_status_changed entering function id: ". $id." status: ".$status." new_status: ".$new_status." is_valid: ". $this->is_valid()." occurs: ".wc_print_r($this->occurs, TRUE)." in_array: ".in_array($new_status, $this->occurs, TRUE));
		}

		if ( $this->is_valid() && in_array($new_status, $this->occurs, TRUE) ) {
			$order = wc_get_order($id);
			$order_data = $order->get_data();
			$item_details = $order->get_items();
			$order_key = $order->get_order_key();
			$order_opt_in = "no";
			if ( ( isset($_POST['es_wc_activecampaign_opt_in']) && $_POST['es_wc_activecampaign_opt_in']) ) {
				$order_opt_in = "yes";
			} else if ($order->get_meta('es_wc_activecampaign_opt_in') !== "") {
				// If the subscribe event is on Order Processing or Order Completed the variable "es_wc_activecampaign_opt_in" will not be in the POST. It must be retrieved from the order meta data.
				$order_opt_in = $order->get_meta('es_wc_activecampaign_opt_in');
			}
			if ($this->logdata == 'yes') {
				$this->log_this("debug", "order_status_changed isset(opt_in): ". isset($_POST['es_wc_activecampaign_opt_in'])." es_wc_activecampaign_opt_in: ".$_POST['es_wc_activecampaign_opt_in']." order_opt_in: ".$order_opt_in." _POST: ".wc_print_r($_POST, true)." items: ".wc_print_r($item_details, TRUE));
			}

			// If the 'es_wc_activecampaign_opt_in' meta value isn't set (because 'display_opt_in' wasn't enabled at the time the order was placed) or the 'es_wc_activecampaign_opt_in' is yes, subscribe the customer
			//if ( ($this->display_opt_in == 'yes' && isset($_POST['es_wc_activecampaign_opt_in']) && $_POST['es_wc_activecampaign_opt_in']) || (isset($this->display_opt_in) && $this->display_opt_in == 'no' )  || (isset($this->display_opt_in) && $this->display_opt_in == 'uncheck' ) ) {
			if ( $order_opt_in == "yes" || (isset($this->display_opt_in) && $this->display_opt_in == 'no' )) {

				if ($this->logdata == 'yes') {
					$this->log_this("debug", "order_status_changed isset(opt_in): ". isset($_POST['es_wc_activecampaign_opt_in'])." es_wc_activecampaign_opt_in: ".$_POST['es_wc_activecampaign_opt_in']. " display_opt_in: ".$this->display_opt_in );
				}

				$this->subscribe(
									$order_data['billing']['first_name'],
									$order_data['billing']['last_name'],
									$order_data['billing']['email'],
									$order_data['billing']['phone'],
									$order_data['billing']['address_1'],
									$order_data['billing']['address_2'],
									$order_data['billing']['city'],
									$order_data['billing']['state'],
									$order_data['billing']['postcode'],
									$this->list,
									$item_details,
									$new_status);
			}
		}
	}

	/**
	 * has_list function - have the ActiveCampaign lists been retrieved.
	 *
	 * @access public
	 * @return boolean
	 */

	public function has_list() {
		if ( $this->list )
			return true;
	}

	/**
	 * has_appid function - has the ActiveCampaign URL and Key been entered.
	 *
	 * @access public
	 * @return boolean
	 */

	public function has_api_info() {
		if ( $this->activecampaign_url && $this->activecampaign_key )
			return true;
	}

	/**
	 * has_appid function - has the ActiveCampaign URL been entered.
	 *
	 * @access public
	 * @return boolean
	 */

	public function has_url() {
		if ( $this->activecampaign_url )
			return true;
	}

	/**
	 * set_url function - set the ActiveCampaign URL property.
	 *
	 * @access public
	 * @return void
	 */

	public function set_url() {

		if (get_option("woocommerce_activecampaign_settings")) {
			$ac_settings = get_option("woocommerce_activecampaign_settings");
			$this->activecampaign_url = $ac_settings["activecampaign_url"];
		}
	}

	/**
	 * has_key function - has the ActiveCampaign Key been entered.
	 *
	 * @access public
	 * @return boolean
	 */

	public function has_key() {
		if ( $this->activecampaign_key )
			return true;
	}

	/**
	 * set_key function - set the ActiveCampaign Key property.
	 *
	 * @access public
	 * @return void
	 */

	public function set_key() {

		if (get_option("woocommerce_activecampaign_settings")) {
			$ac_settings = get_option("woocommerce_activecampaign_settings");
			$this->activecampaign_key = $ac_settings["activecampaign_key"];
		}
	}

	/**
	 * is_valid function - is ActiveCampaign ready to accept information from the site.
	 *
	 * @access public
	 * @return boolean
	 */

	public function is_valid() {
		if ( $this->enabled == 'yes' && $this->has_api_info() && $this->has_list() ) {
			return true;
		}
		return false;
	}

	/**
	 * Initialize Settings Form Fields
	 *
	 * @access public
	 * @return void
	 */

	public function init_form_fields() {
		if ( is_admin() ) {
			if ($this->has_api_info()) {
				array_merge( array( '' => __('Select a list...', 'es_wc_activecampaign' ) ), $this->activecampaign_lists );
			} else {
				array( '' => __( 'Enter your key and save to see your lists', 'es_wc_activecampaign' ) );
			}
			if (get_option("woocommerce_activecampaign_settings")) {
				$ac_settings = get_option("woocommerce_activecampaign_settings");
				if ($ac_settings) {
					$default_ac_url = $ac_settings["activecampaign_url"];
					$default_ac_key = $ac_settings["activecampaign_key"];
				}

			// If ActiveCampaign's plugin is installed and configured, collect the URL and Key from their their plugin for the inital default values.
			} else if (get_option("settings_activecampaign")) {
				$ac_settings = get_option("settings_activecampaign");
				if ($ac_settings) {
					$default_ac_url = $ac_settings["api_url"];
					$default_ac_key = $ac_settings["api_key"];
				}
			} else {
				$default_ac_url = "";
				$default_ac_key = "";
			}

			$list_help = 'All customers will be added to this list. <a href="admin.php?'.http_build_query(array_merge($_GET, array("reset"=>"yes"))).'">Click here to reset lists and tags</a>.';
			if (empty($this->activecampaign_lists)) {
				$list_help .= '<br /><strong>NOTE: If this dowpdown list is empty AND you have entered the API URL and Key correctly, please save your settings and reload the page. <a href="'.$_SERVER['REQUEST_URI'].'">[Click Here]</a></strong>';
			}

			$this->form_fields = array(
				'enabled' => array(
								'title' => __( 'Enable/Disable', 'es_wc_activecampaign' ),
								'label' => __( 'Enable ActiveCampaign', 'es_wc_activecampaign' ),
								'type' => 'checkbox',
								'description' => '',
								'default' => 'no',
							),
				'logdata' => array(
								'title' => __( 'Log API Data', 'es_wc_activecampaign' ),
								'label' => __( 'Enable Logging of API calls to ActiveCampaign', 'es_wc_activecampaign' ),
								'type' => 'checkbox',
								'description' => '',
								'default' => 'no',
							),
				'activecampaign_url' => array(
								'title' => __( 'ActiveCampaign API URL', 'es_wc_activecampaign' ),
								'type' => 'text',
								'description' => __( '<a href="http://www.activecampaign.com/help/using-the-api/" target="_blank">Login to activecampaign</a> to look up your api url.', 'es_wc_activecampaign' ),
								'default' => $default_ac_url
							),
				'activecampaign_key' => array(
								'title' => __( 'ActiveCampaign API Key', 'es_wc_activecampaign' ),
								'type' => 'text',
								'description' => __( '<a href="http://www.activecampaign.com/help/using-the-api/" target="_blank">Login to activecampaign</a> to look up your api key.', 'es_wc_activecampaign' ),
								'default' => $default_ac_key
							),
				'occurs' => array(
								'title' => __( 'Subscribe Event', 'es_wc_activecampaign' ),
								'type' => 'multiselect',
								'description' => __( 'When should customers be subscribed to lists?', 'es_wc_activecampaign' ),
								'css' => 'height: 100%;',
								'default' => 'pending',
								'options' => array(
									'pending' => __( 'Order Created', 'es_wc_activecampaign' ),
									'processing' => __( 'Order Processing', 'es_wc_activecampaign' ),
									'completed'  => __( 'Order Completed', 'es_wc_activecampaign' ),
									'on-hold'  => __( 'Order On Hold', 'es_wc_activecampaign' ),
									'cancelled'  => __( 'Order Cancelled', 'es_wc_activecampaign' ),
									'refunded'  => __( 'Order Refunded', 'es_wc_activecampaign' ),
									'failed'  => __( 'Order Failed', 'es_wc_activecampaign' ),
								),
							),
				'list' => array(
								'title' => __( 'Main List', 'es_wc_activecampaign' ),
								'type' => 'select',
								'description' => __( $list_help, 'es_wc_activecampaign' ),
								'default' => '',
								'options' => $this->activecampaign_lists,
							),
				'contact_tag' => array(
								'title' => __( 'Contact Tag', 'es_wc_activecampaign' ),
								'type' => 'select',
								'description' => __( 'When a WooCommerce customer is added to your ActiveCampaign contacts, you can tag them. Select the tag for this purpose. The number in the parethesis is the number of contacts already associated with this tag.', 'es_wc_activecampaign' ),
								'default' => '',
								'options' => $this->activecampaign_tags_list,
							),

				'display_opt_in' => array(
								'title'       => __( 'Display Opt-In Field', 'es_wc_activecampaign' ),
								'label'       => __( 'Display an Opt-In Field on Checkout', 'es_wc_activecampaign' ),
								'type'        => 'select',
								'default'     => 'no',
								'description' => __( 'If Visible, checked by default or Visible, unchecked by default is chosen, customers will be presented with an "Opt-in" checkbox during checkout and will ONLY be added to the <strong>Main List</strong> above IF they opt-in. If Hidden, checked by default is chosen, ALL customers will be added to the <strong>Main List</strong>.', 'es_wc_activecampaign' ),
								'options' => array(
									'yes' => __( 'Visible, checked by default', 'es_wc_activecampaign' ),
									'uncheck' => __( 'Visible, unchecked by default', 'es_wc_activecampaign' ),
									'no'  => __( 'Hidden, checked by default', 'es_wc_activecampaign' ),
								),
							),

				'opt_in_label' => array(
								'title'       => __( 'Opt-In Field Label', 'es_wc_activecampaign' ),
								'type'        => 'text',
								'description' => __( 'Optional: customize the label displayed next to the opt-in checkbox.', 'es_wc_activecampaign' ),
								'default'     => __( 'Add me to the newsletter (we will never share your email).', 'es_wc_activecampaign' ),
							),
/*
				'opt_in_position' => array(
								'title'       => __( 'Opt-In Field Position Above Order Notes', 'es_wc_activecampaign' ),
								'type'        => 'checkbox',
								'description' => __( 'By default, the Opt-In Field will appear below the Order Notes. If you would like the Opt-In Field to appear above the Order Notes, please check the box.', 'es_wc_activecampaign' ),
								'default'     => 'no',
							),
*/
				'opt_in_position' => array(
								'title'       => __( 'Opt-In Field Position Above Order Notes', 'es_wc_activecampaign' ),
								'type'        => 'select',
								'description' => __( 'By default, the Opt-In Field will appear below the Order Notes. If you would like the Opt-In Field to appear above the Order Notes, please select the option.', 'es_wc_activecampaign' ),
								'default'     => 'no',
								'options' => array(
									'no'  => __( 'Below the Order Notes', 'es_wc_activecampaign' ),
									'yes' => __( 'Above the Order Notes', 'es_wc_activecampaign' ),
									'before_place_order' => __( 'Before Place Order button', 'es_wc_activecampaign' ),
								),
							),
				'tag_purchased_products' => array(
								'title'       => __( 'Tag Products Purchased', 'es_wc_activecampaign' ),
								'label'       => __( 'Tag all products purchased via Woocommerce.', 'es_wc_activecampaign' ),
								'type'        => 'checkbox',
								'description' => __( 'If enabled, all customers added to ActiveCampaign via a purchase through Woocommerce will be tagged with the product id.', 'es_wc_activecampaign' ),
								'default'     => 'no',
							),
				'purchased_product_tag_prefix' => array(
								'title'       => __( 'Purchased Product Tag Prefix', 'es_wc_activecampaign' ),
								'type'        => 'text',
								'description' => __( 'If Tag Products Purchased is enabled, customers added to ActiveCampaign via a purchase through WooCommerce will be tagged with this prefix and the product id of all products purchased.<br><span style="color:#f00;"><strong>Please note</strong>: The next major release of this plugin will eliminate this field. Please use Purchased Product Additional Tags below instead.</span>', 'es_wc_activecampaign' ),
								'default'     => __( 'Purchased Product', 'es_wc_activecampaign' ),
								'desc_tip'    => __( 'If Tag Products Purchased is enabled, customers added to ActiveCampaign via a purchase through WooCommerce will be tagged with this prefix and the product id of all products purchased.', 'es_wc_activecampaign'),
							),
				'purchased_product_tag_add' => array(
								'title'       => __( 'Purchased Product Additional Tags', 'es_wc_activecampaign' ),
								'type'        => 'text',
								'description' => __( 'If Tag Products Purchased is enabled, customers added to ActiveCampaign via WooCommerce can be tagged with this additional information. Supported placeholders: #NAME#, #STATUS#, #SKU#, #ID#, #QTY#, #IDWVAR#. If you want to tag your contacts with the product SKU of all the products they buy, just enter #SKU# in the field above. To tag customers with the product category, enter #CAT#.  To tag customers with the SKU and Order Status, enter "#SKU# - #STATUS#." To tag customers with both the product SKU and product category, enter "#SKU#, #CAT#". PLEASE NOTE the comma between the two placeholders. This will generate two separate tags. If the comma is omitted, one tag will be applied with the SKU and category name in it. If this field is left blank, NO tag will be applied.', 'es_wc_activecampaign' ),

								'default'     => __( '', 'es_wc_activecampaign' ),
								'desc_tip'    => __( 'If Tag Products Purchased is enabled, customers added to ActiveCampaign via WooCommerce can be tagged with this additional information. Supported placeholders: #NAME#, #STATUS#, #SKU#, #ID#, #QTY#, #IDWVAR#. If you want to tag your contacts with the product SKU of all the products they buy, just enter #SKU# in the field above. To tag customers with the product category, enter #CAT#. To tag customers with the SKU and Order Status, enter "#SKU# - #STATUS#." To tag customers with both the product SKU and product category, enter "#SKU#, #CAT#". PLEASE NOTE the comma between the two placeholders. This will generate two separate tags. If the comma is omitted, one tag will be applied with the SKU and category name in it. If this field is left blank, NO tag will be applied.', 'es_wc_activecampaign'),

							),
			);
		}
	} // End init_form_fields()

	/**
	 * get_ac_lists function - retrieve the active lists created in ActiveCampaign.
	 *
	 * @access public
	 * @return void
	 */

	public function get_ac_lists() {
		if ( is_admin() && $this->has_api_info() ) {
			if (isset($_REQUEST["reset"]) && $_REQUEST["reset"] == "yes") {
				delete_transient( 'es_wc_activecampaign_list_' . md5( $this->activecampaign_key ) );
			}
			if ( ! get_transient( 'es_wc_activecampaign_list_' . md5( $this->activecampaign_key ) ) ) {

				$this->activecampaign_lists = array();

				$api = new AC\ActiveCampaign($this->activecampaign_url, $this->activecampaign_key);

				try {

					$retval = $api->api("list/list_", array("ids" => "all"));
					if ($this->logdata == 'yes') {
						//$this->log_this("debug", "get_ac_lists (list/list_) retval: ". wc_print_r($retval, true));
						$total = count((array)$retval);
						$this->log_this("debug", "get_ac_lists (list/list_) number of elements returned: ". $total);
					}

					if ($retval && is_object($retval)) {
						foreach ( $retval as $list ) {
							if (is_object($list)) {
								$this->activecampaign_lists["es|".$list->id ] = $list->name;
							}
						}
					}
					if ($retval->result_code == 0) {
						if (isset($retval->result_message)) {
							$error_msg = sprintf( __( 'Unable to retrieve lists from ActiveCampaign: %s', 'es_wc_activecampaign' ), $retval->result_message );
						} else {
							$error_msg = sprintf( __( 'Unable to retrieve lists from ActiveCampaign: %s', 'es_wc_activecampaign' ), wc_print_r($retval, true) );
						}
						$this->log_this("error", $error_msg);

						set_transient("es_wc_activecampaign_errors", $error_msg, 45);

						//echo '<div class="error"><p>' . __('<strong>ActiveCampaign error</strong>: '.$error_msg, 'es_wc_activecampaign') . '</p></div>';

						// Email admin
						//$error_msg = '<p><strong>' . sprintf( __( 'Unable to retrieve lists from ActiveCampaign: %s', 'es_wc_activecampaign' ), $retval->result_message ) . '</strong></p>';

						//wp_mail( get_option('admin_email'), __( 'Retrieve lists failed (ActiveCampaign)', 'es_wc_activecampaign' ), ' ' . $error_msg );

					}

					if ( sizeof( $this->activecampaign_lists ) > 0 )
						set_transient( 'es_wc_activecampaign_list_' . md5( $this->activecampaign_key ), $this->activecampaign_lists, 60*60*1 );

				} catch (Exception $oException) { // Catch any exceptions
		       		if ($api->error) {
						$errors = $api->error;
						foreach ($errors->errors as $error) {
							$error_msg .= $error;
						}

						// Email admin
						$error_msg = sprintf( __( 'Unable to retrieve lists from ActiveCampaign: %s', 'es_wc_activecampaign' ), $error_msg ) ;
						$this->log_this("error", $error_msg);
						set_transient("es_wc_activecampaign_errors", $error_msg, 45);

						wp_mail( get_option('admin_email'), __( 'Retrieve lists failed (ActiveCampaign)', 'es_wc_activecampaign' ), ' ' . $error_msg );
					}
				}
			} else {
				$this->activecampaign_lists = get_transient( 'es_wc_activecampaign_list_' . md5( $this->activecampaign_key ));
			}
		}
	}


	/**
	 * get_ac_lists function - retrieve the active lists created in ActiveCampaign.
	 *
	 * @access public
	 * @return void
	 */

	public function get_ac_tags_list() {
		if ( is_admin() && $this->has_api_info() ) {
			if (isset($_REQUEST["reset"]) && $_REQUEST["reset"] == "yes") {
				delete_transient( 'es_wc_activecampaign_tags_list_' . md5( $this->activecampaign_key ) );
			}
			if ( ! get_transient( 'es_wc_activecampaign_tags_list_' . md5( $this->activecampaign_key ) ) ) {

				$this->activecampaign_tags_list = array();
				$this->activecampaign_tags_list[""] = "Do not apply a tag";

				$api = new \ESWC\AC\ActiveCampaign($this->activecampaign_url, $this->activecampaign_key);

				try {

					$retval = $api->api("tags/list");
					if ($this->logdata == 'yes') {
						//$this->log_this("debug", "get_ac_tags_list (tags/list) retval: ". wc_print_r($retval, true));
						$total = count((array)$retval);
						$this->log_this("debug", "get_ac_tags_list (tags/list) number of elements returned: ". $total);
					}

					if ($retval && is_array($retval)) {
						foreach ( $retval as $list ) {
							//var_dump($list);
							if (is_object($list)) {
								//$this->activecampaign_tags_list["es|".$list->id ] = $list->name." (".$list->count.")";
								$this->activecampaign_tags_list[$list->name ] = $list->name;
							}
						}
					} else {

						if (isset($retval->result_message)) {
							$error_msg = sprintf( __( 'Unable to retrieve tags list from ActiveCampaign: %s', 'es_wc_activecampaign' ), $retval->result_message );
						} else {
							$error_msg = sprintf( __( 'Unable to retrieve tags list from ActiveCampaign: %s', 'es_wc_activecampaign' ), wc_print_r($retval, true) );
						}
						$this->log_this("error", $error_msg);

						set_transient("es_wc_activecampaign_errors", $error_msg, 45);

					}

					if ( sizeof( $this->activecampaign_tags_list ) > 0 )
						set_transient( 'es_wc_activecampaign_tags_list_' . md5( $this->activecampaign_key ), $this->activecampaign_tags_list, 60*60*1 );

				} catch (Exception $oException) { // Catch any exceptions
		       		if ($api->error) {
						$errors = $api->error;
						foreach ($errors->errors as $error) {
							$error_msg .= $error;
						}

						// Email admin
						$error_msg = sprintf( __( 'Unable to retrieve tags list from ActiveCampaign: %s', 'es_wc_activecampaign' ), $error_msg );

						$this->log_this("error", $error_msg);

						set_transient("es_wc_activecampaign_errors", $error_msg, 45);

						wp_mail( get_option('admin_email'), __( 'Retrieve tags list failed (ActiveCampaign)', 'es_wc_activecampaign' ), ' ' . $error_msg );
					}
				}
			} else {
				$this->activecampaign_tags_list = get_transient( 'es_wc_activecampaign_tags_list_' . md5( $this->activecampaign_key ));
			}
		}
	}



	/**
	 * subscribe function - if enabled, customer will be subscribed to selected list, if the
	 *                      option to tag the customer with products purchased, that too will
	 *                      be done.
	 *
	 * @access public
	 * @param mixed $first_name
	 * @param mixed $last_name
	 * @param mixed $email
	 * @param mixed $address_1
	 * @param mixed $address_2
	 * @param mixed $city
	 * @param mixed $state
	 * @param mixed $zip
	 * @param string $listid (default: 'false')
	 * @param object $items
	 * @param mixed $status
	 * @return void
	 */

	public function subscribe( $first_name, $last_name, $email, $phone = null, $address_1 = null, $address_2 = null, $city = null, $state = null, $zip = null, $listid = false, $items, $status) {

		if($this->has_api_info()) {

			if ( $listid == false )
				$listid = $this->list;

			if ( !$email || !$listid || !$this->enabled )
				return; // Email and listid is required

			$api = new \ESWC\AC\ActiveCampaign($this->activecampaign_url, $this->activecampaign_key);

			try {

				$tags = array();

				$post = array(
				    'email'				=> $email,
				    'first_name'		=> $first_name,
				    'last_name'			=> $last_name,
				    'phone'				=> $phone
				    );

				$retval = $api->api("contact/sync", $post);
				if ($this->logdata == 'yes') {
					$this->log_this("debug", "Subscribe (contact/sync) post: ".wc_print_r($post, true)." retval: ". wc_print_r($retval, true));
				}
				if ( $retval->result_code == 1 ) {

					if (isset($listid) && $listid != "") {
						$listid = ltrim($listid, "es|");

						$contact = array(
							"email" => $email,
							"p[{$listid}]" => $listid,
							"status[{$listid}]" => 1, // "Active" status
						);

						$retval = $api->api("contact/sync", $contact);
						if ($this->logdata == 'yes') {
							$this->log_this("debug", "Subscribe (contact/sync) contact: ".wc_print_r($contact, true)." retval: ". wc_print_r($retval, true));
						}
					}

					//$this->log_this("debug", "Line # ".__LINE__." Success = ".wc_print_r($retval->result_code, true)." retval = ".wc_print_r($retval, true));

					if ($retval->result_code == 0) {
						if (isset($retval->result_message)) {
							// Email admin
							$error_msg = sprintf( __( "Unable to add contact to list from ActiveCampaign: %s \n", 'es_wc_activecampaign' ), $retval->result_message ) .wc_print_r($contact, true);
						} else {
							// Email admin
							$error_msg = sprintf( __( "Unable to add contact to list from ActiveCampaign: %s \n", 'es_wc_activecampaign' ), wc_print_r($retval, true) ) .wc_print_r($contact, true);
						}
						$this->log_this("error", $error_msg." retval: ". wc_print_r($retval, true));

						wp_mail( get_option('admin_email'), __( 'Subscribe contact failed (ActiveCampaign)', 'es_wc_activecampaign' ), ' ' . $error_msg );

					}

					if ( !empty($this->contact_tag) ) {
						$tags[] = $this->contact_tag;
					}

					if ( $this->tag_purchased_products == 'yes' ) {
						if ( !empty($items) ) {

							foreach ( $items as $item ) {
								$purchased_product_id = $item['product_id'];
								if ($item['variation_id']) {
									if ( $this->tag_purchased_products == 'yes') {
										$tags[] = $this->purchased_product_tag_prefix." ".$item['product_id']." / ".$item['variation_id'];
									}
									$product_details = wc_get_product( $item['variation_id'] );
									$idwvar = $item['product_id']." / ".$item['variation_id'];
								} else {
									if ( $this->tag_purchased_products == 'yes') {
										$tags[] = $this->purchased_product_tag_prefix." ".$item['product_id'];
									}
									$product_details = wc_get_product( $item['product_id'] );
									$idwvar = $item['product_id'];
								}

								$tag_formats = explode(",", $this->purchased_product_tag_add);
								if (!empty($tag_formats) ) {

									$search = array("#NAME#", "#STATUS#", "#SKU#", "#ID#", "#QTY#", '#IDWVAR#');
									$replace = array($product_details->get_name(), $status, $product_details->get_sku(), $item['product_id'], $item['quantity'], $idwvar );
									foreach ($tag_formats as $tag_format) {
										$tag_format = str_replace($search, $replace, $tag_format);

										// Replace product category
										$cpos = strpos($tag_format, "#CAT#");
										if ($cpos !== false) {

											$terms = wp_get_post_terms( $item['product_id'], 'product_cat', array( 'fields' => 'names' ) );
											foreach ($terms as $term) {
												$tags[] = str_replace("#CAT#", $term, $tag_format);
											}
										}
										if ($cpos === FALSE) {
											$tags[] = $tag_format;
										}
									}
								}

								$email_text = 'Product id: '.$item['product_id'].' sku: '.$product_details->get_sku().' categories: ';

								$terms = wp_get_post_terms( $item['product_id'], 'product_cat', array( 'fields' => 'names' ) );
								foreach ($terms as $term) {
									$email_text .= $term.', ';
								}

							}
						}
					}

					if (!empty($tags)) {
						$contact = array(
							"email" => $email,
							"tags" => $tags,
						);
						$retval = $api->api("contact/tag/add", $contact);
						if ($this->logdata == 'yes') {
							$this->log_this("debug", "Subscribe (contact/tag/add) contact: ".wc_print_r($contact, true)." retval: ". wc_print_r($retval, true));
						}

						if ($retval->result_code == 0) {
							if (isset($retval->result_message)) {
								// Email admin
								$error_msg = sprintf( __( "Unable to tag contact from ActiveCampaign: %s \n", 'es_wc_activecampaign' ), $retval->result_message ) ."\n".wc_print_r($contact, true);
							} else {
								// Email admin
								$error_msg = sprintf( __( "Unable to tag contact from ActiveCampaign: %s \n", 'es_wc_activecampaign' ), wc_print_r($retval, true) ) ."\n".wc_print_r($contact, true);
							}
							$this->log_this("error", $error_msg);

							wp_mail( get_option('admin_email'), __( 'Tag contact failed (ActiveCampaign)', 'es_wc_activecampaign' ), ' ' . $error_msg );

						}
					}

				} else {

					if (isset($retval->result_message)) {
						$msg = sprintf( __( "Unable to add contact to list from ActiveCampaign.\n\tError message: %s \n\t\t Email: %s \n\t\t First name: %s \n\t\t Last name: %s\n", 'es_wc_activecampaign'), $retval->result_message, $post['email'], $post['first_name'], $post['last_name'] );
					} else {
						$msg = sprintf( __( "Unable to add contact to list from ActiveCampaign.\n\tError message: %s \n\t\t Email: %s \n\t\t First name: %s \n\t\t Last name: %s\n", 'es_wc_activecampaign'), wc_print_r($retval, true), $post['email'], $post['first_name'], $post['last_name'] );
					}
					$tags = "";

					if ( $this->tag_purchased_products == 'yes' ) {
						if ( !empty($items) ) {
							$msg .= sprintf( __( "\t %s was not tagged for their purchase(s): \n", 'es_wc_activecampaign'), $post['email']);

							foreach ( $items as $item ) {
							    $purchased_product_id = $item['product_id'];
							    if ($item['variation_id']) {
							    	$tags .= $this->purchased_product_tag_prefix." ".$item['product_id']." / ".$item['variation_id'];
							    } else {
							    	$tags .= $this->purchased_product_tag_prefix." ".$item['product_id'];
							    }
							    $msg .= sprintf( __("\t\t tag: %s \n", 'es_wc_activecampaign'), $tags);
							}
						}
					}
					$this->log_this("error", $msg);

				}

			} catch (Exception $oException) { // Catch any exceptions
	       		if ($api->error_msg) {
					$errors = $api->error_msg;
					foreach ($errors->errors as $error) {
						$error_msg .= $error;
					}

					// Email admin

					$error_msg = sprintf( __( 'Unable to subscribe a new contact into ActiveCampaign: %s', 'es_wc_activecampaign' ), $error_msg ) ;

					$this->log_this("error", $error_msg);

					wp_mail( get_option('admin_email'), __( 'Email subscription failed (ActiveCampaign)', 'es_wc_activecampaign' ), ' ' . $error_msg);

				}
			}
		}
	}

	/**
	 * Admin Panel Options
	 */

	function admin_options() {
		echo '<table><tboby><tr><td>';
		echo '<div class="column-2">';
		echo '<h3>';
		_e( 'ActiveCampaign', 'es_wc_activecampaign' );
		echo '</h3>';
		if ($this->dependencies_found) {
			echo '<p>';
			_e( 'Enter your ActiveCampaign settings below to control how WooCommerce integrates with your ActiveCampaign lists.', 'es_wc_activecampaign' );
			echo '</p>';
    		echo '<table class="form-table">';
	    	$this->generate_settings_html();
			echo '</table><!--/.form-table-->';
		} else {
			echo "<p>".$this->error_msg."</p>";
		}
		echo '</div>';
		echo '</td><td width="130" style="vertical-align:middle;text-align:center;border-left: 1px solid #cdd0d4;border-bottom: 1px solid #cdd0d4;">';
		echo '<span style="display:block;vertical-align:top;text-align:center;border-bottom:rgb(204, 204, 204) 1px solid;padding:10px 5px 20px 5px;margin:20px 0;background-color:#3576ba;"><h3 style="color:#fff;">Having problems?</h3><ul><li>
		<a target="_blank" href="https://www.equalserving.com/how-to-configure-our-woocommerce-activecampaign-plugin/" style="color:#fff;">Configuration instructions.</a></li><li>
		<a target="_blank" href="https://equalserving.com/support" style="color:#fff;">Check our Knowledge Base for solutions.</a></li></ul></span>';
		echo '<span style="display:block;vertical-align:top;text-align:center;border-bottom:rgb(204, 204, 204) 1px solid;padding-bottom:10px;;margin-bottom:10px"><a target="_blank" href="https://www.siteground.com/wordpress-hosting.htm?afbannercode=867664d872abb760d9caaec6e63cc690"><img src="https://ua.siteground.com/img/banners/general/2019_EN/no_price/wp_120x600_blue.jpg" alt="SiteGround Web Hosting" width="120" height="600" border="0"></a></span>';
		echo '<span style="vertical-align:top;text-align:center;border-bottom:rgb(204, 204, 204) 1px solid;margin-top:10px;"><a target="_blank" href="https://shareasale.com/r.cfm?b=1081122&amp;u=651899&m=74778&urllink=&afftrack="><img src="https://static.shareasale.com/image/74778/120x600.jpg" border="0" alt="WP Rocket - WordPress Caching Plugin" /></a></span>';
		echo '</td></tr></tbody></table>';

	}

	/**
	 * opt-in function - Add the opt-in checkbox to the checkout fields (to be displayed on checkout).
	 */

	function subscribe_checkbox( $checkout ) {

		if (empty($checkout)) {
			woocommerce_form_field( 'es_wc_activecampaign_opt_in', array(
				'type'	=> 'checkbox',
				'class'	=> array('eswcac-field form-row-wide'),
				'label'	=> esc_attr( $this->opt_in_label ),
				'default' => ('yes' == $this->display_opt_in ? 1 : 0),
				)
			);

		} else {
			woocommerce_form_field( 'es_wc_activecampaign_opt_in', array(
				'type'	=> 'checkbox',
				'class'	=> array('eswcac-field form-row-wide'),
				'label'	=> esc_attr( $this->opt_in_label ),
				'default' => ('yes' == $this->display_opt_in ? 1 : 0),
				), $checkout->get_value( 'es_wc_activecampaign_opt_in' )
			);

		}

	}

	/**
	 * save opt-in function - When the checkout form is submitted, save opt-in value.
	 *
	 * @access public
	 * @param integer $order_id
	 * @return void
	 */

	function maybe_save_checkout_fields( $order_id ) {
		$opt_in = isset( $_POST['es_wc_activecampaign_opt_in'] ) ? 'yes' : 'no';
		update_post_meta( $order_id, 'es_wc_activecampaign_opt_in', $opt_in );
	}

	/**
	 * display opt-in function - Display the opt-in value on the order details.
	 *
	 * @access public
	 * @param mixed $order
	 * @return void
	 */

	function checkout_field_display_admin_order_meta($order){
    	echo '<p><strong>'.__('ActiveCampaign Subscribe Opt In').':</strong> <br/>' . get_post_meta( $order->id, 'es_wc_activecampaign_opt_in', true ) . '</p>';
	}

	function log_this($type, $msg) {
		$logger = wc_get_logger();
 		$logger_context = array( 'source' => $this->id );
		$logger->log( $type, $msg, $logger_context );
	}

}
