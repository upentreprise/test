<?php
$demos = apply_filters( 'sf_config_demos', array() );
$demo_history = get_option( 'sf_demo_history' );
$current_demo_id = get_option( 'sf_demo_current' );
$current_demo_id = !empty( $current_demo_id ) ? $current_demo_id : '';
$content_installed = !empty( $demo_history['content'] ) ? $demo_history['content'] : array();
$content_installed = 'all' == $content_installed || in_array( 'all', $content_installed ) ? array( 'all' ) : $content_installed;
$content_type_labels = array(
	'all' => __( 'All', 'spirit' ),
	'pages' => __( 'Pages', 'spirit' ),
	'posts' => __( 'Posts', 'spirit' ),
	'images' => __( 'Images', 'spirit' ),
	'widgets' => __( 'Widgets', 'spirit' ),
	'options' => __( 'Theme Options', 'spirit' ),
	'sliders' => __( 'Sliders', 'spirit' ),
	'courses' => __( 'Courses', 'spirit' ),
	'events' => __( 'Events', 'spirit' )
);
?>
<div id="sf-demos">
	<br>
	<div class="sf-three-columns">
	<?php foreach ( $demos as $demo ) :
		$demo_id = isset( $demo['id'] ) ? $demo['id'] : '';
		$demo_label = isset( $demo['label'] ) ? $demo['label'] : '';
		$demo_thumbnail = isset( $demo['thumbnail'] ) ? $demo['thumbnail'] : '';
		$demo_preview = isset( $demo['preview'] ) ? $demo['preview'] : '';
		$demo_content = isset( $demo['content'] ) ? $demo['content'] : array();
		$demo_plugins = isset( $demo['plugin_dep'] ) ? $demo['plugin_dep'] : array();
		?>
		<div class="sf-demo-item<?php echo ( $current_demo_id == $demo_id ) ? ' sf-demo-installed' : ''; ?>">
			<div class="sf-item-wrapper">
				<div class="sf-item-overlay"></div>
				<div class="sf-item-screenshot">
					<a href="javascript:void(0)" data-toggle="modal" data-target="#sf-demo-modal-<?php echo esc_attr( $demo_id ); ?>" data-backdrop="false">
						<img src="<?php echo esc_url( $demo_thumbnail ); ?>" alt="<?php echo esc_attr( $demo_label ); ?>">
					</a>
				</div>
				<div class="sf-item-bar">
					<div class="sf-label-installing"><?php esc_html_e( 'Installing..', 'spirit' ); ?></div>
					<div class="sf-label-uninstalling"><?php esc_html_e( 'Uninstalling..', 'spirit' ); ?></div>
					<div class="sf-item-title"><?php echo esc_html( $demo_label ); ?></div>
					<div class="sf-item-buttons">
						<input type="submit" class="button button-primary sf-button-uninstall" value="<?php esc_attr_e( 'Uninstall', 'spirit' ); ?>" data-toggle="modal" data-target="#sf-demo-modal-<?php echo esc_attr( $demo_id ); ?>"  data-backdrop="false">
						<input type="submit" class="button button-primary sf-button-install" value="<?php esc_attr_e( 'Install', 'spirit' ); ?>" data-toggle="modal" data-target="#sf-demo-modal-<?php echo esc_attr( $demo_id ); ?>"  data-backdrop="false">
						<a class="button button-secondary sf-button-preview" href="<?php echo esc_url( $demo_preview ); ?>" target="_blank"><?php esc_html_e( 'Preview', 'spirit' ); ?></a>
					</div>
				</div>
			    <div class="modal sf-demo-modal" id="sf-demo-modal-<?php echo esc_attr( $demo_id ); ?>" tabindex="-1" role="dialog" aria-labelledby="<?php esc_attr_e( 'Demo Modal', 'spirit' ); ?>">
			        <div class="modal-dialog modal-dialog-centered" role="document">
			        	<form class="sf-demo-form" data-demo-id="<?php echo esc_attr( $demo_id ); ?>" action="" autocomplete="off">
				            <div class="modal-content">
				                <div class="modal-header">
				                    <h2><?php esc_html_e( 'Import Content', 'spirit' ); ?></h2>
				                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
				                </div>
				                <div class="modal-body">
				                	<div class="sf-demo-content">
				                		<?php $all_attr_disabled = $current_demo_id == $demo_id && in_array( 'all', $content_installed ) ? ' disabled' : '';  ?>
				                		<?php $checkbox_id = 'import-all-'. $demo_id; ?>
				                		<?php $all_attr_checked = $current_demo_id == $demo_id && !in_array( 'all', $content_installed ) ? '' : ' checked="checked"'; ?>
			                			<p>
			                				<label for="<?php echo esc_attr( $checkbox_id ); ?>">
				                				<input type="checkbox" name="content[]" id="<?php echo esc_attr( $checkbox_id ); ?>" class="sf-checkbox" value="all"<?php echo $all_attr_checked . $all_attr_disabled; // WPCS: XSS ok. ?>><?php echo esc_html( $content_type_labels['all'] ); ?>
				                			</label>
				                		</p>
				                		<?php foreach ( $demo_content as $content_type ) : ?>
				                			<?php $checkbox_id = 'import-'. $content_type .'-'. $demo_id ?>
				                			<?php $attr_checked = empty( $current_demo_id ) || $current_demo_id != $demo_id || ( $current_demo_id == $demo_id && ( in_array( $content_type, $content_installed ) || in_array( 'all', $content_installed ) ) ) ? ' checked="checked"' : ''; ?>
				                			<?php $attr_disabled = $current_demo_id == $demo_id && ( in_array( 'all', $content_installed ) || in_array( $content_type, $content_installed ) ) ? ' disabled' : ''; ?>
				                			<p>
				                				<label for="<?php echo esc_attr( $checkbox_id ); ?>">
					                				<input type="checkbox" name="content[]" id="<?php echo esc_attr( $checkbox_id ); ?>" class="sf-checkbox" value="<?php echo esc_attr( $content_type ); ?>"<?php echo $attr_checked . $attr_disabled; // WPCS: XSS ok. ?>><?php echo esc_html( $content_type_labels[ $content_type ] ); ?>
					                			</label>
				                			</p>
				                		<?php endforeach; ?>
				                	</div>
				                </div>
				                <div class="modal-footer">
									<div class="sf-label-installing"><?php esc_html_e( 'Installing..', 'spirit' ); ?></div>
									<div class="sf-label-uninstalling"><?php esc_html_e( 'Uninstalling..', 'spirit' ); ?></div>
									<div class="sf-label-installed"><?php esc_html_e( 'Done :)', 'spirit' ); ?></div>
				                	<div class="sf-progress-bar"></div>
				                	<input type="submit" class="button button-large button-primary sf-button-install" value="<?php esc_attr_e( 'Install', 'spirit' ); ?>" data-demo-id="<?php echo esc_attr( $demo_id ); ?>"<?php if ( !empty( $all_attr_disabled ) ) echo ' style="display:none;"'; ?>>
				                	<input type="submit" class="button button-large button-primary sf-button-uninstall" value="<?php esc_attr_e( 'Uninstall', 'spirit' ); ?>">
				                </div>
				            </div>
				        </div>
			        </form>
			    </div>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</div>