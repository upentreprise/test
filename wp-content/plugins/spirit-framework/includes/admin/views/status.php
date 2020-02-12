<?php
$system_status = new SF_System_Status();
$theme_info = $system_status->get_theme_info();
$environment = $system_status->get_environment();
$active_plugins = $system_status->get_active_plugins();
?>
<div id="sf-system-status">
	<table class="sf-system-report widefat" cellspacing="0">
		<tbody>
			<tr>
				<td colspan="3">
					<span>
						<a href="#" id="sf-get-report" class="button-primary"><?php _e( 'Get system report', 'spirit' ); ?></a>
						<span><?php _e( 'Please copy and paste this information in your ticket when contacting support.', 'spirit' ); ?></span>
					</span>
					<div id="sf-debug-report">
						<textarea readonly="readonly"></textarea>
						<p><button id="sf-copy-report" class="button-primary" href="#" data-tip="<?php esc_attr_e( 'Copied!', 'spirit' ); ?>"><?php _e( 'Copy for support', 'spirit' ); ?></button></p>
						<p class="copy-error hidden"><?php _e( 'Copying to clipboard failed. Please press Ctrl/Cmd+C to copy.', 'spirit' ); ?></p>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="sf-status-table widefat" cellspacing="0">
		<thead>
			<tr>
				<th colspan="3" data-export-label="Theme Info"><?php _e( 'Theme Info', 'spirit' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td data-export-label="Theme Version"><?php _e( 'Theme Version', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'The installed version of the current active theme.', 'spirit' ) ); ?></td>
				<td><?php echo esc_html( $theme_info['version'] ); ?></td>
			</tr>
			<tr>
				<td data-export-label="Child Theme"><?php _e( 'Child Theme', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'Displays whether or not the current theme is a child theme.', 'spirit' ) ); ?></td>
				<td><?php
					echo $theme_info['is_child_theme'] ? '<mark class="yes"><span class="dashicons dashicons-yes"></span></mark>' : '<span class="dashicons dashicons-no-alt"></span> &ndash; ' . sprintf( __( 'If you are modifying a theme that you did not build personally we recommend using a child theme. See: <a href="%s" target="_blank">How to create a child theme</a>', 'spirit' ), 'https://codex.wordpress.org/Child_Themes' );
				?></td>
			</tr>
			<?php if ( $theme_info['is_child_theme'] ) : ?>
			<tr>
				<td data-export-label="Parent Theme Name"><?php _e( 'Parent theme name', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'The name of the parent theme.', 'spirit' ) ); ?></td>
				<td><?php echo esc_html( $theme_info['parent_name'] ); ?></td>
			</tr>
			<tr>
				<td data-export-label="Parent Theme Version"><?php _e( 'Parent theme version', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'The installed version of the parent theme.', 'spirit' ) ); ?></td>
				<td><?php echo esc_html( $theme_info['parent_version'] ); ?></td>
			</tr>
			<?php endif ?>
		</tbody>
	</table>
	<table class="sf-status-table widefat" cellspacing="0" id="status">
		<thead>
			<tr>
				<th colspan="3" data-export-label="WordPress Environment"><?php _e( 'WordPress environment', 'spirit' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td data-export-label="Home URL"><?php _e( 'Home URL', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'The homepage URL of your site.', 'spirit' ) ); ?></td>
				<td><?php echo esc_html( $environment['home_url'] ) ?></td>
			</tr>
			<tr>
				<td data-export-label="Site URL"><?php _e( 'Site URL', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'The root URL of your site.', 'spirit' ) ); ?></td>
				<td><?php echo esc_html( $environment['site_url'] ) ?></td>
			</tr>
			<tr>
				<td data-export-label="WP Version"><?php _e( 'WP Version', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'The version of WordPress installed on your site.', 'spirit' ) ); ?></td>
				<td><?php echo esc_html( $environment['wp_version'] ) ?></td>
			</tr>
			<tr>
				<td data-export-label="WP Multisite"><?php _e( 'WP Multisite', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'Whether or not you have WordPress Multisite enabled.', 'spirit' ) ); ?></td>
				<td><?php echo ( $environment['wp_multisite'] ) ? '<span class="dashicons dashicons-yes"></span>' : '&ndash;'; ?></td>
			</tr>
			<tr>
				<td data-export-label="WP Memory Limit"><?php _e( 'WP Memory Limit', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'The maximum amount of memory (RAM) that your site can use at one time.', 'spirit' ) ); ?></td>
				<td><?php
					if ( $environment['wp_memory_limit'] < 67108864 ) {
						echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . sprintf( __( '%1$s - We recommend setting memory to at least 64MB. See: %2$s', 'spirit' ), size_format( $environment['wp_memory_limit'] ), '<a href="https://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank">' . __( 'Increasing memory allocated to PHP', 'spirit' ) . '</a>' ) . '</mark>';
					} else {
						echo '<mark class="yes">' . size_format( $environment['wp_memory_limit'] ) . '</mark>';
					}
				?></td>
			</tr>
			<tr>
				<td data-export-label="WP Debug Mode"><?php _e( 'WP Debug Mode', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'Displays whether or not WordPress is in Debug Mode.', 'spirit' ) ); ?></td>
				<td>
					<?php if ( $environment['wp_debug_mode'] ) : ?>
						<mark class="yes"><span class="dashicons dashicons-yes"></span></mark>
					<?php else : ?>
						<mark class="no">&ndash;</mark>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td data-export-label="WP Cron"><?php _e( 'WP Cron', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'Displays whether or not WP Cron Jobs are enabled.', 'spirit' ) ); ?></td>
				<td>
					<?php if ( $environment['wp_cron'] ) : ?>
						<mark class="yes"><span class="dashicons dashicons-yes"></span></mark>
					<?php else : ?>
						<mark class="no">&ndash;</mark>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td data-export-label="Language"><?php _e( 'Language', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'The current language used by WordPress. Default = English', 'spirit' ) ); ?></td>
				<td><?php echo esc_html( $environment['language'] ) ?></td>
			</tr>
		</tbody>
	</table>
	<table class="sf-status-table widefat" cellspacing="0">
		<thead>
			<tr>
				<th colspan="3" data-export-label="Server Environment"><?php _e( 'Server Environment', 'spirit' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td data-export-label="Server Info"><?php _e( 'Server Info', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'Information about the web server that is currently hosting your site.', 'spirit' ) ); ?></td>
				<td><?php echo esc_html( $environment['server_info'] ); ?></td>
			</tr>
			<tr>
				<td data-export-label="PHP Version"><?php _e( 'PHP Version', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'The version of PHP installed on your hosting server.', 'spirit' ) ); ?></td>
				<td><?php
					if ( version_compare( $environment['php_version'], '5.6', '<' ) ) {
						echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . sprintf( __( '%1$s - We recommend a minimum PHP version of 5.6. See: %2$s', 'spirit' ), esc_html( $environment['php_version'] ), '<a href="https://docs.woocommerce.com/document/how-to-update-your-php-version/" target="_blank">' . __( 'How to update your PHP version', 'spirit' ) . '</a>' ) . '</mark>';
					} else {
						echo '<mark class="yes">' . esc_html( $environment['php_version'] ) . '</mark>';
					}
					?></td>
			</tr>
			<tr>
				<td data-export-label="MySQL Version"><?php _e( 'MySQL Version', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'The version of MySQL installed on your hosting server.', 'spirit' ) ); ?></td>
				<td>
					<?php
					$is_mariadb = ( strpos( $environment['mysql_info'], 'MariaDB' ) !== false );
					
					if ( !$is_mariadb && version_compare( $environment['mysql_version'], '5.6', '<' ) ) {
						echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . sprintf( __( '%1$s - We recommend a minimum MySQL version of 5.6. See: %2$s', 'spirit' ), esc_html( $environment['mysql_version'] ), '<a href="https://wordpress.org/about/requirements/" target="_blank">' . __( 'WordPress requirements', 'spirit' ) . '</a>' ) . '</mark>';
					} else {
						echo '<mark class="yes">' . esc_html( $environment['mysql_info'] ) . '</mark>';
					}
					?>
				</td>
			</tr>
			<?php if ( function_exists( 'ini_get' ) ) : ?>
				<tr>
					<td data-export-label="PHP Post Max Size"><?php _e( 'PHP Post Max Size', 'spirit' ); ?>:</td>
					<td class="help"><?php echo sf_help_tip( __( 'The largest filesize that can be contained in one post.', 'spirit' ) ); ?></td>
					<td><?php echo esc_html( size_format( $environment['php_post_max_size'] ) ) ?></td>
				</tr>
				<tr>
					<td data-export-label="PHP Time Limit"><?php _e( 'PHP Time Limit', 'spirit' ); ?>:</td>
					<td class="help"><?php echo sf_help_tip( __( 'The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups)', 'spirit' ) ); ?></td>
					<td>
						<?php if ( 180 > $environment['php_max_execution_time'] && 0 < $environment['php_max_execution_time'] ) : ?>
							<mark class="error"><?php printf( __( '%s - Recommended value: <b>180</b>.', 'spirit' ), esc_html( $environment['php_max_execution_time'] ) ); ?></mark>
						<?php else : ?>
							<mark class="yes"><?php echo esc_html( $environment['php_max_execution_time'] ) ?></mark>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td data-export-label="PHP Max Input Vars"><?php _e( 'PHP Max Input Vars', 'spirit' ); ?>:</td>
					<td class="help"><?php echo sf_help_tip( __( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'spirit' ) ); ?></td>
					<td>
						<?php if ( 3000 > $environment['php_max_input_vars'] ) : ?>
							<mark class="error"><?php printf( __( '%s - Recommended value: <b>3000</b>.<br>Max input vars limitation will truncate POST data such as menus.', 'spirit' ), esc_html( $environment['php_max_input_vars'] ) ); ?></mark>
						<?php else : ?>
							<mark class="yes"><?php echo esc_html( $environment['php_max_input_vars'] ) ?></mark>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td data-export-label="SUHOSIN Installed"><?php _e( 'SUHOSIN Installed', 'spirit' ); ?>:</td>
					<td class="help"><?php echo sf_help_tip( __( 'Suhosin is an advanced protection system for PHP installations. It was designed to protect your servers on the one hand against a number of well known problems in PHP applications and on the other hand against potential unknown vulnerabilities within these applications or the PHP core itself. If enabled on your server, Suhosin may need to be configured to increase its data submission limits.', 'spirit' ) ); ?></td>
					<td><?php echo $environment['suhosin_installed'] ? '<span class="dashicons dashicons-yes"></span>' : '&ndash;'; ?></td>
				</tr>
			<?php endif; ?>
			<tr>
				<td data-export-label="Max Upload Size"><?php _e( 'Max Upload Size', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'The largest filesize that can be uploaded to your WordPress installation.', 'spirit' ) ); ?></td>
				<td><?php echo size_format( $environment['max_upload_size'] ) ?></td>
			</tr>
			<tr>
				<td data-export-label="DOMDocument"><?php _e( 'DOMDocument', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'HTML/Multipart emails use DOMDocument to generate inline CSS in templates.', 'spirit' ) ); ?></td>
				<td><?php
					if ( $environment['domdocument_enabled'] ) {
						echo '<mark class="yes"><span class="dashicons dashicons-yes"></span></mark>';
					} else {
						echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . sprintf( __( 'Your server does not have the %s class enabled - HTML/Multipart emails, and also some extensions, will not work without DOMDocument.', 'spirit' ), '<a href="https://php.net/manual/en/class.domdocument.php">DOMDocument</a>' ) . '</mark>';
					} ?>
				</td>
			</tr>
			<tr>
				<td data-export-label="ZipArchive"><?php _e( 'ZipArchive', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'ZipArchive is required for importing demos. They are used to import and export zip files specifically for sliders.', 'spirit' ) ); ?></td>
				<td><?php
					if ( $environment['ziparchive_enabled'] ) {
						echo '<mark class="yes"><span class="dashicons dashicons-yes"></span></mark>';
					} else {
						echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . sprintf( __( 'ZipArchive is not installed on your server, but is required if you need to import demo content.', 'spirit' ), '<a href="https://php.net/manual/en/class.ziparchive.php">ZipArchive</a>' ) . '</mark>';
					} ?>
				</td>
			</tr>
			<tr>
				<td data-export-label="WP Remote Post"><?php _e( 'WP Remote Post', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'WP Remote Post', 'spirit' ) ); ?></td>
				<td><?php
					if ( $environment['remote_post_successful'] ) {
						echo '<mark class="yes"><span class="dashicons dashicons-yes"></span></mark>';
					} else {
						echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . sprintf( __( '%s failed. Contact your hosting provider.', 'spirit' ), 'wp_remote_post()' ) . ' ' . esc_html( $environment['remote_post_response'] ) . '</mark>';
					} ?>
				</td>
			</tr>
			<tr>
				<td data-export-label="WP Remote Get"><?php _e( 'WP Remote Get', 'spirit' ); ?>:</td>
				<td class="help"><?php echo sf_help_tip( __( 'WP Remote Get', 'spirit' ) ); ?></td>
				<td><?php
					if ( $environment['remote_get_successful'] ) {
						echo '<mark class="yes"><span class="dashicons dashicons-yes"></span></mark>';
					} else {
						echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . sprintf( __( '%s failed. Contact your hosting provider.', 'spirit' ), 'wp_remote_get()' ) . ' ' . esc_html( $environment['remote_get_response'] ) . '</mark>';
					} ?>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="sf-status-table widefat" cellspacing="0">
		<thead>
			<tr>
				<th colspan="3" data-export-label="Active Plugins (<?php echo count( $active_plugins ) ?>)"><?php _e( 'Active plugins', 'spirit' ); ?> (<?php echo count( $active_plugins ) ?>)</th>
			</tr>
		</thead><?php
			foreach ( $active_plugins as $plugin ) {
				if ( !empty( $plugin['Name'] ) ) {
					// Link the plugin name to the plugin url if available.
					$plugin_name = esc_html( $plugin['Name'] );
					if ( !empty( $plugin['PluginURI'] ) ) {
						$plugin_name = '<a href="' . esc_url( $plugin['PluginURI'] ) . '" aria-label="' . esc_attr__( 'Visit plugin homepage' , 'spirit' ) . '" target="_blank">' . $plugin_name . '</a>';
					}
				?><tr>
					<td><?php echo $plugin_name; ?></td>
					<td class="help">&nbsp;</td>
					<td><?php
						printf( __( 'by %s', 'spirit' ), $plugin['AuthorName'] );
						echo ' &#91; ' . esc_html( $plugin['Version'] ) . ' &#93;';
					?></td>
				</tr><?php
				}
			}
		?>
	</table>
</div>