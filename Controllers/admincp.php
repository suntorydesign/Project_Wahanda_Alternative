<?php

/**
 *
 */
class Admincp extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
			Session::init();
			if(Session::get('admincp')) {
				header('location:' . URL . 'admincp_dashboard');
			} else {
				$this->view->render_admincp('index', true);
			}
		}

	function login() {
		$this->model->login();
	}

	function logout() {
		$this->model->logout();
	}
	
}