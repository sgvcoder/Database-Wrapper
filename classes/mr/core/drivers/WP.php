<?php
/**
 * Created by PhpStorm.
 * User: sgv
 * Date: 23.08.17
 * Time: 9:44
 */

namespace mr\core\drivers;

use mr\core\Config;

class WP implements \mr\core\interfaces\Database {
	private $wpdb = null;

	// Initialisation and get DB connection
	public function get_connection() {
		if ( $this->wpdb ) {
			return $this->wpdb;
		}

		define( 'WP_DEBUG', false );

		include Config::$wp_path . 'wp-includes/wp-db.php';
		include Config::$wp_path . 'wp-includes/plugin.php';

		$this->wpdb = new \wpdb('root', '123', 'sandbox', 'localhost');

		return $this->wpdb;
	}

	public function update( $params, $data = array() ) {
//		$PDO       = $this->get_connection();
//		$statement = $PDO->prepare( $params[0] );
//		$statement->execute( $data );
	}

	public function insert( $params, $data = array() ) {
//		$PDO       = $this->get_connection();
//		$statement = $PDO->prepare( $params[0] );
//		$statement->execute( $data );
//
//		return $PDO->lastInsertId();
	}

	public function select( $params ) {

		$wpdb = $this->get_connection();

		return $wpdb->get_results($params[0], ARRAY_A);
	}
}