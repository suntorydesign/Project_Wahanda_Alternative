<?php

/**
 *
 */
class servicelocation extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		header('location:' . URL);
	}

	public function searchLocation() {
		Session::initIdle();
		$this -> view -> style = array(URL . 'Views/servicelocation/css/servicelocation.css');
		$this -> view -> script = array(URL . 'Views/servicelocation/js/servicelocation.js'
									  , URL . 'Views/servicelocation/js/advantagesearch.js'
									  , 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBUxUNFuJ09fVcA24HZcEq0gwxs37ESDo4&language=vi-VI');
		if (isset($_GET['s']) && isset($_GET['l'])) {
			$this -> view -> service = $_GET['s'];
			$this -> view -> location = $_GET['l'];
		}else{
			header('location:' . URL);
		}
		$this -> view -> render('servicelocation/index');
	}
	public function loadResultSearch(){
		Session::initIdle();
		if(isset($_POST['service_name']) && isset($_POST['district_id']) && isset($_POST['page'])){
			$data['service_name'] = $_POST['service_name'];
			$data['district_id'] = $_POST['district_id'];
			$data['page'] = $_POST['page'];
			$data['sort_by'] = $_POST['sort_by'];
			$data['user_address_1'] = $_POST['user_address_1'];
			$data['user_address_2'] = $_POST['user_address_2'];
			$data['service_type_id'] = $_POST['service_type_id'];
			$data['service_id'] = $_POST['service_id'];
			$data['user_service_sale_price'] = $_POST['user_service_sale_price'];
			$data['user_service_use_evoucher'] = $_POST['user_service_use_evoucher'];
			$data['user_open_hour'] = $_POST['user_open_hour'];
			$data['user_limit_before_booking'] = $_POST['user_limit_before_booking'];
			$this -> model -> loadResultSearch($data);
		}
	}
	
	public function loadAdvantageSearch(){
		Session::initIdle();
		if(isset($_POST['service_name']) && isset($_POST['district_id'])){
			$data['service_name'] = $_POST['service_name'];
			$data['district_id'] = $_POST['district_id'];
			$data['sort_by'] = $_POST['sort_by'];
			$data['user_address_1'] = $_POST['user_address_1'];
			$data['user_address_2'] = $_POST['user_address_2'];
			$data['service_type_id'] = $_POST['service_type_id'];
			$data['service_id'] = $_POST['service_id'];
			$data['user_open_hour'] = $_POST['user_open_hour'];
			$data['user_limit_before_booking'] = $_POST['user_limit_before_booking'];
			$this -> model -> loadAdvantageSearch($data);
		}
	}
	
	public function reloadService(){
		Session::initIdle();
		if(isset($_POST['service_name']) && isset($_POST['district_id'])){
			$data['service_name'] = $_POST['service_name'];
			$data['district_id'] = $_POST['district_id'];
			$data['sort_by'] = $_POST['sort_by'];
			$data['user_address_1'] = $_POST['user_address_1'];
			$data['user_address_2'] = $_POST['user_address_2'];
			$data['service_type_id'] = $_POST['service_type_id'];
			$data['service_id'] = $_POST['service_id'];
			$this -> model -> reloadService($data);
		}
	}
	
	public function reloadTypeBuy(){
		Session::initIdle();
		if(isset($_POST['service_name']) && isset($_POST['district_id'])){
			$data['service_name'] = $_POST['service_name'];
			$data['district_id'] = $_POST['district_id'];
			$data['sort_by'] = $_POST['sort_by'];
			$data['user_address_1'] = $_POST['user_address_1'];
			$data['user_address_2'] = $_POST['user_address_2'];
			$data['service_type_id'] = $_POST['service_type_id'];
			$data['service_id'] = $_POST['service_id'];
			$this -> model -> reloadTypeBuy($data);
		}
	}

}
