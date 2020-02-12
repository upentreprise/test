<?php

/**
 * Function that fills the field with the desired inputs as part of the larger form
 *
 * @param array $args Arguments passed by the setting
 */
function sf_settings_field( $args ) {
	if ( !isset( $args['type'] ) || !isset( $args['id'] ) ) {
		return;
	}

	$atts = array();
	$id = sanitize_key( $args['id'] );
	global $sf_global_settings;

	if ( isset( $sf_global_settings[ $args['id'] ] ) ) {
		$value = $sf_global_settings[ $args['id'] ];
	} else {
		$value = isset( $args['std'] ) ? $args['std'] : '';
	}

	switch ( $args['type'] ) {

		case 'text':
		case 'password':
		case 'number':
		case 'email':
		case 'url':
		case 'tel':
			$atts['type'] = $args['type'];
			$atts['id'] = 'sf_settings[' . $id . ']';
			$atts['name'] = 'sf_settings[' . $id . ']';
			$atts['value'] = $value;

			if ( !empty( $args['placeholder'] ) ) {
				$atts['placeholder'] = $args['placeholder'];
			}

			if ( !empty( $args['size'] ) ) {
				$atts['class'] = $args['size'] . '-text';
			} else {
				$atts['class'] = 'regular-text';
			}

			if ( !empty( $args['class'] ) ) {
				$atts['class'] .= ' ' . $args['class'];
			}

			if ( isset( $args['max'] ) ) {
				$atts['max'] = $args['max'];
			}

			if ( isset( $args['min'] ) ) {
				$atts['min'] = $args['min'];
			}

			if ( isset( $args['min'] ) ) {
				$atts['step'] = $args['step'];
			}

			if ( isset( $args['disabled'] ) && $args['disabled'] == true ) {
				$atts['disabled'] = 'disabled';
			}

			if ( isset( $args['readonly'] ) && $args['readonly'] == true ) {
				$atts['readonly'] = 'readonly';
			}
			?>
			<input <?php foreach( $atts as $name => $val ) { echo $name . '="' . esc_attr( $val ) . '" '; } ?>/>
			<?php if ( !empty( $args['tooltip'] ) ) : echo sf_help_tip( $args['tooltip'] ); endif; ?>
			<?php if ( !empty( $args['desc'] ) ) : ?>
				<label for="sf_settings[<?php echo esc_attr( $id ); ?>]"><?php echo wp_kses_post( $args['desc'] ); ?></label>
			<?php endif;

			break;

		case 'checkbox':
			$atts['type'] = 'checkbox';
			$atts['id'] = 'sf_settings[' . $id . ']';
			$atts['name'] = 'sf_settings[' . $id . ']';
			$atts['value'] = '1';
			?>
			<input <?php foreach( $atts as $name => $val ) { echo $name . '="' . esc_attr( $val ) . '" '; } checked( 1, $sf_global_settings[ $args['id'] ] ); ?>/>
			<?php if ( !empty( $args['tooltip'] ) ) : echo sf_help_tip( $args['tooltip'] ); endif; ?>
			<?php if ( !empty( $args['desc'] ) ) : ?>
				<label for="sf_settings[<?php echo esc_attr( $id ); ?>]"><?php echo wp_kses_post( $args['desc'] ); ?></label>
			<?php endif;
			
			break;

		case 'select':
			$atts['id'] = 'sf_settings[' . $id . ']';
			$atts['name'] = 'sf_settings[' . $id . ']';

			if ( !empty( $args['placeholder'] ) ) {
				$atts['placeholder'] = $args['placeholder'];
			}

			if ( !isset( $args['selectize'] ) || $args['selectize'] ) {
				$atts['class'] = 'sf-select-single';
			}

			if ( !empty( $args['class'] ) ) {
				$atts['class'] .= ' ' . $args['class'];
			}

			if ( !empty( $args['options'] ) && is_array( $args['options'] ) ) {
				$options = $args['options'];
			} else {
				$options = array();
			}
			?>
			<select <?php foreach( $atts as $name => $val ) { echo $name . '="' . esc_attr( $val ) . '" '; } ?>>
				<option value="" <?php selected( '', $value ); ?>><?php _e( 'Select', 'spirit' ); ?></option>
			<?php foreach ( $options as $option => $label ) : ?>
				<option value="<?php echo esc_attr( $option ); ?>" <?php selected( $option, $value ); ?>><?php echo esc_html( $label ); ?></option>
			<?php endforeach; ?>
			</select>
			<?php if ( !empty( $args['tooltip'] ) ) : echo sf_help_tip( $args['tooltip'] ); endif; ?>
			<?php if ( !empty( $args['desc'] ) ) : ?>
				<label for="sf_settings[<?php echo esc_attr( $id ); ?>]"><?php echo wp_kses_post( $args['desc'] ); ?></label>
			<?php endif;
			
			break;

		case 'textarea':
			$atts['id'] = 'sf_settings[' . $id . ']';
			$atts['name'] = 'sf_settings[' . $id . ']';
			
			if ( !empty( $args['placeholder'] ) ) {
				$atts['placeholder'] = $args['placeholder'];
			}

			if ( !empty( $args['class'] ) ) {
				$atts['class'] = $args['class'];
			}
			?>
			<textarea <?php foreach( $atts as $name => $val ) { echo $name . '="' . esc_attr( $val ) . '" '; } ?>style="min-width: 25em;height: 75px;"><?php echo wp_kses_post( $value ); ?></textarea>
			<?php if ( !empty( $args['tooltip'] ) ) : echo sf_help_tip( $args['tooltip'] ); endif; ?>
			<?php if ( !empty( $args['desc'] ) ) : ?>
				<label for="sf_settings[<?php echo esc_attr( $id ); ?>]"><?php echo wp_kses_post( $args['desc'] ); ?></label>
			<?php endif;

			break;

		case 'rich_editor':

			break;

		case 'header':
			break;

		case 'message':
			if ( !empty( $args['desc'] ) ) { ?>
				<p><?php echo wp_kses_post( $args['desc'] ); ?></p>
			<?php
			}
			break;
		
		case 'upload':
			$atts['type'] = 'url';
			$atts['id'] = 'sf_settings[' . $id . ']';
			$atts['name'] = 'sf_settings[' . $id . ']';

			if ( !empty( $args['size'] ) ) {
				$atts['class'] = $args['size'] . '-text';
			} else {
				$atts['class'] = 'regular-text';
			}

			if ( !empty( $args['class'] ) ) {
				$atts['class'] .= ' ' . $args['class'];
			}

			?>
			<div class="sf-media-upload">
				<input <?php foreach( $atts as $name => $val ) { echo $name . '="' . esc_attr( $val ) . '" '; } ?>value="<?php echo esc_url( $value ); ?>"/>
				<?php if ( !empty( $args['tooltip'] ) ) : echo sf_help_tip( $args['tooltip'] ); endif; ?>
				<div class="sf-media-btns<?php if ( !empty( $value ) ) { echo ' selected'; } ?>">
					<button type="button" class="sf-btn-upload-image button button-secondary"><?php _e( 'Upload Image', 'spirit' ); ?></button>
					<button type="button" class="sf-btn-edit-image button button-secondary"><?php _e( 'Edit', 'spirit' ); ?></button>
					<button type="button" class="sf-btn-remove-image button button-secondary"><?php _e( 'Remove', 'spirit' ); ?></button>
				</div>
				<div class="sf-media-preview">
				<?php if ( !empty( $value ) ) : ?>
					<img src="<?php echo esc_url( $value ); ?>" alt="preview">
				<?php endif; ?>
				</div>
			</div>
			<?php if ( !empty( $args['desc'] ) ) : ?>
				<label for="sf_settings[<?php echo esc_attr( $id ); ?>]"><?php echo wp_kses_post( $args['desc'] ); ?></label>
			<?php endif;

			break;

		default:

			break;
	}

	echo apply_filters( 'sf_after_setting_output', '', $args );
}
