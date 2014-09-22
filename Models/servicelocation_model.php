<?php
/**
 *
 */
class servicelocation_model extends Model {

	function __construct() {
		parent::__construct();
	}

	public function searchLocation() {

	}

	public function loadResultSearch($data) {
		$return = array();
		$sql = <<<SQL
SELECT DISTINCT
user.user_id
,user.user_business_name
,user.user_address
,user.user_description
,user.user_logo
FROM user, user_service, group_service, service
WHERE user.user_id = group_service.group_service_user_id
AND user_service.user_service_group_id = group_service.group_service_id
AND user_service.user_service_service_id = service.service_id
AND service_name LIKE '%{$data["service_name"]}%'
ORDER BY user.user_id DESC
SQL;
		$select = $this -> db -> select($sql);
		$array = array();
		$total_row = 0;
		foreach ($select as $key => $value) {
			$total_row++;
			$array[$key]['user_id'] = $value['user_id'];
			$array[$key]['user_business_name'] = $value['user_business_name'];
			$array[$key]['user_address'] = $value['user_address'];
			$array[$key]['user_description'] = $value['user_description'];
			$array[$key]['user_logo'] = $value['user_logo'];
			$query = <<<SQL
SELECT
user_service.user_service_id
,user_service.user_service_name
,user_service.user_service_duration
,user_service.user_service_full_price
,user_service.user_service_sale_price
FROM user_service, group_service, user
WHERE user.user_id = group_service.group_service_user_id
AND user_service.user_service_group_id = group_service.group_service_id
AND user.user_id = {$value["user_id"]}
ORDER BY user_service.user_service_id DESC
SQL;
			$select_service = $this -> db -> select($query);
			$array[$key]['user_service'] = $select_service;
			
		}
		$return['total_row'] = $total_row;
		$return['data'] = $array;
		echo json_encode($return);
	}

}
?>