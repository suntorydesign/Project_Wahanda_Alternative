<?php

/**
 *
 */
class admincp_dashboard extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		Auth::handleAdminLogin();
		$this->view->render_admincp('dashboard/index');
	}

	
}