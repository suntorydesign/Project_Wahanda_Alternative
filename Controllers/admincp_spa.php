<?php

/**
 *
 */
class Admincp_spa extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		Auth::handleAdminLogin();
		$this->view->render_admincp('spa/index');
	}

	
}