<?php
require ("_model_interface.php");
class user_register_model extends _Model_Interface{
	private $username;
	private $pass;
	private $profile_img;
	private $f_name;
	private $l_name;
	private $email;
	private $location;

	function __construct($username, $pass, $profile_img, $email, $f_name, $l_name, $location){
		parent::__construct();
		$this->username=$username;
		$this->password=$pass;
		$this->profile_img=$profile_img;
		$this->email=$email;
		$this->f_name=$f_name;
		$this->l_name=$l_name;
		$this->location=$location;
	}

	function register_user(){
		$query = "INSERT INTO $this->_table(username, password, profile_img, email, f_name, l_name, location) VALUES ('".$this->username."','".$this->password."','".$this->profile_img."', '".$this->email."', '".$this->f_name."', '".$this->l_name."', '".$this->location."')";

		$result = $this->result($query);
		return true;
	}


}
// $a ="monetd";
// $s ="asd";
// $d ="asd.jpg";
// $f ="sdffff";
// $e ="sadda@gmail.com";
// $g ="erh";
// $h ="vancouver";


// $db= new user_register_model($a, $s, $d, $e, $f, $g, $h);
// $db->register_user();
?>