<?php

namespace mr\core;

use mr\www\Home;

define("MR_DEBUG", true);

spl_autoload_register( function ( $class_name ) {

	if(!strpos($class_name, '\\')) {

		return false;
	}

	$class_name = str_replace("\\", "/", $class_name);
	$file = __DIR__ . '/classes/' . $class_name . '.php';

	if(MR_DEBUG) {

		echo 'autoload include: ' . $file . '<br>';
	}

	if(file_exists($file))
		include $file;
	elseif(MR_DEBUG) {

		Config::show_exception("File <b>$file</b> not found");
		exit;
	}
} );

Config::errors_enable();
new Home();