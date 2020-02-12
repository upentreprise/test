<?php
/**
 * Register Form
 *
 * This template can be overridden by copying it to yourtheme/spirit/form-register.php.
 *
 * @package Spirit_Framework/Templates
 * @version 1.0.0
 * 
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

?>
<?php if ( !is_user_logged_in() ) : ?>

<form method="post" action="<?php echo wp_registration_url(); ?>" class="sf-register-form">
	
	<?php do_action( 'sf_register_form_start' ); ?>
	
	<div class="sf-form-message"></div>
	
	<?php if ( SF()->get_setting( 'new_account_first_last_name' ) ) : ?>
		
		<div class="sf-form-row">
			<input type="text" name="sf-firstname" class="sf-firstname validate" placeholder="<?php _e( 'First name', 'spirit' ); ?>">
			<i class="fas fa-user"></i>
		</div>
		<div class="sf-form-row">
			<input type="text" name="sf-lastname" class="sf-lastname validate" placeholder="<?php _e( 'Last name', 'spirit' ); ?>">
			<i class="fas fa-user"></i>
		</div>
	
	<?php endif; ?>
	
	<?php if ( !SF()->get_setting( 'new_account_generate_username' ) ) : ?>

		<div class="sf-form-row">
			<input type="text" name="sf-username" class="sf-username validate" placeholder="<?php _e( 'Username', 'spirit' ); ?>">
			<i class="fas fa-user"></i>
		</div>
	
	<?php endif; ?>

	<div class="sf-form-row">
		<input type="text" name="sf-email" class="sf-email validate" placeholder="<?php _e( 'Email', 'spirit' ); ?>">
		<i class="fas fa-envelope"></i>
	</div>

	<?php if ( !SF()->get_setting( 'new_account_generate_password' ) ) : ?>
	
		<div class="sf-form-row">
			<input type="password" name="sf-password" class="sf-password validate" placeholder="<?php _e( 'Password', 'spirit' ); ?>">
			<i class="fas fa-key"></i>
		</div>

	<?php endif; ?>
	
	<?php if ( !empty( SF()->get_setting( 'new_account_agreement_text' ) ) ) : ?>
		
		<div class="sf-form-row">
			<label>
				<input type="checkbox" name="sf-account-agreement" class="sf-checkbox" checked disabled>
				<span><?php echo sf_get_new_account_agreement_text(); ?></span>
			</label>
		</div>

	<?php endif; ?>
	
	<button type="submit" class="btn btn-primary btn-lg btn-block"><?php _e( 'Register', 'spirit' ); ?></button>
	<input type="hidden" class="sf-register-nonce" name="sf-register-nonce" value="<?php echo wp_create_nonce( 'sf_register_nonce' ); ?>">

	<?php do_action( 'sf_register_form_end' ); ?>

</form>

<?php endif; ?>