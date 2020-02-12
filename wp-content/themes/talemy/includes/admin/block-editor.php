<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Talemy_Block_Editor {
    /**
	 * Hooks
	 */
	public static function init() {
        add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'assets' ) );
    }

    /**
     * Enqueue block editor assets
     */
    public static function assets() {
        $fonts_url = self::get_fonts_url();
        if ( !empty( $fonts_url ) ) {
            wp_enqueue_style( 'talemy-block-editor-fonts', $fonts_url );
        }

        wp_enqueue_style( 'talemy-block-editor', TALEMY_THEME_URI . 'includes/admin/assets/css/block-editor.css' );
        wp_add_inline_style( 'talemy-block-editor', self::get_inline_css() );
    }

    /**
     * Block editor inline css
     *
     * @return void
     */
    public static function get_inline_css() {
        $css = '';
        $mods = get_theme_mods();
        $font_props = array( 'color', 'font-family', 'font-weight', 'font-style', 'line-height', 'text-transform' );
        
        if ( !empty( $mods['typo_body'] ) ) {
            $body_style = '';
            
            foreach ( $font_props as $prop ) {
                if ( !empty( $mods['typo_body'][ $prop ] ) ) {
                    $body_style .= $prop .':'. $mods['typo_body'][ $prop ] .';';
                }
            }
    
            if ( !empty( $body_style ) ) {
                $css .= '#wpwrap .editor-styles-wrapper {'. $body_style .'}';
            }
        }
    
        if ( !empty( $mods['typo_heading'] ) ) {
            $heading_style = '';
            foreach ( $font_props as $prop ) {
                if ( !empty( $mods['typo_heading'][ $prop ] ) ) {
                    $heading_style .= $prop .':'. $mods['typo_heading'][ $prop ] .';';
                }
            }
    
            if ( !empty( $heading_style ) ) {
                $css .= '.wp-block-heading h1, .wp-block-heading h2, .wp-block-heading h3, .wp-block-heading h4, .wp-block-heading h5, .wp-block-heading h6, #wpwrap .editor-post-title__block .editor-post-title__input {'. $heading_style .'}';
            }
        }
    
        if ( !empty( $mods['secondary_color'] ) ) {
            if ( !empty( $mods['secondary_color'] ) ) {
                $css .= '#wpwrap .edit-post-visual-editor a {color:'. $mods['secondary_color'] .';}';
            }
        }
    
        return $css;
    }
    
    /**
     * Get fonts url
     *
     * @return string
     */
    public static function get_fonts_url() {
        $mods = get_theme_mods();
        $font_options = array( 'typo_body', 'typo_heading' );
        $fonts = array();
    
        // prepare fonts
        foreach ( $font_options as $option ) {
            if ( !empty( $mods[ $option ]['font-family'] ) ) {
                // $font_family = str_replace( ' ', '+', $mods[ $option ]'font-family' );
                $fonts[ $mods[ $option ]['font-family'] ] = array( $mods[ $option ]['variant'] );
            }
        }
    
        if ( function_exists( 'sf_custom_google_fonts' ) ) {
            $fonts = sf_custom_google_fonts( $fonts );
        }
    
        if ( empty( $fonts ) ) {
            return '';
        }
    
        // generate fonts url
        $fonts_url = 'https://fonts.googleapis.com/css?family=';
    
        foreach ( $fonts as $font => $weights ) {
            foreach ( $weights as $key => $value ) {
                if ( 'italic' === $value ) {
                    $weights[ $key ] = '400i';
                } else {
                    $weights[ $key ] = str_replace( array( 'regular', 'bold', 'italic' ), array( '400', '', 'i' ), $value );
                }
            }
            $fonts_url .= '|'. $font .':'. join( ',', $weights );
        }
    
        return str_replace( 'family=|', 'family=', $fonts_url );
    }
}

Talemy_Block_Editor::init();