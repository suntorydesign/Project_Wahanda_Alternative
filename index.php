<?php
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	
	require 'config.php';
	require 'paths.php';

	//autoload libs
	function __autoload($class){
		require LIBS . $class .'.php';
	}
	require_once LIBS . DS . 'other' . DS . 'PHPMailer' . DS . 'class.phpmailer.php';
  	
	$app = new Bootstrap();
	
	

	