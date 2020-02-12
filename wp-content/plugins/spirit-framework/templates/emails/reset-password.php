<?php
/**
 * Reset password email
 *
 * This template can be overridden by copying it to yourtheme/spirit/emails/reset-password.php.
 *
 * @package 	Spirit Framework/Templates/Emails
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'sf_email_header', $email_heading, $email ); ?>

<p><?php _e( 'Someone requested that the password be reset for the following account:', 'spirit' ); ?></p>
<p><?php printf( __( 'Username: %s', 'spirit' ), $user_login ); ?></p>
<p><?php _e( 'If this was a mistake, just ignore this email and nothing will happen.', 'spirit' ); ?></p>
<p><?php _e( 'To reset your password, visit the following address:', 'spirit' ); ?></p>
<p>
	<a class="link" href="<?php echo esc_url_raw( $reset_pass_url ); ?>">
			<?php _e( 'Click here to reset your password', 'spirit' ); ?></a>
</p>
<p></p>

<?php do_action( 'sf_email_footer', $email ); ?>
