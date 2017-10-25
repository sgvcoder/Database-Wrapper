<?php
/**
 * Created by PhpStorm.
 * User: sgv
 * Date: 23.08.17
 * Time: 9:44
 */

namespace mr\core\drivers;

class PDO implements \mr\core\interfaces\Database {
	private $PDO = null;

	// Initialisation and get DB connection
	public function get_connection() {
		if ( $this->PDO ) {
			return $this->PDO;
		}

		try {
			// Making PDO connection
			$this->PDO = new \PDO( "mysql:host=localhost;dbname=sandbox", "root", "123", array( \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'" ) );

			return $this->PDO;
		} catch ( \PDOException $e ) {
			Config::show_exception( $e );
		}
	}

	public function update( $params, $data = array() ) {
		$PDO       = $this->get_connection();
		$statement = $PDO->prepare( $params[0] );
		$statement->execute( $data );
	}

	public function insert( $params, $data = array() ) {
		$PDO       = $this->get_connection();
		$statement = $PDO->prepare( $params[0] );
		$statement->execute( $data );

		return $PDO->lastInsertId();
	}

	public function select( $params ) {
		$PDO       = $this->get_connection();
		$statement = $PDO->prepare( $params[0] );
		$statement->execute();

		return $statement->fetchAll( \PDO::FETCH_ASSOC );
	}
}