<?php
require ("_model_interface.php");
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
		$query = "SELECT * FROM fav LEFT JOIN post ON post.pid = fav.pid WHERE fav.uid=".$uid;
		$result = $this->result($query);
		if($result){
			$arr = array();
			while($row = mysqli_fetch_array($result)){	
				$arr['post_title']= $row['title'];
				$arr['pid']= $row['pid'];
				$arr['text']=$row['text'];
				$arr['uid']=$row['uid'];
				$arr2[]=$arr;
			}
		}
		print_r($arr2);
	}
}
$a=2;
// $b=6;
 $db = new fav_model();
 $db->get_all_fav_by_uid($a);

?>