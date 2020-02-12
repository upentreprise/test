<?php
/**
 * Reset password email
 *
 * This template can be overridden by copying it to yourtheme/spirit/emails/plain/reset-password.php.
 *
 * @package 	Spirit Framework/Templates/Emails/Plain
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

echo "= " . $email_heading . " =\n\n";

echo __( 'Someone requested that the password be reset for the following account:', 'spirit' ) . "\r\n\r\n";
echo esc_url( network_home_url( '/' ) ) . "\r\n\r\n";
echo sprintf( __( 'Username: %s', 'spirit' ), $user_login ) . "\r\n\r\n";
echo __( 'If this was a mistake, just ignore this email and nothing will happen.', 'spirit' ) . "\r\n\r\n";
echo __( 'To reset your password, visit the following address:', 'spirit' ) . "\r\n\r\n";

echo esc_url_raw( $reset_pass_url ) . "\r\n";

echo "\n=====================================================================\n\n";

echo apply_filters( 'sf_email_footer_text', SF()->get_setting( 'email_footer_text' ) );
