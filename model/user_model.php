<?php
require ("_model_interface.php");
 // $c="test";
 // $b="1234";
class user_model extends _Model_Interface{
	private $username;
	private $pass;

	function __construct($username, $pass){
		parent::__construct();
		$this->username=$username;
		$this->password=$pass;
	}


	public function login(){
		$query = "SELECT user.username, user.f_name, user.l_name, user.profile_img FROM user WHERE user.username='".$this->username."' AND user.password=".$this->password;
		$result = mysqli_query($this->_con, $query);
		$arr= array();
		if($result){
			while($row = mysqli_fetch_array($result)){
				$arr['username']= $row['username'];
				$arr['f_name']= $row['f_name'];
				$arr['l_name']= $row['l_name'];
				$arr['profile_img']= $row['profile_img'];
				
			}	
			//print_r($arr);
			return $arr;
		}
		return false;
	}

	function del_user($uid){
		$this->del_row($uid);
		return true;
	}
	


}
/*$a=2;

$db = new user_model($c, $b, null, null, null, null);
$db->login();*/

?>