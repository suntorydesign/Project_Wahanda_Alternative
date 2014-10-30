<?php

/**
 *
 */
class Index extends Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		Session::initIdle();
		$this -> view -> script = array(ASSETS . 'js/homepage.js');
		$this -> view -> render('index');
	}

	public function checkSessionIdle() {
		Session::init();
		if (isset($_SESSION['check_idle'])) {
			if ((time() - $_SESSION['check_idle']) >= IDLE_TIME) {
				// Session::destroy();
				unset($_SESSION['client_id']);
				unset($_SESSION['client_username']);
				unset($_SESSION['client_email']);
				unset($_SESSION['client_name']);
				unset($_SESSION['client_phone']);
				unset($_SESSION['client_join_date']);
				unset($_SESSION['booking_detail']);
				unset($_SESSION['eVoucher_detail']);
				echo 200;
			} else {
				echo 0;
			}
		}
	}

	public function loadDistrict() {
		$this -> model -> loadDistrict();
	}

	public function loadTopServiceList() {
		Session::initIdle();
		$this -> model -> loadTopServiceList();
	}

	public function loadNewServiceList() {
		Session::initIdle();
		$this -> model -> loadNewServiceList();
	}

	public function loadLocation() {
		Session::initIdle();
		$this -> model -> loadLocation();
	}

	public function loadServiceDetail() {
		Session::initIdle();
		$user_service_id = $_POST['user_service_id'];
		$this -> model -> loadServiceDetail($user_service_id);
	}

	public function getBookingInfo() {
		Session::initIdle();
		Session::init();
		$index_e = 0;
		if (isset($_SESSION['eVoucher_detail'])) {
			$index_e = count($_SESSION['eVoucher_detail']);
		}
		if (empty($_SESSION['booking_detail'])) {
			$index = 0;
			foreach ($_POST as $key => $value) {
				$_SESSION['booking_detail'][$index][$key] = $value;
			}
		} else {
			if (empty($_POST)) {
				return FALSE;
			}
			$index = count($_SESSION['booking_detail']);
			foreach ($_SESSION['booking_detail'] as $key => $value) {
				if ($value['user_service_id'] == $_POST['user_service_id'] && $value['booking_detail_date'] == $_POST['booking_detail_date'] && $value['booking_detail_time'] == $_POST['booking_detail_time']) {
					$_SESSION['booking_detail'][$key]['booking_quantity'] = $value['booking_quantity'] + 1;
					echo($index + $index_e);
					return FALSE;
				}
			}
			foreach ($_POST as $key => $value) {
				$_SESSION['booking_detail'][$index][$key] = $value;
			}
		}
		// echo "<pre/>";
		// print_r($_SESSION['booking_detail']);
		echo($index + $index_e + 1);
	}

	public function geteVoucherInfo() {
		Session::initIdle();
		Session::init();
		$index_b = 0;
		if (isset($_SESSION['booking_detail'])) {
			$index_b = count($_SESSION['booking_detail']);
		}
		if (empty($_SESSION['eVoucher_detail'])) {
			$index = 0;
			foreach ($_POST as $key => $value) {
				$_SESSION['eVoucher_detail'][$index][$key] = $value;
			}
		} else {
			if (empty($_POST)) {
				return FALSE;
			}
			$index = count($_SESSION['eVoucher_detail']);
			foreach ($_SESSION['eVoucher_detail'] as $key => $value) {
				if ($value['user_service_id'] == $_POST['user_service_id']) {
					$_SESSION['eVoucher_detail'][$key]['booking_quantity'] = $value['booking_quantity'] + $_POST['booking_quantity'];
					echo($index + $index_b);
					return FALSE;
				}
			}
			foreach ($_POST as $key => $value) {
				$_SESSION['eVoucher_detail'][$index][$key] = $value;
			}
		}
		// echo "<pre/>";
		// print_r($_SESSION['booking_detail']);
		echo($index + $index_b + 1);
	}

	public function shoppingCartDetail() {
		Session::initIdle();
		Session::init();
		$result = array();
		if (isset($_SESSION['booking_detail'])) {
			$result['booking'] = $_SESSION['booking_detail'];
		} else {
			$result['booking'] = '';
		}
		if (isset($_SESSION['eVoucher_detail'])) {
			$result['eVoucher'] = $_SESSION['eVoucher_detail'];
		} else {
			$result['eVoucher'] = '';
		}
		echo json_encode($result);
	}

	public function updateShoppingCart() {
		Session::initIdle();
		Session::init();
		$count_b = 0;
		$count_e = 0;
		if (isset($_SESSION['booking_detail']) && isset($_POST['appointment_quantity_list'])) {
			if ($_POST['appointment_quantity_list'] != '') {
				$quantity_list = rtrim($_POST['appointment_quantity_list'], ',');
				$quantity_list = explode(',', $quantity_list);
				foreach ($_SESSION['booking_detail'] as $key => $value) {
					$_SESSION['booking_detail'][$key]['booking_quantity'] = $quantity_list[$key];
				}
				foreach ($_SESSION['booking_detail'] as $key => $value) {
					if ($_SESSION['booking_detail'][$key]['booking_quantity'] == 0) {
						unset($_SESSION['booking_detail'][$key]);
					}
				}
				$_SESSION['booking_detail'] = array_values($_SESSION['booking_detail']);
			}
			$count_b = count($_SESSION['booking_detail']);
		}
		if (isset($_SESSION['eVoucher_detail']) && isset($_POST['eVoucher_quantity_list'])) {
			if ($_POST['eVoucher_quantity_list'] != '') {
				$quantity_list = rtrim($_POST['eVoucher_quantity_list'], ',');
				$quantity_list = explode(',', $quantity_list);
				foreach ($_SESSION['eVoucher_detail'] as $key => $value) {
					$_SESSION['eVoucher_detail'][$key]['booking_quantity'] = $quantity_list[$key];
				}
				foreach ($_SESSION['eVoucher_detail'] as $key => $value) {
					if ($_SESSION['eVoucher_detail'][$key]['booking_quantity'] == 0) {
						unset($_SESSION['eVoucher_detail'][$key]);
					}
				}
				$_SESSION['eVoucher_detail'] = array_values($_SESSION['eVoucher_detail']);
			}
			$count_e = count($_SESSION['eVoucher_detail']);
		}
		echo $count_b + $count_e;
	}

	public function setTimeIdle() {
		Session::initIdle();
	}

	public function sendCreatePlaceMail() {
		Session::initIdle();
		//Nội dung email
		$body = '<h1>Thông báo từ BELEZA</h1>';
		$body .= '<p>Xin chào Admin BELEZA tôi là: <strong>' . $_POST['create_place_name'] . '</strong></p>';
		$body .= '<p>Tôi muốn tạo địa điểm trên BELEZA với tên là: ' . $_POST['create_place_com_name'] . '</p>';
		$body .= '<p>Có thể liên lạc với tôi qua địa chỉ: ' . $_POST['create_place_address'] . '</p>';
		$body .= '<p>Hoặc SĐT: ' . $_POST['create_place_phone'] . '</p>';
		$body .= '<p>Hoặc Email: ' . $_POST['create_place_email'] . '</p>';
		$body .= '<div align="right"><small><i><b>Khách hàng từ BELEZA</b></i></small></div>';

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
		$mail -> Host = "smtp.gmail.com";
		$mail -> Port = 465;
		// or 587
		$mail -> IsHTML(true);
		$mail -> Username = "vietnt134@gmail.com";
		$mail -> Password = "whathaveyoudone1341996";
		$mail -> SetFrom($_POST['create_place_email']);
		$mail -> Subject = "Thông tin tạo địa điểm từ Beleza!";
		$mail -> Body = $body;
		$mail -> AddAddress(ADMIN_MAIL);
		if (!$mail -> Send()) {
			echo "Mailer Error: " . $mail -> ErrorInfo;
		} else {
			echo 200;
		}
	}

}
?>