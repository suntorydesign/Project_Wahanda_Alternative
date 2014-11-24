<?php
/**
 *
 */
class index_model extends Model {

	function __construct() {
		parent::__construct();
	}

	public function loadDistrict() {
		$sql = <<<SQL
SELECT *
FROM district
ORDER BY district_name ASC
SQL;
		$select = $this -> db -> select($sql);
		if ($select) {
			echo json_encode($select);
		} else {
			echo '[]';
		}
	}

	function loadTopServiceList() {
		$sql = <<<SQL
SELECT user_service.user_service_id
, user_service.user_service_name
, user_service.user_service_full_price
, user_service.user_service_sale_price
, user_service.user_service_image
, user_service.user_service_description
, IF(top.star_amount IS NULL,0,top.star_amount) AS star_amount
FROM user_service
LEFT JOIN
(SELECT user_service.user_service_id
, COUNT(*) AS star_amount
FROM user_service, user_service_review
WHERE user_service.user_service_id = user_service_review.user_service_id
AND (user_service_review_value = 3 
     OR user_service_review_value = 4 
     OR user_service_review_value = 5)
GROUP BY user_service_review.user_service_id) top 
ON top.user_service_id = user_service.user_service_id
WHERE user_service.user_service_delete_flg = 0
ORDER BY star_amount DESC
LIMIT 0,3
SQL;
		$select = $this -> db -> select($sql);
		foreach ($select as $key => $value) {
			$client_amount = 0;
			$star_point = 0;
			$sql = <<<SQL
SELECT user_service.user_service_name
, service_type.service_type_name
, user_service_review.user_service_id
, user_service_review.user_service_review_value
, COUNT(*) AS star_amount
FROM user_service, user_service_review, service, service_type
WHERE user_service_review.user_service_id = user_service.user_service_id
AND user_service.user_service_service_id = service.service_id
AND service.service_service_type_id = service_type.service_type_id
AND user_service.user_service_id = {$value['user_service_id']}
GROUP BY user_service.user_service_name
, service_type.service_type_name
, user_service_review.user_service_id
, user_service_review.user_service_review_value
SQL;
			$select_detail = $this -> db -> select($sql);

			foreach ($select_detail as $i => $item) {
				$star_point = $star_point + $item['user_service_review_value'] * $item['star_amount'];
				$client_amount = $client_amount + $item['star_amount'];
			}
			$star_review = $star_point / $client_amount;
			$select[$key]['star_review'] = round($star_review, 1);
			$select[$key]['total_client_amount'] = $client_amount;
		}
		if ($select) {
			echo json_encode($select);
		} else {
			echo '[]';
		}
	}

	function loadNewServiceList() {
		$sql = <<<SQL
SELECT user_service.user_service_id
, user_service.user_service_name
, user_service.user_service_full_price
, user_service.user_service_sale_price
, user_service.user_service_image
, user_service.user_service_description
FROM `user_service` 
WHERE `user_service_delete_flg` = 0
order by `user_service_id` desc 
limit 8
SQL;
		$select = $this -> db -> select($sql);
		foreach ($select as $key => $value) {
			$client_amount = 0;
			$star_point = 0;
			$sql = <<<SQL
SELECT user_service.user_service_name
, service_type.service_type_name
, user_service_review.user_service_id
, user_service_review.user_service_review_value
, COUNT(*) AS star_amount
FROM user_service, user_service_review, service, service_type
WHERE user_service_review.user_service_id = user_service.user_service_id
AND user_service.user_service_service_id = service.service_id
AND service.service_service_type_id = service_type.service_type_id
AND user_service.user_service_id = {$value['user_service_id']}
GROUP BY user_service.user_service_name
, service_type.service_type_name
, user_service_review.user_service_id
, user_service_review.user_service_review_value
SQL;
			$select_detail = $this -> db -> select($sql);

			foreach ($select_detail as $i => $item) {
				$star_point = $star_point + $item['user_service_review_value'] * $item['star_amount'];
				$client_amount = $client_amount + $item['star_amount'];
			}
			if ($client_amount == 0) {
				$select[$key]['star_review'] = 0;
				$select[$key]['total_client_amount'] = 0;
			} else {
				$star_review = $star_point / $client_amount;
				$select[$key]['star_review'] = round($star_review, 1);
				$select[$key]['total_client_amount'] = $client_amount;
			}
		}
		if ($select) {
			echo json_encode($select);
		} else {
			echo '[]';
		}
	}

