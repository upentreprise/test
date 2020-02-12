<?php
/**
 * WooCommerce integration
 *
 * @since   1.0.0
 * @package Talemy/Classes
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Talemy_WooCommerce {

	/**
	 * Hooks
	 */
	public function __construct() {
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 15 );

		add_filter('woocommerce_billing_fields', array( $this, 'billing_fields' ) );
		add_filter('woocommerce_shipping_fields', array( $this, 'shipping_fields' ) );

		add_filter( 'woocommerce_product_additional_information_heading', '__return_empty_string' );
		add_filter( 'woocommerce_product_description_heading', '__return_empty_string' );

		// Restructure products Loop.
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

		add_action( 'woocommerce_before_shop_loop_item', array( $this, 'before_shop_loop_item' ) , 5 );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'before_shop_loop_item_title' ), 30 );
		add_action( 'woocommerce_shop_loop_item_title', array( $this, 'shop_loop_item_title' ), 10 );
		add_action( 'woocommerce_after_shop_loop_item_title', array( $this, 'after_shop_loop_item_title' ), 20 );
		add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 15 );

		// Related & upsell products per page & columns
		add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
		add_filter( 'woocommerce_upsell_display_args', array( $this, 'upsell_products_args' ) );

		add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'cart_item_count_fragment' ), 10, 1 );
		add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) {
			return 'thumbnail';
		} );
	}

	/**
	 * Modify billing fields
	 *
	 * @param array $fields
	 * @return array
	 */
	public function billing_fields( $fields ) {
		$billing_fields = array(
			'billing_first_name' => esc_attr__( 'First name', 'talemy' ),
			'billing_last_name' => esc_attr__( 'Last name', 'talemy' ),
			'billing_company' => esc_attr__( 'Company name', 'talemy' ),
			'billing_country' => esc_attr__( 'Country', 'talemy' ),
			'billing_address_1' => esc_attr__( 'House number and street name', 'talemy' ),
			'billing_city' => esc_attr__( 'Town / City', 'talemy' ),
			'billing_state' => esc_attr__( 'State / County', 'talemy' ),
			'billing_postcode' => esc_attr__( 'Postcode / ZIP', 'talemy' ),
			'billing_phone' => esc_attr__( 'Phone', 'talemy' ),
			'billing_email' => esc_attr__( 'Email address', 'talemy' ),
		);
		foreach ( $billing_fields as $key => $label ) {
			$fields[$key]['placeholder'] = $label;
		}
		$fields['billing_company']['required'] = false;
		$fields['billing_address_2']['required'] = false;
		return $fields;
	}

	/**
	 * Modify shipping fields
	 *
	 * @param array $fields
	 * @return array
	 */
	public function shipping_fields( $fields ) {
		$shipping_fields = array(
			'shipping_first_name' => esc_attr__( 'First name', 'talemy' ),
			'shipping_last_name' => esc_attr__( 'Last name', 'talemy' ),
			'shipping_company' => esc_attr__( 'Company name', 'talemy' ),
			'shipping_country' => esc_attr__( 'Country', 'talemy' ),
			'shipping_address_1' => esc_attr__( 'House number and street name', 'talemy' ),
			'shipping_city' => esc_attr__( 'Town / City', 'talemy' ),
			'shipping_state' => esc_attr__( 'State / County', 'talemy' ),
			'shipping_postcode' => esc_attr__( 'Postcode / ZIP', 'talemy' ),
			'shipping_phone' => esc_attr__( 'Phone', 'talemy' ),
			'shipping_email' => esc_attr__( 'Email address', 'talemy' ),
		);
		foreach ( $shipping_fields as $key => $label ) {
			$fields[$key]['placeholder'] = $label;
		}
		$fields['shipping_company']['required'] = false;
		$fields['shipping_address_2']['required'] = false;
		return $fields;
	}

	/**
	 * Modify related products args
	 *
	 * @param array $args
	 * @return array
	 */
	public function related_products_args( $args ) {
	  	$args['posts_per_page'] = talemy_get_option( 'wc_related_count' );
	  	$args['columns'] = talemy_get_option( 'wc_related_columns' );
		return $args;
	}

	/**
	 * Modify upsell products args
	 *
	 * @param array $args
	 * @return array
	 */
	public function upsell_products_args( $args ) {
	  	$args['posts_per_page'] = talemy_get_option( 'wc_upsell_count' );
	  	$args['columns'] = talemy_get_option( 'wc_upsell_columns' );
		return $args;
	}

	/**
	 * Before shop loop item
	 */
	public function before_shop_loop_item() {
		?>
		<div class="product-body">
			<div class="product-thumb">
		<?php
	}

	/**
	 * Before shop loop item title
	 */
	public function before_shop_loop_item_title() {
		?>
		</a>
		</div>
		<div class="product-info">
		<?php
	}

	/**
	 * Shop loop item title
	 */
	public function shop_loop_item_title() {
		?>
		<h3 class="woocommerce-loop-product__title">
			<a href="<?php echo esc_url_raw( get_the_permalink() ); ?>">
				<?php echo get_the_title(); ?>
			</a>
		</h3>
		<div class="product-meta">
		<?php
	}

	/**
	 * After shop loop item title
	 */
	public function after_shop_loop_item_title() {
		?>
				</div>
				<div class="product-buttons">
					<?php if ( function_exists( 'tinv_get_option' ) ) : ?>
					<?php echo do_shortcode( "[ti_wishlists_addtowishlist loop=yes]" ); ?>
					<?php endif; ?>
					<?php woocommerce_template_loop_add_to_cart(); ?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Updates cart item count
	 * 
	 * @param  array $fragments AJAX fragments handled by WooCommerce.
	 * @return array
	 */
	public function cart_item_count_fragment( $fragments ) {
		$item_count = WC()->cart->get_cart_contents_count();
	    $fragments['span.cart-item-count'] = '<span class="cart-item-count item-count" style="' . esc_attr( $item_count == '0' ? 'display:none;' : '' ) . '">' . esc_html( $item_count ) . '</span>';
	    return $fragments;
	}

	public function enqueue_scripts() {
		$suffix = !TALEMY_DEV_MODE ? '.min' : '';

		wp_register_style(
			'talemy-woocommerce',
			TALEMY_THEME_URI . 'assets/css/woocommerce' . $suffix . '.css',
			false,
			TALEMY_THEME_VERSION
		);

		wp_enqueue_style( 'talemy-woocommerce' );
		wp_style_add_data( 'talemy-woocommerce', 'rtl', 'replace' );
	}
}

if ( class_exists( 'WooCommerce' ) ) {
	new Talemy_WooCommerce();
}

