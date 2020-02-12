<?php
/**
* SF User Profile
* 
*/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

class SF_User_Profile {

	function __construct() {
		// add custom fields
		add_action( 'show_user_profile', array( $this, 'add_profile_fields' ) );
		add_action( 'edit_user_profile', array( $this, 'add_profile_fields' ) );

		// save/update fields
		add_action( 'personal_options_update', array( $this, 'save_user_profile' ) );
		add_action( 'edit_user_profile_update', array( $this, 'save_user_profile' ) );
	}

	/**
	 * Custom profile fields
	 * @param object $user WP_User
	 */
	function add_profile_fields ( $user ) {
		$avatar = get_the_author_meta( 'sf_user_avatar', $user->ID );
		$avatar = !empty( $avatar ) ? $avatar : '';
		?>
		<!-- sf user meta -->
		<h3><?php esc_html_e( 'Avatar', 'spirit' ); ?></h3>
		<table class="form-table">
	        <tr>
	            <th><label for="sf_user_avatar"><?php esc_html_e( 'Select Image', 'spirit' ); ?></label></th>
	            <td>
	            	<div class="sf-media-upload">
	            		<input type="hidden" id="sf_user_avatar" name="sf_user_avatar" value="<?php echo esc_url( $avatar ); ?>" />
						<div class="sf-media-btns<?php if ( !empty( $avatar ) ) { echo ' selected'; } ?>">
							<button type="button" class="sf-btn-upload-image button button-secondary"><?php esc_html_e( 'Upload Image', 'spirit' ); ?></button>
							<button type="button" class="sf-btn-edit-image button button-secondary"><?php esc_html_e( 'Edit', 'spirit' ); ?></button>
							<button type="button" class="sf-btn-remove-image button button-secondary"><?php esc_html_e( 'Remove', 'spirit' ); ?></button>
						</div>
						<div class="sf-media-preview" style="max-width: 100px;">
						<?php if ( !empty( $avatar ) ) : ?>
							<img src="<?php echo esc_url( $avatar ); ?>" alt="avatar">
						<?php endif; ?>
					</div>
	            </td>
	        </tr>
		</table>
	    <h3><?php esc_html_e( 'Social Links', 'spirit' ); ?></h3>
	    <table class="form-table">
	        <tr>
	            <th><label for="sf_user_title"><?php esc_html_e( 'Author Title', 'spirit' ); ?></label></th>
	            <td>
	                <input type="text" name="sf_user_title" id="sf_user_title" value="<?php echo esc_html( get_the_author_meta( 'sf_user_title', $user->ID ) ); ?>" class="regular-text">
	            </td>
	        </tr>
	        <?php foreach ( sf_get_social_icon_names() as $key => $label ) : ?>
	        <?php $social_data = get_the_author_meta( 'sf_social_links', $user->ID ); ?>
	        <?php $field_id = "sf_$key"; ?>
		        <tr>
		            <th><label for="<?php echo esc_attr( $field_id ); ?>"><?php echo esc_html( $label ); ?></label></th>
		            <td>
		                <input type="url" name="<?php echo esc_attr( $field_id ); ?>" id="<?php echo esc_attr( $field_id ); ?>" value="<?php echo ( isset( $social_data[$key] ) ? $social_data[$key] : '' ); ?>" class="regular-text code">
		            </td>
		        </tr>
	        <?php endforeach; ?>
	    </table><?php
	}

	/**
	 * Save custom profile fields
	 * @param  int $user_id  user ID
	 */
	function save_user_profile( $user_id ) {
	    if ( !current_user_can( 'edit_user', $user_id ) ) {
	    	return;
	    }

	    $social_data = array();

	    foreach ( sf_get_social_icon_names() as $key => $label ) {
	    	$field_id = "sf_$key";
	    	if ( !empty( $_POST[$field_id] ) ) {
	    		$social_data[$key] = $_POST[$field_id];
	    	}
	    }

	    if ( !empty( $_POST['sf_user_avatar'] ) ) {
	    	update_user_meta( $user_id, 'sf_user_avatar', $_POST['sf_user_avatar'] );
	    } else {
	    	delete_user_meta( $user_id, 'sf_user_avatar' );
	    }

	    if ( !empty( $social_data ) ) {
	    	update_user_meta( $user_id, 'sf_social_links', $social_data );
	    } else {
	    	delete_user_meta( $user_id, 'sf_social_links' );
	    }
	    
	    if ( !empty( $_POST['sf_user_title'] ) ) {
	    	update_user_meta( $user_id, 'sf_user_title', $_POST['sf_user_title'] );
	    } else {
	    	delete_user_meta( $user_id, 'sf_user_title' );
	    }
	}
}

new SF_User_Profile();