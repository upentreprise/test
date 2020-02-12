<?php
/**
 * Talemy.
 *
 * Please do not make any edits to this file. All edits should be done in a child theme.
 *
 * @package Talemy
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'TALEMY_THEME_VERSION', '1.1.9' );
define( 'TALEMY_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'TALEMY_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );
define( 'TALEMY_DEV_MODE', false );

require_once( TALEMY_THEME_DIR . 'includes/theme-functions.php' );
require_once( TALEMY_THEME_DIR . 'includes/learndash-functions.php' );
require_once( TALEMY_THEME_DIR . 'includes/template-functions.php' );
require_once( TALEMY_THEME_DIR . 'includes/template-hooks.php' );
require_once( TALEMY_THEME_DIR . 'includes/deprecated.php' );
require_once( TALEMY_THEME_DIR . 'includes/class-talemy.php' );
require_once( TALEMY_THEME_DIR . 'includes/class-talemy-options.php' );
require_once( TALEMY_THEME_DIR . 'includes/class-talemy-ajax.php' );
require_once( TALEMY_THEME_DIR . 'includes/class-talemy-block.php' );
require_once( TALEMY_THEME_DIR . 'includes/class-talemy-block-posts.php' );
require_once( TALEMY_THEME_DIR . 'includes/class-talemy-block-courses.php' );
require_once( TALEMY_THEME_DIR . 'includes/class-talemy-tweaks.php' );
require_once( TALEMY_THEME_DIR . 'includes/class-talemy-gallery.php' );
require_once( TALEMY_THEME_DIR . 'includes/class-talemy-walker-menu.php' );
require_once( TALEMY_THEME_DIR . 'includes/support/class-talemy-learndash.php' );
require_once( TALEMY_THEME_DIR . 'includes/support/class-talemy-elementor.php' );
require_once( TALEMY_THEME_DIR . 'includes/support/class-talemy-course-reviews.php' );
require_once( TALEMY_THEME_DIR . 'includes/support/class-talemy-woocommerce.php' );
require_once( TALEMY_THEME_DIR . 'includes/support/class-talemy-events-calendar.php' );
require_once( TALEMY_THEME_DIR . 'includes/support/class-talemy-bbpress.php' );
require_once( TALEMY_THEME_DIR . 'includes/support/class-talemy-buddypress.php' );
require_once( TALEMY_THEME_DIR . 'includes/admin/functions.php' );

if ( defined( 'SF_FRAMEWORK_VERSION' ) ) {
    require_once( TALEMY_THEME_DIR . 'includes/admin/customize.php' );
}

if ( is_admin() || is_customize_preview() ) {
    require_once( TALEMY_THEME_DIR . 'includes/admin/admin.php' );
}