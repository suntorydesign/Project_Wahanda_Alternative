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
		$this -> view -> style = array(URL . 'Views/servicelocation/css/servicelocation.css');
		$this -> view -> script = array(URL . 'Views/servicelocation/js/servicelocation.js');
		if (isset($_GET['s']) && isset($_GET['l'])) {
			$this -> view -> service = $_GET['s'];
			$this -> view -> location = $_GET['l'];
		}else{
			header('location:' . URL);
		}
		$this -> view -> render('servicelocation/index');
	}

}
