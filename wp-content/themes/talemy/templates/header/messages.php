<?php
global $messages_template;
if ( ! is_user_logged_in() || ! talemy_get_option( 'bp_nav_messages' ) || ! class_exists( 'BuddyPress' ) ) {
	return;
}
$active_components = bp_get_option( 'bp-active-components' );
if ( empty( $active_components['messages'] ) ) {
	return;
}
$menu_link            = trailingslashit( bp_loggedin_user_domain() . bp_get_messages_slug() );
$unread_message_count = messages_get_unread_count();
?>
<a href="<?php echo esc_url( $menu_link ) ?>" ref="notification_bell" class="nav-btn btn-messages" title="<?php esc_html_e( 'Messages', 'talemy' ); ?>">
	<i class="position-relative">
		<i class="far fa-envelope"></i>
		<?php if ( $unread_message_count > 0 ): ?>
			<span class="item-count"><?php echo esc_html( $unread_message_count ); ?></span>
		<?php endif; ?>
	</i>
</a>