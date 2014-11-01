<?php

class Admincp_Spa_Model extends Model {
	function __construct(){
		parent::__construct();
	}

	function loadSpaList(){
		$sql = <<<SQL
SELECT
user_id
, user_business_name
, user_full_name
, user_email
, user_phone
, user_address
FROM user
WHERE user_delete_flg = 0
SQL;
		$select = $this -> db -> select($sql);
		echo json_encode($select);
	}
	
	public function checkSpaEmailExist($email){
		$sql = <<<SQL
SELECT COUNT(*) AS check_email
FROM user
WHERE user_email = '{$email}'
SQL;
		$select = $this -> db -> select($sql);
		return $select[0]['check_email'];
	}
	
	public function addSaveDetail($data){
		$sql = <<<SQL
INSERT INTO user(
user_full_name
, user_email
, user_password
, user_business_name
, user_address
, user_phone
, user_district_id
)
VALUES(
'{$data['user_full_name']}'
, '{$data['user_email']}'
, '{$data['user_password']}'
, '{$data['user_business_name']}'
, '{$data['user_address']}'
, '{$data['user_phone']}'
, '{$data['user_district_id']}'
)
SQL;
		$insert = $this -> db -> prepare($sql);
		$insert -> execute();
		if($insert -> rowCount() > 0){
			echo 200;
		}else{
			echo 0;
		}
	}
	
	public function loadUserDetail($data){
		$sql = <<<SQL
SELECT
user_id
, user_business_name
, user_full_name
, user_email
, user_phone
, user_address
, user_district_id
FROM user
WHERE user_delete_flg = 0
AND user_id = {$data['user_id']}
SQL;
		$select = $this -> db -> select($sql);
		echo json_encode($select);
	}
}