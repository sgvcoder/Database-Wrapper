<?php
/**
 * Created by PhpStorm.
 * User: sgv
 * Date: 23.08.17
 * Time: 9:44
 */

namespace mr\core\drivers;

use mr\core\Config;

use \JFactory as JFactory;

class Joomla implements \mr\core\interfaces\Database {
	private $jdb = null;

	// Initialisation and get DB connection
	public function get_connection() {
		if ( $this->jdb ) {
			return $this->jdb;
		}

		define( '_JEXEC', 1 );
		define( 'DS', DIRECTORY_SEPARATOR );
		define( 'JPATH_BASE', Config::$j_path );

		include Config::$j_path . 'includes/defines.php';
//		include Config::$j_path . 'libraries/loader.php';
		include Config::$j_path . 'includes/framework.php';
//		include Config::$j_path . 'libraries/joomla/factory.php';

		$this->jdb = JFactory::getDbo();

		return $this->jdb;
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

		$jdb = $this->get_connection();

		$query = $jdb->getQuery( true );

		$query->select( $jdb->quoteName( '*' ) )
		      ->from( $jdb->quoteName( '#__users' ) )
		      ->where( $jdb->quoteName( 'id' ) . ' = ' . $jdb->quote( (int) 433 ) )
		      ->order( 'id ASC' );

		$jdb->setQuery( $query );

		return $jdb->loadObjectList();
	}

	private function prepare_result($data = array()){

	}
}