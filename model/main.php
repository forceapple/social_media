<?php
require ("db.php");

//REMINDER OF POST TYPES
//post type 0 = title and URL only
//post type 1 = title image URL a link
//post type 2 = title and text only

class Noni{
	private $con;
	function __construct(){
		
		global $con;
		$this->con = $con;
		//echo $this->con;
	}
	//get all post
	function get_all_post(){
		
		$query = "SELECT * FROM post LEFT JOIN user_post ON user_post.pid = post.pid
										LEFT JOIN user ON user.uid = user_post.uid";
		$result = mysqli_query($this->con, $query);
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
				$result2 = mysqli_query($this->con, $query2);
				while($row2 = mysqli_fetch_array($result2)){
					$arr4['count']=$row2['COUNT(*)'];
					$arr['num_comment']= $arr4['count'];
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
		$result = mysqli_query($this->con, $query);
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
			$query = "SELECT user.username, user_post.pid,user.profile_img, user_post.uid, post.title, post.type, post.text FROM post LEFT JOIN user_post ON user_post.pid = post.pid LEFT JOIN user ON user.uid = user_post.uid WHERE user.uid=".$uid;
			$result = mysqli_query($this->con, $query);
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
	//get comments by post id
	function get_comments($pid){
		$query = "SELECT * FROM post LEFT JOIN comments_posts ON comments_posts.pid = post.pid
										LEFT JOIN user ON user.uid = comments_posts.uid
										LEFT JOIN comments ON comments.cid = comments_posts.cid WHERE post.pid=".$pid;
		$result = mysqli_query($this->con, $query);

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
	function create_post($uid, $title, $text, $type){
		$query = "INSERT INTO post(title, text, post_image, type) VALUES ('".$title."','".$text."','".$type."')";
		$result = mysqli_query($this->con, $query);
		if($result){
			//get last insert id and insert into user_post
			$id = mysqli_insert_id($this->con);
			$query = "INSERT INTO user_post(uid,pid) VALUES ('".$uid."','".$id."')";
			$result2 = mysqli_query($this->con,$query);
			if($result2){
				//both inserts are good, return true
				return true;
			}
			return false;
		}
		return false;
	}

	function create_comment($uid, $pid, $comment){
	 	$query = "INSERT INTO comments(comment) VALUES ('".$comment."')";
		$result = mysqli_query($this->con,$query);
		if($result){
			$id = mysqli_insert_id($this->con);
			$query = "INSERT INTO comments_posts(pid,uid,cid) VALUES('".$pid."','".$uid."','".$id."')";
			$result2 = mysqli_query($this->con, $query);
			if($result2){
				//both inserts are good, return true
				return true;
			}
			return false;
		}
		return false;
	}
	function edit_post($pid,$uid, $title, $text, $url, $type){
		$query = "SELECT * FROM user_post LEFT JOIN post ON post.pid = user_post.pid WHERE user_post.uid=".$uid;
		$result = mysqli_query($this->con,$query);

		if($result){
			$query = "UPDATE post SET title='".$title."',text='".$url."', post_image='".$url."', type='".$type."' WHERE pid=".$pid;
			$result2 = mysqli_query($this->con,$query);
 			if($result2){
				return true;
			}
			return false;
		}
		return false;
					

	}
	function del_post($pid,$uid){
		$query = "SELECT * FROM user_post LEFT JOIN post ON post.pid = user_post.pid WHERE user_post.uid=".$uid;
		$result = mysqli_query($this->con,$query);
		//$query ="DELETE FROM user_post WHERE user_post.pid='".$pid."' AND user_post.uid= ".$uid;
		if($result){
			$query2 ="DELETE FROM post WHERE post.pid=".$pid;
			$result2 = mysqli_query($this->con,$query2);
			if($result2){
				return true;
			}
			return false;
		}
		return false;
	}
	function edit_comment($pid, $uid, $cid, $comment){
		$query = "SELECT * FROM comments_posts LEFT JOIN comments ON comments.cid = comments_posts.cid LEFT JOIN post ON comments_posts.pid=post.pid WHERE comments_posts.pid='".$pid."' AND comments_posts.cid='".$cid."' AND comments_posts.uid='".$uid."'";
		$result = mysqli_query($this->con,$query);

		if($result){
			$query = "UPDATE comments SET comment='".$comment."'WHERE cid=".$cid;
			$result2 = mysqli_query($this->con,$query);
			if($result2){
				return true;
			}
			return false;
		}
		return false;
	}
	function del_comment($cid,$uid){
		$query = "SELECT * FROM comments_posts LEFT JOIN comments ON comments.cid = comments_posts.cid LEFT JOIN post ON comments_posts.pid=post.pid WHERE comments_posts.uid='".$uid."' AND comments_posts.cid='".$cid."'";
		$result = mysqli_query($this->con,$query);
		if($result){
			$query2 ="DELETE FROM comments WHERE comments.cid=".$cid;
			$result2 = mysqli_query($this->con,$query2);
			if($result2){
				return true;
			}
			return false;
		}
		return false;
	}
}

/*
$db = new Noni();
$asd="1";
$a="5";
$a2="1";
$f="Noni!!!!!!";
$r="I never  noni beo22222fre";
$w="http://www.costaricannoni.com/pics/P1050237.JPG";

$db->get_all_post();
//$db->edit_post($asd, $a,$f,$r,$w);


	*/


?>