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

	function loadSpaList() {
		Auth::handleAdminLogin();
		$this -> model -> loadSpaList();
	}

	function addSaveDetail() {
		Auth::handleAdminLogin();
		$data['user_full_name'] = $_POST['user_full_name'];
		$data['user_email'] = $_POST['user_email'];
		$data['user_password'] = bin2hex(openssl_random_pseudo_bytes(3));
		$data['user_business_name'] = $_POST['user_business_name'];
		$data['user_address'] = $_POST['user_address'];
		$data['user_district_id'] = $_POST['user_district_id'];
		$data['user_phone'] = $_POST['user_phone'];
		$checkEmailExist = $this -> model -> checkSpaEmailExist($data['user_email'] = $_POST['user_email']);
		if ($checkEmailExist == 0) {
			$this -> model -> addSaveDetail($data);
		} else {
			echo 0;
		}
	}

	function addSpaDetail() {
		Auth::handleAdminLogin();
		$this -> view -> style = array(URL . 'Views/admincp/spa/css/spa.css');
		$this -> view -> script = array(URL . 'Views/admincp/spa/js/spa.js');
		$this -> view -> render_admincp('spa/add');
	}

	public function editSpaDetail($user_id) {
		Auth::handleAdminLogin();
		$this -> view -> style = array(URL . 'Views/admincp/spa/css/spa.css');
		$this -> view -> script = array(URL . 'Views/admincp/spa/js/spa.js');
		$this -> view -> user_id = $user_id;
		$this -> view -> render_admincp('spa/edit');
	}

	function loadUserDetail() {
		Auth::handleAdminLogin();
		if (isset($_POST['user_id'])) {
			$data['user_id'] = $_POST['user_id'];
			$this -> model -> loadUserDetail($data);
		}
	}

	public function saveEditDetail() {
		Auth::handleAdminLogin();
		$data['user_id'] = $_POST['user_id'];
		$data['user_full_name'] = $_POST['user_full_name'];
		$data['user_address'] = $_POST['user_address'];
		$data['user_district_id'] = $_POST['user_district_id'];
		$data['user_phone'] = $_POST['user_phone'];
		$this -> model -> saveEditDetail($data);
	}
	public function deleteUser(){
		Auth::handleAdminLogin();
		$data['user_id'] = $_POST['user_id'];
		$this -> model -> deleteUser($data);
	}
	public function approveUser(){
		Auth::handleAdminLogin();
		$data['user_id'] = $_POST['user_id'];
		$data['user_email'] = $_POST['user_email'];
		$data['user_password'] = bin2hex(openssl_random_pseudo_bytes(3));
		$body = '<h1>BELEZA Thông Báo</h1>';
		$body .= '<p>Bạn đã yêu tài khoản trên BELEZA</p>';
		$body .= '<p>Tên đăng nhập của bạn trên BELEZA connect là: ' . $data['user_email'] . '</p>';
		$body .= '<p>Mật khẩu đăng nhập trên BELEZA connect của bạn là: <h3><strong><i>' . $data['user_password'] . '</i></strong></h3></p>';
		$body .= '<p>Hãy đăng nhập lại và đổi password của bạn nhé </p>';
		$body .= '<p>Chúc một bạn ngày mới tốt lành</p>';
		$body .= '<div align="right"><small><i><b>Ban quản trị BELEZA</b></i></small></div>';

		//Gửi mail local
		$mail = new PHPMailer(TRUE);
		$mail -> CharSet = "UTF-8";
		// create a new object
		$mail -> IsSMTP();
		// enable SMTP
		$mail -> SMTPDebug = 1;
		// debugging: 1 = errors and messages, 2 = messages only
		$mail -> SMTPAuth = true;
		// authentication enabled
		$mail -> SMTPSecure = 'ssl';
		// secure transfer enabled REQUIRED for GMail
		$mail -> Host = SMTP_MAIL;
		$mail -> Port = 465;
		// or 587
		$mail -> IsHTML(true);
		$mail -> Username = INFO_MAIL;
		$mail -> Password = PASS_MAIL;
		$mail -> SetFrom(INFO_MAIL, 'BELEZA VIETNAM');
		$mail -> Subject = "Thông tin tạo địa điểm từ Beleza!";
		$mail -> Body = $body;
		$mail -> AddAddress($data['user_email']);
		if (!$mail -> Send()) {
			echo "Mailer Error: " . $mail -> ErrorInfo;
		} else {
			$this -> model -> approveUser($data);
		}	
	}
}
