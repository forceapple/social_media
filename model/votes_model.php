<?php
class votes_model extends _Model_Interface{
	function __construct(){
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
				$vote = ($votetype == 0 ? 1 : -1);
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

	/*
	// votetype 0 = up vote
	// votetype 1 = down vote
	//the user can up vote and up vote again to revert the vote. same for down vote
	// up voting then down voting does nothing
	private function check_user_voted($uid, $pid){
		$query = "SELECT * FROM votes WHERE user_id = ".$uid." AND post_id = ".$pid;
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

	public function up_vote($uid, $pid){
		if($this->check_user_voted($uid, $pid)){
			$this->del_vote($uid, $pid, 0);
			$this->update_vote_count($pid);
			
		}else{
			$query="INSERT INTO  $this->_table (user_id, post_id, votetype) VALUES (".$uid.",".$pid.", 0)";
			$result = $this->result($query);
			$this->update_vote_count($pid);
			return true;
		}
	}

	public function down_vote($uid, $pid){
		if($this->check_user_voted($uid, $pid)){
			//print_r($check_vote);
			$this->del_vote($uid, $pid, 1);
			$this->update_vote_count($pid);
			
		}else{
			$query="INSERT INTO  $this->_table (user_id, post_id, votetype) VALUES (".$uid.",".$pid.", 1)";
			$result = $this->result($query);
			$this->update_vote_count($pid);
			return true;
		}
	}
	//count down votes by pid
	public function count_down_votes($pid){
		$query="SELECT COUNT(votetype) AS 'count'FROM $this->_table WHERE $this->_table.votetype=1 AND $this->_table.post_id=".$pid;
		$result = $this->result($query);
		$row = mysqli_fetch_assoc($result);
		$result = $row['count'];
		return $result;
	}
	//count up votes by pid
	public function count_up_votes($pid){
		$query="SELECT COUNT(votetype) AS 'count'FROM $this->_table WHERE $this->_table.votetype=0 AND $this->_table.post_id=".$pid;
		$result = $this->result($query);
		$row = mysqli_fetch_assoc($result);
		$result = $row['count'];
		return $result;
	}
	//updates 
	public function update_vote_count($pid){
		$up_votes = $this->count_up_votes($pid);
		$down_votes =$this->count_down_votes($pid);
		$diff=$up_votes-$down_votes;
		$query ="UPDATE post SET votes=".$diff." WHERE pid=".$pid;
		$this->result($query);
	}
	
	public function del_vote($uid, $pid, $votetype){
		$query="DELETE FROM $this->_table WHERE $this->_table.user_id=".$uid." AND  $this->_table.post_id=".$pid." AND votetype=".$votetype;
		$result = $this->result($query);
		if($result){
			return true;
		}else{
			return false;
		}
	}
}

*/



// $a=1;
// $b=1;
// //voting test
// $db = new votes_model();
// //$db->update_vote_count($a);
// $db->up_vote(1,1);
// $db->count_up_votes(2);
// $db->down_vote($a, $b);
//echo $db->get_votes_by_post_id(2);
?>