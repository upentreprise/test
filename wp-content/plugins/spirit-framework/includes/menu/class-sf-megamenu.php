<?php
/**
 * SF Megamenu
 *
 * @package  Spirit_Framework
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

class SF_Megamenu {
	
	/**
	 * Mega menu enabled?
	 * @var boolean
	 */
	private $megamenu_enabled = false;

	/**
	 * Constructor
	 */
	function __construct() {
		$this->megamenu_enabled = apply_filters( 'sf_enable_mega_menu', true );

		// add the menu item fields.
		add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'add_menu_item_fields' ), 10, 4 );
		
		// save menu item custom fields
		if ( ! is_customize_preview() ) {
			add_action( 'wp_update_nav_menu_item', array( $this, 'save_custom_menu_item_fields' ), 10, 3 );
		}

        // add custom nav menu items	
        add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_custom_menu_item_fields' ) );

        // add custom edit fields
        add_filter( 'wp_edit_nav_menu_walker', array( $this, 'add_custom_edit_fields' ), 99 );
	}

	/**
	 * Menu item options
	 * 
	 * @param int $item_id   menu item id
	 * @param object $item   menu item object
	 * @param int $depth     level
	 * @param array $args    item args
	 */
	function add_menu_item_fields( $item_id, $item, $depth, $args ) {
		$name  = 'menu-item-sf-megamenu-style';
		?>
		<div class="sf-menu-options-container">
			<button type="button" class="button button-primary sf-btn-menu-options" data-toggle="modal" data-target="#sf-menu-options-<?php echo esc_attr( $item_id ); ?>" data-backdrop="false"><?php esc_attr_e( 'Menu Options', 'spirit' ); ?></button>
			<div class="modal sf-menu-options-modal" id="sf-menu-options-<?php echo esc_attr( $item_id ); ?>" tabindex="-1" role="dialog" aria-labelledby="<?php esc_attr_e( 'Menu Options', 'spirit' ); ?>">
				<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2><?php esc_attr_e( 'Menu Item Options', 'spirit' ); ?></h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
						</div>
						<div class="modal-body">
							<div class="sf-menu-option field-icon">
								<div class="option-label">
									<h3><?php esc_attr_e( 'Icon Font', 'spirit' ); ?></h3>
								</div>
								<div class="option-field">
									<input type="hidden" id="edit-menu-item-sf-megamenu-icon-<?php echo esc_attr( $item_id ); ?>" class="edit-menu-item-sf-megamenu-icon sf-input-iconpicker" name="menu-item-sf-megamenu-icon[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->sf_megamenu_icon ); ?>" />
								</div>
							</div>
							<div class="sf-menu-option field-icon-image">
								<div class="option-label">
									<h3><?php esc_attr_e( 'Icon Image', 'spirit' ); ?></h3>
									<p class="description"><?php esc_html_e( 'Icon font option will be ignored if icon image is set.', 'spirit' ); ?></p>
								</div>
								<div class="option-field sf-media-upload">
									<input type="hidden" id="edit-menu-item-sf-megamenu-icon-image-<?php echo esc_attr( $item_id ); ?>" class="edit-menu-item-sf-megamenu-icon-image widefat" name="menu-item-sf-megamenu-icon-image[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_url( $item->sf_megamenu_icon_image ); ?>" />
									<div class="sf-media-btns<?php if ( !empty( $item->sf_megamenu_icon_image ) ) { echo ' selected'; } ?>">
										<button type="button" class="sf-btn-upload-image button button-secondary"><?php esc_html_e( 'Upload Image', 'spirit' ); ?></button>
										<button type="button" class="sf-btn-edit-image button button-secondary"><?php esc_html_e( 'Edit', 'spirit' ); ?></button>
										<button type="button" class="sf-btn-remove-image button button-secondary"><?php esc_html_e( 'Remove', 'spirit' ); ?></button>
									</div>
									<div class="sf-media-preview">
									<?php if ( !empty( $item->sf_megamenu_icon_image ) ) : ?>
										<img src="<?php echo esc_url( $item->sf_megamenu_icon_image ); ?>" alt="">
									<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="sf-menu-option field-icon-only">
								<div class="option-label">
									<h3><?php esc_attr_e( 'Icon Only', 'spirit' ); ?></h3>
									<p class="description"><?php esc_html_e( 'Turn on to only show the icon while hiding the menu text.', 'spirit' ); ?></p>
								</div>
								<div class="option-field">
									<label class="sf-switch">
									  	<input type="checkbox" id="edit-menu-item-sf-megamenu-icon-only-<?php echo esc_attr( $item_id ); ?>" class="edit-menu-item-sf-megamenu-icon-only" name="menu-item-sf-megamenu-icon-only[<?php echo esc_attr( $item_id ); ?>]" value="1" <?php checked( $item->sf_megamenu_icon_only, 1 ); ?> />
									  	<span class="sf-slider"></span>
									</label>
								</div>
							</div>
							<div class="sf-menu-option field-icon-color">
								<div class="option-label">
									<h3><?php esc_attr_e( 'Icon Color', 'spirit' ); ?></h3>
								</div>
								<div class="option-field">
									<input type="text" id="edit-menu-item-sf-megamenu-icon-color-<?php echo esc_attr( $item_id ); ?>" class="edit-menu-item-sf-megamenu-icon-color sf-menu-option-colorpicker color-picker" data-alpha="true" name="menu-item-sf-megamenu-icon-color[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->sf_megamenu_icon_color ); ?>" />
								</div>
							</div>
							<div class="sf-menu-option field-icon-bg-color">
								<div class="option-label">
									<h3><?php esc_attr_e( 'Icon Background Color', 'spirit' ); ?></h3>
								</div>
								<div class="option-field">
									<input type="text" id="edit-menu-item-sf-megamenu-icon-bg-color-<?php echo esc_attr( $item_id ); ?>" class="edit-menu-item-sf-megamenu-icon-bg-color sf-menu-option-colorpicker color-picker" data-alpha="true" name="menu-item-sf-megamenu-icon-bg-color[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->sf_megamenu_icon_bg_color ); ?>" />
								</div>
							</div>
							<div class="sf-menu-option field-text-color">
								<div class="option-label">
									<h3><?php esc_attr_e( 'Text Color', 'spirit' ); ?></h3>
								</div>
								<div class="option-field">
									<input type="text" id="edit-menu-item-sf-megamenu-text-color-<?php echo esc_attr( $item_id ); ?>" class="edit-menu-item-sf-megamenu-text-color sf-menu-option-colorpicker color-picker" data-alpha="true" name="menu-item-sf-megamenu-text-color[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->sf_megamenu_text_color ); ?>" />
								</div>
							</div>
							<div class="sf-menu-option field-item-bg-color">
								<div class="option-label">
									<h3><?php esc_attr_e( 'Item Background Color', 'spirit' ); ?></h3>
								</div>
								<div class="option-field">
									<input type="text" id="edit-menu-item-sf-megamenu-item-bg-color-<?php echo esc_attr( $item_id ); ?>" class="edit-menu-item-sf-megamenu-item-bg-color sf-menu-option-colorpicker color-picker" data-alpha="true" name="menu-item-sf-megamenu-item-bg-color[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->sf_megamenu_item_bg_color ); ?>" />
								</div>
							</div>
							<?php if ( $this->megamenu_enabled ) {
								$this->add_megamenu_fields( $item_id, $item, $depth, $args );
							} ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="button button-secondary button-large" data-dismiss="modal"><?php esc_attr_e( 'Cancel', 'spirit' ); ?></button>
	        				<button type="button" class="button button-primary button-large" data-dismiss="modal"><?php esc_attr_e( 'Save', 'spirit' ); ?></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}

	/**
	 * Mega menu options
	 * @param int $item_id   menu item id
	 * @param object $item   menu item object
	 * @param int $depth     level
	 * @param array $args    item args
	 */
	function add_megamenu_fields( $item_id, $item, $depth, $args ) {
		$img_url = $item->sf_megamenu_icon; ?>
		<div class="sf-megamenu-options-label">
			<h3><?php esc_html_e( 'Mega Menu Settings', 'spirit' ); ?></h3>
		</div>
		<div class="sf-menu-option field-type">
			<div class="option-label">
				<h3><?php esc_html_e( 'Menu Type', 'spirit' ); ?></h3>
			</div>
			<div class="option-field">
				<select id="edit-menu-item-sf-megamenu-type-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-sf-megamenu-type sf-select-single" name="menu-item-sf-megamenu-type[<?php echo esc_attr( $item_id ); ?>]" >
					<option value="" <?php selected( $item->sf_megamenu_type, '' ); ?>><?php esc_html_e( 'Default', 'spirit' ); ?></option>
					<option value="mega_menu" <?php selected( $item->sf_megamenu_type, 'mega_menu' ); ?>><?php esc_html_e( 'Mega Menu', 'spirit' ); ?></option>
				</select>
			</div>
		</div>
		<div class="sf-menu-option field-width">
			<div class="option-label">
				<h3><?php esc_html_e( 'Menu Width', 'spirit' ); ?></h3>
			</div>
			<div class="option-field">
				<select id="edit-menu-item-sf-megamenu-width-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-sf-megamenu-width sf-select-single" name="menu-item-sf-megamenu-width[<?php echo esc_attr( $item_id ); ?>]" >
					<option value=""><?php esc_html_e( 'Full Width ( 8 )', 'spirit' ); ?></option>
				<?php for( $i = 1; $i < 9; $i++ ) :  ?>
					<option value="<?php echo esc_attr( $i );?>" <?php selected( $item->sf_megamenu_width, $i ); ?> ><?php echo esc_html( $i ); ?></option>
				<?php endfor; ?>
				</select>
			</div>
		</div>
		<div class="sf-menu-option field-column-width">
			<div class="option-label">
				<h3><?php esc_html_e( 'Column Width', 'spirit' ); ?></h3>
			</div>
			<div class="option-field">
				<select id="edit-menu-item-sf-megamenu-column-width-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-sf-megamenu-column-width sf-select-single" name="menu-item-sf-megamenu-column-width[<?php echo esc_attr( $item_id ); ?>]" >
					<option value=""><?php esc_html_e( 'Default ( 1/4 )', 'spirit' ); ?></option>
				<?php $column_names = sf_get_megamenu_column_names(); ?>
				<?php for( $i = 0; $i < count( $column_names ); $i++ ) :  ?>
					<option value="<?php echo esc_attr( $i );?>" <?php selected( $item->sf_megamenu_column_width, $i ); ?> ><?php echo $column_names[$i]; ?></option>
				<?php endfor; ?>
				</select>
			</div>
		</div>
		<div class="sf-menu-option field-widget-area">
			<div class="option-label">
				<h3><?php esc_html_e( 'Widget Area', 'spirit' ); ?></h3>
			</div>
			<div class="option-field">
				<select id="edit-menu-item-sf-megamenu-widget-area-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-sf-megamenu-widget-area sf-select-single" name="menu-item-sf-megamenu-widget-area[<?php echo esc_attr( $item_id ); ?>]" >
					<option value="" <?php selected( $item->sf_megamenu_widget_area, '' ); ?>><?php esc_html_e( 'Select a Widget Area', 'spirit' ); ?></option>
				<?php global $wp_registered_sidebars;
					if ( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ):
						foreach( $wp_registered_sidebars as $sidebar ):?>
					 	<option value="<?php echo $sidebar['id']; ?>" <?php selected( $item->sf_megamenu_widget_area, $sidebar['id'] ); ?> ><?php echo esc_html( $sidebar['name'] ); ?></option>;
					<?php endforeach; ?>
				<?php endif; ?>
				</select>
			</div>
		</div>
		<div class="sf-menu-option field-hide-title">
			<div class="option-label">
				<h3><?php esc_html_e( 'Hide Column Title', 'spirit' ); ?></h3>
			</div>
			<div class="option-field">
				<label class="sf-switch">
				  	<input type="checkbox" id="edit-menu-item-sf-megamenu-hide-title-<?php echo esc_attr( $item_id ); ?>" class="edit-menu-item-sf-megamenu-hide-title" name="menu-item-sf-megamenu-hide-title[<?php echo esc_attr( $item_id ); ?>]" value="1" <?php checked( $item->sf_megamenu_hide_title, 1 ); ?> />
				  	<span class="sf-slider"></span>
				</label>
			</div>
		</div>
		<div class="sf-menu-option field-new-row">
			<div class="option-label">
				<h3><?php esc_html_e( 'Start a New Row', 'spirit' ); ?></h3>
			</div>
			<div class="option-field">
				<label class="sf-switch">
				  	<input type="checkbox" id="edit-menu-item-sf-megamenu-new-row-<?php echo esc_attr( $item_id ); ?>" class="edit-menu-item-sf-megamenu-new-row" name="menu-item-sf-megamenu-new-row[<?php echo esc_attr( $item_id ); ?>]" value="1" <?php checked( $item->sf_megamenu_new_row, 1 ); ?> />
				  	<span class="sf-slider"></span>
				</label>
			</div>
		</div>
		<div class="sf-menu-option field-bg-color">
			<div class="option-label">
				<h3><?php esc_attr_e( 'Background Color', 'spirit' ); ?></h3>
			</div>
			<div class="option-field">
				<input type="text" id="edit-menu-item-sf-megamenu-bg-color-<?php echo esc_attr( $item_id ); ?>" class="edit-menu-item-sf-megamenu-bg-color sf-menu-option-colorpicker color-picker" data-alpha="true" name="menu-item-sf-megamenu-bg-color[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->sf_megamenu_bg_color ); ?>" />
			</div>
		</div>
		<div class="sf-menu-option field-bg-image">
			<div class="option-label">
				<h3><?php esc_attr_e( 'Background Image', 'spirit' ); ?></h3>
			</div>
			<div class="option-field sf-media-upload">
				<input type="hidden" id="edit-menu-item-sf-megamenu-bg-image-<?php echo esc_attr( $item_id ); ?>" class="edit-menu-item-sf-megamenu-bg-image widefat" name="menu-item-sf-megamenu-bg-image[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_url( $item->sf_megamenu_bg_image ); ?>" />
				<div class="sf-media-btns<?php if ( !empty( $item->sf_megamenu_bg_image ) ) { echo ' selected'; } ?>">
					<button type="button" class="sf-btn-upload-image button button-secondary"><?php esc_html_e( 'Upload Image', 'spirit' ); ?></button>
					<button type="button" class="sf-btn-edit-image button button-secondary"><?php esc_html_e( 'Edit', 'spirit' ); ?></button>
					<button type="button" class="sf-btn-remove-image button button-secondary"><?php esc_html_e( 'Remove', 'spirit' ); ?></button>
				</div>
				<div class="sf-media-preview">
				<?php if ( !empty( $item->sf_megamenu_bg_image ) ) : ?>
					<img src="<?php echo esc_url( $item->sf_megamenu_bg_image ); ?>" alt="">
				<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="sf-menu-option field-bg-position">
			<div class="option-label">
				<h3><?php esc_attr_e( 'Background Position', 'spirit' ); ?></h3>
			</div>
			<div class="option-field">
				<select id="edit-menu-item-sf-megamenu-bg-position-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-sf-megamenu-bg-position sf-select-single" name="menu-item-sf-megamenu-bg-position[<?php echo esc_attr( $item_id ); ?>]" >
					<option value=""><?php esc_attr_e( 'Center Center', 'spirit' ); ?></option>
					<option value="left top"<?php selected( $item->sf_megamenu_bg_position, 'left top' ); ?>><?php esc_attr_e( 'Left Top', 'spirit' ); ?></option>
					<option value="left center"<?php selected( $item->sf_megamenu_bg_position, 'left center' ); ?>><?php esc_attr_e( 'Left Center', 'spirit' ); ?></option>
					<option value="left bottom"<?php selected( $item->sf_megamenu_bg_position, 'left bottom' ); ?>><?php esc_attr_e( 'Left Bottom', 'spirit' ); ?></option>
					<option value="right top"<?php selected( $item->sf_megamenu_bg_position, 'right top' ); ?>><?php esc_attr_e( 'Right Top', 'spirit' ); ?></option>
					<option value="right center"<?php selected( $item->sf_megamenu_bg_position, 'right center' ); ?>><?php esc_attr_e( 'Right Center', 'spirit' ); ?></option>
					<option value="right bottom"<?php selected( $item->sf_megamenu_bg_position, 'right bottom' ); ?>><?php esc_attr_e( 'Right Bottom', 'spirit' ); ?></option>
					<option value="center top"<?php selected( $item->sf_megamenu_bg_position, 'center top' ); ?>><?php esc_attr_e( 'Center Top', 'spirit' ); ?></option>
					<option value="center center"<?php selected( $item->sf_megamenu_bg_position, 'center center' ); ?>><?php esc_attr_e( 'Center Center', 'spirit' ); ?></option>
					<option value="center bottom"<?php selected( $item->sf_megamenu_bg_position, 'center bottom' ); ?>><?php esc_attr_e( 'Center Bottom', 'spirit' ); ?></option>
				</select>
			</div>
		</div>
		<div class="sf-menu-option field-bg-repeat">
			<div class="option-label">
				<h3><?php esc_attr_e( 'Background Repeat', 'spirit' ); ?></h3>
			</div>
			<div class="option-field">
				<select id="edit-menu-item-sf-megamenu-bg-repeat-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-sf-megamenu-bg-repeat sf-select-single" name="menu-item-sf-megamenu-bg-repeat[<?php echo esc_attr( $item_id ); ?>]" >
					<option value="no-repeat"<?php selected( $item->sf_megamenu_bg_repeat, 'no-repeat' ); ?>><?php esc_attr_e( 'No Repeat', 'spirit' ); ?></option>
					<option value="repeat"<?php selected( $item->sf_megamenu_bg_repeat, 'repeat' ); ?>><?php esc_attr_e( 'Repeat All', 'spirit' ); ?></option>
					<option value="repeat-x"<?php selected( $item->sf_megamenu_bg_repeat, 'repeat-x' ); ?>><?php esc_attr_e( 'Repeat Horizontally', 'spirit' ); ?></option>
					<option value="repeat-y"<?php selected( $item->sf_megamenu_bg_repeat, 'repeat-y' ); ?>><?php esc_attr_e( 'Repeat Vertically', 'spirit' ); ?></option>
				</select>
			</div>
		</div>
		<?php
	}

	/**
	 * Add custom menu item property
	 * 
	 * @param object $menu_item   menu item object
	 */
    function add_custom_menu_item_fields( $menu_item ) {
    	$meta_data = get_post_meta( $menu_item->ID, '_menu_item_sf_megamenu', true );

		$menu_item->sf_megamenu_icon = isset( $meta_data['icon'] ) ? $meta_data['icon'] : '';
		$menu_item->sf_megamenu_icon_image = isset( $meta_data['icon_image'] ) ? $meta_data['icon_image'] : '';
		$menu_item->sf_megamenu_icon_only = isset( $meta_data['icon_only'] ) ? $meta_data['icon_only'] : '';
		$menu_item->sf_megamenu_icon_color = isset( $meta_data['icon_color'] ) ? $meta_data['icon_color'] : '';
		$menu_item->sf_megamenu_icon_bg_color = isset( $meta_data['icon_bg_color'] ) ? $meta_data['icon_bg_color'] : '';
		$menu_item->sf_megamenu_text_color = isset( $meta_data['text_color'] ) ? $meta_data['text_color'] : '';
		$menu_item->sf_megamenu_item_bg_color = isset( $meta_data['item_bg_color'] ) ? $meta_data['item_bg_color'] : '';

    	if ( $this->megamenu_enabled ) {
    		$menu_item->sf_megamenu_bg_color = isset( $meta_data['bg_color'] ) ? $meta_data['bg_color'] : '';
    		$menu_item->sf_megamenu_bg_image = isset( $meta_data['bg_image'] ) ? $meta_data['bg_image'] : '';
    		$menu_item->sf_megamenu_bg_position = isset( $meta_data['bg_position'] ) ? $meta_data['bg_position'] : '';
    		$menu_item->sf_megamenu_bg_repeat = isset( $meta_data['bg_repeat'] ) ? $meta_data['bg_repeat'] : '';
    		$menu_item->sf_megamenu_column_width = isset( $meta_data['column_width'] ) ? $meta_data['column_width'] : '';
    		$menu_item->sf_megamenu_hide_title = isset( $meta_data['hide_title'] ) ? $meta_data['hide_title'] : '';
    		$menu_item->sf_megamenu_new_row = isset( $meta_data['new_row'] ) ? $meta_data['new_row'] : '';
    		$menu_item->sf_megamenu_type = isset( $meta_data['type'] ) ? $meta_data['type'] : '';
    		$menu_item->sf_megamenu_width = isset( $meta_data['width'] ) ? $meta_data['width'] : '';
    	}

        return $menu_item;
    }

    /**
     * Save custom menu item meta
     * @param  int $menu_id         menu id
     * @param  int $menu_item_db_id menu item id
     * @param  array $args          args array
     */
    function save_custom_menu_item_fields( $menu_id, $menu_item_db_id, $args ) {
        $menu_meta = get_post_meta( '_menu_item_sf_megamenu', true );
        $meta_data = isset( $menu_meta ) ? $menu_meta : array();

        $field_name_suffix = array(
        	'icon',
        	'icon-image',
        	'icon-only',
        	'icon-color',
        	'icon-bg-color',
        	'text-color',
        	'item-bg-color'
        );

        if ( $this->megamenu_enabled ) {
        	$megamenu_field_name_suffix = array(
	        	'bg-color',
	        	'bg-image',
	        	'bg-position',
	        	'bg-repeat',
        		'column-width',
	        	'hide-title',
	        	'new-row',
	        	'type',
	        	'widget-area',
	        	'width',
        	);

        	$field_name_suffix = array_merge( $field_name_suffix, $megamenu_field_name_suffix );
        }

        foreach ( $field_name_suffix as $key ) {
            $meta_key = str_replace( '-', '_', $key );

            if ( isset( $_REQUEST['menu-item-sf-megamenu-'. $key][$menu_item_db_id] ) ) {
            	$meta_data[ $meta_key ] = $_REQUEST['menu-item-sf-megamenu-'. $key][ $menu_item_db_id ];
            } else {
                $meta_data[ $meta_key ] = '';
            }
        }

        update_post_meta( $menu_item_db_id, '_menu_item_sf_megamenu', $meta_data );
    }

    /**
     * Add custom menu edit fields
     */
    function add_custom_edit_fields() {
    	require_once 'class-sf-megamenu-edit.php';
		return 'SF_Megamenu_Edit';
	}
}

new SF_Megamenu();