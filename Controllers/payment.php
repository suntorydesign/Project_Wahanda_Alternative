<?php /**
 *
 */
class payment extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		Session::initIdle();
		Auth::handleClientLogin();
		if (!isset($_SESSION['booking_detail']) && !isset($_SESSION['eVoucher_detail'])) {
			header('Location:' . URL);
		}
		$this -> view -> style = array(URL . 'Views/payment/css/payment.css');
		$this -> view -> script = array(URL . 'Views/payment/js/payment.js');
		$this -> view -> is_payment_page = 1;
		$this -> view -> render('payment/index');
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

	function processVenuePayment() {
		Session::initIdle();
		if (isset($_SESSION['client_id'])) {
			$this -> model -> processVenuePayment();
		} else {
			echo 0;
		}
	}

	function checkIsLoginPayment() {
		Session::initIdle();
		if (isset($_SESSION['client_id'])) {
			echo 200;
		} else {
			echo 0;
		}
	}

	function loadPaymentDetail() {
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

}
