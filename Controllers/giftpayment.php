<?php
class giftpayment extends Controller {
	function __construct() {
		parent::__construct();
	}

	public function index() {
		Session::initIdle();
		Auth::handleClientLogin();
		if (!isset($_SESSION['gift_voucher_email']) || !isset($_SESSION['gift_voucher_price'])) {
			header('Location:' . URL);
		}
		$this -> view -> style = array(URL . 'Views/giftpayment/css/giftpayment.css');
		$this -> view -> script = array(URL . 'Views/giftpayment/js/giftpayment.js');
		$this -> view -> is_payment_page = 1;
		$this -> view -> render('giftpayment/index');
	}

	function loadGiftPaymentDetail() {
		Session::initIdle();
		Session::init();
		$result = array();
		if (isset($_SESSION['gift_voucher_sender']) && isset($_SESSION['gift_voucher_email']) && isset($_SESSION['gift_voucher_type']) && isset($_SESSION['gift_voucher_date']) && isset($_SESSION['gift_voucher_mess']) && isset($_SESSION['gift_voucher_price'])) {
			$result['gift_booking'][0]['gift_voucher_sender'] = $_SESSION['gift_voucher_sender'];
			$result['gift_booking'][0]['gift_voucher_email'] = $_SESSION['gift_voucher_email'];
			$result['gift_booking'][0]['gift_voucher_type'] = $_SESSION['gift_voucher_type'];
			$result['gift_booking'][0]['gift_voucher_date'] = $_SESSION['gift_voucher_date'];
			$result['gift_booking'][0]['gift_voucher_due_date'] = $_SESSION['gift_voucher_due_date'];
			$result['gift_booking'][0]['gift_voucher_mess'] = $_SESSION['gift_voucher_mess'];
			$result['gift_booking'][0]['gift_voucher_price'] = $_SESSION['gift_voucher_price'];
		} else {
			$result['gift_booking'] = '';
		}
		if (isset($_SESSION['client_id'])) {
			$result['client_info'][0]['client_id'] = $_SESSION['client_id'];
			$result['client_info'][0]['client_username'] = $_SESSION['client_username'];
			$result['client_info'][0]['client_email'] = $_SESSION['client_email'];
			$result['client_info'][0]['client_name'] = $_SESSION['client_name'];
			$result['client_info'][0]['client_phone'] = $_SESSION['client_phone'];
			$result['client_info'][0]['client_join_date'] = $_SESSION['client_join_date'];
		} else {
			$result['client_info'] = '';
		}
		echo json_encode($result);
	}

	public function processPaypalPayment() {
		Session::initIdle();
		if (isset($_SESSION['client_id']) && isset($_POST['payment_type'])) {
			$data['payment_type'] = $_POST['payment_type'];
			$data['card_number'] = $_POST['card_number'];
			$data['secure_code'] = $_POST['secure_code'];
			$data['date_expire'] = $_POST['date_expire'];
			$data['first_name'] = $_POST['first_name'];
			$data['last_name'] = $_POST['last_name'];
			$this -> model -> processPaypalPayment($data);
		} else {
			echo 0;
		}
	}

}
