<?php

/**
 *
 */
class giftvoucher extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		Session::initIdle();
		$this -> view -> style = array(URL . 'Views/giftvoucher/css/giftvoucher.css');

		$this -> view -> script = array(URL . 'Views/giftvoucher/js/giftvoucher.js');

		$this -> view -> render('giftvoucher/index');
	}

	public function saveGiftvoucher() {
		Session::initIdle();
		if (isset($_SESSION['client_id'])) {
			if (isset($_POST['gift_voucher_sender']) && isset($_POST['gift_voucher_email']) && isset($_POST['gift_voucher_type']) && isset($_POST['gift_voucher_date']) && isset($_POST['gift_voucher_mess']) && isset($_POST['gift_voucher_price'])) {
				$_SESSION['gift_voucher_sender'] = $_POST['gift_voucher_sender'];
				$_SESSION['gift_voucher_email'] = $_POST['gift_voucher_email'];
				$_SESSION['gift_voucher_type'] = $_POST['gift_voucher_type'];
				$_SESSION['gift_voucher_date'] = $_POST['gift_voucher_date'];
				$_SESSION['gift_voucher_due_date'] = $this -> model -> getDueDate($_POST['gift_voucher_date']);
				$_SESSION['gift_voucher_mess'] = $_POST['gift_voucher_mess'];
				$_SESSION['gift_voucher_price'] = $_POST['gift_voucher_price'];
				echo 200;
				// $this -> model -> saveGiftvoucher($data);
			} else {
				echo 800;
			}
		} else {
			echo 0;
		}
	}

}
?>