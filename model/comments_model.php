<?php
class comments_model extends _Model_Interface{
	function __construct(){
		// parent::__construct("user"); //passing the table
		parent::__construct();
	}
	//get comments by post id
	function get_comments($pid){
		$query = "SELECT * FROM post LEFT JOIN comments_posts ON comments_posts.pid = post.pid
										LEFT JOIN user ON user.uid = comments_posts.uid
										LEFT JOIN comments ON comments.cid = comments_posts.cid WHERE post.pid=".$pid;
		$result = mysqli_query($this->_con, $query);

		if($result){
			$arr = array();
			while($row = mysqli_fetch_array($result)){
				$arr['cid']= $row['cid'];
				$arr['uid']= $row['uid'];
				$arr['username']= $row['username'];
				$arr['profile_img']= $row['profile_img'];
				$arr['comment']= $row['comment'];
				$arr['comment_time_stamp'] = $row['comment_time_stamp'];
				$arr2[]=$arr;
			}
			
			return $arr2;
		}

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