<?php
if ( ! is_user_logged_in() || ! talemy_get_option( 'bp_nav_notifications' ) || ! class_exists( 'BuddyPress' ) ) {
    return;
}
$active_components = bp_get_option( 'bp-active-components' );
if ( empty( $active_components['notifications'] ) ) {
	return;
}
$menu_link                 = trailingslashit( bp_loggedin_user_domain() . bp_get_notifications_slug() );
$notifications             = bp_notifications_get_unread_notification_count( bp_loggedin_user_id() );
$unread_notification_count = ! empty( $notifications ) ? $notifications : 0;
?>
<a href="<?php echo esc_url( $menu_link ); ?>" class="nav-btn btn-notifications btn-has-dropdown" title="<?php esc_html_e( 'Notifications', 'talemy' ); ?>">
    <i class="position-relative">
        <i class="far fa-bell"></i>
        <?php if ( $unread_notification_count > 0 ): ?>
            <span class="item-count"><?php echo esc_html( $unread_notification_count ); ?></span>
        <?php endif; ?>
    </i>
</a>
