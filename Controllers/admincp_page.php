<?php

/**
 *
 */
class admincp_page extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		Auth::handleAdminLogin();
		$this->view->render_admincp('page/index');
	}

	
}