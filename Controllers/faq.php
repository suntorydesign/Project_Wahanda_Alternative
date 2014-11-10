<?php

	/**
	 * 
	 */
	class faq extends Controller {
		
		function __construct() {
			parent::__construct();
		}
		
		function index() {
			Session::initIdle();
			$this->view->style = array(
				URL . 'Views/faq/css/faq.css'
			);

			$this->view->script = array(
				URL . 'Views/faq/js/faq.js'
			);

			$this->view->render('faq/index');
		}
		
	}