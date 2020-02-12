<?php
/*
Plugin Name: Woocommerce Zoho Books Integration
Plugin URI:  http://
Description: Integrate Woocommerce with Zoho Books
Version:     1.0.1
Author:      Ratul Bin Hasan
Author URI:  http://codecanyon.net/user/woocommerceintegration
*/
if ( ! defined( 'WPINC' ) ) {
	die;
}


require plugin_dir_path( __FILE__ ) . 'active/options.php';

require plugin_dir_path( __FILE__ ) . 'active/ocp.php';

require plugin_dir_path( __FILE__ ) . 'active/opr.php';
require plugin_dir_path( __FILE__ ) . 'active/ops.php';
require plugin_dir_path( __FILE__ ) . 'active/orf.php';
require plugin_dir_path( __FILE__ ) . 'active/opn.php';
require plugin_dir_path( __FILE__ ) . 'active/sorc.php';
require plugin_dir_path( __FILE__ ) . 'active/ein.php';
require plugin_dir_path( __FILE__ ) . 'active/epm.php';
require plugin_dir_path( __FILE__ ) . 'active/eso.php';



require plugin_dir_path( __FILE__ ) . 'active/wootoqbo.php';


add_action("admin_menu", "add_theme_menu_item1");
add_action("admin_init", "display_theme_panel_fields1");

//Adding Product data tab
add_filter( 'woocommerce_product_data_tabs', 'add_my_custom_product_data_tab1' );
add_action('woocommerce_process_product_meta','woocommerce_product_custom_fields_save1');
add_action( 'woocommerce_product_data_panels', 'add_my_custom_product_data_fields1' );


//Triggering actions
add_action('woocommerce_order_status_completed', 'woobook_ocp');
add_action('woocommerce_order_status_processing', 'woobook_opr');
add_action('woocommerce_thankyou', 'woobook_ops');
add_action('woocommerce_order_status_refunded', 'woobook_orf');
add_action('woocommerce_subscription_renewal_payment_complete', 'woobook_sorc');



if (isset($_REQUEST['go'])) {
bookwoo_bookwoo();
}

if (isset($_REQUEST['gotoqbo'])) {
toquickon();
}

if (isset($_REQUEST['go2'])) {
    woobook_opn();
}










add_filter( 'bulk_actions-edit-shop_order', 'misha_register_bulk_action' ); // edit-shop_order is the screen ID of the orders page
 
function misha_register_bulk_action( $bulk_actions ) {
 
    $bulk_actions['mark_awaiting_shipment'] = 'Export to ZohoBooks as Invoice';

$bulk_actions['mark_awaiting_shipment2'] = 'Export to ZohoBooks as Sales Order';

$bulk_actions['mark_awaiting_shipment3'] = 'Export to ZohoBooks as Payment';

    return $bulk_actions;
 
}
 
/*
 * Bulk action handler
 * Make sure that "action name" in the hook is the same like the option value from the above function
 */
add_action( 'admin_action_mark_awaiting_shipment', 'misha_bulk_process_custom_status' ); // admin_action_{action name}

add_action( 'admin_action_mark_awaiting_shipment2', 'misha_bulk_process_custom_status2' );

add_action( 'admin_action_mark_awaiting_shipment3', 'misha_bulk_process_custom_status3' );
 
add_action('admin_notices', 'misha_custom_order_status_notices');
 
function misha_custom_order_status_notices() {
 
    global $pagenow, $typenow;
 
    if( $typenow == 'shop_order'
     && $pagenow == 'edit.php'
     && isset( $_REQUEST['marked_awaiting_shipment'] )
     && $_REQUEST['marked_awaiting_shipment'] == 1
     && isset( $_REQUEST['changed'] ) ) {
 
        $message = sprintf( _n( 'Exported to quickbooks.', '%s order statuses changed.', $_REQUEST['changed'] ), number_format_i18n( $_REQUEST['changed'] ) );
        echo "<div class=\"updated\"><p>{$message}</p></div>";
 
    }
 
}



//////////////////





add_action('admin_notices', 'misha_custom_order_status_notices2');
 
function misha_custom_order_status_notices2() {
 
    global $pagenow, $typenow;
 
    if( $typenow == 'shop_order'
     && $pagenow == 'edit.php'
     && isset( $_REQUEST['marked_awaiting_shipment2'] )
     && $_REQUEST['marked_awaiting_shipment2'] == 1
     && isset( $_REQUEST['changed'] ) ) {
 
        $message = sprintf( _n( 'Exported to quickbooks.', '%s order statuses changed.', $_REQUEST['changed'] ), number_format_i18n( $_REQUEST['changed'] ) );
        echo "<div class=\"updated\"><p>{$message}</p></div>";
 
    }
 
}





////////////////////////////////



add_action('admin_notices', 'misha_custom_order_status_notices3');
 
