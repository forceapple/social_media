<?php
require ("_model_interface.php");

class comments_model extends _Model_Interface{
	function __construct(){
		// parent::__construct("user"); //passing the table
		parent::__construct();
	}

	function create_comment($uid, $pid, $comment){
	 	$query = "INSERT INTO comments(comment) VALUES ('".$comment."')";
		$result = mysqli_query($this->_con,$query);
		if($result){
			$id = mysqli_insert_id($this->_con);
			$query = "INSERT INTO comments_posts(pid,uid,cid) VALUES('".$pid."','".$uid."','".$id."')";
			$result2 = mysqli_query($this->_con, $query);
			if($result2){
				//both inserts are good, return true
				return true;
			}
			return false;
		}
		return false;
	}

	function edit_comment($pid, $uid, $cid, $comment){
		$query = "SELECT * FROM comments_posts LEFT JOIN comments ON comments.cid = comments_posts.cid LEFT JOIN post ON comments_posts.pid=post.pid WHERE comments_posts.pid='".$pid."' AND comments_posts.cid='".$cid."' AND comments_posts.uid='".$uid."'";
		$result = mysqli_query($this->_con,$query);

		if($result){
			$query = "UPDATE comments SET comment='".$comment."'WHERE cid=".$cid;
			$result2 = mysqli_query($this->_con,$query);
			if($result2){
				return true;
			}
			return false;
		}
		return false;
	}

	function del_comment($cid){
		$this->del_row($cid);
	}
}
// $a=2;
// $db = new comments_model();
// $db->del_comment($a);
/*echo "<pre>";
print_r($db->get_post_by_uid($a));
echo "</pre>";*/

?>