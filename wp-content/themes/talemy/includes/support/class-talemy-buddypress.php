<?php
/**
 * BuddyPress integration
 *
 * @since   1.1.8
 * @package Talemy/Classes
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Talemy_BuddyPress {

    /**
	 * Hooks
	 */
	public function __construct() {
        // Enqueue scripts
        add_filter( 'bp_nouveau_enqueue_styles', array( $this, 'bp_scripts' ) );
    }

    /**
     * Enqueue scripts
     *
     * @return void
     */
    public function bp_scripts( $styles ) {
        $suffix = !TALEMY_DEV_MODE ? '.min' : '';
        $suffix = is_rtl() ? $suffix .'-rtl' : $suffix;
        $styles['bp-nouveau']['file'] = TALEMY_THEME_URI . 'assets/css/buddypress' . $suffix . '.css';
        return $styles;
    }
}

if ( class_exists( 'BuddyPress' ) ) {
    new Talemy_BuddyPress();
}
