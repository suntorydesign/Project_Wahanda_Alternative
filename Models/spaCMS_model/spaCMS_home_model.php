<?php

class SpaCMS_Home_Model {
	/**
	 * Tìm mã evoucher
	 * @param $_POST['e_voucher_id'] : mã của evoucher đó
	 * @return json
	 */
	public function get_redeem_voucher() {
		$user_id = Session::get('user_id');
		$e_voucher_id = $_POST['e_voucher_id'];

		$aQuery = <<<SQL
		SELECT 
			e.e_voucher_id,
			e.e_voucher_due_date, 
			e.e_voucher_status,
			e.e_voucher_price,
			c.client_id,
			c.client_name,
			c.client_phone,
			b.booking_id,
			u.user_service_id,
			u.user_service_name
		FROM 
			e_voucher e, 
			booking b, 
			client c,
			user_service u
		WHERE 
				e.e_voucher_user_id = {$user_id}
			AND e.e_voucher_id = '{$e_voucher_id}'
			AND e.e_voucher_booking_id = b.booking_id
			AND b.booking_client_id = c.client_id
			AND e.e_voucher_user_service_id = u.user_service_id
SQL;
		$data = $this->db->select($aQuery);

		echo json_encode($data);
	}

	/**
	 * Xác nhận dùng evoucher này
	 * @param $_POST['data_id'] : mã của evoucher đó
	 * @return success/errorr
	 */
	public function update_e_voucher() {
		$user_id = Session::get('user_id');
		$data_id = $_POST['data_id'];
		$data = array(
			"e_voucher_status" => 1
		);

		if( $this->db->update('e_voucher', $data, "e_voucher_id = '$data_id'") ){
			echo 'success';
		} else {
			echo 'error';
		}
	}

	/**
	 * Doanh số booking trong tháng
	 * @param $user_id
	 * @return success/error
	 */
	public function get_monthly_sales() {
		$user_id = Session::get('user_id');
		$this_month_from = $_GET['this_month_from'];
		$this_month_to = $_GET['this_month_to'];

		$aQuery_booking = <<<SQL
		SELECT 
			COUNT(*) as total_booking_count,
			SUM(booking_detail_price) as total_booking_value
		FROM 
			booking b
				RIGHT JOIN booking_detail bd ON bd.booking_detail_booking_id = b.booking_id
			
		WHERE 
				bd.booking_detail_user_id = {$user_id}
			AND ( b.booking_date BETWEEN '{$this_month_from}' AND '{$this_month_to}' )
SQL;
		$data_booking = $this->db->select($aQuery_booking);

		$aQuery_evoucher = <<<SQL
		SELECT 
			COUNT(*) as total_evoucher_count,
			SUM(e_voucher_price) as total_evoucher_value
		FROM 
			booking b 
				RIGHT JOIN e_voucher e ON e.e_voucher_booking_id = b.booking_id
		
		WHERE 
				e.e_voucher_user_id = {$user_id}
			AND ( b.booking_date BETWEEN '{$this_month_from}' AND '{$this_month_to}' )
SQL;
		$data_evoucher = $this->db->select($aQuery_evoucher);

		$data = array(
			"total_booking_count" => $data_booking[0]["total_booking_count"],
			"total_booking_value" => $data_booking[0]["total_booking_value"],
			"total_evoucher_count" => $data_evoucher[0]["total_evoucher_count"],
			"total_evoucher_value" => $data_evoucher[0]["total_evoucher_value"]
		);

		echo json_encode($data);
	}

	/**
	 * Danh sách dịch vụ tốt nhất tháng này và kèm theo thông tin booking của tháng trước đó (tính theo lượt booking)
	 * @param $user_id
	 * @return success/error
	 */
	// /////////////// TOP SERVICE THEO THÁNG NÀY - THÁNG TRƯỚC /////////////////////
// 	public function get_top_services() {
// 		$user_id = Session::get('user_id');
// 		$this_month_from = $_GET['this_month_from'];
// 		$this_month_to = $_GET['this_month_to'];

// 		$pre_month_from = $_GET['pre_month_from'];
// 		$pre_month_to = $_GET['pre_month_to'];

// 		$aQuery = <<<SQL
// 		SELECT 
// 			us.user_service_id,
// 			us.user_service_name,
// 			COUNT(*) as total_count_this_month,
// 		FROM 
// 			booking_detail bd, user_service us,
// 			(
// 				SELECT
// 					us.user_service_id, 
// 					COUNT(*) as total_count_pre_month
// 				FROM 
// 					booking_detail bd, user_service us
// 				WHERE 
// 						bd.booking_detail_user_id = {$user_id}
// 					AND bd.booking_detail_user_service_id = us.user_service_id
// 					AND ( bd.booking_detail_date BETWEEN '{$pre_month_from}' AND '{$pre_month_to}' )
// 				GROUP BY ( us.user_service_id )
// 				ORDER BY ( total_count_this_month ) DESC
// 			) A
// 		WHERE 
// 				bd.booking_detail_user_id = {$user_id}
// 			AND bd.booking_detail_user_service_id = us.user_service_id
// 			AND ( bd.booking_detail_date BETWEEN '{$this_month_from}' AND '{$this_month_to}' )
// 			-- AND ( bd.booking_detail_date BETWEEN '{$pre_month_from}' AND '{$pre_month_to}' )
// 		GROUP BY ( us.user_service_id )
// 		ORDER BY ( total_count_this_month ) DESC
// 		LIMIT 10
// SQL;
// 		$data = $this->db->select($aQuery);

// 		echo json_encode($data);
// 	}

