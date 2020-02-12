<?php
/**
 * Lost Password Form
 *
 * This template can be overridden by copying it to yourtheme/sf/form-lost-password.php.
 *
 * @package Spirit_Framework/Templates
 * @version 1.0.0
 * 
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

?>
<form method="post" action="<?php echo wp_lostpassword_url(); ?>" class="sf-lost-password-form">
	
	<?php do_action( 'sf_lost_password_form_start' ); ?>
	
	<div class="sf-top-message"><?php _e( 'Please enter your username or email address. You will receive a link to create a new password via email.', 'spirit' ); ?></div>
	<div class="sf-form-message"></div>
	<div class="sf-form-row">
		<input type="text" name="sf-user-login" class="sf-user-login validate" placeholder="<?php _e( 'Username or Email', 'spirit' ); ?>">
		<i class="fas fa-envelope"></i>
	</div>
	<button type="submit" class="btn btn-primary btn-lg btn-block"><?php _e( 'Get New Password', 'spirit' ); ?></button>
	<input type="hidden" class="sf-lost-password-nonce" name="sf-lost-password-nonce" value="<?php echo wp_create_nonce( 'sf_lost_password_nonce' ); ?>">
	<div class="sf-form-after-message"><?php _e( 'If you do not receive this email, please check your spam folder or contact us for assistance.', 'spirit' ); ?></div>

	<?php do_action( 'sf_lost_password_form_end' ); ?>

</form>