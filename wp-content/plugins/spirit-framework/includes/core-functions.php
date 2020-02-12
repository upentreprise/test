<?php

defined( 'ABSPATH' ) || exit;

/**
 * Get template part (for templates like the content-loop).
 *
 * SF_TEMPLATE_DEBUG will prevent overrides in themes from taking priority.
 *
 * @access public
 * @param mixed  $slug Template slug.
 * @param string $name Template name (default: '').
 */
function sf_get_template_part( $slug, $name = '' ) {
	$template = '';

	// Look in yourtheme/slug-name.php and yourtheme/themespirit/slug-name.php.
	if ( $name && !SF_TEMPLATE_DEBUG ) {
		$template = locate_template( array( "{$slug}-{$name}.php", SF()->template_path() . "{$slug}-{$name}.php" ) );
	}

	// Get default slug-name.php.
	if ( !$template && $name && file_exists( SF_FRAMEWORK_DIR . "templates/{$slug}-{$name}.php" ) ) {
		$template = SF_FRAMEWORK_DIR . "templates/{$slug}-{$name}.php";
	}

	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/themespirit/slug.php.
	if ( !$template && !SF_TEMPLATE_DEBUG ) {
		$template = locate_template( array( "{$slug}.php", SF()->template_path() . "{$slug}.php" ) );
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
function sf_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	if ( !empty( $args ) && is_array( $args ) ) {
		extract( $args ); // @codingStandardsIgnoreLine
	}

	$located = sf_locate_template( $template_name, $template_path, $default_path );

	if ( !file_exists( $located ) ) {
		_doing_it_wrong( __FUNCTION__, sprintf( __( '%s does not exist.', 'spirit' ), '<code>' . $located . '</code>' ), '1.0' );
		return;
	}

	include $located;
}

/**
 * Like sf_get_template, but returns the HTML instead of outputting.
 *
 * @see sf_get_template
 * @param string $template_name Template name.
 * @param array  $args          Arguments. (default: array).
 * @param string $template_path Template path. (default: '').
 * @param string $default_path  Default path. (default: '').
 *
 * @return string
 */
function sf_get_template_html( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	ob_start();
	sf_get_template( $template_name, $args, $template_path, $default_path );
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
function sf_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	if ( !$template_path ) {
		$template_path = SF()->template_path();
	}

	if ( !$default_path ) {
		$default_path = SF_FRAMEWORK_DIR . 'templates/';
	}

	// Look within passed path within the theme - this is priority.
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name,
		)
	);

	// Get default template/.
	if ( !$template || SF_TEMPLATE_DEBUG ) {
		$template = $default_path . $template_name;
	}

	// Return what we found.
	return $template;
}

/**
 * Perform a HTTP HEAD or GET request.
 *
 * If $file_path is a writable filename, this will do a GET request and write
 * the file to that path.
 * 
 * @param string      $url       URL to fetch.
 * @param string|bool $file_path Optional. File path to write request to. Default false.
 * @param array       $args      Optional. Arguments to be passed-on to the request.
 * @return bool|string False on failure and string of headers if HEAD request.
 */
function sf_wp_get_http( $url, $file_path = false, $args = array() ) {
    
    if ( !$url || !$file_path ) {
    	return false;
    }

	// Include WP_Http class if not exist
	if ( !class_exists( 'WP_Http' ) ) {
		include_once wp_normalize_path( ABSPATH . WPINC . '/class-http.php' );
	}
	// Inlude wp_remote_get function if not exist
	if ( !function_exists( 'wp_remote_get' ) ) {
		include_once wp_normalize_path( ABSPATH . WPINC . '/http.php' );
	}

	$args = wp_parse_args( $args, array(
		'timeout' => 30,
		'user-agent' => 'sf-user-agent'
	) );
	
	// Get remote file
	$response = wp_remote_get( esc_url_raw( $url ), $args );
	if ( is_wp_error( $response ) ) {
		return false;
	}

	$body = wp_remote_retrieve_body( $response );
	if ( empty( $body ) ) {
		return false;
	}

	if ( !defined( 'FS_CHMOD_DIR' ) ) {
		define( 'FS_CHMOD_DIR', ( 0755 & ~ umask() ) );
	}

	if ( !defined( 'FS_CHMOD_FILE' ) ) {
		define( 'FS_CHMOD_FILE', ( 0644 & ~ umask() ) );
	}

	global $wp_filesystem;
	
	if ( empty( $wp_filesystem ) ) {
		require_once wp_normalize_path( ABSPATH . '/wp-admin/includes/file.php' );
		WP_Filesystem();
	}

	// Write the file
	if ( !$wp_filesystem->put_contents( $file_path, $body, FS_CHMOD_FILE ) ) {
		// Try fwrite if failed
		@unlink( $file_path );
		$out_fp = @fopen( $file_path, 'w' );
		$written = @fwrite( $out_fp, $body );
		@fclose( $out_fp );
		if ( false === $written ) {
			return false;
		}
	}

	if ( isset( $response['headers'] ) ) {
		return $response['headers'];
	}

	return false;
}

/**
 * Add custom Google fonts
 * @param  array $fonts  fonts array
 * @return array         fonts
 */
function sf_custom_google_fonts( $fonts = array() ) {
	$theme_fonts = get_option( 'sf_fonts' );

	if ( empty( $theme_fonts ) ) {
		return $fonts;
	}

	foreach ( $theme_fonts as $font ) {
		if ( empty( $font['source'] ) || 'Google' !== $font['source'] ) {
			continue;
		}

		$font_family = $font['family'];
		if ( isset( $font_family ) ) {
			if ( isset( $fonts[ $font_family ] ) ) {
				if ( !empty( $font['variants'] ) ) {
					$variants = explode( ',',  $font['variants'] );
					foreach ( $variants as $variant ) {
						if ( in_array( $variant, $fonts[ $font_family ] ) ) {
							continue;
						} else {
							$fonts[ $font_family ][] = $variant;
						}
					}
				}
			} else {
				$fonts[ $font_family ] = explode( ',', $font['variants'] );
			}
		}
	}

	return $fonts;
}

/**
 * Get parent theme name
 * @return string  theme name
 */
function sf_get_parent_theme_name() {
	$active_theme = wp_get_theme();

	if ( is_child_theme() ) {
	    $parent_theme = wp_get_theme( $active_theme->Template );
	    $theme_name = $parent_theme->Name;
	} else {
		$theme_name = $active_theme->Name;
	}
	return $theme_name;
}