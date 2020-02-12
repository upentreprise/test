<?php
/**
 * New account email
 *
 * This template can be overridden by copying it to yourtheme/spirit/emails/new-account.php.
 *
 * @package 	Spirit Framework/Templates/Emails
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'sf_email_header', $email_heading, $email ); ?>

	<p><?php printf( __( 'Thanks for creating an account on %s.', 'spirit' ), esc_html( $blogname ) ); ?></p>

	<p><?php printf( __( 'Username: %s', 'spirit' ), '<strong>' . esc_html( $user_login ) . '</strong>' ); ?></p>

<?php if ( $password_generated ) : ?>

	<p><?php printf( __( 'Password: %s', 'spirit' ), '<strong>' . esc_html( $user_pass ) . '</strong>' ); ?></p>

<?php else: ?>

	<p><?php _e( 'Password: [Password entered at registration]', 'spirit' ); ?></p>

<?php endif; ?>

	<p><?php printf( __( 'Login URL: %s', 'spirit' ), make_clickable( esc_url( network_home_url( '/wp-login.php', ( is_ssl() ? 'https' : 'http' ) ) ) ) ); ?></p>

<?php do_action( 'sf_email_footer', $email );
