<?php
/**
 * Social Login
 *
 * This template can be overridden by copying it to yourtheme/sf/social-login.php.
 *
 * @package Spirit_Framework/Templates
 * @version 1.0.0
 * 
 */

if ( class_exists('NextendSocialLogin', false) ) {
	echo NextendSocialLogin::renderButtonsWithContainer();
}