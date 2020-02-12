<?php
/**
 * Account activated email
 *
 * This template can be overridden by copying it to yourtheme/spirit/emails/activated.php.
 *
 * @package 	Spirit Framework/Templates/Emails
 * @version     1.0.0
 * @since       1.0.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'sf_email_header', $email_heading, $email ); ?>
	
	<p><?php esc_html_e( 'Your email address has been confirmed.', 'spirit' ); ?></p>

<?php do_action( 'sf_email_footer', $email );
