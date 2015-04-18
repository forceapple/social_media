<?php
require ("db.php");

// $a="test";
// $b="1234";
class login_model{

	private $con;
	function __construct(){
		
		global $con;
		$this->con = $con;
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
	


}

// $db = new login_model();
// $db->login($a,$b);

?>