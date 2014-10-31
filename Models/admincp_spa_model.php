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
}