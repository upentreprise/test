<?php

 function sf_register_settings() {
 	
	if ( false == get_option( 'sf_settings' ) ) {
		add_option( 'sf_settings' );
	}

	foreach ( sf_get_registered_settings() as $tab => $sections ) {
		foreach ( $sections as $section => $settings ) {

			add_settings_section(
				'sf_settings_' . $tab . '_' . $section,
				__return_null(),
				'__return_false',
				'sf_settings_' . $tab . '_' . $section
			);

			foreach ( $settings as $option ) {

				if ( empty( $option['id'] ) ) {
					continue;
				}

				$args = wp_parse_args( $option, array(
				    'section'       => $section,
				    'id'            => null,
				    'desc'          => '',
				    'name'          => '',
				    'size'          => null,
				    'options'       => '',
				    'std'           => '',
				    'min'           => null,
				    'max'           => null,
				    'step'          => null,
				    'selectize'     => true,
				    'placeholder'   => null,
				    'allow_blank'   => true,
				    'readonly'      => false,
				    'tooltip'       => '',
				    'class'         => '',
				) );

				add_settings_field(
					'sf_settings[' . $args['id'] . ']',
					$args['name'],
					'sf_settings_field',
					'sf_settings_' . $tab . '_' . $section,
					'sf_settings_' . $tab . '_' . $section,
					$args
				);
			}
		}
	}

 	register_setting( 'sf_settings', 'sf_settings', 'sf_settings_sanitize' );
}

add_action( 'admin_init', 'sf_register_settings' );

/**
 * Settings Sanitization
 *
 * Sanitize settings and add a settings updated message
 *
 * @param array   $input              the value inputted in the field
 * @global array  $sf_global_settings sf_settings option
 * @return string $input              sanitized value
 */
function sf_settings_sanitize( $input = array() ) {
	global $sf_global_settings;
	
	$doing_section = !empty( $_POST['_wp_http_referer'] ) ? true : false;
	$input = $input ? $input : array();

	if ( $doing_section ) {
		parse_str( $_POST['_wp_http_referer'], $referrer ); // Pull out the tab and section
		$tab = isset( $referrer['tab'] ) ? $referrer['tab'] : 'general';
		$section  = isset( $referrer['section'] ) ? $referrer['section'] : 'main';

		if ( ! empty( $_POST['sf_section_override'] ) ) {
			$section = sanitize_text_field( $_POST['sf_section_override'] );
		}
		$setting_types = sf_get_registered_settings_types( $tab, $section );
	} else {
		$setting_types = sf_get_registered_settings_types();
	}

	// Merge new settings with the existing
	$output = array_merge( $sf_global_settings, $input );
	
	foreach ( $setting_types as $key => $type ) {
		// Some setting types are not actually settings, just keep moving along here
		$non_setting_types = apply_filters( 'sf_non_setting_types', array( 'header', 'descriptive_text', 'hook' ) );

		if ( in_array( $type, $non_setting_types ) ) {
			continue;
		}

		if ( array_key_exists( $key, $output ) ) {
			$output[ $key ] = apply_filters( 'sf_settings_sanitize_' . $type, $output[ $key ], $key );
			$output[ $key ] = apply_filters( 'sf_settings_sanitize', $output[ $key ], $key );
		}

		if ( $doing_section ) {
			switch( $type ) {

				case 'text':
				case 'select':
					if ( array_key_exists( $key, $input ) && empty( $input[ $key ] ) ) {
						unset( $output[ $key ] );
					}
					break;

				case 'textarea':
					break;

				default:
					if ( array_key_exists( $key, $input ) && empty( $input[ $key ] ) || ( array_key_exists( $key, $output ) && ! array_key_exists( $key, $input ) ) ) {
						unset( $output[ $key ] );
					}
					break;
			}
		} else {
			if ( empty( $input[ $key ] ) ) {
				unset( $output[ $key ] );
			}
		}
	}

	if ( $doing_section ) {
		add_settings_error( 'sf-notices', '', __( 'Settings updated.', 'spirit' ), 'updated' );
	}

	return $output;
}

/**
 * Get all registered settings with their types
 *
 * @param $filtered_tab     bool|string     A tab to filter setting types by.
 * @param $filtered_section bool|string     A section to filter setting types by.
 * @return array  array(id => type)
 */
function sf_get_registered_settings_types( $filtered_tab = false, $filtered_section = false ) {
	$settings = sf_get_registered_settings();
	$setting_types = array();
	foreach ( $settings as $tab_id => $tab ) {
		
		if ( false !== $filtered_tab && $filtered_tab !== $tab_id ) {
			continue;
		}

		foreach ( $tab as $section_id => $section_or_setting ) {
			// See if we have a setting registered at the tab level for backwards compatibility
			if ( false !== $filtered_section && is_array( $section_or_setting ) && array_key_exists( 'type', $section_or_setting ) ) {
				$setting_types[ $section_or_setting['id'] ] = $section_or_setting['type'];
				continue;
			}

			if ( false !== $filtered_section && $filtered_section !== $section_id ) {
				continue;
			}

			foreach ( $section_or_setting as $section => $section_settings ) {

				if ( ! empty( $section_settings['type'] ) ) {
					$setting_types[ $section_settings['id'] ] = $section_settings['type'];
				}
			}
		}
	}
	return $setting_types;
}


/**
 * Sanitize text fields
 *
 * @since 1.8
 * @param array $input The field value
 * @return string $input Sanitized value
 */
function sf_sanitize_text_field( $input ) {
	$tags = array(
		'p' => array(
			'class' => array(),
			'id'    => array(),
		),
		'span' => array(
			'class' => array(),
			'id'    => array(),
		),
		'a' => array(
			'href'   => array(),
			'target' => array(),
			'title'  => array(),
			'class'  => array(),
			'id'     => array(),
		),
		'strong' => array(),
		'em' => array(),
		'br' => array(),
		'img' => array(
			'src'   => array(),
			'title' => array(),
			'alt'   => array(),
			'id'    => array(),
		),
		'div' => array(
			'class' => array(),
			'id'    => array(),
		),
		'ul' => array(
			'class' => array(),
			'id'    => array(),
		),
		'li' => array(
			'class' => array(),
			'id'    => array(),
		)
	);

	$allowed_tags = apply_filters( 'sf_allowed_html_tags', $tags );

	return trim( wp_kses( $input, $allowed_tags ) );
}
add_filter( 'sf_settings_sanitize_text', 'sf_sanitize_text_field' );