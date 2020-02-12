<?php
/**
 * Deprecated hooks & functions
 *
 * @author 		ThemeSpirit
 * @version     1.0.0
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'talemy_after_sidebar', '__return_empty_string' );