<?php

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Settings Page
 *
 * Renders the settings page.
 *
 * @since 1.0
 * @return void
 */
function sf_settings_page() {
	$settings_tabs = sf_get_settings_tabs();
	$settings_tabs = empty($settings_tabs) ? array() : $settings_tabs;
	$active_tab    = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'general';
	$active_tab    = array_key_exists( $active_tab, $settings_tabs ) ? $active_tab : 'general';
	$sections      = sf_get_settings_tab_sections( $active_tab );
	$key           = 'main';

	if ( ! empty( $sections ) ) {
		$key = key( $sections );
	}

	$registered_sections = sf_get_settings_tab_sections( $active_tab );
	$section             = isset( $_GET['section'] ) && ! empty( $registered_sections ) && array_key_exists( $_GET['section'], $registered_sections ) ? sanitize_text_field( $_GET['section'] ) : $key;

	// Unset 'main' if it's empty and default to the first non-empty if it's the chosen section
	$all_settings = sf_get_registered_settings();

	// Let's verify we have a 'main' section to show
	$has_main_settings = true;
	if ( empty( $all_settings[ $active_tab ]['main'] ) ) {
		$has_main_settings = false;
	}

	// Check for old non-sectioned settings (see #4211 and #5171)
	if ( ! $has_main_settings ) {
		foreach( $all_settings[ $active_tab ] as $sid => $stitle ) {
			if ( is_string( $sid ) && ! empty( $sections) && array_key_exists( $sid, $sections ) ) {
				continue;
			} else {
				$has_main_settings = true;
				break;
			}
		}
	}

	$override = false;
	if ( false === $has_main_settings ) {
		unset( $sections['main'] );

		if ( 'main' === $section ) {
			foreach ( $sections as $section_key => $section_title ) {
				if ( ! empty( $all_settings[ $active_tab ][ $section_key ] ) ) {
					$section  = $section_key;
					$override = true;
					break;
				}
			}
		}
	}

	ob_start();
	?>
	<div id="sf-settings-page" class="wrap">
		
		<h2 class="nav-tab-wrapper">
			<?php
			foreach ( sf_get_settings_tabs() as $tab_id => $tab_name ) {
				$tab_url = add_query_arg( array(
					'settings-updated' => false,
					'tab'              => $tab_id,
				) );

				// Remove the section from the tabs so we always end up at the main section
				$tab_url = remove_query_arg( 'section', $tab_url );

				$active = $active_tab == $tab_id ? ' nav-tab-active' : '';

				echo '<a href="' . esc_url( $tab_url ) . '" class="nav-tab' . $active . '">';
					echo esc_html( $tab_name );
				echo '</a>';
			}
			?>
		</h2>
		<?php

		$number_of_sections = count( $sections );
		$number = 0;
		if ( $number_of_sections > 1 ) {
			echo '<ul class="subsubsub">';
			foreach( $sections as $section_id => $section_name ) {
				echo '<li>';
				$number++;
				$tab_url = add_query_arg( array(
					'settings-updated' => false,
					'tab' => $active_tab,
					'section' => $section_id
				) );
				$class = '';
				if ( $section == $section_id ) {
					$class = 'current';
				}
				echo '<a class="' . $class . '" href="' . esc_url( $tab_url ) . '">' . $section_name . '</a>';

				if ( $number != $number_of_sections ) {
					echo ' | ';
				}
				echo '</li>';
			}
			echo '</ul>';
		}
		?>
		<div id="sf-settings-wrapper">
			<form method="post" action="options.php">
				<table class="form-table">
				<?php

				settings_fields( 'sf_settings' );

				do_settings_sections( 'sf_settings_' . $active_tab . '_' . $section );

				// If the main section was empty and we overrode the view with the next subsection, prepare the section for saving
				if ( true === $override ) {
					?><input type="hidden" name="sf_section_override" value="<?php echo $section; ?>" /><?php
				}

				?>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
	</div>
	<?php
	echo ob_get_clean();
}
