<?php

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Retrieve the array of plugin settings
 *
 * @return array
*/
function ldcr_get_registered_settings() {

	/**
	 * 'Whitelisted' LDCR settings, filters are provided for each settings
	 * section to allow extensions and other plugins to add their own settings
	 */

	$ldcr_settings = array(
		/** General Settings */
		'general' => apply_filters( 'ldcr_settings_general',
			array(
				'main' => array(
					'review_require_approval' => array(
						'id'   => 'review_require_approval',
						'name' => __( 'Review require approval', 'ld-course-reviews' ),
						'desc' => __( 'Review require approval before publishing', 'ld-course-reviews' ),
						'type' => 'checkbox'
					),
					'disable_comments' => array(
						'id'   => 'disable_comments',
						'name' => __( 'Review comments', 'ld-course-reviews' ),
						'desc' => __( 'Disable review comments', 'ld-course-reviews' ),
						'type' => 'checkbox'
					),
					'review_hide_avatar' => array(
						'id'   => 'review_hide_avatar',
						'name' => __( 'Hide reviewer avatar', 'ld-course-reviews' ),
						'desc' => __( 'Hide reviewer avatar', 'ld-course-reviews' ),
						'type' => 'checkbox'
					),
					'full_star_rating' => array(
						'id'   => 'full_star_rating',
						'name' => __( 'Full-star rating', 'ld-course-reviews' ),
						'desc' => __( 'Disable half star rating', 'ld-course-reviews' ),
						'type' => 'checkbox'
					),
					'reviews_per_page' => array(
						'id'   => 'reviews_per_page',
						'name' => __( 'Reviews per page', 'ld-course-reviews' ),
						'type' => 'number',
						'std'  => 10
					),
					'rating_summary_style' => array(
						'id' => 'rating_summary_style',
						'name' => __( 'Rating Summary Style', 'ld-course-reviews' ),
						'type' => 'select',
						'options' => array(
							'1' => __( 'Style 1', 'ld-course-reviews' ),
							'2' => __( 'Style 2', 'ld-course-reviews' ),
							'3' => __( 'Style 3', 'ld-course-reviews' ),
						),
						'std' => '1'
					),
					'review_template' => array(
						'id' => 'review_template',
						'name' => __( 'Single Review Template', 'ld-course-reviews' ),
						'type' => 'select',
						'options' => array(
							'' => __( 'Default Template', 'ld-course-reviews' ),
							'theme' => __( 'Theme Template', 'ld-course-reviews' )
						),
						'std' => ''
					),
					'show_after_course' => array(
						'id'   => 'show_after_course',
						'name' => __( 'Course Reviews', 'ld-course-reviews' ),
						'desc' => __( 'Show reviews after course content', 'ld-course-reviews' ),
						'type' => 'checkbox'
					)
				)
			)
		),

		// Email Settings
		'emails' => apply_filters( 'ldcr_settings_emails',
			array(
				'main' => array(
					'email_logo' => array(
						'id'   => 'email_logo',
						'name' => __( 'Email logo', 'ld-course-reviews' ),
						'type' => 'url',
						'desc' => __( 'URL to an image you want to show in the email header. Displayed on HTML emails only.', 'ld-course-reviews' ),
					),
					'from_name' => array(
						'id'   => 'from_name',
						'name' => __( 'From name', 'ld-course-reviews' ),
						'desc' => __( 'How the sender name appears in outgoing emails.', 'ld-course-reviews' ),
						'type' => 'text',
						'std'  => get_bloginfo( 'name' ),
					),
					'from_email' => array(
						'id'   => 'from_email',
						'name' => __( 'From email', 'ld-course-reviews' ),
						'desc' => __( 'How the sender email appears in outgoing emails.', 'ld-course-reviews' ),
						'type' => 'email',
						'std'  => get_bloginfo( 'admin_email' ),
						'allow_blank' => false,
					),
				),
				'new_review' => array(
					'new_review_email' => array(
						'id'   => 'new_review_email',
						'name' => __( 'Enable notification', 'ld-course-reviews' ),
						'desc' => __( 'Send email notification to the author after review submission', 'ld-course-reviews' ),
						'type' => 'checkbox',
						'std' => true,
					),
					'new_review_subject' => array(
						'id'   => 'new_review_subject',
						'name' => __( 'Email subject', 'ld-course-reviews' ),
						'type' => 'text',
						'placeholder' => __( 'A user has written a new review for {course_title}', 'ld-course-reviews' ),
					),
					'new_review_email_type' => array(
						'id' => 'new_review_email_type',
						'name' => __( 'Email type', 'ld-course-reviews' ),
						'type' => 'select',
						'options' => array(
							'plain' => __( 'Plain text', 'ld-course-reviews' ),
							'html' => __( 'HTML', 'ld-course-reviews' ),
						),
						'std' => 'plain',
						'desc' => __( 'Choose which format of email to send.', 'ld-course-reviews' ),
						'allow_empty' => false,
					),
					'plain_template' => array(
						'id' => 'plain_template',
						'name' => __( 'Plain template', 'ld-course-reviews' ),
						'type' => 'message',
						'desc' => __( 'To override and edit this email template copy <code>ld-course-reviews/templates/emails/plain/new-review.php</code> to your theme folder: <code>yourtheme/course-reviews/emails/plain/new-review.php</code>', 'ld-course-reviews' ),
					),
					'html_template' => array(
						'id' => 'html_template',
						'name' => __( 'HTML template', 'ld-course-reviews' ),
						'type' => 'message',
						'desc' => __( 'To override and edit this email template copy <code>ld-course-reviews/templates/emails/new-review.php</code> to your theme folder: <code>yourtheme/course-reviews/emails/new-review.php</code>', 'ld-course-reviews' ),
					),
				),
				'approved' => array(
					'approved_email' => array(
						'id'   => 'approved_email',
						'name' => __( 'Enable notification', 'ld-course-reviews' ),
						'desc' => __( 'Send email notification to the user after review approval', 'ld-course-reviews' ),
						'type' => 'checkbox',
						'std' => true,
					),
					'approved_subject' => array(
						'id'   => 'approved_subject',
						'name' => __( 'Email subject', 'ld-course-reviews' ),
						'type' => 'text',
						'placeholder' => __( 'Your review for {course_title} has been approved', 'ld-course-reviews' ),
					),
					'approved_email_type' => array(
						'id' => 'approved_email_type',
						'name' => __( 'Email type', 'ld-course-reviews' ),
						'type' => 'select',
						'options' => array(
							'plain' => __( 'Plain text', 'ld-course-reviews' ),
							'html' => __( 'HTML', 'ld-course-reviews' ),
						),
						'std' => 'plain',
						'desc' => __( 'Choose which format of email to send.', 'ld-course-reviews' ),
					),
					'plain_template' => array(
						'id' => 'plain_template',
						'name' => __( 'Plain template', 'ld-course-reviews' ),
						'type' => 'message',
						'desc' => __( 'To override and edit this email template copy <code>ld-course-reviews/templates/emails/plain/review-approved.php</code> to your theme folder: <code>yourtheme/course-reviews/emails/plain/review-approved.php</code>', 'ld-course-reviews' ),
					),
					'html_template' => array(
						'id' => 'html_template',
						'name' => __( 'HTML template', 'ld-course-reviews' ),
						'type' => 'message',
						'desc' => __( 'To override and edit this email template copy <code>ld-course-reviews/templates/emails/review-approved.php</code> to your theme folder: <code>yourtheme/course-reviews/emails/review-approved.php</code>', 'ld-course-reviews' ),
					),
				),
			)
		),
	);

	return apply_filters( 'ldcr_registered_settings', $ldcr_settings );
}

