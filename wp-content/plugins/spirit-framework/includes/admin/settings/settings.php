<?php

/**
 * Retrieve the array of plugin settings
 *
 * @return array
*/
function sf_get_registered_settings() {

	/**
	 * 'Whitelisted' SF settings, filters are provided for each settings
	 * section to allow extensions and other plugins to add their own settings
	 */

	$sf_settings = array(
		/** General Settings */
		'general' => apply_filters( 'sf_settings_general',
			array(
				'main' => array(
					'enable_custom_sidebars' => array(
						'id'   => 'enable_custom_sidebars',
						'name' => __( 'Custom Sidebars', 'spirit' ),
						'desc' => __( 'Enable Custom Sidebars', 'spirit' ),
						'type' => 'checkbox',
						'std'  => '1'
					),
					'enable_login_registration' => array(
						'id'   => 'enable_login_registration',
						'name' => __( 'Login & Registration', 'spirit' ),
						'desc' => __( 'Enable User Login & Registration', 'spirit' ),
						'type' => 'checkbox',
						'std'  => '1'
					)
				)
			)
		),

		// Login Settings
		'login' => apply_filters( 'sf_settings_login',
			array(
				'main' => array(
					'login_redirect_page' => array(
						'id'   => 'login_redirect_page',
						'name' => __( 'Login Redirect Page', 'spirit' ),
						'type' => 'select',
						'options' => sf_get_option_pages(),
						'class' => 'allow-empty'
					),
					'verification_page' => array(
						'id'   => 'verification_page',
						'name' => __( 'Verification Page', 'spirit' ),
						'type' => 'select',
						'options' => sf_get_option_pages(),
						'class' => 'allow-empty'
					),
					'verification_redirect_page' => array(
						'id'   => 'verification_redirect_page',
						'name' => __( 'Verification Redirect Page', 'spirit' ),
						'type' => 'select',
						'options' => sf_get_option_pages(),
						'class' => 'allow-empty'
					),
					'new_account_verify_email' => array(
						'id'   => 'new_account_verify_email',
						'name' => __( 'Email Verification', 'spirit' ),
						'desc' => __( 'New account requires email verification', 'spirit' ),
						'type' => 'checkbox',
					),
					'verification_auto_login' => array(
						'id'   => 'verification_auto_login',
						'name' => __( 'Verification Auto login', 'spirit' ),
						'desc' => __( 'Automatically login after verification', 'spirit' ),
						'type' => 'checkbox',
					),
					'new_account_generate_username' => array(
						'id'   => 'new_account_generate_username',
						'name' => __( 'Autogenerate Username', 'spirit' ),
						'desc' => __( 'When creating an account, automatically generate a username from the user\'s email address', 'spirit' ),
						'type' => 'checkbox',
					),
					'new_account_generate_password' => array(
						'id'   => 'new_account_generate_password',
						'name' => __( 'Autogenerate Password', 'spirit' ),
						'desc' => __( 'When creating an account, automatically generate an account password', 'spirit' ),
						'type' => 'checkbox',
					),
				),
				'forms' => array(
					'login_remember_me' => array(
						'id'   => 'login_remember_me',
						'name' => __( 'Remember Me', 'spirit' ),
						'desc' => __( 'Display remember me field in Login Form', 'spirit' ),
						'type' => 'checkbox',
						// 'std'  => true,
					),
					'first_last_name' => array(
						'id'   => 'new_account_first_last_name',
						'name' => __( 'First name and Last name', 'spirit' ),
						'desc' => __( 'Display first name and last name fields in Registration Form', 'spirit' ),
						'type' => 'checkbox',
					),
					'new_account_agreement_text' => array(
						'id'   => 'new_account_agreement_text',
						'name' => __( 'New Account Agreement', 'spirit' ),
						'tooltip' => __( 'Optionally add some text about your site terms and privacy policy to show on account registration form.', 'spirit' ),
						'type' => 'textarea',
						'std' => __( 'I agree to [terms] and [privacy_policy]', 'spirit' ),
					),
					'terms_page' => array(
						'id'   => 'terms_page_id',
						'name' => __( 'Terms and Conditions Page', 'spirit' ),
						'type' => 'select',
						'options' => sf_get_option_pages(),
						'class' => 'allow-empty',
					),
					'privacy_page' => array(
						'id'   => 'privacy_page_id',
						'name' => __( 'Privacy Policy Page', 'spirit' ),
						'type' => 'select',
						'options' => sf_get_option_pages(),
						'class' => 'allow-empty',
					)
				)
			)
		),

		// Email Settings
		'emails' => apply_filters( 'sf_settings_emails',
			array(
				'main' => array(
					'email_logo' => array(
						'id'   => 'email_logo',
						'name' => __( 'Logo', 'spirit' ),
						'type' => 'upload',
						'tooltip' => __( 'URL to an image you want to show in the email header. Displayed on HTML emails only.', 'spirit' ),
					),
					'from_name' => array(
						'id'   => 'from_name',
						'name' => __( 'From Name', 'spirit' ),
						'type' => 'text',
						'std'  => get_bloginfo( 'name' ),
						'tooltip' => __( 'How the sender name appears in outgoing emails.', 'spirit' ),
					),
					'from_email' => array(
						'id'   => 'from_email',
						'name' => __( 'From Email', 'spirit' ),
						'tooltip' => __( 'How the sender email appears in outgoing emails.', 'spirit' ),
						'type' => 'email',
						'std'  => get_bloginfo( 'admin_email' ),
					),
				),
				'new_account' => array(
					'new_account_subject' => array(
						'id'   => 'new_account_subject',
						'name' => __( 'Email Subject', 'spirit' ),
						'type' => 'text',
						'placeholder' => __( 'Your account on {site_title}', 'spirit' ),
					),
					'new_account_heading' => array(
						'id'   => 'new_account_heading',
						'name' => __( 'Email Heading', 'spirit' ),
						'type' => 'text',
						'placeholder' => __( 'Welcome to {site_title}', 'spirit' ),
					),
					'new_account_email_type' => array(
						'id' => 'new_account_email_type',
						'name' => __( 'Email Type', 'spirit' ),
						'type' => 'select',
						'options' => array(
							'plain' => __( 'Plain text', 'spirit' ),
							'html' => __( 'HTML', 'spirit' ),
							'multipart' => __( 'Multipart', 'spirit' ),
						),
						'std' => 'plain',
						'tooltip' => __( 'Choose which format of email to send.', 'spirit' ),
					),
					'plain_template' => array(
						'id' => 'plain_template',
						'name' => __( 'Plain template', 'spirit' ),
						'type' => 'message',
						'desc' => __( 'To override and edit this email template copy <code>spirit-framework/templates/emails/plain/new-account.php</code> to your theme folder: <code>yourtheme/spirit/emails/plain/new-account.php</code>', 'spirit' ),
					),
					'html_template' => array(
						'id' => 'html_template',
						'name' => __( 'HTML template', 'spirit' ),
						'type' => 'message',
						'desc' => __( 'To override and edit this email template copy <code>spirit-framework/templates/emails/new-account.php</code> to your theme folder: <code>yourtheme/spirit/emails/new-account.php</code>', 'spirit' ),
					),
				),
				'reset_password' => array(
					'reset_password_subject' => array(
						'id'   => 'reset_password_subject',
						'name' => __( 'Email Subject', 'spirit' ),
						'type' => 'text',
						'placeholder' => __( 'Password reset for {site_title}', 'spirit' ),
					),
					'reset_password_heading' => array(
						'id'   => 'reset_password_heading',
						'name' => __( 'Email Heading', 'spirit' ),
						'type' => 'text',
						'placeholder' => __( 'Password reset instructions', 'spirit' ),
					),
					'reset_password_email_type' => array(
						'id' => 'reset_password_email_type',
						'name' => __( 'Email Type', 'spirit' ),
						'type' => 'select',
						'options' => array(
							'plain' => __( 'Plain text', 'spirit' ),
							'html' => __( 'HTML', 'spirit' ),
							'multipart' => __( 'Multipart', 'spirit' ),
						),
						'std' => 'plain',
						'tooltip' => __( 'Choose which format of email to send.', 'spirit' ),
					),
					'plain_template' => array(
						'id' => 'plain_template',
						'name' => __( 'Plain template', 'spirit' ),
						'type' => 'message',
						'desc' => __( 'To override and edit this email template copy <code>spirit-framework/templates/emails/plain/reset-password.php</code> to your theme folder: <code>yourtheme/spirit/emails/plain/reset-password.php</code>', 'spirit' ),
					),
					'html_template' => array(
						'id' => 'html_template',
						'name' => __( 'HTML template', 'spirit' ),
						'type' => 'message',
						'desc' => __( 'To override and edit this email template copy <code>spirit-framework/templates/emails/reset-password.php</code> to your theme folder: <code>yourtheme/spirit/emails/reset-password.php</code>', 'spirit' ),
					)
				),
				'activate_account' => array(
					'activate_account_subject' => array(
						'id'   => 'activate_account_subject',
						'name' => __( 'Email Subject', 'spirit' ),
						'type' => 'text',
						'placeholder' => __( 'Account Confirmation', 'spirit' ),
					),
					'activate_account_heading' => array(
						'id'   => 'activate_account_heading',
						'name' => __( 'Email Heading', 'spirit' ),
						'type' => 'text',
						'placeholder' => __( 'Account Confirmation', 'spirit' ),
					),
					'activate_account_email_type' => array(
						'id' => 'activate_account_email_type',
						'name' => __( 'Email Type', 'spirit' ),
						'type' => 'select',
						'options' => array(
							'plain' => __( 'Plain text', 'spirit' ),
							'html' => __( 'HTML', 'spirit' ),
							'multipart' => __( 'Multipart', 'spirit' ),
						),
						'std' => 'plain',
						'tooltip' => __( 'Choose which format of email to send.', 'spirit' ),
					),
					'plain_template' => array(
						'id' => 'plain_template',
						'name' => __( 'Plain template', 'spirit' ),
						'type' => 'message',
						'desc' => __( 'To override and edit this email template copy <code>spirit-framework/templates/emails/plain/activate-account.php</code> to your theme folder: <code>yourtheme/spirit/emails/plain/activate-account.php</code>', 'spirit' ),
					),
					'html_template' => array(
						'id' => 'html_template',
						'name' => __( 'HTML template', 'spirit' ),
						'type' => 'message',
						'desc' => __( 'To override and edit this email template copy <code>spirit-framework/templates/emails/activate-account.php</code> to your theme folder: <code>yourtheme/spirit/emails/activate-account.php</code>', 'spirit' ),
					)
				)
			)
		)
	);

	return apply_filters( 'sf_registered_settings', $sf_settings );
}

