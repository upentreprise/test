<?php
/**
 * SF Fonts Manager
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

class SF_Fonts_Manager {

	function __construct() {
		add_action( 'wp_ajax_sf_add_font', array( $this, 'add_font' ) );
		add_action( 'wp_ajax_sf_save_fonts', array( $this, 'save_fonts' ) );
		add_action( 'wp_ajax_sf_save_custom_font', array( $this, 'save_custom_font' ) );
		add_action( 'wp_ajax_sf_remove_custom_font', array( $this, 'remove_custom_font' ) );
	}

	/**
	 * Add font to default font list
	 */
    function add_font() {
    	$font_source = isset( $_POST['source'] ) ? sanitize_text_field( $_POST['source'] ) : '';
    	$font_family = isset( $_POST['font_family'] ) ? sanitize_text_field( $_POST['font_family'] ) : '';

    	if ( 'google' == $font_source ) :
			$variants = SF_Fonts::get_variants( $font_family );
			$checked_variants = array( '400', 'regular' );
			$attr_disabled = count( $variants ) > 1 ? '' : ' disabled';
		?>
			<li>
				<h2 class="sf-font-family"><?php echo esc_html( $font_family ); ?></h2>
				<div class="sf-font-source"><?php printf( esc_html__( 'Source: %s', 'spirit' ), 'Google' ); ?></div>
				<div class="sf-font-variant-subset">
					<div class="sf-font-variants">
						<h3><?php esc_html_e( 'Variants', 'spirit' ); ?>:</h3>
						<ul><?php foreach( $variants as $variant ) : ?>
							<li><?php $attr_checked = in_array( $variant, $checked_variants ) ? ' checked' : ''; ?>
								<label>
									<input type="checkbox" data-variant="<?php echo esc_attr( $variant ); ?>" class="sf-check-variant"<?php echo esc_html( $attr_checked . $attr_disabled ); ?>>
									<?php echo esc_html( $variant ); ?>
								</label>
							</li>
						<?php endforeach; ?>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
			</li><?php
    	
    	elseif ( 'custom' == $font_source ) :

    		$font_preview = '<li><style>' . SF_Fonts::get_custom_font_css( $font_family ) . '</style><span class="sf-font-specimen" style="font-family:\'' . esc_attr( $font_family ) . '\';">Grumpy wizards make toxic brew for the evil Queen and Jack.</span><span class="sf-font-family" data-source="Custom">' . esc_html( $font_family ) . '</span><a href="javascript:void(0)" class="sf-remove-font">X</a></li>';
    		$font_details = '<li><h2 class="sf-font-family">' . esc_html( $font_family ) . '</h2><div class="sf-font-source">' . esc_html__( 'Source: Custom', 'spirit' ) . '</div></li>';
    		echo json_encode( array( 'preview' => $font_preview, 'details' => $font_details ) );

    	endif;

    	exit;
    }

    /**
     * Save default font list
     */
    function save_fonts() {
    	$font_data = isset( $_POST['fontData'] ) ? (array) $_POST['fontData']: array();
    	if ( !empty( $font_data ) ) {
    		update_option( SF_Fonts::$option_name, $font_data );
    		echo '<span class="success">' . esc_html__( 'Fonts Saved.', 'spirit' ) . '</span>';
    	}
    	exit;
    }

	/**
	 * Save custom fonts - upload font file & save font
	 */
	function save_custom_font() {
		check_admin_referer( 'save-cf-nonce', 'security' );

		if ( empty( $_FILES ) ) {
			echo json_encode( array( 'error' => '<span class="error">' . esc_html__( 'No font file was choosen.', 'spirit' )  . '</span>') );
			exit;
		}

		$font_name = isset( $_POST['font_name'] ) ? sanitize_text_field( $_POST['font_name'] ) : '';
		if ( empty( $font_name ) ) {
			echo json_encode( array( 'error' => '<span class="error">' . esc_html__( 'Please enter a font name.', 'spirit' )  . '</span>' ) );
			exit;
		}


		if ( !function_exists( 'wp_handle_upload' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}

		add_filter( 'upload_dir', array( $this, 'upload_dir' ) );
		add_filter( 'upload_mimes', array( $this, 'upload_mimes' ) );
		add_filter( 'wp_check_filetype_and_ext', array( $this, 'disable_mime_for_ttf_files' ), 10, 4 );

		$upload = wp_upload_dir();
		$success = false;
		$new_font = array();
		$new_font['family'] = $font_name;
		$custom_fonts = get_option( SF_Fonts::$custom_option_name );

		// check if font exists
		if ( !empty( $custom_fonts ) ) {
			foreach ( $custom_fonts as $font ) {
				if ( $font['family'] == $font_name ) {
					echo json_encode( array( 'error' => '<span class="error">' . esc_html__( 'Font already exist.', 'spirit' )  . '</span>' ) );
					exit;
				}
			}
		}

		foreach ( $_FILES as $key => $file ) {
			if ( !@file_exists( trailingslashit( $upload['path'] ) . $file['name'] ) ) {
				$overrides = array( 'test_form' => false );
				$upload_file = wp_handle_upload( $file, $overrides );
				if ( isset( $upload_file['error'] ) ) {
					echo json_encode( array( 'error' => '<span class="error">' . $upload_file['error'] . '</span>' ) );
					exit;
				}
			}
			$new_font[ $key ] = trailingslashit( $upload['url'] ) . sanitize_text_field( $file['name'] );
		}
		remove_filter( 'upload_dir', array( $this, 'upload_dir' ) );
		remove_filter( 'upload_mimes', array( $this, 'upload_mimes' ) );
		remove_filter( 'wp_check_filetype_and_ext', array( $this, 'disable_mime_for_ttf_files' ) );

		// update font option
		$custom_fonts = get_option( SF_Fonts::$custom_option_name );
		$custom_fonts = !empty( $custom_fonts) && is_array( $custom_fonts ) ? $custom_fonts : array();
		$custom_fonts[] = $new_font;
		update_option( SF_Fonts::$custom_option_name, $custom_fonts );

		echo json_encode( array( 'success' => '<span class="success">' . esc_html__( 'Font has been added.', 'spirit' ) . '</span>' ) );

		exit;
	}

	/**
	 * Remove custom font
	 */
	function remove_custom_font() {
		$font_name = isset( $_POST['font_name'] ) ? sanitize_text_field( $_POST['font_name'] ) : '';
		$upload = wp_upload_dir();
		
		if ( !empty( $font_name ) ) {
			$custom_fonts = get_option( SF_Fonts::$custom_option_name ); $i = 0;
			foreach ( $custom_fonts as $font ) {
				if ( $font['family'] == $font_name ) {
					foreach ( $font as $key => $value ) {
						if ( $key !== 'family' && !empty( $value ) ) {
							$file_name = basename( $value );
							$file_name = preg_replace( '/.[^.]*$/', '', $file_name );
							$file_path = trailingslashit( $upload['basedir'] ) . 'sf-fonts/' . $file_name . '.' . $key;
							if ( @file_exists( $file_path ) ) {
								@unlink( $file_path );
							}
						}
					}
					unset( $custom_fonts[ $i ] );
					$custom_fonts = array_values( $custom_fonts );
					update_option( SF_Fonts::$custom_option_name, $custom_fonts );
					break;
				}
				$i ++;
			}

			$fonts = get_option( SF_Fonts::$option_name ); $j = 0;
			foreach ( $fonts as $font ) {
				if ( $font['family'] == $font_name ) {
					unset( $fonts[ $j ] );
					$fonts = array_values( $fonts );
					update_option( SF_Fonts::$option_name, $fonts );
					break;
				}
				$j ++;
			}
		}

		exit;
	}

	function upload_dir( $upload ) {
		$upload['subdir'] = '/sf-fonts';
		$upload['path'] = $upload['basedir'] . $upload['subdir'];
		$upload['url'] = $upload['baseurl'] . $upload['subdir'];
		return $upload;
	}

	function upload_mimes( $mimes ) {
		$mimes['woff'] = 'application/font-woff';
		$mimes['ttf'] = 'application/x-font-truetype';
		$mimes['eot'] = 'application/vnd.ms-fontobject';
		$mimes['svg'] = 'image/svg+xml';
		$mimes['woff2'] = 'application/font-woff2';
		$mimes['otf'] = 'application/x-font-opentype';
		return $mimes;
	}

	/**
	 * Disable Mime type check for TTF font files
	 *
	 * A bug was introduced in WordPress 4.7.1 which caused stricter checks on mime types
	 * However, files can have multiple mime types which doesn't appear to be supported yet.
	 * Once this bug is resolved we'll remove this patch.
	 *
	 * @trac https://core.trac.wordpress.org/ticket/39550
	 *
	 * @param array  $data     File data array containing 'ext', 'type', and 'proper_filename' keys.
	 * @param string $file     Full path to the file.
	 * @param string $filename The name of the file (may differ from $file due to $file being in a tmp directory).
	 * @param array  $mimes    Key is the file extension with value as the mime type.
	 *
	 * @return array
	 *
	 * @since 4.1
	 */
	function disable_mime_for_ttf_files( $data, $file, $filename, $mimes ) {
		$wp_filetype = wp_check_filetype( $filename, $mimes );
		if ( strtolower( $wp_filetype['ext'] ) === 'ttf' ) {
			$ext             = $wp_filetype['ext'];
			$type            = $wp_filetype['type'];
			$proper_filename = $data['proper_filename'];
			return compact( 'ext', 'type', 'proper_filename' );
		}
		return $data;
	}
}

new SF_Fonts_Manager();


/**
 * Add custom fonts
 * @param  array $fonts  fonts array
 * @return array         fonts
 */
function sf_custom_fonts( $fonts ) {
    $custom_fonts = get_option( 'sf_custom_fonts' );
    if ( !empty( $custom_fonts ) ) {
    	foreach( $custom_fonts as $font ) {
    		if ( isset( $font['family'] ) ) {
    			$font_family = $font['family'];
	    		$fonts[ $font_family ] = array(
	    			'label' => $font_family,
	    			'stack' => $font_family
	    		);
    		}
    	}
    }
	return $fonts;
}
add_filter( 'kirki_fonts_standard_fonts', 'sf_custom_fonts' );