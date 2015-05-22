<?php
class post_model extends _Model_Interface{
	function __construct(){
		// parent::__construct("user"); //passing the table
		parent::__construct();
	}

	//get all post
	function get_all_post($page){
		$offset = 15*$page;
		$query = "SELECT * FROM $this->_table LEFT JOIN user_post ON user_post.pid = post.pid
										LEFT JOIN user ON user.uid = user_post.uid ORDER BY post.pid LIMIT 15 OFFSET ".$offset;
		$result = $this->result($query);
		if($result){
			$arr = array();
			while($row = mysqli_fetch_array($result)){	
				$arr['post_title']= $row['title'];
				$arr['post_text']= $row['text'];
				$arr['pid']= $row['pid'];
				$postid=$arr['pid'];

				$arr['post_type']= $row['type'];
				$arr['username']= $row['username'];
				$arr['profile_img']= $row['profile_img'];
				$arr['time_stamp']= $row['time_stamp'];
				$query2="SELECT COUNT(*) as count FROM comments_posts WHERE comments_posts.pid=".$postid;
				$result2 = $this->result($query2);

				if($result2){
					while($row2 = mysqli_fetch_array($result2)){
						$arr4['count']=$row2['count'];
						$arr['num_comment']= $arr4['count'];
					}
				}else{
					
					//print_r('asdsad');
				}
				$arr2[]=$arr;
				
			}
			return $arr2;
		}

	}
	//get post by post id
	function get_post($pid){
		$query = "SELECT user.username, user_post.pid,user.profile_img, user_post.uid, post.title, post.type, post.text, post.time_stamp  FROM post LEFT JOIN user_post ON user_post.pid = post.pid
									LEFT JOIN user ON user.uid = user_post.uid WHERE post.pid=".$pid;
		$result = $this->result($query);
		if($result){
			$arr = array();
			while($row = mysqli_fetch_array($result)){

				$arr['post_title']= $row['title'];
				$arr['pid']= $row['pid'];
				$arr['text']= $row['text'];
				$arr['post_type']= $row['type'];
				$arr['username']= $row['username'];
				$arr['time_stamp']= $row['time_stamp'];
				$arr['uid'] = $row['uid'];
				$arr['profile_img']= $row['profile_img'];
				
			}
			
			return $arr;
		}
	}
	// get post by uid
	function get_post_by_uid($uid){
		$query = "SELECT user.username, user_post.pid,user.profile_img, user_post.uid, post.title, post.type, post.text, post.time_stamp FROM post LEFT JOIN user_post ON user_post.pid = post.pid LEFT JOIN user ON user.uid = user_post.uid WHERE user.uid=".$uid;
		$result = $this->result($query);
		if($result){
			$arr = array();
			while($row = mysqli_fetch_array($result)){

				$arr['post_title']= $row['title'];
				$arr['pid']= $row['pid'];
				$arr['text']= $row['text'];
				$arr['post_type']= $row['type'];
				$arr['time_stamp']= $row['time_stamp'];
				$arr['username']= $row['username'];
				$arr['uid'] = $row['uid'];
				$arr['profile_img']= $row['profile_img'];
				
			}
			return $arr;
		}

	}	

	function create_post($uid, $title, $text, $type){
		$query = "INSERT INTO post(title, text, type) VALUES ('".$title."','".$text."','".$type."')";
		$result = $this->result($query);
		if($result){
			//get last insert id and insert into user_post
			$id = mysqli_insert_id($this->_con);
			$query = "INSERT INTO user_post(uid,pid) VALUES ('".$uid."','".$id."')";
			$result2 = $this->result($query);
			if($result2){
				//both inserts are good, return true
				return true;
			}
			return false;
		}
		return false;
	}

	function edit_post($pid,$uid, $title, $text, $type){
		$query = "SELECT * FROM user_post LEFT JOIN post ON post.pid = user_post.pid WHERE user_post.uid=".$uid;
		$result = $this->result($query);

		if($result){
			$query = "UPDATE post SET title='".$title."',text='".$url."', type='".$type."' WHERE pid=".$pid;
			$result2 = $this->result($query);
				if($result2){
				return true;
			}
			return false;
		}
		return false;
	}

	function del_post($pid){
		$this->del_row($pid);
	}

}

// $a=0;
//  $db = new post_model();
//  $db->get_all_post($a);
// $db->del_post($a);
/*echo "<pre>";
print_r($db->get_post_by_uid($a));
echo "</pre>";*/
?>