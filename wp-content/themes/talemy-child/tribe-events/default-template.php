<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Display -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.23
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header();
do_action( 'talemy_content_start' );
get_template_part( 'templates/ec-content-banner' );
?>
<div class="content-wrapper">
	<div class="container">
		<main id="tribe-events-pg-template" class="tribe-events-pg-template">
			<?php tribe_events_before_html(); ?>
			<?php tribe_get_view(); ?>
			<?php tribe_events_after_html(); ?>
		</main> <!-- #tribe-events-pg-template -->
	</div>
</div>
<?php
do_action( 'talemy_content_end' );
get_footer();
