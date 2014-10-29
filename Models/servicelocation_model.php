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
		$page = ($data['page'] - 1) * MAX_PAGINATION_ITEM;
		$item_per_page = MAX_PAGINATION_ITEM;
		$return = array();
		$service_name = explode(' ', $data["service_name"]);
		$where = 'WHERE (';
		foreach ($service_name as $key => $value) {
			$where .= "service.service_name LIKE '%{$value}%' OR ";
		}
		foreach ($service_name as $i => $item) {
			$where .= "user_service.user_service_name LIKE '%{$value}%' OR ";
		}
		foreach ($service_name as $i => $item) {
			$where .= "user.user_business_name LIKE '%{$value}%' OR ";
		}
		$where = substr($where, 0, strlen($where) - 4);
		$where .= ')';
		// if($data['service_name'] == ''){
			// $where = "WHERE (service.service_name LIKE '%{$data["service_name"]}%'";
			// $where .= "OR user_service.user_service_name LIKE '%{$data["service_name"]}%')";
		// }else{
			// $where = "WHERE (MATCH (service.service_name) AGAINST ('{$data["service_name"]}')";
			// $where .= "OR MATCH (user_service.user_service_name) AGAINST ('{$data["service_name"]}'))";
		// }
		$order = '';
		if($data['sort_by'] == '1'){
			$order = 'ORDER BY user.user_id DESC';
		}else if($data['sort_by'] == '2'){
			$order = 'ORDER BY star_amount DESC';
		}else if($data['sort_by'] == '3'){
			$order = 'ORDER BY user_service.user_service_sale_price ASC';
		}else if($data['sort_by'] == '4'){
			$order = 'ORDER BY user_service.user_service_sale_price DESC';
		}
		$sql = <<<SQL
SELECT COUNT(DISTINCT user.user_id) AS total_row
FROM user
INNER JOIN group_service ON user.user_id = group_service.group_service_user_id
INNER JOIN user_service ON user_service.user_service_group_id = group_service.group_service_id
INNER JOIN service ON user_service.user_service_service_id = service.service_id
LEFT JOIN 
(SELECT user_review.user_id
, COUNT(*) AS star_amount
FROM user, user_review
WHERE user.user_id = user_review.user_id
GROUP BY user_review.user_id) user_review ON user_review.user_id = user.user_id
{$where}
AND user.user_district_id LIKE '%{$data["district_id"]}%'
AND user.user_delete_flg = 0
AND user_service.user_service_delete_flg = 0
SQL;
		$select = $this -> db -> select($sql);
		$return['total_row'] = $select[0]['total_row'];
		$sql = <<<SQL
