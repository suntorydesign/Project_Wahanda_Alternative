<?php
/**
 * 
 */
class clientlogin extends Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function clientLogin(){
		Session::initIdle();
		$data['email_login'] = $_POST['email'];
		$data['pass_login'] = $_POST['pass'];
		$this -> model -> clientLogin($data);
	}
	
	function clientLogout(){
		Session::initIdle();
		Session::init();
		Session::destroy();
		echo "logout";
	}
}

?>