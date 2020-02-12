<?php
/**
 * Activate account email
 *
 * This template can be overridden by copying it to yourtheme/spirit/emails/plain/activate-account.php.
 *
 * @package 	Spirit Framework/Templates/Emails/Plain
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

echo $email_heading . "\n\n";

echo sprintf( __( 'Welcome to %s. Please click the link below to confirm your email address.', 'spirit' ), esc_html( $blogname ) ) . "\n\n";

echo esc_url( $activation_link ) . "\n\n";

echo "\n=====================================================================\n\n";

echo apply_filters( 'sf_email_footer_text', SF()->get_setting( 'email_footer_text' ) );
