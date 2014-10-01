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
		$result = ($data['review_result']) * RESULT_PER_SHOW_MORE;
		$result_per_show = RESULT_PER_SHOW_MORE;
		$sql = <<<SQL
SELECT COUNT(*) AS number_result
FROM user_review
WHERE user_id = {$data["user_id"]}
AND user_review_status = 1
SQL;
		$select = $this -> db -> select($sql);
		$return['number_result'] = $select[0]['number_result'];
		$sql = <<<SQL
SELECT user_review_content
,user_review_time
,user_review_date
,CURRENT_DATE as review_current_date
,client.client_username
,client.client_join_date
FROM user_review, client
WHERE user_review.client_id = client.client_id 
AND user_id = {$data["user_id"]}
AND user_review_status = 1
ORDER BY user_review_date DESC
LIMIT {$result},{$result_per_show}
SQL;
		$select = $this -> db -> select($sql);
		$return['data'] = $select;
		echo json_encode($return);
	}

	public function loadPersonReview($data) {
		$sql = <<<SQL
SELECT user_review_content
, user_review_overall
, user_review_active
, user_review_clean
, user_review_quality
, user_review_staff
, user_review_valuable
FROM user_review
WHERE user_id = {$data["user_id"]}
AND client_id = {$data["client_id"]}
SQL;
		$select = $this -> db -> select($sql);
		$return['user_review'] = $select;
		$sql = <<<SQL
SELECT *
FROM review
SQL;
		$select = $this -> db -> select($sql);
		$return['review_type'] = $select;
		echo json_encode($return);
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
,?
,CURRENT_TIME
,CURRENT_DATE
,0)
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
`user_review_content` = '{$data["user_review_content"]}'
,`user_review_status` = 0
{$where}
SQL;
			$update = $this -> db -> prepare($sql);
			$update -> execute();
			if ($update) {
				echo 200;
			} else {
				echo -1;
			}
		}
	}

	public function sendRating($data) {
		$sql = <<<SQL
SELECT COUNT(*) AS check_review
FROM user_review
WHERE user_id = {$data["user_id"]}
AND client_id = {$data["client_id"]}
SQL;
		$select = $this -> db -> select($sql);
		if ($select[0]['check_review'] == 0) {
			$field = $data['field'];
			$sql = <<<SQL
INSERT INTO user_review 
SET user_id = {$data["user_id"]},
client_id = {$data["client_id"]},
user_review_content = '',
$field = {$data[$data['field']]},
user_review_date = CURRENT_DATE,
user_review_time = CURRENT_TIME
SQL;
			$insert = $this -> db -> prepare($sql);
			$insert -> execute();
			if ($insert -> rowCount() > 0) {
				echo 200;
			} else {
				echo -1;
			}
		} else {
			$field = $data['field'];
			$where = 'WHERE user_id = ' . $data['user_id'] . ' AND client_id = ' . $data['client_id'];
			$sql = <<<SQL
UPDATE user_review 
SET 
$field = {$data[$data['field']]}
{$where}
SQL;
			$update = $this -> db -> prepare($sql);
			$update -> execute();
			if ($update -> rowCount() > 0) {
				echo 200;
			} else {
				echo -1;
			}
		}
	}

}
?>