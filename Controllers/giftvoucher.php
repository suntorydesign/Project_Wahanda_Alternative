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
		if (isset($_POST['gift_voucher_email']) && isset($_POST['gift_voucher_price'])) {
			$data['gift_voucher_email'] = $_POST['gift_voucher_email'];
			$data['gift_voucher_price'] = $_POST['gift_voucher_price'];
			$data['gift_voucher_mess'] = $_POST['gift_voucher_mess'];
			$this -> model -> saveGiftvoucher($data);
		}
	}

}
?>