function misha_custom_order_status_notices3() {
 
    global $pagenow, $typenow;
 
    if( $typenow == 'shop_order'
     && $pagenow == 'edit.php'
     && isset( $_REQUEST['marked_awaiting_shipment3'] )
     && $_REQUEST['marked_awaiting_shipment3'] == 1
     && isset( $_REQUEST['changed'] ) ) {
 
        $message = sprintf( _n( 'Exported to quickbooks.', '%s order statuses changed.', $_REQUEST['changed'] ), number_format_i18n( $_REQUEST['changed'] ) );
        echo "<div class=\"updated\"><p>{$message}</p></div>";
 
    }
 
}








///////////////////////////////////

/**
 * Adds 'Profit' column header to 'Orders' page immediately after 'Total' column.
 *
 * @param string[] $columns
 * @return string[] $new_columns
 */
function sv_wc_cogs_add_order_profit_column_header( $columns ) {

    $new_columns = array();

    foreach ( $columns as $column_name => $column_info ) {

        $new_columns[ $column_name ] = $column_info;

        if ( 'order_total' === $column_name ) {
            $new_columns['order_profit'] = __( 'Woobook Status', 'my-textdomain' );
        }
    }

    return $new_columns;
}
add_filter( 'manage_edit-shop_order_columns', 'sv_wc_cogs_add_order_profit_column_header', 20 );









if ( ! function_exists( 'sv_helper_get_order_meta' ) ) :

    /**
     * Helper function to get meta for an order.
     *
     * @param \WC_Order $order the order object
     * @param string $key the meta key
     * @param bool $single whether to get the meta as a single item. Defaults to `true`
     * @param string $context if 'view' then the value will be filtered
     * @return mixed the order property
     */
    function sv_helper_get_order_meta( $order, $key = '', $single = true, $context = 'edit' ) {

        // WooCommerce > 3.0
        if ( defined( 'WC_VERSION' ) && WC_VERSION && version_compare( WC_VERSION, '3.0', '>=' ) ) {

            $value = $order->get_meta( $key, $single, $context );

        } else {

            // have the $order->get_id() check here just in case the WC_VERSION isn't defined correctly
            $order_id = is_callable( array( $order, 'get_id' ) ) ? $order->get_id() : $order->id;
            $value    = get_post_meta( $order_id, $key, $single );
        }

        return $value;
    }

endif;


/**
 * Adds 'Profit' column content to 'Orders' page immediately after 'Total' column.
 *
 * @param string[] $column name of column being displayed
 */
function sv_wc_cogs_add_order_profit_column_content( $column ) {
    global $post;

    if ( 'order_profit' === $column ) {

        $order    = wc_get_order( $post->ID );
        $currency = is_callable( array( $order, 'get_currency' ) ) ? $order->get_currency() : $order->order_currency;
        $profit   = '';
        $cost     = sv_helper_get_order_meta( $order, '_wc_cog_order_total_cost' );
        $total    = (float) $order->get_total();

        // don't check for empty() since cost can be '0'
        if ( '' !== $cost || false !== $cost ) {

            // now we can cast cost since we've ensured it was calculated for the order
            $cost   = (float) $cost;
          
            
            
            $profit= get_post_meta( $post->ID, 'woobookstatus', true );
        }

        echo  "<button style=\"background-color: #4CAF50;
    border: none;
    color: white;
    padding: 1px 1px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 13px;
    margin: 4px 2px;
    cursor: pointer;\">".$profit."</button>";
    }
}
add_action( 'manage_shop_order_posts_custom_column', 'sv_wc_cogs_add_order_profit_column_content' );

























add_action( 'add_meta_boxes', 'cpmb_add_meta_box');
function cpmb_add_meta_box() {

    add_meta_box(
        'woocommerce-order-my-custom',
        __('WooBook'),
        'cpmb_display_meta_box',
        'shop_order',
        'side',
        'core'
    );
    
}
// The metabox content
function cpmb_display_meta_box( $post ) {
    // Get
    $total_usd = get_post_meta( $post->ID, 'woobookstatus', true );
    
    
     $total_usd1 = get_post_meta( $post->ID, 'woobookerror', true );

    echo '<input type="hidden" name="cpmb_total_usd_nonce" value="' . wp_create_nonce() . '">
    <label class="woobookstatus" for="woobookstatus">
    <strong>Woobook Status</strong></label><br />
    <input type="text" id="woobookstatus" name="woobookstatus" value="' . $total_usd . '" placeholder="'. __(" ").'" /> <br>
    <strong>Woobook Error</strong></label><br />
    <input type="text" id="woobookstatus" name="woobookerror" value="' . $total_usd1 . '" placeholder="'. __(" ").'" />
    ';
    
    
    
    
 
       
    
    
}

// Save/Update the meta data
add_action( 'save_post', 'cpmb_save_meta_box_data' );
function cpmb_save_meta_box_data( $post_id ) {

   


    ## SETTING AND UPDATING DATA (SECURITY PASSED) ##



    update_post_meta( $post_id, 'woobookstatus', sanitize_text_field( $_POST[ 'woobookstatus' ] ) );
    
 update_post_meta( $post_id, 'woobookerror', sanitize_text_field( $_POST[ 'woobookerror' ] ) );   
    
}












