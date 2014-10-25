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
		// Session::destroy();
		unset($_SESSION['client_id']);
		unset($_SESSION['client_username']);
		unset($_SESSION['client_email']);
		unset($_SESSION['client_name']);
		unset($_SESSION['client_phone']);
		unset($_SESSION['client_join_date']);
		unset($_SESSION['booking_detail']);
		unset($_SESSION['eVoucher_detail']);
		echo "logout";
	}
}

?>