/**
 * Retrieve settings tabs
 *
 * @return array $tabs
 */
function sf_get_settings_tabs() {
	$tabs = array();
	$tabs['general'] = __( 'General', 'spirit' );
	$tabs['login'] = __( 'Login', 'spirit' );
	$tabs['emails'] = __( 'Emails', 'spirit' );

	return apply_filters( 'sf_settings_tabs', $tabs );
}

/**
 * Retrieve settings tabs
 *
 * @return array $section
 */
function sf_get_settings_tab_sections( $tab = false ) {

	$tabs     = array();
	$sections = sf_get_registered_settings_sections();

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
function sf_get_registered_settings_sections() {

	static $sections = false;

	if ( false !== $sections ) {
		return $sections;
	}

	$sections = array(
		'general' => apply_filters( 'sf_settings_sections_general', array(
			'main'               => __( 'General', 'spirit' ),
		)),
		'login' => apply_filters( 'sf_settings_sections_login', array(
			'main'               => __( 'General', 'spirit' ),
			'forms'              => __( 'Forms', 'spirit' )
		)),
		'emails' => apply_filters( 'sf_settings_sections_login', array(
			'main'               => __( 'General', 'spirit' ),
			'new_account'        => __( 'New Account', 'spirit' ),
			'activate_account'   => __( 'Activate Account', 'spirit' ),
			'reset_password'     => __( 'Reset Password', 'spirit' )
		))
	);

	$sections = apply_filters( 'sf_settings_sections', $sections );

	return $sections;
}