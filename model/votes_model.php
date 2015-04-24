<?php
require ("_model_interface.php");

class votes_model extends _Model_Interface{
	function __construct(){
		// parent::__construct("user"); //passing the table
		parent::__construct();
	}

	// function to check if user upvoted / downvoted a post
	// $votetype
	// 0 - upvote
	// 1 - downvote
	private function check_user_voted($uid, $pid, $votetype){
		$query = "SELECT * FROM votes WHERE user_id = ".$uid." AND post_id = ".$pid." AND votetype = ".$votetype;
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
	function vote_post($uid, $pid, $votetype){
		if($this->check_user_voted($uid,$pid,$votetype)){
			//user voted, return
			$query = "DELETE FROM votes WHERE user_id = ".$uid." AND post_id = ".$pid;
			$result = mysqli_query($this->_con, $query);
			if($result){
				$vote = ($votetype == 0 ? 1 : - 1);
				$query2 = "UPDATE post SET votes = votes - ".$vote." WHERE pid= ".$pid;
				$result2 = mysqli_query($this->_con, $query2);
				return true;
			}
		}else{
			//user has not voted
			$t = $this->returnNot($votetype);
			if($this->check_user_voted($uid,$pid,$t)){
				//user has upvoted / downvoted before that, delete the record of that
				$query = "DELETE FROM votes WHERE user_id = ".$uid." AND post_id = ".$pid."";
				$result = mysqli_query($this->_con, $query);
				if($result){
					$vote = ($votetype == 0 ? 1 : -1 );
					$query2 = "UPDATE post SET votes = votes + ".$vote." WHERE pid= ".$pid;
					$result2 = mysqli_query($this->_con, $query2);
				}
			}
			//increase / decrease the number of votes
			//insert the record of vote into votes tables
			$vote = ($votetype == 0 ? 1 : - 1);
			$query = "UPDATE post SET votes = votes +".$vote." WHERE pid = ".$pid;
			$result = mysqli_query($this->_con, $query);
			if($result){
				$query2 = "INSERT INTO votes (user_id, post_id, votetype) VALUES (".$uid.",".$pid.",".$votetype.")";
				$result2 = mysqli_query($this->_con, $query2);
				if($result2){
					return true;
				}
			}
		}
		return false;
	}

	public function get_votes_by_post_id($pid){
		$query = "SELECT votes FROM post WHERE pid = ".$pid;
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

//voting test
$db = new votes_model();
$db->vote_post(1,2,0);
echo $db->get_votes_by_post_id(2);
?>