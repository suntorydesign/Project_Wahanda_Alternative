<?php

/**
 *
 */
class service extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		header('location:' . URL);
	}

	public function servicePlace($user_id) {
		$this -> view -> style = array(URL . 'Views/service/css/service.css');
		$this -> view -> script = array(URL . 'Views/service/js/service.js');
		$this -> view -> user_id = $user_id;
		$this -> view -> render('service/index');
	}

	public function loadLocationDetail() {
		if (isset($_POST['user_id'])) {
			$this -> model -> loadLocationDetail($_POST['user_id']);
		}
	}

}
