<?php
/**
 * New account email
 *
 * This template can be overridden by copying it to yourtheme/spirit/emails/plain/new-account.php.
 *
 * @package 	Spirit Framework/Templates/Emails/Plain
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

echo "= " . $email_heading . " =\n\n";

echo sprintf( __( 'Thanks for creating an account on %s.', 'spirit' ), $blogname ) . "\n\n";

echo sprintf( __( 'Username: %s', 'spirit' ), $user_login ) . "\n\n";

if ( $password_generated ) {
	echo sprintf( __( 'Password: %s', 'spirit' ), $user_pass ) . "\n\n";
} else {
	echo __( 'Password: [Password entered at registration]', 'spirit' ) . "\n\n";
}

echo sprintf( __( 'Login URL: %s', 'spirit' ), network_home_url( '/wp-login.php', ( is_ssl() ? 'https' : 'http' ) ) ) . "\n\n";

echo "\n=====================================================================\n\n";

echo apply_filters( 'sf_email_footer_text', SF()->get_setting( 'email_footer_text' ) );
