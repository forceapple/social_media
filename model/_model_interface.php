<?php
require ("db.php");

/**
 * This class is stores the generic or basic crud that other classes can build on.
 */
class _Model_Interface{
	protected $_table;
	protected $_con;

	// function __construct($table_name=""){
	// 	global $con;
	// 	$this->_con = $con;
	// 	echo $table_name;
	// }

	function __construct(){
		global $con;
		$this->_con = $con;
		$table_name = get_class($this);
		$table_name = explode('_', $table_name);
		$this->_table = array_shift($table_name);
	}

	
}