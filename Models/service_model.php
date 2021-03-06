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
,type_business.type_business_name
,user_open_hour
,user_long
,user_lat
,user_address
,user_phone
,user_email
,user_description
,user_logo
,user_slide
FROM user
, type_business
WHERE user.user_type_business_id = type_business.type_business_id
AND user_id = {$user_id}
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
AND user_service.user_service_is_featured = 1
AND user_service.user_service_delete_flg = 0
ORDER BY user_service.user_service_id DESC
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

AND service_type.service_type_id = {$value["service_type_id"]}
AND user_service.user_service_delete_flg = 0;
ORDER BY user_service.user_service_id DESC

SQL;
			$select_one = $this -> db -> select($sql);
			$return[$value['service_type_name']] = $select_one;
		}
		$sql = <<<SQL
SELECT 
user_service_use_evoucher
, COUNT(*) AS count_check
FROM user_service
INNER JOIN group_service ON group_service.group_service_id = user_service.user_service_group_id
INNER JOIN user ON user.user_id = group_service.group_service_user_id
WHERE user.user_id = {$user_id}
AND user_service.user_service_delete_flg = 0
GROUP BY user_service_use_evoucher
SQL;
		$select = $this -> db -> select($sql);
		$array_voucher = array('evoucher' => 0, 'appointment' => 0, 'gift_voucher' => 0);
		foreach ($select as $key => $value) {
			if ($key == 0 || $key == 2) {
				$array_voucher['appointment'] = 1;
			}
			if ($key == 1 || $key == 2) {
				$array_voucher['evoucher'] = 1;
			}
		}
		$sql = <<<SQL
