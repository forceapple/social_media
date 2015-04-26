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

	function result($query){
		$result = mysqli_query($this->_con, $query);
		return $result;
	}

	function del_row($where){
		// gets the first col of the table, which is id
		$sql = "DESCRIBE".$this->_table;
		$result = $this->result($sql);
		$row = mysqli_fetch_array($result);
		$id = $row[0];
		//################################################
		//del query
		$query ="DELETE FROM ".$this->_table." WHERE ".$this->_table.".".$id."=".$where;
		$result = $this->result($query);
		return true;
	}

	
}