<?php
/////////////////////////////////////////////////////////////////////////////
// FabCMS Framework
//
// Copyright (c) 2009 - 2010 FabCMS China Inc. (http://www.fabcms.com)
//
// 许可协议，请查看源代码中附带的 LICENSE.txt 文件，
// 或者访问 http://www.fabcms.com/ 获得详细信息。
/////////////////////////////////////////////////////////////////////////////

class FMongoDB
{
	var $CONNECTION;
	var $HOST = "localhost";
	var $DB;

	function FMongoDB() {
		//$this->_connection();
	}

	function _connection() {
		$this->CONNECTION = new Mongo($this->HOST); 
	}

	function dbname($name) {
		$this->_connection();
		$this->DB = $this->CONNECTION->$name;
		return $this->DB;
	}

	function getValue($dbname,$key) {
		return $this->dbname($dbname)->$key;
	}

	function setValue($dbname,$key, $value) {
		$collection = $this->dbname($dbname)->$key;
		var_dump($collection);
		var_dump($value);
		return $collection->insert($value);
	}
}