SELECT user_is_use_gvoucher
FROM user
WHERE user_id = {$user_id}
SQL;
		$select = $this -> db -> select($sql);
		if ($select[0]['user_is_use_gvoucher'] == 1) {
			$array_voucher['gift_voucher'] = 1;
		}
		$return['array_voucher'] = $array_voucher;
		echo json_encode($return);
	}

	public function loadLocationStarRating($user_id) {
		$sql = <<<SQL
SELECT user_review_overall, COUNT(*) AS star_amount
FROM user_review
WHERE user_id = {$user_id}
GROUP BY user_review_overall
SQL;
		$select = $this -> db -> select($sql);
		$client_amount = 0;
		$star_point = 0;
		$result = array();
		$chart_info = array();
		$chart_info['one_star'] = 0;
		$chart_info['two_stars'] = 0;
		$chart_info['three_stars'] = 0;
		$chart_info['four_stars'] = 0;
		$chart_info['five_stars'] = 0;
		foreach ($select as $key => $value) {
			if ($value['user_review_overall'] == '1') {
				$chart_info['one_star'] = $value['star_amount'];
			}
			if ($value['user_review_overall'] == '2') {
				$chart_info['two_stars'] = $value['star_amount'];
			}
			if ($value['user_review_overall'] == '3') {
				$chart_info['three_stars'] = $value['star_amount'];
			}
			if ($value['user_review_overall'] == '4') {
				$chart_info['four_stars'] = $value['star_amount'];
			}
			if ($value['user_review_overall'] == '5') {
				$chart_info['five_stars'] = $value['star_amount'];
			}
		}
		foreach ($select as $key => $value) {
			$star_point = $star_point + $value['user_review_overall'] * $value['star_amount'];
			$client_amount = $client_amount + $value['star_amount'];
		}
		$star_review = $star_point / $client_amount;
		$result['star_review'] = round($star_review, 1);
		$result['client_amount'] = $client_amount;
		$chart_info['client_amount'] = $client_amount;
		$return['general_info'][] = $result;
		$return['chart_info'][] = $chart_info;

		$sql = <<<SQL
SELECT user_review_active, COUNT(*) AS star_amount
FROM user_review
WHERE user_id = {$user_id}
GROUP BY user_review_active
SQL;
		$select = $this -> db -> select($sql);
		$client_amount = 0;
		$star_point = 0;
		$data = array();
		foreach ($select as $key => $value) {
			$star_point = $star_point + $value['user_review_active'] * $value['star_amount'];
			$client_amount = $client_amount + $value['star_amount'];
		}
		$star_review = $star_point / $client_amount;
		$data['star_review'] = round($star_review, 1);
		$data['review_name'] = 'Sự nhiệt tình';
		//$result['client_amount'] = $client_amount;
		$return['data'][] = $data;
		$sql = <<<SQL
SELECT user_review_clean, COUNT(*) AS star_amount
FROM user_review
WHERE user_id = {$user_id}
GROUP BY user_review_clean
SQL;
		$select = $this -> db -> select($sql);
		$client_amount = 0;
		$star_point = 0;
		foreach ($select as $key => $value) {
			$star_point = $star_point + $value['user_review_clean'] * $value['star_amount'];
			$client_amount = $client_amount + $value['star_amount'];
		}
		$star_review = $star_point / $client_amount;
		$data['star_review'] = round($star_review, 1);
		$data['review_name'] = 'Vệ sinh';
		//$result['client_amount'] = $client_amount;
		$return['data'][] = $data;
		$sql = <<<SQL
SELECT user_review_quality, COUNT(*) AS star_amount
FROM user_review
WHERE user_id = {$user_id}
GROUP BY user_review_quality
SQL;
		$select = $this -> db -> select($sql);
		$client_amount = 0;
		$star_point = 0;
		foreach ($select as $key => $value) {
			$star_point = $star_point + $value['user_review_quality'] * $value['star_amount'];
			$client_amount = $client_amount + $value['star_amount'];
		}
		$star_review = $star_point / $client_amount;
		$data['star_review'] = round($star_review, 1);
		$data['review_name'] = 'Chất lượng';
		//$result['client_amount'] = $client_amount;
		$return['data'][] = $data;
		$sql = <<<SQL
SELECT user_review_staff, COUNT(*) AS star_amount
FROM user_review
WHERE user_id = {$user_id}
GROUP BY user_review_staff
SQL;
		$select = $this -> db -> select($sql);
		$client_amount = 0;
		$star_point = 0;
		foreach ($select as $key => $value) {
			$star_point = $star_point + $value['user_review_staff'] * $value['star_amount'];
			$client_amount = $client_amount + $value['star_amount'];
		}
		$star_review = $star_point / $client_amount;
		$data['star_review'] = round($star_review, 1);
		$data['review_name'] = 'Nhân viên';
		$return['data'][] = $data;
		$sql = <<<SQL
SELECT user_review_valuable, COUNT(*) AS star_amount
FROM user_review
WHERE user_id = {$user_id}
GROUP BY user_review_valuable
SQL;
		$select = $this -> db -> select($sql);
		$client_amount = 0;
		$star_point = 0;
		foreach ($select as $key => $value) {
			$star_point = $star_point + $value['user_review_valuable'] * $value['star_amount'];
			$client_amount = $client_amount + $value['star_amount'];
		}
		$star_review = $star_point / $client_amount;
		$data['star_review'] = round($star_review, 1);
		$data['review_name'] = 'Giá trị';
		$return['data'][] = $data;
		echo json_encode($return);
	}

	public function loadServiceStarRating($user_id) {
		$sql = <<<SQL
SELECT user_service_id
, user_service_name
FROM user_service, user, group_service
WHERE user.user_id = group_service.group_service_user_id
AND user_service.user_service_group_id = group_service.group_service_id
AND user.user_id = {$user_id}
AND user_service.user_service_delete_flg = 0
ORDER BY user_service_id DESC
SQL;
		$select = $this -> db -> select($sql);
		$return = array();
		foreach ($select as $key => $value) {
			$client_amount = 0;
			$star_point = 0;
			$sql = <<<SQL
SELECT user_service.user_service_name
, service_type.service_type_name
, user_service.user_service_id
, IF(user_service_review.user_service_review_value IS NULL, 0, user_service_review.user_service_review_value) AS user_service_review_value
, COUNT(*) AS star_amount
FROM user_service
INNER JOIN group_service ON user_service.user_service_group_id = group_service.group_service_id
INNER JOIN user ON user.user_id = group_service.group_service_user_id
INNER JOIN service ON user_service.user_service_service_id = service.service_id
INNER JOIN service_type ON service.service_service_type_id = service_type.service_type_id
LEFT JOIN user_service_review ON user_service_review.user_service_id = user_service.user_service_id
WHERE user.user_id = {$user_id}
AND user_service.user_service_id = {$value['user_service_id']}
GROUP BY user_service.user_service_name
, service_type.service_type_name
, user_service_review.user_service_id
, user_service_review.user_service_review_value
SQL;
			$select = $this -> db -> select($sql);
			foreach ($select as $key => $item) {
				$star_point = $star_point + $item['user_service_review_value'] * $item['star_amount'];
				$client_amount = $client_amount + $item['star_amount'];
			}
			$data['user_service_name'] = $value['user_service_name'];
			if ($client_amount == 0) {
				$data['star_review'] = 0;
			} else {
				$star_review = $star_point / $client_amount;

				$data['star_review'] = round($star_review, 1);
			}
			$data['service_type_name'] = $select[0]['service_type_name'];
			$return['data'][] = $data;
		}
		$group_data = array();
		foreach ($return['data'] as $key => $value) {
			$temp = $value['service_type_name'];
			$j = 0;
			foreach ($return['data'] as $i => $item) {
				if ($temp == $item['service_type_name']) {
					$group_data[$temp][$j]['user_service_name'] = $item['user_service_name'];
					$group_data[$temp][$j]['star_review'] = $item['star_review'];
					$j++;
				}
			}
		}
		//print_r($group_data);
		$return['group_data'][] = $group_data;
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
SELECT IF(user_review.user_review_content IS NULL, '', user_review.user_review_content) AS user_review_content
, IF(user_review.user_review_overall IS NULL, 0, user_review.user_review_overall) AS user_review_overall
, IF(user_review.user_review_active IS NULL, 0, user_review.user_review_active) AS user_review_active
, IF(user_review.user_review_clean IS NULL, 0, user_review.user_review_clean) AS user_review_clean
, IF(user_review.user_review_quality IS NULL, 0, user_review.user_review_quality) AS user_review_quality
, IF(user_review.user_review_staff IS NULL, 0, user_review.user_review_staff) AS user_review_staff
, IF(user_review.user_review_valuable IS NULL, 0, user_review.user_review_valuable) AS user_review_valuable
FROM client
LEFT JOIN(
    SELECT *
    FROM user_review
    WHERE user_review.user_id = {$data["user_id"]}
	AND user_review.client_id = {$data["client_id"]}
)user_review ON user_review.client_id = client.client_id
WHERE client.client_id = {$data["client_id"]}
SQL;
		$select = $this -> db -> select($sql);
		$return['user_review'] = $select;
		$sql = <<<SQL
SELECT *
FROM review
SQL;
		$select = $this -> db -> select($sql);
		$return['review_type'] = $select;
		$sql = <<<SQL
SELECT user_service.user_service_id
,group_service.group_service_user_id AS user_id
,user_service.user_service_name
,IF(user_service_review.user_service_review_value IS NULL,0,user_service_review.user_service_review_value) AS user_service_review_value
FROM user_service
INNER JOIN(
    SELECT group_service_id
    ,group_service_user_id
    FROM group_service
    WHERE group_service_delete_flg = 0
)group_service ON user_service.user_service_group_id = group_service.group_service_id
INNER JOIN(
	SELECT user_id
    FROM user
    WHERE user_delete_flg = 0
)user ON user.user_id = group_service.group_service_user_id
LEFT JOIN(
    SELECT *
    FROM user_service_review
    WHERE client_id = {$data["client_id"]}
)user_service_review ON user_service_review.user_service_id = user_service.user_service_id
WHERE user.user_id = {$data["user_id"]}
AND user_service.user_service_delete_flg = 0
ORDER BY user_service.user_service_id DESC
SQL;
		$select = $this -> db -> select($sql);
		$return['user_service_review'] = $select;
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

	public function sendServiceRating($data) {
		$sql = <<<SQL
SELECT COUNT(*) AS check_review
FROM user_service_review
WHERE user_service_id = {$data["user_service_id"]}
AND client_id = {$data["client_id"]}
SQL;
		$select = $this -> db -> select($sql);
		if ($select[0]['check_review'] == 0) {
			$sql = <<<SQL
INSERT INTO user_service_review 
SET user_service_id = {$data["user_service_id"]},
client_id = {$data["client_id"]},
user_service_review_value = {$data["user_service_review_value"]}
SQL;
			$insert = $this -> db -> prepare($sql);
			$insert -> execute();
			if ($insert -> rowCount() > 0) {
				echo 200;
			} else {
				echo -1;
			}
		} else {
			$where = 'WHERE user_service_id = ' . $data['user_service_id'] . ' AND client_id = ' . $data['client_id'];
			$sql = <<<SQL
UPDATE user_service_review 
SET 
user_service_review_value = {$data["user_service_review_value"]}
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

	public function get_user_slide($user_id) {
		$aQuery = <<<SQL
SELECT user_slide
FROM user
WHERE user_id = {$user_id}
SQL;

		$data = $this -> db -> select($aQuery);
		echo json_encode($data[0]);
	}

	public function loadFirstConsultingQuestion($user_id) {
		$sql = <<<SQL
SELECT DISTINCT 
user_business_name
, service_type_id
, service_type_name
FROM service_type,
service,
user_service,
group_service,
user
WHERE
service_type.service_type_id = service.service_service_type_id
AND service.service_id = user_service.user_service_service_id
AND user_service.user_service_group_id = group_service.group_service_id
AND user.user_id = group_service.group_service_user_id
AND user.user_id = {$user_id}
AND user_delete_flg = 0
AND user_service_delete_flg = 0
SQL;
		$select = $this -> db -> select($sql);
		echo json_encode($select);
	}

	public function loadConsultingQuestion($data) {
		$sql = <<<SQL
SELECT question_id
, question_content
FROM question
WHERE question_service_type_id = {$data['question_service_type_id']}
AND question_delete_flg = 0
SQL;
		$select = $this -> db -> select($sql);
		$select_array = array();
		$index = 0;
		foreach ($select as $key => $value) {
			$index++;
			$sql = <<<SQL
SELECT *
FROM fact
WHERE fact_question_id = {$value['question_id']}
AND fact_delete_flg = 0
SQL;
			$select_fact = $this -> db -> select($sql);
			$select_array[$index . ') ' . $value['question_content']] = $select_fact;
		}
		echo json_encode($select_array);
	}

	public function consulting($data) {
		SESSION::initIdle();
		$rule_temp = '';
		if (isset($_SESSION['rule_group'])) {
			$rule_temp = $_SESSION['rule_group'];
			if ($rule_temp == '') {
				$rule_temp = $data['fact_id'];
			} else {
				$rule_temp .= ',' . $data['fact_id'];
			}
		}
		$sql = <<<SQL
SELECT COUNT(*) AS check_rule
FROM rule
WHERE rule_group = '{$rule_temp}'
AND rule_delete_flg = 0
SQL;
		$select_rule_result = $this -> db -> select($sql);
		if ($select_rule_result[0]['check_rule'] == 1) {
			$sql = <<<SQL
SELECT rule_result
, rule_service_id
FROM rule
WHERE rule_group = '{$rule_temp}'
AND rule_delete_flg = 0
SQL;
			$result = $this -> db -> select($sql);
			$result[0]['rule_group'] = $rule_temp;
			echo json_encode($result);
		} else if ($select_rule_result[0]['check_rule'] == 0) {
			$sql = <<<SQL
SELECT COUNT(*) AS check_rule
FROM rule
WHERE rule_group LIKE '%{$rule_temp}%'
AND rule_delete_flg = 0
SQL;
			$select_rule = $this -> db -> select($sql);
			if ($select_rule[0]['check_rule'] > 0) {
				if ($_SESSION['rule_group'] == '') {
					$_SESSION['rule_group'] = $data['fact_id'];
				} else {
					$_SESSION['rule_group'] .= ',' . $data['fact_id'];
				}
			}
			echo '[]';
		}
	}

	public function loadAdviseService($data) {
		$sql = <<<SQL
SELECT user.user_id
,user_service.user_service_id
,user_service.user_service_name
,user_service.user_service_full_price
,user_service.user_service_sale_price
,user_service.user_service_duration
FROM service
, user_service
, group_service
, user
WHERE user.user_id = group_service.group_service_user_id
AND user_service.user_service_group_id = group_service.group_service_id
AND user_service.user_service_service_id = service.service_id
AND user.user_id = {$data['user_id']}
AND service.service_id = {$data['service_id']}
AND service.service_delete_flg = 0
AND user_service.user_service_delete_flg = 0
AND group_service.group_service_delete_flg = 0
AND user.user_delete_flg = 0
SQL;
		$select = $this -> db -> select($sql);
		echo json_encode($select);
	}

}
?>