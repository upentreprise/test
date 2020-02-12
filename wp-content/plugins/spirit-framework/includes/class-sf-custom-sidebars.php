<?php
/**
 * SF Custom Sidebars
 * 
 * Allows Adding or removing custom sidebars on WordPress widgets page
 *
 * @package  Spirit_Framework/Class
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

class SF_Custom_Sidebars {
	
	/**
	 * Static property to hold our singleton instance
	 */
	protected static $_instance = null;

	/**
	 * Main instance
	 * Ensures only one instance of this class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @return SF_Custom_Sidebars - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * option name to save custom sidebars data
	 * @var string
	 */
	private $option_name = 'sf_custom_sidebars';

	/**
	 * id prefix
	 * @var string
	 */
	private $id_prefix = 'sf-';

	function __construct() {
		add_action( 'widgets_init', array( $this, 'register_custom_sidebars' ), 999 );
		add_action( 'widgets_admin_page', array( $this, 'sidebar_form' ) );
		add_action( 'wp_ajax_sf_add_sidebar', array( $this, 'add_sidebar' ) );
		add_action( 'wp_ajax_sf_remove_sidebar', array( $this, 'remove_sidebar' ) );
		add_shortcode( 'sf_sidebar', array( $this, 'sidebar_content' ) );
	}

	/**
	 * Print sidebar form on widgets admin page
	 */
	function sidebar_form() {
		?>
		<div id="sf-custom-sidebars">
			<form id="sf-new-sidebar-form" method="post" action>
				<div class="sf-sidebar-wrap">
					<div class="col">
						<input type="text" name="sf-sidebar-name" id="sf-sidebar-name" class="sf-sidebar-input" placeholder="<?php esc_attr_e( 'Name', 'spirit' ); ?>" />
					</div>
					<div class="col">
						<textarea name="sf-sidebar-desc" id="sf-sidebar-desc" class="sf-sidebar-input" placeholder="<?php esc_attr_e( 'Description', 'spirit' ); ?>" rows="1"/></textarea>
					</div>
					<div class="col">
						<button type="submit" id="sf-add-sidebar" class="button-primary"><?php _e( 'Add New Sidebar', 'spirit' ); ?></button>
					</div>
					<?php wp_nonce_field( 'sidebar-nonce', 'sf-sidebar-nonce' ); ?>
				</div>
				<div id="sf-sidebar-message"></div>
			</form>
			<div class="clear"></div>
		</div>
		<?php
	}

	/**
	 * Add new sidebar
	 */
	function add_sidebar() {
		check_admin_referer( 'sidebar-nonce', 'sidebar_nonce' );
		$name = isset( $_POST['sidebar_name'] ) ? sanitize_text_field( $_POST['sidebar_name'] ) : '';
		$desc = isset( $_POST['sidebar_desc'] ) ? sanitize_text_field( $_POST['sidebar_desc'] ) : '';

		if ( !empty( $name ) ) {
			global $wp_registered_sidebars;
			$id = sanitize_title_with_dashes( $name );
			$sidebars = get_option( $this->option_name );

			// check if the sidebar exists
			if ( !empty( $wp_registered_sidebars ) && array_key_exists( $id, $wp_registered_sidebars )
				|| ( !empty( $sidebars ) && array_key_exists( $id, $sidebars ) )
			) {
				self::response( 2 );
			}
			// add new sidebar
			else {
				$sidebars[$id] = array( 'name' => $name, 'desc' => $desc );
				update_option( $this->option_name, $sidebars );
				self::response( 3 );
			}
		} else {
			self::response( 1 );
		}
		exit;
	}

	/**
	 * Remove sidebar
	 */
	function remove_sidebar() {
		check_admin_referer( 'sidebar-nonce', 'sidebar_nonce' );
		$id = isset( $_POST['sidebar_id'] ) ? $_POST['sidebar_id'] : '';
		$id = str_replace( $this->id_prefix, '', $id );
		$sidebars = get_option( $this->option_name );
		// check if the sidebar exists
		if ( !empty( $sidebars ) && array_key_exists( $id, $sidebars ) ) {
			unset( $sidebars[$id] );
			unregister_sidebar( $id );
			update_option( $this->option_name, $sidebars );
			self::response( 5 );
		} else {
			self::response( 4 );
		}
		exit;
	}

 	/**
 	 * Sidebar messages
 	 * @param  int 	 $index  message index
 	 */
	static function response( $index, $message = '' ) {
		switch( $index ) {
			case 1: $success = false; $message = '<span class="error">'. __( 'Please enter a name.', 'spirit' ) .'</span>'; break;
			case 2: $success = false; $message = '<span class="error">'. __( 'Name exist, please use another name.', 'spirit' ) .'</span>'; break;
			case 3: $success = true; $message = '<span class="success">'. __( 'New sidebar created successfully.', 'spirit' ) .'</span>'; break;
			case 4: $success = false; $message = '<span class="error">'. __( 'Widget cannot be removed.', 'spirit' ) .'</span>'; break;
			case 5: $success = true; break;
		}
		echo json_encode( array( 'success'=> $success, 'message' => $message ) );
	}

	/**
	 * Register custom sidebars
	 */
	function register_custom_sidebars() {
		$sidebars = get_option( $this->option_name );
		if ( $sidebars ) {
			foreach ( $sidebars as $id => $data ) {
				register_sidebar( array(
					'id'            => esc_attr( $this->id_prefix . $id ),
					'name'          => esc_attr( $data['name'] ),
					'description'	=> esc_html( $data['desc'] ),
					'class' 		=> 'sf-custom-sidebar',
					'before_widget' => '<div id="%1$s" class="%2$s widget '. esc_attr( $id ) .'">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="widget-title">',
					'after_title'   => '</h4>',
				));
			}
		}
	}

	/**
	 * sidebar content
	 */
    function sidebar_content( $atts ) {
        $id = isset( $atts['id'] ) ? $atts['id'] : '';
        if ( is_active_sidebar( $id ) ) {
        	ob_start();
            dynamic_sidebar( $id );
            return ob_get_clean();
        }
        return '';
    }
}