	public function get_top_services_booking() {
		$user_id = Session::get('user_id');

		$aQuery = <<<SQL
		SELECT 
			us.user_service_id,
			us.user_service_name,
			COUNT(*) as total_book
		FROM 
			booking_detail bd, 
			user_service us
		WHERE 
				bd.booking_detail_user_id = {$user_id}
			AND bd.booking_detail_user_service_id = us.user_service_id
		GROUP BY ( us.user_service_id )
		ORDER BY ( total_book ) DESC
		LIMIT 10
SQL;
		$data = $this->db->select($aQuery);

		echo json_encode($data);
	}

	public function get_top_services_evoucher () {
		$user_id = Session::get('user_id');

		$aQuery = <<<SQL
		SELECT 
			us.user_service_id,
			us.user_service_name,
			COUNT(*) as total_evoucher
		FROM 
			e_voucher e, 
			user_service us
		WHERE 
				e.e_voucher_user_id = {$user_id}
			AND e.e_voucher_user_service_id = us.user_service_id
		GROUP BY ( us.user_service_id )
		ORDER BY ( total_evoucher ) DESC
		LIMIT 10
SQL;
		$data = $this->db->select($aQuery);

		echo json_encode($data);
	}

	public function get_top_services_pre_month() {

	}

	public function get_appointment_not_confirm() {
		$user_id = Session::get('user_id');
		// Thời gian hiện tại
		$today = date("Y-m-d");
		// $today = "2014-10-27";

		$appointments 	= self::get_appointments_not_confirm($user_id, $today);
		$bookings 		= self::get_bookings_not_confirm($user_id, $today);

		$data = array();
		foreach ($appointments as $a) {
			$data[] = array(
				'data_us_name' 		=> $a['data_us_name'],
				'data_client_name' 	=> $a['data_client_name'],
				'data_date' 		=> $a['data_date'],
				'data_time_start' 	=> $a['data_time_start'],
				'data_type' 		=> 'a'
			);
		}

		foreach ($bookings as $b) {
			$data[] = array(
				'data_us_name' 		=> $b['data_us_name'],
				'data_client_name' 	=> $b['data_client_name'],
				'data_date' 		=> $b['data_date'],
				'data_time_start' 	=> $b['data_time_start'],
				'data_type' 		=> 'b'
			);
		}

		echo json_encode($data);
	}

	public function get_appointments_not_confirm($user_id, $today) {
		$aQuery = <<<SQL
		SELECT 
			us.user_service_name as data_us_name,
			a.appointment_client_name as data_client_name,
			a.appointment_date as data_date,
			a.appointment_time_start as data_time_start
		FROM 
			appointment a, user_service us
		WHERE 
				a.appointment_user_id = {$user_id}
			AND a.appointment_user_service_id = us.user_service_id
			AND a.appointment_date >= '{$today}'
			AND a.appointment_is_confirm = 0
			AND ( a.appointment_status = 0 OR a.appointment_status = 1 )
SQL;
		$data = $this->db->select($aQuery);

		return $data;
	}

	public function get_bookings_not_confirm($user_id, $today) {
		$aQuery = <<<SQL
		SELECT 
			us.user_service_name as data_us_name,
			c.client_name as data_client_name,
			bd.booking_detail_date as data_date,
			bd.booking_detail_time_start as data_time_start
		FROM 
			booking b,
			booking_detail bd, 
			user_service us,
			client c
		WHERE 
				bd.booking_detail_user_id = {$user_id}
			AND bd.booking_detail_user_service_id = us.user_service_id
			AND bd.booking_detail_booking_id = b.booking_id
			AND b.booking_client_id = c.client_id
			AND bd.booking_detail_date >= '{$today}'
			AND bd.booking_detail_is_confirm = 0
			AND ( bd.booking_detail_status = 0 OR bd.booking_detail_status = 1 )
SQL;
		$data = $this->db->select($aQuery);

		return $data;
	}
}