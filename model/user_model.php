<?php
require ("_model_interface.php");

// $a="test";
// $b="1234";
class user_model extends _Model_Interface{
	function __construct(){
		// parent::__construct("user"); //passing the table
		parent::__construct();
	}


	function login($username, $pass){
		$query = "SELECT user.username, user.f_name, user.l_name, user.profile_img FROM user WHERE user.username='".$username."' AND user.password=".$pass;
		$result = mysqli_query($this->con, $query);
		$arr= array();
		if($result){
			while($row = mysqli_fetch_array($result)){
				$arr['username']= $row['username'];
				$arr['f_name']= $row['f_name'];
				$arr['l_name']= $row['l_name'];
				$arr['profile_img']= $row['profile_img'];
				
			}	
			print_r($arr);
			return $arr;
		}
		return false;
	}

	function del_user($uid){
		$this->del_row($uid);
	}
	


}
$a=2;

$db = new user_model();
$db->del_user($a);

?>