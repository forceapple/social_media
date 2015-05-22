<?php
// require ("_model_interface.php");
class comment_votes_model extends _Model_Interface{
	function __construct(){
		parent::__construct();
	}

	// function to check if user upvoted / downvoted a post
	// $votetype
	// 0 - upvote
	// 1 - downvote
	private function check_user_voted($uid, $cid, $votetype){
		$query = "SELECT * FROM comment_vote WHERE user_id = ".$uid." AND commnet_id = ".$cid." AND votetype = ".$votetype;
		$result = mysqli_query($this->_con, $query);
		if($result){
			if(mysqli_num_rows($result) == 0){
				return false;
			}else{
				return true;
			}
		}
		return false;
		
	}

	// function to upvote a post
	// votetype - type of vote to be invoked
	// 0 - upvote
	// 1 - downvote
	function vote_comment($uid, $cid, $votetype){
		if($this->check_user_voted($uid,$cid,$votetype)){
			//user voted, return
			$query = "DELETE FROM comment_vote WHERE user_id = ".$uid." AND commnet_id = ".$cid;
			$result = mysqli_query($this->_con, $query);
			if($result){
				$vote = ($votetype == 0 ? 1 : -1);
				$query2 = "UPDATE comments SET votes = votes - ".$vote." WHERE cid= ".$cid;
				$result2 = mysqli_query($this->_con, $query2);
				return true;
			}
		}else{
			//user has not voted
			$t = $this->returnNot($votetype);
			if($this->check_user_voted($uid,$cid,$t)){
				//user has upvoted / downvoted before that, delete the r 	ecord of that
				$query = "DELETE FROM comment_vote WHERE user_id = ".$uid." AND commnet_id = ".$cid."";
				$result = mysqli_query($this->_con, $query);
				if($result){
					$vote = ($votetype == 0 ? 1 : -1 );
					$query2 = "UPDATE comment_vote SET votes = votes + ".$vote." WHERE cid= ".$cid;
					$result2 = mysqli_query($this->_con, $query2);
				}
			}
			//increase / decrease the number of votes
			//insert the record of vote into votes tables
			$vote = ($votetype == 0 ? 1 : - 1);
			$query = "UPDATE comments SET votes = votes +".$vote." WHERE cid = ".$cid;
			$result = mysqli_query($this->_con, $query);
			if($result){
				$query2 = "INSERT INTO comment_vote (user_id, commnet_id, votetype) VALUES (".$uid.",".$cid.",".$votetype.")";
				$result2 = mysqli_query($this->_con, $query2);
				if($result2){
					return true;
				}
			}
		}
		return false;
	}

	public function get_votes_by_commnet_id($cid){
		$query = "SELECT votes FROM comments WHERE cid = ".$cid;
		$result = mysqli_query($this->_con, $query);
		if($result){
			while ($row=mysqli_fetch_row($result)){
				return $row[0];
			}	
		}
		return false;
	}

	//aka PHP's ! operator is retarded
	function returnNot($type){
		switch($type){
			case 0:
				return 1;
				break;
			case 1:
				return 0;
				break;
		}

	}
}
// $a=2;
// $b=3;
// $c=0;
// //voting test
// $db = new comment_votes_model();
// $db->vote_comment($a,$b,$c);

?>