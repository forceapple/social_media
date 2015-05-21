<?php
class search_model extends _Model_Interface{
	function __construct(){
		parent::__construct();
	}


	public function search_post($input){
		$query="SELECT pid, title, text FROM post WHERE title LIKE '%".$input."%'";
		$result= $this->result($query);

		if($result){
			$arr = array();
			while($row = mysqli_fetch_array($result)){
				$arr['pid'] =$row['pid'];
				$arr['title']=$row['title'];
				$arr['text']=$row['text'];
				$arr2[] =$arr;
			}
				if($arr){
					//print_r($arr2);
					return $arr2;	
				}else{
					//print_r("none found");
					return false;
				}
			
		}
	}

	public function search_user($input){
		$query="SELECT uid, username, profile_img, f_name, l_name FROM user WHERE username LIKE '%".$input."%' ORDER BY username";
		$result= $this->result($query);

		if($result){
			$arr = array();
			while($row = mysqli_fetch_array($result)){
				$arr['uid'] =$row['uid'];
				$arr['username']=$row['username'];
				$arr['profile_img']=$row['profile_img'];
				$arr['f_name']=$row['f_name'];
				$arr['l_name']=$row['l_name'];
				$arr2[] =$arr;

			}
				if($arr){
					//print_r($arr2);
					return $arr2;	
				}else{
					//print_r("none found");
					return false;
				}
			
		}
	}

	public function search_name($input){
		$query="SELECT uid, username, profile_img, f_name, l_name FROM user WHERE f_name LIKE '%".$input."%' OR l_name LIKE '%".$input."%' ORDER BY username";
		$result= $this->result($query);

		if($result){
			$arr = array();
			while($row = mysqli_fetch_array($result)){
				$arr['uid'] =$row['uid'];
				$arr['username']=$row['username'];
				$arr['profile_img']=$row['profile_img'];
				$arr['f_name']=$row['f_name'];
				$arr['l_name']=$row['l_name'];
				$arr2[] =$arr;

			}
				if($arr){
					//print_r($arr2);
					return $arr2;	
				}else{
					//print_r("none found");
					return false;
				}
			
		}
	}

	public function search_comment($input){
		$query="SELECT * FROM comments WHERE comment LIKE '%".$input."%'";
		$result= $this->result($query);
		if($result){
			$arr = array();
			while($row = mysqli_fetch_array($result)){
				$cid=$row['cid'];
				$arr['cid'] =$row['cid'];
				$query2="SELECT * FROM comments_posts WHERE cid=".$cid;
				$result2= $this->result($query2);
				if($result2){
					$row2=mysqli_fetch_array($result2);
					$uid=$row2['uid'];
					$pid=$row2['pid'];
					$arr['pid']=$row2['pid'];
					$arr['uid']=$row2['uid'];
					$query3="SELECT title FROM post WHERE pid=".$pid;
					$result3= $this->result($query3);
					$arr['title']=mysqli_fetch_array($result3)['title'];
					$query4="SELECT username, profile_img FROM user WHERE uid=".$uid;
					$result4= $this->result($query4);
					$row4=mysqli_fetch_array($result4);
					$arr['username']=$row4['username'];
					$arr['profile_img']=$row4['profile_img'];
				}
				$arr2[] =$arr;
			}
				if($arr){
					///print_r($arr2);
					return $arr2;	
				}else{
					//print_r("none found");
					return false;
				}
			
		}
	}
}
// $a="p";
// $db = new search_model();

// $db->search_comment($a);

?>