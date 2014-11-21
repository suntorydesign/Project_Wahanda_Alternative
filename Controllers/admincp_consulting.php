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

	public function loadRuleList() {
		Auth::handleAdminLogin();
		$this -> model -> loadRuleList();
	}

	public function addRuleDetail() {
		Auth::handleAdminLogin();
		$this -> view -> style = array(URL . 'Views/admincp/consulting/css/consulting.css');
		$this -> view -> script = array(URL . 'Views/admincp/consulting/js/consulting.js');
		$this -> view -> render_admincp('consulting/add');
	}

	public function loadRuleServiceType() {
		Auth::handleAdminLogin();
		$this -> model -> loadRuleServiceType();
	}

	public function loadRuleService() {
		Auth::handleAdminLogin();
		if (isset($_POST['service_type_id'])) {
			$this -> model -> loadRuleService($_POST['service_type_id']);
		}
	}

	public function loadQuestionList() {
		Auth::handleAdminLogin();
		if (isset($_POST['service_type_id'])) {
			$this -> model -> loadQuestionList($_POST['service_type_id']);
		}
	}

	public function checkFactExist() {
		Auth::handleAdminLogin();
		if (isset($_POST['fact']) && isset($_POST['fact_id']) && isset($_POST['question_id'])) {
			$data['fact'] = $_POST['fact'];
			$data['fact_id'] = $_POST['fact_id'];
			$data['question_id'] = $_POST['question_id'];
			$this -> model -> checkFactExist($data);
		}
	}

	public function editRuleDetail($rule_id) {
		Auth::handleAdminLogin();
		$this -> view -> style = array(URL . 'Views/admincp/consulting/css/consulting.css');
		$this -> view -> script = array(URL . 'Views/admincp/consulting/js/consulting.js');
		$this -> view -> render_admincp('consulting/edit');
	}

}
