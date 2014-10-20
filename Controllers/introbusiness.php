<?php

	/**
	 * 
	 */
	class introbusiness extends Controller {
		
		function __construct() {
			parent::__construct();
		}
		
		function index() {
			$this->view->style = array(
				// ASSETS .'plugins/rs-plugin/css/settings.css',
				URL . 'Views/introbusiness/css/introbusiness.css'
			);

			$this->view->script = array(
				// ASSETS .'plugins/rs-plugin/js/jquery.themepunch.tools.min.js',
				// ASSETS .'plugins/rs-plugin/js/jquery.themepunch.revolution.min.js',
				URL . 'Views/introbusiness/js/introbusiness.js'
			);

			$this->view->render('introbusiness/index');
		}
		
	}