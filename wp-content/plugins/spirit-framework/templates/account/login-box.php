<?php
/**
 * Login Box
 *
 * This template can be overridden by copying it to yourtheme/sf/login-box.php.
 *
 * @package Spirit_Framework/Templates
 * @version 1.0.0
 * 
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

?>
<div class="sf-login-wrapper">
<?php if ( !is_user_logged_in() ): ?>
	<div class="sf-login-tabs">
		<a href="javascript:void(0)" class="sf-login-tab" data-form="login-form"><?php _e( 'Log In', 'spirit' ); ?></a>
		<a href="javascript:void(0)" class="sf-register-tab" data-form="register-form"><?php _e( 'Register', 'spirit' ); ?></a>
		<a href="javascript:void(0)" class="sf-lost-tab" data-form="lost-password-form"><?php _e( 'Reset your possword', 'spirit' ); ?></a>
	</div>
	<div class="sf-login-forms">
		<div class="preloader">
			<svg class="google-circular" viewBox="25 25 50 50">
				<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/>
			</svg>
		</div>
		<?php sf_get_template( 'account/form-login.php' ); ?>
		<?php sf_get_template( 'account/form-register.php' ); ?>
		<?php sf_get_template( 'account/form-lost-password.php' ); ?>
		<div class="sf-bottom-message"><a href="javascript:void(0);" class="sf-lost-password"><?php _e( 'Forgot Password?', 'spirit' ); ?></a></div>
		<div class="sf-social-login"><?php sf_get_template( 'account/social-login.php' ); ?></div>
	</div>
<?php else: ?>
<?php $user = wp_get_current_user(); ?>
	<div class="sf-user-details">
		<figure class="sf-user-avatar"><?php echo get_avatar( $user->ID, 80 ); ?></figure>
		<h2 class="sf-user-name"><?php echo $user->first_name; ?></h2>
		<?php do_action( 'sf_logged_in_content' ); ?>
		<a href="<?php echo wp_logout_url( home_url() ); ?>" class="btn btn-secondary btn-block"><?php _e( 'Logout', 'spirit' ); ?></a>
	</div>
<?php endif; ?>
</div>