<?php

/**
 *
 */
class Index extends Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this -> view -> render('index');
	}

	public function loadTopServiceList() {
		$this -> model -> loadTopServiceList();
	}

	public function loadNewServiceList() {
		$this -> model -> loadNewServiceList();
	}

	public function loadServiceDetail() {
		$user_service_id = $_POST['user_service_id'];
		$this -> model -> loadServiceDetail($user_service_id);
	}

	public function getBookingInfo() {
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
			if(empty($_POST)){
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

	public function geteVoucherInfo(){
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
			if(empty($_POST)){
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
		Session::init();
		$result = array();
		if (isset($_SESSION['booking_detail'])) {
			$result['booking'] = $_SESSION['booking_detail'];
		} else {
			$result['booking'] = '';
		}
		if(isset($_SESSION['eVoucher_detail'])){
			$result['eVoucher'] = $_SESSION['eVoucher_detail'];
		}else{
			$result['eVoucher'] = '';
		}
		echo json_encode($result);
	}

	public function updateShoppingCart() {
		Session::init();
		$count_b = 0;
		$count_e = 0;
		if (isset($_SESSION['booking_detail']) && isset($_POST['appointment_quantity_list'])) {
			if($_POST['appointment_quantity_list'] != ''){
				$quantity_list = rtrim($_POST['appointment_quantity_list'], ',');
				$quantity_list = explode(',', $quantity_list);
				foreach ($_SESSION['booking_detail'] as $key => $value) {
					$_SESSION['booking_detail'][$key]['booking_quantity'] = $quantity_list[$key];
				}
				foreach ($_SESSION['booking_detail'] as $key => $value) {
					if($_SESSION['booking_detail'][$key]['booking_quantity'] == 0){
						unset($_SESSION['booking_detail'][$key]);
					}
				}
				$_SESSION['booking_detail'] = array_values($_SESSION['booking_detail']);
			}
			$count_b = count($_SESSION['booking_detail']);
		}
		if (isset($_SESSION['eVoucher_detail']) && isset($_POST['eVoucher_quantity_list'])) {
			if($_POST['eVoucher_quantity_list'] != ''){
				$quantity_list = rtrim($_POST['eVoucher_quantity_list'], ',');
				$quantity_list = explode(',', $quantity_list);
				foreach ($_SESSION['eVoucher_detail'] as $key => $value) {
					$_SESSION['eVoucher_detail'][$key]['booking_quantity'] = $quantity_list[$key];
				}
				foreach ($_SESSION['eVoucher_detail'] as $key => $value) {
					if($_SESSION['eVoucher_detail'][$key]['booking_quantity'] == 0){
						unset($_SESSION['eVoucher_detail'][$key]);
					}
				}
				$_SESSION['eVoucher_detail'] = array_values($_SESSION['eVoucher_detail']);
			}
			$count_e = count($_SESSION['eVoucher_detail']);
		}
		echo $count_b + $count_e;
	}

}
?>