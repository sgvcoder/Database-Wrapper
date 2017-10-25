<?php
/**
 * Created by PhpStorm.
 * User: sgv
 * Date: 23.08.17
 * Time: 8:03
 */

namespace mr\core\interfaces;


interface Database {

	public function get_connection();

	public function select($str);

	public function update($str);

	public function insert($str);
}