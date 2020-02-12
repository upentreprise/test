<?php
/**
 * SF Post Fields
 *
 * Add subtitle field for posts
 *
 * @package  Spirit_Framework
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

class SF_Post_Fields {

	private $post_type = 'sf_subtitle';
	private $meta_key = '_sf_subtitle';

	function __construct() {
		add_post_type_support( 'post', $this->post_type );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'post_updated', array( $this, 'save_post' ), 9 );
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	function admin_init() {
		add_action( 'admin_head', array( $this, 'add_admin_styles' ) );
		add_action( 'edit_form_after_title', array( $this, 'add_subtitle_field' ), 9 );
	}

	public static function add_subtitle_field() {
		global $post;
		
		if ( !post_type_supports( $post->post_type, 'sf_subtitle' ) ) {
			return;
		}

		$subtitle = get_post_meta( $post->id, '_sf_subtitle', true );
		$subtitle = isset( $subtitle ) ? $subtitle : '';
		?>
		<div id="subtitlediv" class="top">
			<div id="subtitlewrap">
				<input type="text" id="sf_subtitle" name="sf_subtitle" value="<?php echo esc_attr( $subtitle ); ?>" autocomplete="off" placeholder="<?php esc_attr_e( 'Enter subtitle here', 'spirit' ); ?>" />
				<input type="hidden" name="sf_post_fields_nonce" id="sf_post_fields_nonce" value="<?php echo wp_create_nonce( 'sf-post-fields-nonce' ); ?>" />
			</div>
		</div>
		<?php
	}

	public static function add_admin_styles() {
		?>
		<style>
		#subtitlediv.top {
			margin-top: 5px;
			margin-bottom: 15px;
			position: relative;
		}
		#subtitlediv.top #subtitlewrap {
			border: 0;
			padding: 0;
		}
		#subtitlediv.top #sf_subtitle {
			background-color: #fff;
			font-size: 1.4em;
			line-height: 1em;
			margin: 0;
			outline: 0;
			padding: 3px 8px;
			width: 100%;
			height: 36px;
		}
		#subtitlediv.top #sf_subtitle::-webkit-input-placeholder { padding-top: 3px; }
		#subtitlediv.top #sf_subtitle:-moz-placeholder { padding-top: 3px; }
		#subtitlediv.top #sf_subtitle::-moz-placeholder { padding-top: 3px; }
		#subtitlediv.top #sf_subtitle:-ms-input-placeholder { padding-top: 3px; }
		</style>
		<?php
	}

	/**
	 * Save subtitle
	 * 
	 * @param  int  $post_id  Post ID or object.
	 */
	public static function save_post( $post_id ) {

		// check autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// check security
		if ( 'post' !== get_post_type( $post_id ) ||
			!isset( $_POST['sf_post_fields_nonce'] ) ||
		    !wp_verify_nonce( $_POST['sf_post_fields_nonce'], 'sf-post-fields-nonce' ) ||
		    !current_user_can( 'edit_post', $post_id )
		) {
			return;
		}

		// save subtitle
		if ( isset( $_POST['sf_subtitle'] ) ) {
			update_post_meta( $post_id, $this->meta_key, $_POST['sf_subtitle'] );
		}
	}
}

if ( apply_filters( 'sf_enable_post_subtitle', true ) ) {
	// new SF_Post_Fields();
}

