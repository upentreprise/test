<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Pda_Helper {

	public static function generate_unique_string() {
		return uniqid();
	}

	public static function get_plugin_configs() {
		return array('endpoint' => 'pda_v3_pf');
	}

	public static function get_guid($file_name, $request_url, $file_type) {
		$guid = preg_replace("/-\d+x\d+.$file_type$/", ".$file_type", $request_url);
	}
}

?>
