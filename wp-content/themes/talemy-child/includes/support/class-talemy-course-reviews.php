<?php
/**
 * Learndash Course Reviews integration
 *
 * @since   1.1.7
 * @package Talemy/Classes
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Talemy_Course_Reviews {

	/**
	 * Constructor
	 */
	public static function init() {
		add_action( 'ldcr_before_main_content', array( __CLASS__, 'output_before_main_content' ) );
		add_action( 'ldcr_after_main_content', array( __CLASS__, 'output_after_main_content' ) );
	}

	/**
	 * Output before content wrapper
	 *
	 * @return void
	 */
	public static function output_before_main_content() {
		?>
		<div class="#content">
			<div class="article-content">
				<div class="container">
		<?php
	}

	/**
	 * Output after content wrapper
	 *
	 * @return void
	 */
	public static function output_after_main_content() {
		?>
				</div>
			</div>
		</div>
		<?php
	}

}

if ( defined( 'LDCR_PLUGIN_FILE' ) ) {
	Talemy_Course_Reviews::init();
}

