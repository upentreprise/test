<?php
/**
 * Talemy Block Posts
 *
 * @since   1.1.7
 * @package Talemy/Classes
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Talemy_Tweaks {
	/**
	 * Constructor
	 */
	public function __construct() {
		
		add_action( 'wp_head', array( $this, 'head_content' ) );
		add_action( 'wp_footer', array( $this, 'footer_content' ) );
		// add page break button to mce toolbar
		add_filter( 'mce_buttons', array( $this, 'add_page_break_button' ), 1, 2 );
		// remove widget title if empty
		add_filter( 'widget_title', array( $this, 'widget_title' ), 10, 3 );
		// filter widget tag cloud args
		add_filter( 'widget_tag_cloud_args', array( $this, 'tag_cloud_args' ) );
		// add wrapper to embeds
		add_filter( 'embed_oembed_html', array( $this, 'embed_oembed_html' ), 99, 4 );
		// add wrapper to audio shortcodes
		add_filter( 'wp_audio_shortcode', array( $this, 'audio_shortcode' ) );
		// add wrapper to video shortcodes
		add_filter( 'wp_video_shortcode', array( $this, 'video_shortcode' ) );
		// add theme image size settings
		add_filter( 'image_size_names_choose', array( $this, 'add_image_sizes_settings' ) );
		// add theme icons
		add_filter( 'sf_font_icons', array( $this, 'add_theme_icons' ) );
		// do not load contact form 7 css
		add_filter( 'wpcf7_load_css', '__return_false' );
		// add custom navgitation to revolution slider
		add_filter( 'revslider_mod_default_navigations', array( $this, 'add_custom_navigations' ) );
	}

	/**
	 * Prints head content
	 */
    public function head_content() {
		// Add a pingback url auto-discovery header for single posts, pages, or attachments.
        if ( is_singular() && pings_open() ) {
            printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
		// output head code from theme setting
 		echo talemy_get_option( 'header_code' );
	}
	
    /**
     * Prints before </body> content
     */
    public function footer_content() {
        echo talemy_get_option( 'footer_code' );
    }

	/**
	 * Add custom mce button
	 *
	 * @param array $buttons
	 * @param string $id
	 * @return $buttons
	 */
	public function add_page_break_button( $buttons, $id ) {
	    // only add this for content editor
	    if ( 'content' != $id ) {
	        return $buttons;
		}
	    // add next page after more tag button
		array_splice( $buttons, 13, 0, 'wp_page' );
		
		return $buttons;
	}

	/**
	 * Modify widget title
	 *
	 * @param string $title
	 * @param string $instance
	 * @param string $id_base
	 * @return $html
	 */
	public function widget_title( $title, $instance = '', $id_base = '' ) {
		if ( empty( $title ) || $title == '!' ) {
			$title = '';
		}
		return $title;
	}

	/**
	 * Filter widget tag cloud args
	 *
	 * @param array $args
	 * @return void
	 */
	public function tag_cloud_args( $args ) {
		$new_args = array(
			'smallest' => 13,
			'largest' => 13,
			'number' => 25,
			'orderby' => 'name',
			'unit' => 'px'
			);
		$args = wp_parse_args( $args, $new_args );
		return $args;
	}

	/**
	 * Add wrapper to oembed
	 *
	 * @param string $html
	 * @param string $url
	 * @param array $attr
	 * @param integer $post_id
	 * @return $html
	 */
	public function embed_oembed_html( $html, $url, $attr, $post_id ) {
	  	return '<div class="post-media media-embed">'. $html .'</div>';
	}

	/**
	 * Add wrapper to audio shortcodes
	 *
	 * @param string $html
	 * @return void
	 */
	public function audio_shortcode( $html ) {
		return '<div class="post-media">'. $html .'</div>';
	}

	/**
	 * Add wrapper to video shortcodes
	 *
	 * @param string $html
	 * @return void
	 */
	public function video_shortcode( $html ) {
		return '<div class="post-media">'. $html .'</div>';
	}

	/**
	 * Add additional size to gallery settings
	 * @param  array $sizes image sizes
	 * @return array        image sizes
	 */
	public function add_image_sizes_settings( $sizes ) {
		$custom_sizes = array(
		    'talemy_thumb_x_small' => 'talemy_thumb_x_small [ 100x70 ]',
		    'talemy_thumb_small_s' => 'talemy_thumb_small_s [ 380x380 ]',
		    'talemy_thumb_small' => 'talemy_thumb_small [ 540x360 ]',
		    'talemy_thumb_small_x' => 'talemy_thumb_small_x [ 540x9999 ]',
		    'talemy_thumb_half' => 'talemy_thumb_half [ 585x390 ]',
		    'talemy_thumb_medium' => 'talemy_thumb_medium [ 870x489 ]',
		    'talemy_thumb_medium_x' => 'talemy_thumb_medium_x [ 870x9999 ]',
		    'talemy_thumb_large' => 'talemy_thumb_large [ 1170x658 ]',
		    'talemy_thumb_large_x' => 'talemy_thumb_large_x [ 1170x9999 ]',
		);
		$sizes = array_merge( $sizes, $custom_sizes );
       	return $sizes;
	}

	/**
	 * Add custom revolution slider navigations
	 *
	 * @param array $navigations
	 * @return $navigations
	 */
	public function add_custom_navigations( $navigations ) {
		$secondary_color = talemy_get_option( 'secondary_color' );

		$navigations[] = array(
			'id' => 9001,
			'type' => 'arrows',
			'name' => 'Talemy Light',
			'handle' => 'talemy-arrows-light',
			'markup' => '',
			'css' => ".talemy-arrows-light.tparrows {\n\tbackground-color: ##bg-color##;\n\theight: 60px;\n\twidth: 50px;\n\t-webkit-transition: background-color 0.4s;\n\ttransition: background-color 0.4s;\n }\n \n .talemy-arrows-light.tparrows:before {\n\tcolor: ##arrow-color##;\n\tfont-family: 'revicons';\n\tfont-weight: 400;\n\tfont-size: 30px;\n\tline-height: 58px;\n\t-webkit-transition: background-color 0.4s;\n\ttransition: background-color 0.4s;\n }\n \n .talemy-arrows-light.tparrows:after {\n\tcontent: \"\";\n\theight: 0;\n\twidth: 0;\n\tposition: absolute;\n\ttop: 0;\n\t-webkit-transition: border-color 0.4s;\n\ttransition: border-color 0.4s;\n }\n \n .talemy-arrows-light.tparrows.tp-leftarrow:before {\n\tcontent: '##left-icon##';\n }\n \n .talemy-arrows-light.tparrows.tp-leftarrow:after {\n\tborder-top: 60px solid ##bg-color##;\n\tborder-right: 10px solid transparent;\n\tleft: 100%;\n }\n \n .talemy-arrows-light.tparrows.tp-rightarrow:before {\n\tcontent: '##right-icon##';\n }\n \n .talemy-arrows-light.tparrows.tp-rightarrow:after {\n\tborder-bottom: 60px solid ##bg-color##;\n\tborder-left: 10px solid transparent;\n\tright: 100%;\n }\n \n .talemy-arrows-light.tparrows:hover {\n\tbackground-color: ##bg-hover-color##;\n\topacity: 1;\n }\n \n .talemy-arrows-light.tparrows:hover:before {\n\tcolor: ##arrow-hover-color##;\n }\n \n .talemy-arrows-light.tparrows:hover.tp-leftarrow:after {\n\tborder-top-color: ##bg-hover-color##;\n }\n \n .talemy-arrows-light.tparrows:hover.tp-rightarrow:after {\n\tborder-bottom-color: ##bg-hover-color##;\n",
			'settings' => '{"dim":{"width":"160","height":"160"},"placeholders":{"left-icon":{"type":"icon","title":"Left-Icon","data":"\\\\e820"},"right-icon":{"type":"icon","title":"Right-Icon","data":"\\\\e81d"},"bg-color":{"type":"color","title":"BG-Color","data":"rgba(255, 255, 255, 0.4)"},"bg-hover-color":{"type":"color","title":"BG-Hover-Color","data":"'. $secondary_color .'"},"arrow-color":{"type":"color","title":"Arrow-Color","data":"#000000"},"arrow-hover-color":{"type":"color","title":"Arrow-Hover-Color","data":"#ffffff"}},"presets":{},"version":"6.0.0"}'
		);

		$navigations[] = array(
			'id' => 9002,
			'type' => 'arrows',
			'name' => 'Talemy Dark',
			'handle' => 'talemy-arrows-dark',
			'markup' => '',
			'css' => ".talemy-arrows-dark.tparrows {\n\tbackground-color: ##bg-color##;\n\theight: 60px;\n\twidth: 50px;\n\t-webkit-transition: background-color 0.4s;\n\ttransition: background-color 0.4s;\n }\n \n .talemy-arrows-dark.tparrows:before {\n\tcolor: ##arrow-color##;\n\tfont-family: 'revicons';\n\tfont-weight: 400;\n\tfont-size: 30px;\n\tline-height: 58px;\n\t-webkit-transition: background-color 0.4s;\n\ttransition: background-color 0.4s;\n }\n \n .talemy-arrows-dark.tparrows:after {\n\tcontent: \"\";\n\theight: 0;\n\twidth: 0;\n\tposition: absolute;\n\ttop: 0;\n\t-webkit-transition: border-color 0.4s;\n\ttransition: border-color 0.4s;\n }\n \n .talemy-arrows-dark.tparrows.tp-leftarrow:before {\n\tcontent: '##left-icon##';\n }\n \n .talemy-arrows-dark.tparrows.tp-leftarrow:after {\n\tborder-top: 60px solid ##bg-color##;\n\tborder-right: 10px solid transparent;\n\tleft: 100%;\n }\n \n .talemy-arrows-dark.tparrows.tp-rightarrow:before {\n\tcontent: '##right-icon##';\n }\n \n .talemy-arrows-dark.tparrows.tp-rightarrow:after {\n\tborder-bottom: 60px solid ##bg-color##;\n\tborder-left: 10px solid transparent;\n\tright: 100%;\n }\n \n .talemy-arrows-dark.tparrows:hover {\n\tbackground-color: ##bg-hover-color##;\n\topacity: 1;\n }\n \n .talemy-arrows-dark.tparrows:hover:before {\n\tcolor: ##arrow-hover-color##;\n }\n \n .talemy-arrows-dark.tparrows:hover.tp-leftarrow:after {\n\tborder-top-color: ##bg-hover-color##;\n }\n \n .talemy-arrows-dark.tparrows:hover.tp-rightarrow:after {\n\tborder-bottom-color: ##bg-hover-color##;\n",
			'settings' => '{"dim":{"width":"160","height":"160"},"placeholders":{"left-icon":{"type":"icon","title":"Left-Icon","data":"\\\\e820"},"right-icon":{"type":"icon","title":"Right-Icon","data":"\\\\e81d"},"bg-color":{"type":"color","title":"BG-Color","data":"rgba(0, 0, 0, 0.6)"},"bg-hover-color":{"type":"color","title":"BG-Hover-Color","data":"'. $secondary_color .'"},"arrow-color":{"type":"color","title":"Arrow-Color","data":"#ffffff"},"arrow-hover-color":{"type":"color","title":"Arrow-Hover-Color","data":"#ffffff"}},"presets":{},"version":"6.0.0"}'
		);

		return $navigations;
	}

	/**
	 * Talemy theme icons
	 * @param  string $icons default icons
	 * @return array         icons array
	 */
	public function add_theme_icons( $icons = '' ) {
		if ( !is_array( $icons ) ) {
			return $icons;
		}
		$icons['Talemy'] = array( 'ticon-angle-left','ticon-angle-right','ticon-angle-up','ticon-angle-down','ticon-heart','ticon-cloud','ticon-star','ticon-tv','ticon-sound','ticon-video','ticon-trash','ticon-user','ticon-key','ticon-search','ticon-settings','ticon-camera','ticon-tag','ticon-lock','ticon-bulb','ticon-pen','ticon-diamond','ticon-display','ticon-location','ticon-eye','ticon-bubble','ticon-stack','ticon-cup','ticon-phone','ticon-news','ticon-mail','ticon-like','ticon-photo','ticon-note','ticon-watch','ticon-paperplane','ticon-params','ticon-banknote','ticon-data','ticon-music','ticon-megaphone','ticon-study','ticon-lab','ticon-food','ticon-t-shirt','ticon-fire','ticon-clip','ticon-shop','ticon-calendar','ticon-wallet','ticon-vynil','ticon-truck','ticon-world','ticon-add','ticon-close','ticon-star-full','ticon-remove','ticon-star-emtpy','ticon-star-half','ticon-interface','ticon-open-book-alt','ticon-earth-globe','ticon-diploma','ticon-flask','ticon-calculator-alt','ticon-lamp','ticon-medal','ticon-school-alt-1','ticon-calculator','ticon-microscope','ticon-writing','ticon-drawing','ticon-school-alt-2','ticon-pencil-case','ticon-desk','ticon-stationery','ticon-canvas','ticon-trophy','ticon-open-book','ticon-certificate','ticon-backpack','ticon-library','ticon-school','ticon-next','ticon-back','ticon-graduation-cap','ticon-fast-food','ticon-building','ticon-exam','ticon-placeholder','ticon-clown','ticon-big-data','ticon-cloud-computing','ticon-notepad','ticon-graphic-design','ticon-layers','ticon-megaphone-alt','ticon-monitor','ticon-photo-camera','ticon-presentation','ticon-presentation-alt','ticon-research','ticon-search-alt','ticon-user-alt','ticon-navigation','ticon-shopping-bag','ticon-girl','ticon-figures','ticon-abacus','ticon-ball','ticon-pencil','ticon-book','ticon-bricks','ticon-puzzle','ticon-boy','ticon-bell' );
		return $icons;
	}
}

new Talemy_Tweaks();

