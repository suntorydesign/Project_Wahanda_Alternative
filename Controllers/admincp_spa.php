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
	
	function addSpaDetail(){
		Auth::handleAdminLogin();
		$this -> view -> style = array(URL . 'Views/admincp/spa/css/spa.css');
		$this -> view -> script = array(URL . 'Views/admincp/spa/js/spa.js');
		$this -> view -> render_admincp('spa/add');
	}

}
