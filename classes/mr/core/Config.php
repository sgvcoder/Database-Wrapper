<?php
/**
 * Created by PhpStorm.
 * User: core
 * Date: 22.08.17
 * Time: 9:22
 */

namespace mr\core;


class Config {

	/** @var string PDO, WP or Joomla */
	public static $db_driver = 'Joomla';

	public static $wp_path = __DIR__ . '/../../../../wordpress/';

	public static $j_path = __DIR__ . '/../../../../joomla3/';

	public static $view_folder = __DIR__ . '/../../../views/';
	public static $view_global_data = array();

	public static function errors_enable() {

		error_reporting( E_ALL );
		ini_set( 'display_errors', 'On' );
	}

	public static function errors_disable() {

		error_reporting( 0 );
		ini_set( 'display_errors', 'Off' );
	}

	public static function show_exception($e) {

		echo "<pre>";
		print_r($e);
		echo "</pre>";
	}
}
