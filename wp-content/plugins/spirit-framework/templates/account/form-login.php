<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/spirit/form-login.php.
 *
 * @package Spirit_Framework/Templates
 * @version 1.0.0
 * 
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

?>
<?php if ( !is_user_logged_in() ) : ?>

<form method="post" action="<?php echo wp_login_url(); ?>" class="sf-login-form">
	
	<?php do_action( 'sf_login_form_start' ); ?>
	
	<div class="sf-form-message"></div>
	<div class="sf-form-row">
		<input type="text" name="sf-username" class="sf-username validate" placeholder="<?php _e( 'Username or Email', 'spirit' ); ?>">
		<i class="fas fa-user"></i>
	</div>
	<div class="sf-form-row">
		<input type="password" name="sf-password" class="sf-password validate" placeholder="<?php _e( 'Password', 'spirit' ); ?>">
		<i class="fas fa-key"></i>
	</div>
	
	<?php if ( SF()->get_setting( 'login_remember_me' ) ) : ?>
		
		<div class="sf-form-row">
			<?php $id_suffix = uniqid(); ?>
			<label for="sf-remember-<?php echo esc_attr( $id_suffix ); ?>">
				<input type="checkbox" id="sf-remember-<?php echo esc_attr( $id_suffix ); ?>" name="sf-rememberme" class="sf-checkbox sf-rememberme">
				<span><?php _e( 'Remember Me', 'spirit' ); ?></span>
			</label>
		</div>
	
	<?php endif; ?>
	
	<button type="submit" class="btn btn-primary btn-lg btn-block"><?php _e( 'Log In', 'spirit' ); ?></button>
	<input type="hidden" class="sf-login-nonce" name="sf-login-nonce" value="<?php echo wp_create_nonce( 'sf_login_nonce' ); ?>">
	
	<?php do_action( 'sf_login_form_end' ); ?>

</form>

<?php endif; ?>
