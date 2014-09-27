<?php

/**
 *
 */
class service extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		Session::initIdle();
		header('location:' . URL);
	}

	public function servicePlace($user_id) {
		Session::initIdle();
		$this -> view -> style = array(URL . 'Views/service/css/service.css');
		$this -> view -> script = array(URL . 'Views/service/js/service.js');
		$this -> view -> user_id = $user_id;
		$this -> view -> render('service/index');
	}

	public function loadLocationDetail() {
		Session::initIdle();
		if (isset($_POST['user_id'])) {
			$this -> model -> loadLocationDetail($_POST['user_id']);
		}
	}

	public function loadReview() {
		Session::initIdle();
		if (isset($_POST['review_user_id']) && isset($_POST['review_result'])) {
			$data['user_id'] = $_POST['review_user_id'];
			$data['review_result'] = $_POST['review_result'];
			$this -> model -> loadReview($data);
		}
	}

	public function loadPersonReview() {
		Session::initIdle();
		Session::init();
		if (isset($_SESSION['client_id'])) {
			if (isset($_POST['review_user_id'])) {
				$data['user_id'] = $_POST['review_user_id'];
				$data['client_id'] = $_SESSION['client_id'];
				$this -> model -> loadPersonReview($data);
			}
		} else {
			echo '[]';
		}
	}

	public function sendReview() {
		Session::initIdle();
		Session::init();
		if (isset($_POST['review_content']) && isset($_SESSION['client_id'])) {
			$data['user_id'] = $_POST['review_user_id'];
			$data['client_id'] = $_SESSION['client_id'];
			$data['user_review_content'] = $_POST['review_content'];
			$data['user_review_active'] = 0;
			$data['user_review_clean'] = 0;
			$data['user_review_quality'] = 0;
			$data['user_review_staff'] = 0;
			$data['user_review_valuable'] = 0;
			//print_r($data);
			$this -> model -> sendReview($data);
		}
	}

}
