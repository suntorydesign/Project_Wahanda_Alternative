<?php

/**
 *
 */
class Admincp_setting extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		Auth::handleAdminLogin();
		$this->view->render_admincp('setting/index');
	}

	
}