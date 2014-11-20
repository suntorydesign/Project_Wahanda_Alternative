<?php

/**
 *
 */
class admincp_consulting extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		Auth::handleAdminLogin();
		$this -> view -> style = array(URL . 'Views/admincp/consulting/css/consulting.css');
		$this -> view -> script = array(URL . 'Views/admincp/consulting/js/consulting.js');
		$this -> view -> render_admincp('consulting/index');

	}

	public function addRuleDetail() {
		Auth::handleAdminLogin();
		$this -> view -> style = array(URL . 'Views/admincp/consulting/css/consulting.css');
		$this -> view -> script = array(URL . 'Views/admincp/consulting/js/consulting.js');
		$this -> view -> render_admincp('consulting/add');
	}
	
	public function editRuleDetail($rule_id) {
		Auth::handleAdminLogin();
		$this -> view -> style = array(URL . 'Views/admincp/consulting/css/consulting.css');
		$this -> view -> script = array(URL . 'Views/admincp/consulting/js/consulting.js');
		$this -> view -> render_admincp('consulting/edit');
	}

}
