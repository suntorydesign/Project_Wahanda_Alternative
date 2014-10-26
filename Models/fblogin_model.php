<?php
/**
 * 
 */
class fblogin_model extends Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function checkFBExistMail($mail){
		$sql = <<<SQL
SELECT COUNT(*) as check_count
FROM client
WHERE client_email = '{$mail}'
SQL;
		$select = $this -> db -> select($sql);
		return $select[0]['check_count'];
	}
	
	public function getClientInfo($mail){
		$sql = <<<SQL
SELECT client_id
, client_username
, client_email
, client_name
, client_phone 
, client_join_date
FROM client
WHERE client_email = '{$mail}'
AND client_is_active = 1
SQL;
		$result = $this ->db -> select($sql);
		if(isset($result[0]['client_id'])){
			Session::initIdle();
			Session::set('client_id', $result[0]['client_id']);
			Session::set('client_username', $result[0]['client_username']);
			Session::set('client_email', $result[0]['client_email']);
			Session::set('client_name', $result[0]['client_name']);
			Session::set('client_phone', $result[0]['client_phone']);
			Session::set('client_join_date', $result[0]['client_join_date']);
		}
	}
	
	public function insertClientFB($data){
		$sql = <<<SQL
INSERT INTO `client`(
`client_name`
, `client_email`
, `client_pass`
, `client_phone`
, `client_postcode`
, `client_username`
, `client_sex`
, `client_creditpoint`
, `client_giftpoint`
, `client_is_active`
) VALUES (
'{$data['client_name']}'
,'{$data['client_email']}'
,'{$data['client_pass']}'
,''
,'70000'
,'{$data['client_username']}'
,{$data['client_sex']}
,0
,0
,1
)
SQL;
		$insert = $this -> db -> prepare($sql);
		$insert -> execute();
		if ($insert -> rowCount() > 0) {
			$this ->getClientInfo($data['client_email']);
		}
	}
}
