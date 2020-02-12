<?php
/**
 * Plugin Name: LearnDash Course Reviews
 * Plugin URI: https://themespirit.com/downloads/learndash-course-reviews/
 * Description: LearnDash course reviews plugin.
 * Author: ThemeSpirit
 * Author URI: https://themespirit.com
 * Version: 1.0.4
 * Text Domain: ld-course-reviews
 * Domain Path: languages
 */

if ( !defined( 'LDCR_VERSION' ) ) define( 'LDCR_VERSION', '1.0.4' );
if ( !defined( 'LDCR_PLUGIN_FILE' ) ) define( 'LDCR_PLUGIN_FILE', __FILE__ );
if ( !defined( 'LDCR_DIR' ) ) define( 'LDCR_DIR', plugin_dir_path( __FILE__ ) );
if ( !defined( 'LDCR_URI' ) ) define( 'LDCR_URI', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function ldcr_activate_plugin() {
    if ( ! get_option( 'ldcr_flush_rewrite_rules_flag' ) ) {
        add_option( 'ldcr_flush_rewrite_rules_flag', true );
    }
}

register_activation_hook( __FILE__, 'ldcr_activate_plugin' );
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );

/**
 * The core plugin class
 */
require LDCR_DIR . 'includes/class-ld-course-reviews.php';

LD_Course_Reviews::instance();