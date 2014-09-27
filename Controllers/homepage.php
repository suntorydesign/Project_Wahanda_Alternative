<?php

	/**
	 * 
	 */
	class HomePage extends Controller {
		
		function __construct() {
			parent::__construct();
		}
		
		function index() {
			Session::initIdle();
			$this->view->render('index');
		}
		
	}