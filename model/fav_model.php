<?php
//require ("_model_interface.php");
class fav_model extends _Model_Interface{
	function __construct(){
		// parent::__construct("user"); //passing the table
		parent::__construct();
	}

	function fav_post($pid, $uid){
		$query = "INSERT INTO fav(pid,uid) VALUES ('".$pid."','".$uid."')";
		$result = $this->result($query);
		if($result){
			return true;
		}
		return false;
	}

	function get_all_fav_by_uid($uid){

	}
}
// $a=16;
// $b=6;
//  $db = new fav_model();
//  $db->fav_post($a, $b);

?>