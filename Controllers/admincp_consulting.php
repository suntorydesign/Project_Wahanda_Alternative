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
		if(isset($_POST['question_service_type_id'])){
			$this -> model -> loadRuleList($_POST['question_service_type_id']);
		}
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
	
	public function saveRule(){
		Auth::handleAdminLogin();
		if(isset($_POST['rule_group']) && isset($_POST['rule_result']) && isset($_POST['rule_service'])){
			$data['rule_group'] = $_POST['rule_group'];
			$data['rule_result'] = $_POST['rule_result'];
			$data['rule_service'] = $_POST['rule_service'];
			$this -> model -> saveRule($data);
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
