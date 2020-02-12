<?php
/**
 * SF Fonts
 *
 * @package     classes
 * @category    fonts
 * @author      ThemeSpirit
 * @version     1.0.0
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

class SF_Fonts {

	/**
	 * Theme font option name
	 * @var string
	 */
	static $option_name = 'sf_fonts';

	/**
	 * Custom font option name
	 * @var string
	 */
	static $custom_option_name = 'sf_custom_fonts';

	/**
	 * Google fonts array
	 * @var array
	 */
	static $google_fonts = array();

	/**
	 * default fonts used by the theme
	 * @var array
	 */
	static $default_fonts = array(
		array(
			'family' => 'Poppins',
			'variants' => '300,regular,italic,600,600italic,700',
			'source' => 'Google'
		)
	);

	/**
	 * Add theme default fonts
	 */
	static function add_default_fonts() {
		if ( get_option( self::$option_name ) == false ) {
			self::$default_fonts = apply_filters( 'sf_config_theme_fonts', array() );
			add_option( self::$option_name, self::$default_fonts );
		}
	}

	/**
	 * Get theme fonts
	 * @return array
	 */
	static function get_fonts() {
		$fonts = get_option( self::$option_name );

		if ( ! empty( $fonts ) ) {
			return $fonts;
		}
		return array();
	}

	/**
	 * Get Google fonts data from a json file
	 * @return array
	 */
	static function get_google_fonts() {
		if ( empty( self::$google_fonts ) ) {
			ob_start();
			include( SF_FRAMEWORK_DIR . 'includes/libs/kirki/modules/webfonts/webfonts.json' );
			$fonts_json = ob_get_clean();
			$fonts = json_decode( $fonts_json, true );
			self::$google_fonts = $fonts['items'];
		}
		return self::$google_fonts;
	}

	/**
	 * Get font variants
	 * @param  string $family font name
	 * @return array          font variants
	 */
	static function get_variants( $font_family = '' ) {
	    if ( $font_family === '' ) {
	        return array();
	    }

	    $fonts = self::get_google_fonts();
	    
	    if ( isset( $fonts[$font_family]['variants'] ) ) {
	        return $fonts[$font_family]['variants'];
	    }
	    return array();
	}

	/**
	 * Convert a variant to standard format
	 * @param  string $variant string
	 * @return string
	 */
	static function to_variant( $variant = '' ) {
		if ( empty( $variant ) ) {
			return '';
		}
		$style = preg_replace( '/[0-9\s]/', '', $variant );
		
		if ( $style != 'Italic' ) {
			return preg_replace( '/\D/', '', $variant );
		} else {
			return preg_replace( '/\s/', '', $variant );
		}
	}

	/**
	 * Get custom font CSS style
	 * @param  string $font_family font name
	 * @return string              font face css
	 */
	static function get_custom_font_css( $font_family = null ) {
		$custom_fonts = get_option( self::$custom_option_name );
		$output_css = '';

		foreach ( $custom_fonts as $font ) {
			if ( $font_family == $font['family'] ) {
				$output_css .= '@font-face{font-family:"' . $font['family'] . '";';
				if ( !empty( $font['eot'] ) ) {
					$output_css .= 'src:url("' . esc_url( $font['eot'] ) . '");';
					// IE6 - IE8 optional
					// $output_css .= 'src:url("' . esc_url( $font['eot'] ) . '?#iefix") format("embedded-opentype");';
				}
				if ( !empty( $font['woff2'] ) ) {
					$output_css .='src:url("' . esc_url( $font['woff2'] ) . '") format("woff2"),';
				}
				if ( !empty( $font['woff'] ) ) {
					$output_css .='src:url("' . esc_url( $font['woff'] ) . '") format("woff"),';
				}
				if ( !empty( $font['ttf'] ) ) {
					$output_css .='src:url("' . esc_url( $font['ttf'] ) . '") format("truetype"),';
				}
				if ( !empty( $font['svg'] ) ) {
					$output_css .='src:url("' . esc_url( $font['svg'] ) . '#' . $font_family . '") format("svg");';
				}
				$output_css .= '}';
				$output_css = str_replace( ',src:', ',', $output_css );
				$output_css = str_replace( ',}', ';}', $output_css );
				break;
			}
		}
		return $output_css;
	}

	/**
	 * Get custom fonts CSS style for frontend
	 * @return string  CSS
	 */
	static function get_frontend_style() {
		$theme_fonts = get_option( self::$option_name );
		$output_css = '';

		if ( !empty( $theme_fonts ) ) {
			foreach ( $theme_fonts as $font ) {
				if ( isset( $font['source'] ) && 'Custom' == $font['source'] ) {
					$output_css .= self::get_custom_font_css( $font['family'] );
				}
			}
		}
		return $output_css;
	}
}
