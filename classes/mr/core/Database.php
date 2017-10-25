<?php

namespace mr\core;

use mr\core\drivers\Joomla;
use mr\core\drivers\PDO;
use mr\core\drivers\WP;

class Database {

	protected $instance;

	public function __construct() {

		switch ( Config::$db_driver ) {
			case "PDO":
				$this->instance = new PDO();
				break;
			case "WP":
				$this->instance = new WP();
				break;
			case "Joomla":
				$this->instance = new Joomla();
				break;
		}
	}

	public function __call( $method, $arg ) {

		return $this->instance->$method( $arg );
	}
}