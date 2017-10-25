<?php
/**
 * Created by PhpStorm.
 * User: sgv
 * Date: 22.08.17
 * Time: 9:34
 */

namespace mr\www;

use mr\core\Config;
use mr\core\Database;
use mr\core\View;
use mr\helpers\Cleaner;

class Home {

	public function __construct() {

		$db = new Database();
		$result = $db->select("select * from users;");

		$clear_url = Cleaner::clear_url("http://test.com");

		$view = new View("home");
		$view->set('result', $result);
		$view->set('clear_url', $clear_url);
		$view->render();
	}
}