/**
 * Retrieve settings tabs
 *
 * @return array $tabs
 */
function ldcr_get_settings_tabs() {
	$tabs = array();
	$tabs['general'] = __( 'General', 'ld-course-reviews' );
	$tabs['emails'] = __( 'Emails', 'ld-course-reviews' );

	return apply_filters( 'ldcr_settings_tabs', $tabs );
}

/**
 * Retrieve settings tabs
 *
 * @return array $section
 */
function ldcr_get_settings_tab_sections( $tab = false ) {

	$tabs     = array();
	$sections = ldcr_get_registered_settings_sections();

	if( $tab && ! empty( $sections[ $tab ] ) ) {
		$tabs = $sections[ $tab ];
	} else if ( $tab ) {
		$tabs = array();
	}

	return $tabs;
}

/**
 * Get the settings sections for each tab
 * Uses a static to avoid running the filters on every request to this function
 *
 * @return array Array of tabs and sections
 */
function ldcr_get_registered_settings_sections() {

	static $sections = false;

	if ( false !== $sections ) {
		return $sections;
	}

	$sections = array(
		'general' => apply_filters( 'ldcr_settings_sections_general', array(
			'main'               => __( 'General', 'ld-course-reviews' ),
		)),
		'emails' => apply_filters( 'ldcr_settings_sections_emails', array(
			'main'               => __( 'General', 'ld-course-reviews' ),
			'new_review'      => __( 'New Review', 'ld-course-reviews' ),
			// 'approved'      => __( 'Review Approved', 'ld-course-reviews' ),
		))
	);

	$sections = apply_filters( 'ldcr_settings_sections', $sections );

	return $sections;
}


