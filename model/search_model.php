<?
require ("_model_interface.php");

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

			}
				if($arr){
					//print_r($arr);
					return $arr;	
				}else{
					//print_r("none found");
					return false;
				}
			
		}
		
	}
}
// $a="tes";
// $db = new search_model();

// $db->search_post($a);

?>