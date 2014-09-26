<?php
/**
 *
 */
class service_model extends Model {

	function __construct() {
		parent::__construct();
	}

	public function loadLocationDetail($user_id) {
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
user.user_id
,user_service.user_service_id
,user_service.user_service_name
,user_service.user_service_full_price
,user_service.user_service_sale_price
,user_service.user_service_duration
FROM user_service, user, group_service
WHERE user.user_id = group_service.group_service_user_id
AND user_service.user_service_group_id = group_service.group_service_id
AND user.user_id = {$user_id}
AND user_service.user_service_highlight = 1
ORDER BY user_service.user_service_id DESC
LIMIT 5
SQL;
		$select = $this -> db -> select($query);
		$return['user_service'] = $select;
		$query = <<<SQL
SELECT service_type_id, service_type_name
FROM service_type
SQL;
		$select = $this -> db -> select($query);
		foreach ($select as $key => $value) {
			$sql = <<<SQL
SELECT 
user.user_id
,user_service.user_service_id
,user_service.user_service_name
,user_service.user_service_full_price
,user_service.user_service_sale_price
,user_service.user_service_duration
FROM user_service, user, group_service, service, service_type
WHERE user.user_id = group_service.group_service_user_id
AND user_service.user_service_group_id = group_service.group_service_id
AND user_service.user_service_service_id = service.service_id
AND service.service_service_type_id = service_type.service_type_id
AND user.user_id = {$user_id}
AND user_service.user_service_highlight = 0
AND service_type.service_type_id = {$value["service_type_id"]}
ORDER BY user_service.user_service_id DESC
LIMIT 5
SQL;
			$select_one = $this -> db -> select($sql);
			$return[$value['service_type_name']] = $select_one;
		}
		echo json_encode($return);
	}

	public function loadReview($data) {
		$sql = <<<SQL
SELECT user_review_content
,user_review_time
,user_review_date
,client.client_username
,client.client_join_date
FROM user_review, client
WHERE user_review.client_id = client.client_id 
AND user_id = {$data["user_id"]}
SQL;
		$select = $this -> db -> select($sql);
		echo json_encode($select);
	}

	public function loadPersonReview($data) {
		$sql = <<<SQL
SELECT user_review_content
FROM user_review
WHERE user_id = {$data["user_id"]}
AND client_id = {$data["client_id"]}
SQL;
		$select = $this -> db -> select($sql);
		echo json_encode($select);
	}

	public function sendReview($data) {
		$sql = <<<SQL
SELECT COUNT(*) AS check_review
FROM user_review
WHERE user_id = {$data["user_id"]}
AND client_id = {$data["client_id"]}
SQL;
		$select = $this -> db -> select($sql);
		if ($select[0]['check_review'] == 0) {
			$sql = <<<SQL
INSERT INTO user_review 
VALUES(
?
,?
,?
,?
,?
,?
,?
,?
,CURRENT_TIME
,CURRENT_DATE)
SQL;
			$insert_array = array();
			foreach ($data as $key => $value) {
				$insert_array[] = $value;
			}
			// echo "$sql";
			// print_r($insert_array);
			// exit;
			$insert = $this -> db -> prepare($sql);
			$insert -> execute($insert_array);
			if ($insert) {
				echo 200;
			} else {
				echo -1;
			}
		} else {
			$where = 'WHERE user_id = ' . $data['user_id'] . ' AND client_id = ' . $data['client_id'];
			$sql = <<<SQL
UPDATE user_review 
SET 
`user_review_content`=?
,`user_review_active`=?
,`user_review_clean`=?
,`user_review_quality`=?
,`user_review_staff`=?
,`user_review_valuable`=?
,`user_review_time` = CURRENT_TIME
,`user_review_date` = CURRENT_DATE
{$where}
SQL;
			$update_array = array();
			unset($data['user_id']);
			unset($data['client_id']);
			foreach ($data as $key => $value) {
				$update_array[] = $value;
			}
			// echo "$sql";
			// print_r($update_array);
			// exit;
			$update = $this -> db -> prepare($sql);
			$update -> execute($update_array);
			if ($update) {
				echo 200;
			} else {
				echo -1;
			}
		}
	}

}
?>