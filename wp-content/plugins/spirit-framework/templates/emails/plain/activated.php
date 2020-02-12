<?php
/**
 * Account activated email
 *
 * This template can be overridden by copying it to yourtheme/spirit/emails/plain/activated.php.
 *
 * @package 	Spirit Framework/Templates/Emails/Plain
 * @version     1.0.0
 * @since       1.0.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

echo $email_heading . "\n\n";

echo esc_html__( 'Your email address has been confirmed.', 'spirit' ) . "\n\n";

echo "\n=====================================================================\n\n";

echo apply_filters( 'sf_email_footer_text', SF()->get_setting( 'email_footer_text' ) );
