<?php

defined( 'ABSPATH' ) || exit;

/**
 * Get template part (for templates like the content-loop).
 *
 * @access public
 * @param mixed  $slug Template slug.
 * @param string $name Template name (default: '').
 */
function ldcr_get_template_part( $slug, $name = '' ) {
	$template = '';

	// Look in yourtheme/slug-name.php and yourtheme/course-reviews/slug-name.php.
	if ( $name ) {
		$template = locate_template( array( "{$slug}-{$name}.php", 'course-reviews/' . "{$slug}-{$name}.php" ) );
	}

	// Get default slug-name.php.
	if ( !$template && $name && file_exists( LDCR_DIR . "templates/{$slug}-{$name}.php" ) ) {
		$template = LDCR_DIR . "templates/{$slug}-{$name}.php";
	}

	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/course-reviews/slug.php.
	if ( !$template ) {
		$template = locate_template( array( "{$slug}.php", 'course-reviews/' . "{$slug}.php" ) );
	}

	if ( $template ) {
		load_template( $template, false );
	}
}

/**
 * Get other templates passing attributes and including the file.
 *
 * @access public
 * @param string $template_name Template name.
 * @param array  $args          Arguments. (default: array).
 * @param string $template_path Template path. (default: '').
 * @param string $default_path  Default path. (default: '').
 */
function ldcr_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	if ( !empty( $args ) && is_array( $args ) ) {
		extract( $args ); // @codingStandardsIgnoreLine
	}

	$located = ldcr_locate_template( $template_name, $template_path, $default_path );

	if ( !file_exists( $located ) ) {
		_doing_it_wrong( __FUNCTION__, sprintf( __( '%s does not exist.', 'ld-course-reviews' ), '<code>' . $located . '</code>' ), '1.0' );
		return;
	}

	include $located;
}

/**
 * Like ldcr_get_template, but returns the HTML instead of outputting.
 *
 * @see ldcr_get_template
 * @param string $template_name Template name.
 * @param array  $args          Arguments. (default: array).
 * @param string $template_path Template path. (default: '').
 * @param string $default_path  Default path. (default: '').
 *
 * @return string
 */
function ldcr_get_template_html( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	ob_start();
	ldcr_get_template( $template_name, $args, $template_path, $default_path );
	return ob_get_clean();
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 * yourtheme/$template_path/$template_name
 * yourtheme/$template_name
 * $default_path/$template_name
 *
 * @access public
 * @param string $template_name Template name.
 * @param string $template_path Template path. (default: '').
 * @param string $default_path  Default path. (default: '').
 * @return string
 */
function ldcr_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	if ( !$template_path ) {
		$template_path = 'course-reviews/';
	}

	if ( !$default_path ) {
		$default_path = LDCR_DIR . 'templates/';
	}

	// Look within passed path within the theme - this is priority.
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name,
		)
	);

	// Get default template/.
	if ( !$template ) {
		$template = $default_path . $template_name;
	}

	// Return what we found.
	return $template;
}

/**
 * Get setting
 * 
 * @param  string $key     setting key
 * @param  string $default default value if given setting is not set
 * @return bool|int|string setting value
 */
function ldcr_get_setting( $key, $default = '' ) {
	global $ldcr_global_settings;
	if ( !isset( $ldcr_global_settings ) ) {
		$ldcr_global_settings = get_option( 'ldcr_settings' );
	}
	$value = isset( $ldcr_global_settings[ $key ] ) ? $ldcr_global_settings[ $key ] : $default;
	return $value;
}
