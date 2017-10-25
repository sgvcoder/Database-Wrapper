<?php
/**
 * Created by PhpStorm.
 * User: core
 * Date: 22.08.17
 * Time: 9:22
 */

namespace mr\core;

class View {
	private $fullPathName = null;
	private $savedVars = Array();

	public function __construct( $name ) {
		try {
			// Getting full path to the view
			$this->fullPathName = Config::$view_folder . $name . ".php";

			// Does view's file exist ?
			if ( file_exists( $this->fullPathName ) == false ) {
				throw new \Exception ( 'View: "' . $name . ".php" . '" is not exist!' );
			}
		} catch ( \Exception $e ) {
			Config::show_exception( $e );
		}

		return $this;
	}

	/*
	 *  Display/Render current and all child views
	 */

	public function render( $isPrint = true ) {
		try {
			// Add global variables from global array
			$this->savedVars = array_merge( $this->savedVars, Config::$view_global_data );

			// Creation added variables into current class
			foreach ( $this->savedVars as $key => $val ) {
				// Is it View ?
				if ( $this->savedVars[ $key ] instanceof View ) {
					// Yes, we need to render child view and save result into variable
					${$key} = $val->render( false );
				} else {
					// No, creation variable
					${$key} = $val;
				}
			}

			// Return html
			ob_start();
			require $this->fullPathName;
			$result = ob_get_contents();
			ob_end_clean();

			if ( $isPrint == true ) {
				echo $result;
			} else {
				return $result;
			}
		} catch ( \Exception $e ) {
			Config::show_exception( $e );
		}
	}

	/*
	 *  Adding varibales to the view
	 */

	public function set( $name, $value ) {
		$this->savedVars[ $name ] = $value;

		return $this;
	}

	/*
	 *  Adding varibales to the view from array
	 */

	public function setArray( $array ) {
		foreach ( $array as $key => $val ) {
			$this->savedVars[ $key ] = $val;
		}

		return $this;
	}

	/**
	 * Display view
	 * @return string
	 */
	public function __toString() {
		$this->render();

		return '';
	}

}