<?php
/**
 * 
 */
class service_model extends Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function loadLocationDetail($user_id)
	{
		$return = array();
		$query = <<<SQL
SELECT 
user_business_name
,user_open_hour
,user_long
,user_lat
,user_address
,user_phone
,user_email
,user_description
FROM user
WHERE user_id = {$user_id}
AND user_delete_flg = 0
SQL;
		$select = $this -> db -> select($query);
		$return['user'] = $select;
		$query = <<<SQL
SELECT 
user_service.user_service_name
,user_service.user_service_full_price
,user_service.user_service_sale_price
,user_service.user_service_duration
FROM user_service, user, group_service
WHERE user.user_id = group_service.group_service_user_id
AND user_service.user_service_group_id = group_service.group_service_id
AND user.user_id = {$user_id}
SQL;
		$select = $this -> db -> select($query);
		$return['user_service'] = $select;
		echo json_encode($return);
	}
}

?>