SELECT DISTINCT
user.user_id
,user.user_business_name
,user.user_address
,user.user_description
,user.user_logo
,IF(user_review.star_amount IS NULL,0,user_review.star_amount) AS star_amount
FROM user
INNER JOIN group_service ON user.user_id = group_service.group_service_user_id
INNER JOIN user_service ON user_service.user_service_group_id = group_service.group_service_id
INNER JOIN service ON user_service.user_service_service_id = service.service_id
LEFT JOIN 
(SELECT user_review.user_id
, COUNT(*) AS star_amount
FROM user, user_review
WHERE user.user_id = user_review.user_id
GROUP BY user_review.user_id) user_review ON user_review.user_id = user.user_id
{$where}
AND user.user_district_id LIKE '%{$data["district_id"]}%'
AND user.user_delete_flg = 0
AND user_service.user_service_delete_flg = 0
{$order}
LIMIT {$page}, {$item_per_page}
SQL;
		$select = $this -> db -> select($sql);
		$array = array();
		foreach ($select as $key => $value) {
			$sql = <<<SQL
SELECT user_review_overall, COUNT(*) AS star_amount
FROM user_review
WHERE user_id = {$value['user_id']}
AND user_review.user_review_status = 1
GROUP BY user_review_overall
SQL;
			$select = $this -> db -> select($sql);
			$client_amount = 0;
			$star_point = 0;
			foreach ($select as $i => $item) {
				$star_point = $star_point + $item['user_review_overall'] * $item['star_amount'];
				$client_amount = $client_amount + $item['star_amount'];
			}
			$star_review = $star_point / $client_amount;
			$array[$key]['star_review'] = round($star_review, 1);
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
FROM user
INNER JOIN group_service ON user.user_id = group_service.group_service_user_id
INNER JOIN user_service ON user_service.user_service_group_id = group_service.group_service_id
INNER JOIN service ON user_service.user_service_service_id = service.service_id
LEFT JOIN 
(SELECT user_review.user_id
, COUNT(*) AS star_amount
FROM user, user_review
WHERE user.user_id = user_review.user_id
GROUP BY user_review.user_id) user_review ON user_review.user_id = user.user_id
{$where}
AND user.user_id = {$value["user_id"]}
AND user.user_district_id LIKE '%{$data["district_id"]}%'
AND user.user_delete_flg = 0
AND user_service.user_service_delete_flg = 0
{$order}
SQL;
			$select_service = $this -> db -> select($query);
			$array[$key]['user_service'] = $select_service;
			
		}
		$return['data'] = $array;
		echo json_encode($return);
	}

	public function loadAdvantageSearch($data){
		$return = array();
		$service_name = explode(' ', $data["service_name"]);
		$where = 'WHERE (';
		foreach ($service_name as $key => $value) {
			$where .= "service.service_name LIKE '%{$value}%' OR ";
		}
		foreach ($service_name as $i => $item) {
			$where .= "user_service.user_service_name LIKE '%{$value}%' OR ";
		}
		foreach ($service_name as $i => $item) {
			$where .= "user.user_business_name LIKE '%{$value}%' OR ";
		}
		$where = substr($where, 0, strlen($where) - 4);
		$where .= ')';
		// if($data['service_name'] == ''){
			// $where = "WHERE (service.service_name LIKE '%{$data["service_name"]}%'";
			// $where .= "OR user_service.user_service_name LIKE '%{$data["service_name"]}%')";
		// }else{
			// $where = "WHERE (MATCH (service.service_name) AGAINST ('{$data["service_name"]}')";
			// $where .= "OR MATCH (user_service.user_service_name) AGAINST ('{$data["service_name"]}'))";
		// }
		$sql = <<<SQL
SELECT service_type.service_type_id
, service_type.service_type_name
, COUNT(*) AS amount
FROM service_type
INNER JOIN service ON service.service_service_type_id = service_type.service_type_id
INNER JOIN user_service ON user_service.user_service_service_id = service.service_id
INNER JOIN group_service ON group_service.group_service_id = user_service.user_service_group_id
INNER JOIN user ON user.user_id = group_service.group_service_user_id
{$where}
AND user.user_district_id LIKE '%{$data["district_id"]}%'
AND user.user_delete_flg = 0
AND user_service.user_service_delete_flg = 0
GROUP BY service_type.service_type_id
SQL;
		$select = $this -> db -> select($sql);
		$return['service_type'] = $select;
		$sql = <<<SQL
SELECT service.service_id
, service.service_name
, COUNT(*) AS amount
FROM service_type
INNER JOIN service ON service.service_service_type_id = service_type.service_type_id
INNER JOIN user_service ON user_service.user_service_service_id = service.service_id
INNER JOIN group_service ON group_service.group_service_id = user_service.user_service_group_id
INNER JOIN user ON user.user_id = group_service.group_service_user_id
{$where}
AND user.user_district_id LIKE '%{$data["district_id"]}%'
AND user.user_delete_flg = 0
AND user_service.user_service_delete_flg = 0
GROUP BY service.service_id
SQL;
		$select = $this -> db -> select($sql);
		$return['service'] = $select;
		$sql = <<<SQL
SELECT user_service_use_evoucher,
COUNT(*) AS user_evoucher
FROM user_service
WHERE user_service_delete_flg = 0
GROUP BY user_service_use_evoucher
SQL;
		$select = $this -> db -> select($sql);
		$return['evoucher'] = $select;
		echo json_encode($return);
	}

}
?>