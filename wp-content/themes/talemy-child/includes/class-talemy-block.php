<?php
/**
 * Block parent class
 *
 * @since   1.0.0
 * @package Talemy/Classes
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Talemy_Block {
	
    var $atts;
    var $block_id = 0;
    var $current_tab_id = 0;
    var $preload_content = false;
    var $pagination = false;

	function __construct( $atts ) {
		$this->atts = talemy_block_parse_atts( $atts );
	}

    /**
     * Get block data in json format
     *
     * @return json
     */
    function get_block_data() {
        $block_data = array(
            'atts' => $this->atts,
            'block_id' => $this->block_id,
            'max_num_pages' => $this->query->max_num_pages,
            'found_posts' => $this->query->found_posts,
            'query_args' => $this->query->query
        );
        return json_encode( $block_data );
    }
}