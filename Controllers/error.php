<?php

/**
 *
 */
class Error extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		Session::initIdle();
		$this->view->render('error/index',true);
	}

}
