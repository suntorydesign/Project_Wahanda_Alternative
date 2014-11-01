<?php

/**
 *
 */
class admincp_spa extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		Auth::handleAdminLogin();
		$this -> view -> style = array(URL . 'Views/admincp/spa/css/spa.css');
		$this -> view -> script = array(URL . 'Views/admincp/spa/js/spa.js');
		$this -> view -> render_admincp('spa/index');
		
	}
	
	function loadSpaList(){
		Auth::handleAdminLogin();
		$this -> model -> loadSpaList();
	}
	
	function addSaveDetail(){
		Auth::handleAdminLogin();
		$data['user_full_name'] = $_POST['user_full_name'];
		$data['user_email'] = $_POST['user_email'];
		$data['user_password'] = Hash::create('md5', $_POST['user_password'], HASH_PASSWORD_KEY);
		$data['user_business_name'] = $_POST['user_business_name'];
		$data['user_address'] = $_POST['user_address'];
		$data['user_district_id'] = $_POST['user_district_id'];
		$data['user_phone'] = $_POST['user_phone'];
		$checkEmailExist = $this -> model -> checkSpaEmailExist($data['user_email'] = $_POST['user_email']);
		if($checkEmailExist == 0){
			$this -> model -> addSaveDetail($data);
		}else{
			echo 0;
		}
	}
	
	function addSpaDetail(){
		Auth::handleAdminLogin();
		$this -> view -> style = array(URL . 'Views/admincp/spa/css/spa.css');
		$this -> view -> script = array(URL . 'Views/admincp/spa/js/spa.js');
		$this -> view -> render_admincp('spa/add');
	}
	
	public function editSpaDetail($user_id){
		Auth::handleAdminLogin();
		$this -> view -> style = array(URL . 'Views/admincp/spa/css/spa.css');
		$this -> view -> script = array(URL . 'Views/admincp/spa/js/spa.js');
		$this -> view -> user_id = $user_id;
		$this -> view -> render_admincp('spa/edit');
	}
	
	function loadUserDetail(){
		Auth::handleAdminLogin();
		if(isset($_POST['user_id'])){
			$data['user_id'] = $_POST['user_id'];
			$this -> model -> loadUserDetail($data);
		}
	}

}
