<?php
/**
 * SF Autoload
 * 
 * Autoload classes
 *
 * @package Spirit_Framework
 */

class SF_Autoload {

	/**
	 * Class paths.
	 *
	 * @access protected
	 * @var array
	 */
	protected static $paths = array(
		SF_FRAMEWORK_DIR . 'includes/',
		SF_FRAMEWORK_DIR . 'includes/demo/',
		SF_FRAMEWORK_DIR . 'includes/fonts/',
		SF_FRAMEWORK_DIR . 'includes/widgets/'
	);

	/**
	 * Class constructor.
	 *
	 * @access public
	 */
	public function __construct() {
		spl_autoload_register( array( $this, 'autoload' ) );
	}

	/**
	 * Include a class file.
	 *
	 * @param  string $path File path.
	 */
	protected function load_file( $path ) {
		if ( file_exists( $path ) ) {
			require_once $path;
		}
	}

	/**
	 * The SF class autoloader.
	 * Finds the path to a class that we're requiring and includes the file.
	 *
	 * @access protected
	 * @param string $class_name The name of the class we're trying to load.
	 */
	public function autoload( $class_name ) {

		// Exit if not a SF class
		if ( 0 !== stripos( $class_name, 'SF' ) ) {
			return;
		}

		// Convert a class name to a file name
		$file_name = 'class-' . strtolower( str_replace( '_', '-', $class_name ) ) . '.php';
		
		// Include class file if exist
		foreach ( self::$paths as $path ) {
			$file_path = $path . $file_name;
			$this->load_file( $file_path );
		}
	}
}

new SF_Autoload();