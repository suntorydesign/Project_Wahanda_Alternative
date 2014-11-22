<?php

/**
 *
 */
class admincp_question extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		Auth::handleAdminLogin();
		$this -> view -> style = array(URL . 'Views/admincp/question/css/question.css');
		$this -> view -> script = array(URL . 'Views/admincp/question/js/question.js');
		$this -> view -> render_admincp('question/index');
	}

	public function loadServiceTypeList() {
		Auth::handleAdminLogin();
		$this -> model -> loadServiceTypeList();
	}

	public function loadQuestionList() {
		Auth::handleAdminLogin();
		if(isset($_POST['service_type_id'])){
			$this -> model -> loadQuestionList($_POST['service_type_id']);
		}
	}

}