/**
 * Function that fills the field with the desired inputs as part of the larger form
 *
 * @param array $args Arguments passed by the setting
 */
function ldcr_settings_field( $args ) {
	if ( !isset( $args['type'] ) || !isset( $args['id'] ) ) {
		return;
	}

	$atts = array();
	$id = sanitize_key( $args['id'] );
	global $ldcr_settings;

	if ( isset( $ldcr_settings[ $args['id'] ] ) ) {
		$value = $ldcr_settings[ $args['id'] ];
	} else {
		$value = isset( $args['std'] ) ? $args['std'] : '';
	}

	switch ( $args['type'] ) {

		case 'text':
		case 'password':
		case 'number':
		case 'email':
		case 'url':
		case 'tel':
			$atts['type'] = $args['type'];
			$atts['id'] = 'ldcr_settings[' . $id . ']';
			$atts['name'] = 'ldcr_settings[' . $id . ']';
			$atts['value'] = $value;

			if ( !empty( $args['placeholder'] ) ) {
				$atts['placeholder'] = $args['placeholder'];
			}

			if ( !empty( $args['size'] ) ) {
				$atts['class'] = $args['size'] . '-text';
			} else {
				$atts['class'] = 'regular-text';
			}

			if ( !empty( $args['class'] ) ) {
				$atts['class'] .= ' ' . $args['class'];
			}

			if ( isset( $args['max'] ) ) {
				$atts['max'] = $args['max'];
			}

			if ( isset( $args['min'] ) ) {
				$atts['min'] = $args['min'];
			}

			if ( isset( $args['min'] ) ) {
				$atts['step'] = $args['step'];
			}

			if ( isset( $args['disabled'] ) && $args['disabled'] == true ) {
				$atts['disabled'] = 'disabled';
			}

			if ( isset( $args['readonly'] ) && $args['readonly'] == true ) {
				$atts['readonly'] = 'readonly';
			}
			?>
			<input <?php foreach( $atts as $name => $val ) { echo $name . '="' . esc_attr( $val ) . '" '; } ?>/>
			<?php if ( !empty( $args['desc'] ) ) : ?>
				<label for="ldcr_settings[<?php echo esc_attr( $id ); ?>]" class="ldcr-desc"><?php echo wp_kses_post( $args['desc'] ); ?></label>
			<?php endif;

			break;

		case 'checkbox':
			$atts['type'] = 'checkbox';
			$atts['id'] = 'ldcr_settings[' . $id . ']';
			$atts['name'] = 'ldcr_settings[' . $id . ']';
			$atts['value'] = '1';
			?>
			<input <?php foreach( $atts as $name => $val ) { echo $name . '="' . esc_attr( $val ) . '" '; } checked( 1, $value ); ?>/>
			<?php if ( !empty( $args['desc'] ) ) : ?>
				<label for="ldcr_settings[<?php echo esc_attr( $id ); ?>]"><?php echo wp_kses_post( $args['desc'] ); ?></label>
			<?php endif;
			
			break;

		case 'select':
			$atts['id'] = 'ldcr_settings[' . $id . ']';
			$atts['name'] = 'ldcr_settings[' . $id . ']';

			if ( !empty( $args['placeholder'] ) ) {
				$atts['placeholder'] = $args['placeholder'];
			}

			if ( !empty( $args['size'] ) ) {
				$atts['class'] = $args['size'] . '-text';
			} else {
				$atts['class'] = 'regular-text';
			}

			if ( !empty( $args['class'] ) ) {
				$atts['class'] .= ' ' . $args['class'];
			}

			if ( !empty( $args['options'] ) && is_array( $args['options'] ) ) {
				$options = $args['options'];
			} else {
				$options = array();
			}
			?>
			<select <?php foreach( $atts as $name => $val ) { echo $name . '="' . esc_attr( $val ) . '" '; } ?>>
			<?php foreach ( $options as $option => $label ) : ?>
				<option value="<?php echo esc_attr( $option ); ?>" <?php selected( $option, $value ); ?>><?php echo esc_html( $label ); ?></option>
			<?php endforeach; ?>
			</select>
			<?php if ( !empty( $args['desc'] ) ) : ?>
				<label for="ldcr_settings[<?php echo esc_attr( $id ); ?>]" class="ldcr-desc"><?php echo wp_kses_post( $args['desc'] ); ?></label>
			<?php endif;
			
			break;

		case 'textarea':
			$atts['id'] = 'ldcr_settings[' . $id . ']';
			$atts['name'] = 'ldcr_settings[' . $id . ']';
			
			if ( !empty( $args['placeholder'] ) ) {
				$atts['placeholder'] = $args['placeholder'];
			}

			if ( !empty( $args['class'] ) ) {
				$atts['class'] = $args['class'];
			}
			?>
			<textarea <?php foreach( $atts as $name => $val ) { echo $name . '="' . esc_attr( $val ) . '" '; } ?>style="min-width: 25em;height: 75px;"><?php echo wp_kses_post( $value ); ?></textarea>
			<?php if ( !empty( $args['desc'] ) ) : ?>
				<label for="ldcr_settings[<?php echo esc_attr( $id ); ?>]" class="ldcr-desc"><?php echo wp_kses_post( $args['desc'] ); ?></label>
			<?php endif;

			break;

		case 'message':
			if ( !empty( $args['desc'] ) ) { ?>
				<p><?php echo wp_kses_post( $args['desc'] ); ?></p>
			<?php
			}
			break;

		default:

			break;
	}

	echo apply_filters( 'ldcr_after_setting_output', '', $args );
}


