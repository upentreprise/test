<?php
/**
 * Activate account email
 *
 * This template can be overridden by copying it to yourtheme/spirit/emails/activate-account.php.
 *
 * @package 	Spirit Framework/Templates/Emails
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'sf_email_header', $email_heading, $email ); ?>
	
	<p><?php printf( __( 'Welcome to %s. Please click the button below to confirm your email address.', 'spirit' ), '<b>'. esc_html( $blogname ) .'</b>' ); ?></p>

	<br>

	<p><center><a class="button" href="<?php echo esc_url( $activation_link ); ?>"><?php esc_html_e( 'Confirm your email address', 'spirit' ); ?></a></center></p>

<?php do_action( 'sf_email_footer', $email );