	function loadLocation() {
		$select = $this -> db -> select('SELECT DISTINCT 
										   user.user_id, 
										   user.user_business_name, 
										   user.user_logo, 
										   user.user_description 
										   FROM user_service, user, group_service
										   WHERE user.user_id = group_service.group_service_user_id
										   AND user_service.user_service_group_id = group_service.group_service_id
										   AND user.user_delete_flg = 0 order by user.user_id desc
										   limit 8');
		if ($select) {
			echo json_encode($select);
		} else {
			echo '[]';
		}
	}

	function loadServiceDetail($user_service_id = 1) {
		$hour = date('H');
		$min = date('i');
		$evoucher_due_date = EVOUCHER_DUE_DATE;
		$query = <<<SQL
SELECT 
user_service.`user_service_id`,
user_service.`user_service_name`,
user_service.`user_service_duration`,
user_service.`user_service_full_price`,
user_service.`user_service_sale_price`,
user_service.`user_service_status`,
user_service.`user_service_image`,
user_service.`user_service_description`,
user_service.`user_service_use_evoucher`,
user_service.`user_service_group_id`,
user_service.`user_service_service_id`,
user.`user_id`,
user.`user_logo`,
user.`user_business_name`,
user.`user_description`,
user.`user_open_hour`,
user.`user_long`,
user.`user_lat`,
user.`user_address`,
user.`user_phone`,
user.`user_notification_email`,
user.`user_limit_before_service`,
user.`user_limit_before_booking`,
user_service.`user_service_limit_booking` AS user_limit_booking,
group_service.`group_service_name`,
DAYOFWEEK(CURRENT_DATE) AS day_of_week,
DAYOFMONTH(CURRENT_DATE) AS day_of_month,
YEAR(CURRENT_DATE) AS year,
MONTH(CURRENT_DATE) AS month,
{$hour} as hour,
{$min} as minute,
DATE_ADD(CURRENT_DATE, INTERVAL {$evoucher_due_date} MONTH) as evoucher_due_date
FROM user_service,user,group_service
WHERE user.user_id = group_service.group_service_user_id
AND user_service.user_service_group_id = group_service.group_service_id
AND`user_service_delete_flg` = 0 AND `user_service_id`= {$user_service_id}
AND group_service_delete_flg = 0 AND user_delete_flg = 0
SQL;

		$select = $this -> db -> select($query);
		if ($select) {
			echo json_encode($select);
		} else {
			echo '[]';
		}
	}
	
	public function sendCreatePlaceMail($data){
		$sql = <<<SQL
INSERT INTO user(
user_full_name
, user_email
, user_business_name
, user_address
, user_phone
, user_district_id
)
VALUES(
'{$data['user_full_name']}'
, '{$data['user_email']}'
, '{$data['user_business_name']}'
, '{$data['user_address']}'
, '{$data['user_phone']}'
, '{$data['user_district_id']}'
)
SQL;
		$insert = $this -> db -> prepare($sql);
		$insert -> execute();
		if ($insert -> rowCount() > 0) {
			echo 200;
		}else{
			echo 0;
		}
	}
	public function checkSpaEmailExist($email) {
		$sql = <<<SQL
SELECT COUNT(*) AS check_email
FROM user
WHERE user_email = '{$email}'
SQL;
		$select = $this -> db -> select($sql);
		return $select[0]['check_email'];
	}
	
	public function checkBookingLimit($data) {
		$sql = <<<SQL
SELECT
IF(SUM(booking_detail_quantity) IS NULL, 0, SUM(booking_detail_quantity)) AS check_booking
FROM booking_detail
WHERE booking_detail_user_service_id = {$data['user_service_id']}
AND booking_detail_date = '{$data['choosen_date']}'
AND booking_detail_time_start = '{$data['choosen_time']}'
SQL;
		$select = $this -> db -> select($sql);
		if($select[0]['check_booking'] >= $data['user_limit_booking']){
			echo 0;
		}else{
			echo 200;
		}
	}

}
?>