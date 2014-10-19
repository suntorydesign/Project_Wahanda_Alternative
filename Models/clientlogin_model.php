<?php
/**
 * 
 */
class clientlogin_model extends Model {
	
	function __construct() {
		parent::__construct();
	}
	
	function clientLogin($data){
		$sql = "SELECT client_id
			, client_username
			, client_email
			, client_name
			, client_phone 
			, client_join_date
		FROM client 
		WHERE client_email = :client_email 
		AND client_pass = :client_pass 
		AND client_is_active = 1";

		$client = array(
				':client_email' 		=> $data['email_login'],
				':client_pass' 	=> Hash::create('md5', $data['pass_login'], HASH_PASSWORD_KEY)
			);
		$result = $this -> db -> select($sql, $client);
		if(isset($result[0]['client_id'])){
			Session::init();
			Session::set('client_id', $result[0]['client_id']);
			Session::set('client_username', $result[0]['client_username']);
			Session::set('client_email', $result[0]['client_email']);
			Session::set('client_name', $result[0]['client_name']);
			Session::set('client_phone', $result[0]['client_phone']);
			Session::set('client_join_date', $result[0]['client_join_date']);
		}
		echo json_encode($result);
	}
	
}

?>