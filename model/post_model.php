<?php
require ("_model_interface.php");

// $a="test";
// $b="1234";
class post_model extends _Model_Interface{
	function __construct(){
		// parent::__construct("user"); //passing the table
		parent::__construct();
	}

	//get all post
	function get_all_post(){
		
		$query = "SELECT * FROM $this->_table LEFT JOIN user_post ON user_post.pid = post.pid
										LEFT JOIN user ON user.uid = user_post.uid LIMIT 20";
		$result = mysqli_query($this->_con, $query);
		if($result){
			$arr = array();
			while($row = mysqli_fetch_array($result)){
				$pid = $row['pid'];
				
				
				$arr['post_title']= $row['title'];
				$arr['post_text']= $row['text'];
				$arr['pid']= $row['pid'];
				$arr['post_type']= $row['type'];
				$arr['username']= $row['username'];
				$arr['profile_img']= $row['profile_img'];
				$arr['time_stamp']= $row['time_stamp'];
				$query2="SELECT COUNT(*) FROM comments_posts WHERE comments_posts.pid=".$pid;
				$result2 = mysqli_query($this->_con, $query2);
				while($row2 = mysqli_fetch_array($result2)){
					$arr4['count']=$row2['COUNT(*)'];
					$arr['num_comment']= $arr4['count'];
				}

				$arr2[]=$arr;
			}
			return $arr2;
		}

	}
}