function ldcr_register_settings() {
 	
	if ( false == get_option( 'ldcr_settings' ) ) {
		add_option( 'ldcr_settings' );
	}

	foreach ( ldcr_get_registered_settings() as $tab => $sections ) {
		foreach ( $sections as $section => $settings ) {

			add_settings_section(
				'ldcr_settings_' . $tab . '_' . $section,
				__return_null(),
				'__return_false',
				'ldcr_settings_' . $tab . '_' . $section
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
				    'class'         => '',
				) );

				add_settings_field(
					'ldcr_settings[' . $args['id'] . ']',
					$args['name'],
					'ldcr_settings_field',
					'ldcr_settings_' . $tab . '_' . $section,
					'ldcr_settings_' . $tab . '_' . $section,
					$args
				);
			}
		}
	}

 	register_setting( 'ldcr_settings', 'ldcr_settings', 'ldcr_settings_sanitize' );
}

add_action( 'admin_init', 'ldcr_register_settings' );

/**
 * Settings Sanitization
 *
 * Sanitize settings and add a settings updated message
 *
 * @param array   $input              the value inputted in the field
 * @global array  $ldcr_settings ldcr_settings option
 * @return string $input              sanitized value
 */
function ldcr_settings_sanitize( $input = array() ) {
	global $ldcr_settings;
	
	$doing_section = !empty( $_POST['_wp_http_referer'] ) ? true : false;
	$input = $input ? $input : array();

	if ( $doing_section ) {
		parse_str( $_POST['_wp_http_referer'], $referrer ); // Pull out the tab and section
		$tab = isset( $referrer['tab'] ) ? $referrer['tab'] : 'general';
		$section  = isset( $referrer['section'] ) ? $referrer['section'] : 'main';

		if ( ! empty( $_POST['ldcr_section_override'] ) ) {
			$section = sanitize_text_field( $_POST['ldcr_section_override'] );
		}
		$setting_types = ldcr_get_registered_settings_types( $tab, $section );
	} else {
		$setting_types = ldcr_get_registered_settings_types();
	}

	// Merge new settings with the existing
	$output = array_merge( $ldcr_settings, $input );
	
	foreach ( $setting_types as $key => $type ) {
		// Some setting types are not actually settings, just keep moving along here
		$non_setting_types = apply_filters( 'ldcr_non_setting_types', array( 'hook', 'message' ) );

		if ( in_array( $type, $non_setting_types ) ) {
			continue;
		}

		if ( array_key_exists( $key, $output ) ) {
			$output[ $key ] = apply_filters( 'ldcr_settings_sanitize_' . $type, $output[ $key ], $key );
			$output[ $key ] = apply_filters( 'ldcr_settings_sanitize', $output[ $key ], $key );
		}

		if ( $doing_section ) {
			switch( $type ) {
				case 'checkbox':
				case 'multicheck':
					if ( !array_key_exists( $key, $input ) ) {
						unset( $output[ $key ] );
					}
					break;

				case 'number':
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
		add_settings_error( 'ldcr-notices', '', __( 'Settings updated.', 'ld-course-reviews' ), 'updated' );
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
function ldcr_get_registered_settings_types( $filtered_tab = false, $filtered_section = false ) {
	$settings = ldcr_get_registered_settings();
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
function ldcr_sanitize_text_field( $input ) {
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

	$allowed_tags = apply_filters( 'ldcr_allowed_html_tags', $tags );

	return trim( wp_kses( $input, $allowed_tags ) );
}
add_filter( 'ldcr_settings_sanitize_text', 'ldcr_sanitize_text_field' );


/**
 * Settings Page
 *
 * Renders the settings page.
 *
 * @since 1.0
 * @return void
 */
function ldcr_settings_page() {
	$settings_tabs = ldcr_get_settings_tabs();
	$settings_tabs = empty($settings_tabs) ? array() : $settings_tabs;
	$active_tab    = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'general';
	$active_tab    = array_key_exists( $active_tab, $settings_tabs ) ? $active_tab : 'general';
	$sections      = ldcr_get_settings_tab_sections( $active_tab );
	$key           = 'main';

	if ( ! empty( $sections ) ) {
		$key = key( $sections );
	}

	$registered_sections = ldcr_get_settings_tab_sections( $active_tab );
	$section             = isset( $_GET['section'] ) && ! empty( $registered_sections ) && array_key_exists( $_GET['section'], $registered_sections ) ? sanitize_text_field( $_GET['section'] ) : $key;

	// Unset 'main' if it's empty and default to the first non-empty if it's the chosen section
	$all_settings = ldcr_get_registered_settings();

	// Let's verify we have a 'main' section to show
	$has_main_settings = true;
	if ( empty( $all_settings[ $active_tab ]['main'] ) ) {
		$has_main_settings = false;
	}

	// Check for old non-sectioned settings (see #4211 and #5171)
	if ( ! $has_main_settings ) {
		foreach( $all_settings[ $active_tab ] as $sid => $stitle ) {
			if ( is_string( $sid ) && ! empty( $sections) && array_key_exists( $sid, $sections ) ) {
				continue;
			} else {
				$has_main_settings = true;
				break;
			}
		}
	}

	$override = false;
	if ( false === $has_main_settings ) {
		unset( $sections['main'] );

		if ( 'main' === $section ) {
			foreach ( $sections as $section_key => $section_title ) {
				if ( ! empty( $all_settings[ $active_tab ][ $section_key ] ) ) {
					$section  = $section_key;
					$override = true;
					break;
				}
			}
		}
	}

	ob_start();
	?>
	<div id="ldcr-settings-page" class="wrap">
		<h2 class="nav-tab-wrapper">
			<?php
			foreach ( ldcr_get_settings_tabs() as $tab_id => $tab_name ) {
				$tab_url = add_query_arg( array(
					'settings-updated' => false,
					'tab'              => $tab_id,
				) );

				// Remove the section from the tabs so we always end up at the main section
				$tab_url = remove_query_arg( 'section', $tab_url );

				$active = $active_tab == $tab_id ? ' nav-tab-active' : '';

				echo '<a href="' . esc_url( $tab_url ) . '" class="nav-tab' . $active . '">';
					echo esc_html( $tab_name );
				echo '</a>';
			}
			?>
		</h2>
		<?php
		$number_of_sections = count( $sections );
		$number = 0;
		if ( $number_of_sections > 1 ) {
			echo '<ul class="subsubsub">';
			foreach( $sections as $section_id => $section_name ) {
				echo '<li>';
				$number++;
				$tab_url = add_query_arg( array(
					'settings-updated' => false,
					'tab' => $active_tab,
					'section' => $section_id
				) );
				$class = '';
				if ( $section == $section_id ) {
					$class = 'current';
				}
				echo '<a class="' . $class . '" href="' . esc_url( $tab_url ) . '">' . $section_name . '</a>';

				if ( $number != $number_of_sections ) {
					echo ' | ';
				}
				echo '</li>';
			}
			echo '</ul>';
		}
		?>
		<div id="ldcr-settings-wrapper">
			<form method="post" action="options.php">
				<table class="form-table">
				<?php

				settings_fields( 'ldcr_settings' );
				do_settings_sections( 'ldcr_settings_' . $active_tab . '_' . $section );

				// If the main section was empty and we overrode the view with the next subsection, prepare the section for saving
				if ( true === $override ) {
					?><input type="hidden" name="ldcr_section_override" value="<?php echo $section; ?>" /><?php
				}

				?>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
	</div>
	<?php
	echo ob_get_clean();
}
