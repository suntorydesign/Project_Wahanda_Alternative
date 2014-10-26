<?php
/*	FACEBOOK LOGIN BASIC - PHP SDK V4.0
 *	file 			- index.php
 * 	Developer 		- Krishna Teja G S
 *	Website			- http://packetcode.com/apps/fblogin-basic/
 *	Date 			- 27th Sept 2014
 *	license			- GNU General Public License version 2 or later
 */

/* INCLUSION OF LIBRARY FILEs*/
require_once ('fb_lib/Facebook/FacebookSession.php');
require_once ('fb_lib/Facebook/FacebookRequest.php');
require_once ('fb_lib/Facebook/FacebookResponse.php');
require_once ('fb_lib/Facebook/FacebookSDKException.php');
require_once ('fb_lib/Facebook/FacebookRequestException.php');
require_once ('fb_lib/Facebook/FacebookRedirectLoginHelper.php');
require_once ('fb_lib/Facebook/FacebookAuthorizationException.php');
require_once ('fb_lib/Facebook/GraphObject.php');
require_once ('fb_lib/Facebook/GraphUser.php');
require_once ('fb_lib/Facebook/GraphSessionInfo.php');
require_once ('fb_lib/Facebook/Entities/AccessToken.php');
require_once ('fb_lib/Facebook/HttpClients/FacebookCurl.php');
require_once ('fb_lib/Facebook/HttpClients/FacebookHttpable.php');
require_once ('fb_lib/Facebook/HttpClients/FacebookCurlHttpClient.php');

/* USE NAMESPACES */
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
use Facebook\FacebookHttpable;
use Facebook\FacebookCurlHttpClient;
use Facebook\FacebookCurl;

/*PROCESS*/
class fblogin extends Controller {

	function __construct() {
		parent::__construct();
	}

	public function index() {
		Session::initIdle();
	}

	public function loginFB() {
		$required_scope = 'email';
		//1.Start Session
		Session::initIdle();
		//2.Use app id,secret and redirect url
		$app_id = '1519995188216019';
		$app_secret = 'b8c037c995dcee5e43bc6d1038f68606';
		$redirect_url = 'http:' . URL . 'fblogin/processFBLogin';

		//3.Initialize application, create helper object and get fb sess
		FacebookSession::setDefaultApplication($app_id, $app_secret);
		$helper = new FacebookRedirectLoginHelper($redirect_url);
		echo $helper -> getLoginUrl(array('scope' => $required_scope));
	}

	public function processFBLogin() {
		//1.Start Session
		Session::initIdle();
		//2.Use app id,secret and redirect url
		$app_id = '1519995188216019';
		$app_secret = 'b8c037c995dcee5e43bc6d1038f68606';
		$redirect_url = 'http:' . URL . 'fblogin/processFBLogin';

		//3.Initialize application, create helper object and get fb sess
		FacebookSession::setDefaultApplication($app_id, $app_secret);
		$helper = new FacebookRedirectLoginHelper($redirect_url);
		$sess = $helper -> getSessionFromRedirect();
		//4. if fb sess exists echo name
		if (isset($sess)) {
			//create request object,execute and capture response
			$request = new FacebookRequest($sess, 'GET', '/me');
			// from response get graph object
			$response = $request -> execute();
			$graph = $response -> getGraphObject(GraphUser::className());
			// use graph object methods to get user details
			$check_exist_mail = $this -> model -> checkFBExistMail($graph -> getProperty('email'));
			if ($check_exist_mail != '0') {
				$this -> model -> getClientInfo($graph -> getProperty('email'));
				header('Location: ' . URL);
			} else {
				$data['client_name'] = $graph -> getProperty('name');
				$data['client_username'] = '[FB]' . $graph -> getProperty('id');
				$data['client_email'] = $graph -> getProperty('email');
				if($graph -> getProperty('gender') == 'male'){
					$data['client_sex'] = 0;
				}else{
					$data['client_sex'] = 1;
				}
				$data['client_pass'] = bin2hex(openssl_random_pseudo_bytes(3));
				$data['client_pass'] = Hash::create('md5', $data['client_pass'], HASH_PASSWORD_KEY);
				$this -> model -> insertClientFB($data);
				header('Location: ' . URL);
				// echo '<pre/>';
				// print_r($graph);
				// echo('Hi : ' . $graph -> getProperty('name') . '</br>');
				// echo('Email : ' . $graph -> getProperty('email') . '</br>');
				// echo('Id : ' . $graph -> getProperty('id') . '</br>');
				// echo('Birth : ' . $graph -> getProperty('birthday') . '</br>');
				// echo('Exist : ' . $check_exist_mail . '</br>');
			}
		}
	}

}
?>