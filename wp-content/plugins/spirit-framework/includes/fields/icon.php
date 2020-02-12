<?php

if ( class_exists( 'RWMB_Field' ) ) {
    class RWMB_Icon_Field extends RWMB_Field {

		/**
		 * Enqueue scripts and styles.
		 */
		public static function admin_enqueue_scripts() {
			wp_enqueue_style( 'font-awesome' );
			wp_enqueue_script( 'fonticonpicker' );
		}

		public static function html( $meta, $field ) {
		    return sprintf(
		        '<input type="hidden" name="%s" id="%s" class="sf-input-iconpicker" value="%s">',
		        $field['field_name'],
		        $field['id'],
		        $meta
		    );
		}
    }
}