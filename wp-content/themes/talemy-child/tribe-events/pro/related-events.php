<?php
/**
 * Related Events Template
 * The template for displaying related events on the single event page.
 *
 * You can recreate an ENTIRELY new related events view by doing a template override, and placing
 * a related-events.php file in a tribe-events/pro/ directory within your theme directory, which
 * will override the /views/pro/related-events.php.
 *
 * You can use any or all filters included in this file or create your own filters in
 * your functions.php. In order to modify or extend a single filter, please see our
 * readme on templates hooks and filters
 *
 * @package TribeEventsCalendarPro
 * @version 4.4.28
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$posts = tribe_get_related_posts();

if ( is_array( $posts ) && ! empty( $posts ) ) : ?>

<div class="events-single__related">
	<h2 class="tribe-events-related-events-title"><?php printf( esc_html__( 'Related %s', 'talemy' ), tribe_get_event_label_plural() ); ?></h2>

	<ul class="tribe-related-events tribe-clearfix">
		<?php foreach ( $posts as $post ) : ?>
		<li class="equal-height">
			<div class="tribe-related-events-thumbnail">
				<a href="<?php echo esc_url( tribe_get_event_link( $post ) ); ?>" class="url" rel="bookmark" tabindex="-1">
				<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
				<?php echo get_the_post_thumbnail( $post->ID, 'talemy_thumb_small' ); ?>
				<?php else : ?>
					<img src="<?php echo esc_url( trailingslashit( Tribe__Events__Pro__Main::instance()->pluginUrl ) . 'src/resources/images/tribe-related-events-placeholder.png' ); ?>" alt="<?php echo esc_attr( get_the_title( $post->ID ) ); ?>" />
				<?php endif; ?>
				</a>
			</div>
			<div class="tribe-related-event-info">
				<h3 class="tribe-related-events-title"><a href="<?php echo tribe_get_event_link( $post ); ?>" class="tribe-event-url" rel="bookmark"><?php echo get_the_title( $post->ID ); ?></a></h3>
				<div class="events-single__related-meta">
				<?php
					if ( $post->post_type == Tribe__Events__Main::POSTTYPE ) {
						echo tribe_events_event_schedule_details( $post );
					}
				?>
				</div>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
</div>
<?php
endif;
