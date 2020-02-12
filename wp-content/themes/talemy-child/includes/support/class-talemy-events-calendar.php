<?php
/**
 * The Events Calendar integration
 *
 * @since   1.0.0
 * @package Talemy/Classes
 */
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Talemy_Events_Calendar {

	/**
	 * Hooks
	 */
	public function __construct() {
		add_action( 'wp_footer', array( $this, 'remove_customizer_css' ) );
		add_action( 'customize_register', array( $this, 'remove_customizer_panel' ), 99 );
		add_filter( 'tribe_events_mobile_breakpoint', array( $this, 'customize_tribe_events_breakpoint' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'add_custom_style' ), 99 );
		add_action( 'tribe_events_widget_render', array( $this, 'add_custom_widget_style' ), 200 );
		add_action( 'tribe_events_pro_widget_render', array( $this, 'add_custom_widget_style' ), 200 );
		add_filter( 'tribe_event_featured_image_size', array( $this, 'add_featured_image_size' ), 10, 2 );
		add_filter( 'tribe_events_event_schedule_details_inner', array( $this, 'add_icon_schedule' ), 10, 2 );
		add_filter( 'bcn_breadcrumb_title', array( $this, 'bcn_fix_month_view' ), 10, 3 );
	}

	/**
	 * Add custom style
	 */
	public function add_custom_style() {
		global $post;

		// Checks if we should enqueue frontend assets
		$should_enqueue = (
			tribe_is_event_query()
			|| tribe_is_event_organizer()
			|| tribe_is_event_venue()
			|| ( $post instanceof WP_Post && has_shortcode( $post->post_content, 'tribe_events' ) )
		);

		if ( !apply_filters( 'tribe_events_assets_should_enqueue_frontend', $should_enqueue ) ) {
			return;
		}

		// Remove default styles
		wp_deregister_style( 'tribe-events-calendar-style' );
		wp_dequeue_style( 'tribe-events-calendar-style' );
		wp_deregister_style( 'tribe-events-full-calendar-style' );
		wp_dequeue_style( 'tribe-events-full-calendar-style' );
		wp_deregister_style( 'tribe-events-calendar-pro-style' );
		wp_dequeue_style( 'tribe-events-calendar-pro-style' );
		
		$suffix = !TALEMY_DEV_MODE ? '.min' : '';

		// Enqueue custom event calendar style
		wp_enqueue_style(
			'talemy-events-calendar-style',
			TALEMY_THEME_URI . 'assets/css/events'. $suffix .'.css',
			array( 'tribe-events-custom-jquery-styles', 'tribe-events-bootstrap-datepicker-css' )
		);
		wp_style_add_data( 'talemy-events-calendar-style', 'rtl', 'replace' );

		// Enqueue custom event calendar pro style
		if ( defined( 'EVENTS_CALENDAR_PRO_FILE' ) ) {
			// remove default styles
			wp_dequeue_style( 'tribe-events-calendar-pro-style' );
			wp_dequeue_style( 'tribe-events-calendar-pro-mobile-style' );
			wp_dequeue_style( 'tribe-events-calendar-full-pro-mobile-style' );

			// enqueue style
			wp_enqueue_style( 'talemy-events-calendar-pro-style', TALEMY_THEME_URI . 'assets/css/events-pro'. $suffix .'.css' );
			wp_style_add_data( 'talemy-events-calendar-pro-style', 'rtl', 'replace' );

			// google map api error.
			if ( tribe_is_event() || is_singular( 'tribe_events' ) || is_singular( 'tribe_venue' ) ) {
				wp_dequeue_script( 'tribe-events-pro-geoloc' );
			}
		}

		if ( defined( 'TRIBE_EVENTS_FILTERBAR_FILE' ) ) {
			// Enqueue custom event filter bar style
			wp_enqueue_style( 'talemy-filterbar-style', TALEMY_THEME_URI . 'assets/css/filter-view'. $suffix .'.css' );
			wp_style_add_data( 'talemy-filterbar-style', 'rtl', 'replace' );
		}
	}

	/**
	 * Add custom widget style
	 */
	public function add_custom_widget_style() {
		$suffix = !TALEMY_DEV_MODE ? '.min' : '';
		wp_dequeue_style( 'widget-calendar-style' );
		wp_dequeue_style( 'widget-calendar-pro-style' );
		wp_dequeue_style( 'tribe_events-widget-calendar-pro-style' );
		wp_dequeue_style( 'tribe_events-widget-this-week-pro-style' );
		wp_dequeue_style( 'tribe_events--widget-calendar-pro-override-style' );
		// Enqueue custom event calendar widget style
		wp_enqueue_style( 'talemy-widget-calendar-style', TALEMY_THEME_URI . 'assets/css/widget-calendar'. $suffix .'.css' );
		wp_style_add_data( 'talemy-widget-calendar-style', 'rtl', 'replace' );
	}

	/**
	 * Customize breakpoint
	 */
	public function customize_tribe_events_breakpoint() {
	    return 768;
	}

	/**
	 * Remove the Tribe Customier CSS script
	 */
	public function remove_customizer_css() {
		if ( class_exists( 'Tribe__Customizer' ) ) {
			remove_action( 'wp_print_footer_scripts', array( Tribe__Customizer::instance(), 'print_css_template' ), 15 );
		}
	}

	/**
	 * Remove the Tribe Customier panel
	 */
	public function remove_customizer_panel( $wp_customize ) {
		$wp_customize->remove_panel( 'tribe_customizer' );
	}

	/**
	 * Change thumbnail size for featured events
	 */
	public function add_icon_schedule( $html, $event_id ) {
		return '<i class="far fa-calendar-alt"></i>'. $html;
	}

	/**
	 * Change thumbnail size for featured events
	 */
	public function add_featured_image_size( $size, $post_id = null ) {
		$is_featured = (bool) get_post_meta( $post_id, '_tribe_featured', true );
		if ( $is_featured ) {
			$size = 'talemy_thumb_large';
		}
		return $size;
	}

    /**
     * A custom "hack" to override the breadcrumbs on the month view Events page.
     *
     * @param string $title
     * @param string $type
     * @param int $id
     * @return string
     */
    public function bcn_fix_month_view( $title, $type, $id ) {
        // Modify Month View breadcrumbs.
        if ( empty( $title ) && tribe_is_month() ) {
            $title = sprintf( 
                '<a href="%s">%s</a>',
                get_post_type_archive_link( $type ),
                esc_html__( 'Events', 'talemy' )
            );
        }
        return $title;
    }
}

if ( defined( 'TRIBE_EVENTS_FILE' ) ) {
	new Talemy_Events_Calendar();
}
