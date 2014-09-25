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

	public function sendComment() {
		Session::init();
		if (isset($_POST['comment_content']) && isset($_SESSION['client_id'])) {
			$data['comment_content'] = $_POST['comment_content'];
			$data['comment_status'] = 0;
			$data['comment_client_id'] = $_SESSION['client_id'];
			$data['comment_user_id'] = $_POST['comment_user_id'];
			$this -> model -> sendComment($data);
		}
	}

}
