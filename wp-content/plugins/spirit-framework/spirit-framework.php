<?php
/**
 * Plugin Name: Spirit Framework
 * Plugin URI: https://themespirit.com
 * Description: Spirit Framework.
 * Author: ThemeSpirit
 * Author URI: https://themespirit.com
 * Version: 1.1.3
 * Text Domain: spirit
 * Domain Path: languages
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

if ( !defined( 'SF_FRAMEWORK_VERSION' ) ) define( 'SF_FRAMEWORK_VERSION', '1.1.3' );
if ( !defined( 'SF_FRAMEWORK_FILE' ) ) define( 'SF_FRAMEWORK_FILE', __FILE__ );
if ( !defined( 'SF_FRAMEWORK_DIR' ) ) define( 'SF_FRAMEWORK_DIR', plugin_dir_path( __FILE__ ) );
if ( !defined( 'SF_FRAMEWORK_URI' ) ) define( 'SF_FRAMEWORK_URI', plugin_dir_url( __FILE__ ) );

// debug mode
define( 'SF_SCRIPT_DEBUG', false );
define( 'SF_TEMPLATE_DEBUG', false );

// autoload class files
require_once SF_FRAMEWORK_DIR . 'includes/class-sf-autoload.php';

// include main class
require_once SF_FRAMEWORK_DIR . 'includes/class-spirit-framework.php';

/**
 * Main instance of Spirit Framework.
 *
 * Returns the main instance of sf to prevent the need to use globals.
 *
 * @return Spirit_Framework
 */
function SF() {
	return Spirit_Framework::instance();
}

SF();
