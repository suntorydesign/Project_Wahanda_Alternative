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
		$this -> view -> script = array(URL . 'Views/servicelocation/js/servicelocation.js', URL . 'Views/servicelocation/js/advantagesearch.js');
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
			$this -> model -> loadResultSearch($data);
		}
	}
	
	public function loadAdvantageSearch(){
		Session::initIdle();
		if(isset($_POST['service_name']) && isset($_POST['district_id'])){
			$data['service_name'] = $_POST['service_name'];
			$data['district_id'] = $_POST['district_id'];
			$this -> model -> loadAdvantageSearch($data);
		}
	}

}
