<?php

class SpaCMS_Calendar_Model {

	/**
	 * Get lịch hẹn (appointment & booking_detail) từ ngày start -> end
	 * @param user_id
	 * @param $_GET['start'] : 
	 * @param $_GET['end'] : Ngày kết thúc
	 * @return json
	 */
	public function get_calendar() {
		$user_id 	= Session::get('user_id');
		$start_date = $_GET['start'];
		$end_date 	= $_GET['end'];

		$appointments 	= self::get_appointments($user_id, $start_date, $end_date);
		$bookings 		= self::get_bookings($user_id, $start_date, $end_date);

		$data = array();
		foreach ($appointments as $a) {
			$start 	= $a['appointment_date'] . 'T' . $a['appointment_time_start'];
			$end 	= $a['appointment_date'] . 'T' . $a['appointment_time_end'];

			$data[] = array(
				'a_id' 		=> $a['appointment_id'],
				'title' 	=> $a['appointment_title'],
				'start' 	=> $start,
				'end' 		=> $end,
				'className' => 'e-appointment'
			);
		}

		foreach ($bookings as $b) {
			$start 	= $b['booking_detail_date'] . 'T' . $b['booking_detail_time_start'];
			$end 	= $b['booking_detail_date'] . 'T' . $b['booking_detail_time_end'];

			$data[] = array(
				'b_id' 		=> $b['booking_detail_id'],
				'title' 	=> $b['client_name'],
				'start' 	=> $start,
				'end' 		=> $end,
				'className' => 'e-booking'
			);
		}

		echo json_encode($data); 
	}

	public function get_appointments($user_id, $start_date, $end_date) {
		$aQuery = <<<SQL
		SELECT 
			a.appointment_id, 
			a.appointment_title,
			a.appointment_date, 
			a.appointment_time_start, 
			a.appointment_time_end,
			a.appointment_client_name 
		FROM appointment a
		WHERE 
				a.appointment_user_id = {$user_id}
			AND a.appointment_date BETWEEN '{$start_date}' AND '{$end_date}'
SQL;
		$data = $this->db->select($aQuery);

		return $data;
	}

	public function get_bookings($user_id, $start_date, $end_date) {
		$aQuery = <<<SQL
		SELECT 
			bd.booking_detail_id, 
			c.client_name,
			bd.booking_detail_date, 
			bd.booking_detail_time_start, 
			bd.booking_detail_time_end,
			b.booking_status
		FROM 
			booking b, 
			booking_detail bd, 
			client c
		WHERE 
				bd.booking_detail_user_id = {$user_id}
			AND bd.booking_detail_date BETWEEN '{$start_date}' AND '{$end_date}'
			AND bd.booking_detail_booking_id = b.booking_id
			AND c.client_id = b.booking_client_id
SQL;
		$data = $this->db->select($aQuery);

		return $data;
	}

	/**
	 * Thông tin chi tiết lịch hẹn (appointment)
	 * @param user_id
	 * @param $_GET['data_id'] : appointment_id
	 * @return json
	 */
	public function get_appointment() {
		$user_id = Session::get('user_id');
		$appointment_id = $_GET['data_id'];

		$aQuery = <<<SQL
		SELECT 
			a.appointment_id as 'data_id',
		 	a.appointment_date as 'data_date', 
			a.appointment_time_start as 'data_time_start', 
			a.appointment_time_end as 'data_time_end',
			a.appointment_price as 'data_price',
			us.user_service_name as 'data_us_name', 
			us.user_service_duration as 'data_us_duration', 
			a.appointment_client_name as 'data_client_name',
			a.appointment_client_phone as 'data_client_phone', 
			a.appointment_client_gender as 'data_client_gender', 
			a.appointment_client_email as 'data_client_email', 
			a.appointment_client_birth as 'data_client_birth',
			a.appointment_client_note as 'data_client_note',
			a.appointment_status as 'data_status',
			us.user_service_full_price as 'data_us_full_price', 
			us.user_service_sale_price as 'data_us_sale_price',
			a.appointment_created as 'data_created',
			a.appointment_updated as 'data_update'
		FROM 
			appointment a, 
			user_service us
		WHERE 
				a.appointment_user_id = {$user_id}
			AND a.appointment_id = {$appointment_id}
			AND a.appointment_user_service_id = us.user_service_id
SQL;
		$data = $this->db->select($aQuery);

		echo json_encode($data);
	}

	/**
	 * Thông tin chi tiết lịch hẹn (booking_detail)
	 * @param user_id
	 * @param $_GET['data_id'] : booking_detail_id
	 * @return json
	 */
	public function get_booking() {
		$user_id = Session::get('user_id');
		$booking_detail_id = $_GET['data_id'];

		$aQuery = <<<SQL
		SELECT 
			bd.booking_detail_id as 'data_id', 
			bd.booking_detail_date as 'data_date', 
			bd.booking_detail_time_start as 'data_time_start', 
			bd.booking_detail_time_end as 'data_time_end',
			bd.booking_detail_price as 'data_price', 
			us.user_service_name as 'data_us_name', 
			us.user_service_duration as 'data_us_duration', 
			c.client_name as 'data_client_name', 
			c.client_phone as 'data_client_phone',
			c.client_sex as 'data_client_gender', 
			c.client_email as 'data_client_email', 
			c.client_birth as 'data_client_birth',
			c.client_note as 'data_client_note',
			b.booking_status as 'data_status',
			us.user_service_full_price as 'data_us_full_price', 
			us.user_service_sale_price as 'data_us_sale_price',
			b.booking_date as 'data_created'
			-- b.booking_updated as 'data_updated'
		FROM 
			booking b, 
			booking_detail bd, 
			client c, 
			user_service us
		WHERE 
				bd.booking_detail_user_id = {$user_id}
			AND bd.booking_detail_id = {$booking_detail_id}
			AND bd.booking_detail_booking_id = b.booking_id
			AND us.user_service_id = bd.booking_detail_user_service_id
SQL;
		$data = $this->db->select($aQuery);

		echo json_encode($data);
	}

	public function get_client( $appointment_id ){
		
	}

	/**
	 * Lấy thông tin dịch vụ (user_service)
	 * @param $_GET['user_service_id'] : id của dịch vụ đó
	 * @return json
	 */
	public function get_user_service() {
		// $user_id = Session::get('user_id');
		$us_id = $_GET['user_service_id'];

		$aQuery = <<<SQL
		SELECT 
			user_service_id,
			user_service_name,
			user_service_duration,
			user_service_sale_price,
			user_service_full_price
		FROM user_service
		WHERE user_service_id = {$us_id}
SQL;

		$data = $this->db->select($aQuery);
		echo json_encode($data);
	}

// 	public function max_slot_each_service($user_id) {
// 		$aQuery = <<<SQL
// 		SELECT user_serv
// SQL;
// 	}

	/**
	 * Thêm lịch hẹn (appointment)
	 * @return String success/error
	 */
	public function insert_appointment() {
		$user_id = Session::get('user_id');

		$data = array();
		$data["appointment_user_id"] = $user_id;
		$data["appointment_title"] = $_POST["appointment_client_name"];

		foreach ($_POST as $key => $value) {
			if($key == "url") {
				continue;
			}
			if($key == "user_service_service_id"){
				$data["appointment_user_service_id"] = $value ;
				continue;
			}
			$data["$key"] = $value;
		}

		if( $this->db->insert('appointment', $data) ){
			echo 'success';
		} else {
			echo 'error';
		}
	}

	/**
	 * Danh sách giờ mở cửa của địa điểm spa
	 * @param Session::get('user_id') : user_id 
	 * @return json
	 */
	function get_user_open_hour() {
		$user_id = Session::get('user_id');
		$query = "SELECT user_open_hour FROM user WHERE user_id = $user_id";
		$result = $this->db->select($query);
		echo $result[0]['user_open_hour']; // Its json
	}
	
	/**
	 * Danh sách những lịch hẹn đã được đặt từ appointment & booking_detail
	 * @param $_GET['us_id'] : user_service_id dịch vụ được đặt
	 * @param $_GET['date']	 : ngày đặt hẹn
	 * @return json
	 */
	function get_appointment_confirmed() {
		$user_id = Session::get('user_id');
		$us_id 	= $_GET['us_id']; // user_service_id
		$date 	= $_GET['date']; // ngày đặt hẹn

		// Lấy danh sách lịch hẹn từ appointment
		$aQuery_app = <<<SQL
		SELECT 
			appointment_date,
			appointment_time_start,
			appointment_time_end
		FROM
			appointment
		WHERE 
				appointment_user_id = {$user_id}
			AND appointment_user_service_id = {$us_id}
			AND appointment_date = '{$date}'
SQL;
		$data_app = $this->db->select($aQuery_app);

		// Lấy danh sách lịch hẹn từ booking_detail
		$aQuery_bkdetail = <<<SQL
		SELECT
			booking_detail_date,
			booking_detail_time_start,
			booking_detail_time_end
		FROM
			booking_detail
		WHERE
				booking_detail_user_id = {$user_id}
			AND booking_detail_user_service_id = {$us_id}
			AND booking_detail_date = '{$date}'
SQL;
		$data_bkdetail = $this->db->select($aQuery_bkdetail);

		// Chèn dữ liệu vào mảng data_schedule 
		$data_schedule = array();
		foreach ($data_app as $app) {
			$data_schedule[] = array(
				"schedule_date"			=> $app["appointment_date"],
				"schedule_time_start"	=> $app["appointment_time_start"],
				"schedule_time_end"		=> $app["appointment_time_end"]
			);
		}

		foreach ($data_bkdetail as $bkdetail) {
			$data_schedule[] = array(
				"schedule_date"			=> $bkdetail["booking_detail_date"],
				"schedule_time_start"	=> $bkdetail["booking_detail_time_start"],
				"schedule_time_end"		=> $bkdetail["booking_detail_time_end"]
			);
		}

		// Xuất dữ liệu
		echo json_encode($data_schedule);
	}


	/**
	 * Hủy một lịch hẹn
	 * @param $_POST['data_id'] : id lịch hẹn
	 * @param $_POST['data_type'] : lịch hẹn là appointment hay booking_detail
	 * @return success/error
	 */
	public function delete_appointment() {
		$user_id = Session::get('user_id');
		$data_id = $_POST['data_id'];
		$data_type = $_POST['data_type'];

		if($data_type == "appointment") {
			$rs = $this->db->delete("appointment", "appointment_id = $data_id");
		}

		if($data_type == "booking_detail") {
			$rs = $this->db->delete("booking_detail", "booking_detail_id = $data_id");	
		}

		if($rs) {
			echo "success";
		} else {
			echo "error";
		}

	}


	/**
	 * Lấy thông tin một lịch hẹn nhằm để sửa lịch hẹn đó
	 * @param $_POST['data_id'] : id lịch hẹn
	 * @param $_POST['data_type'] : lịch hẹn là appointment hay booking_detail
	 * @return json
	 */
	public function get_appointment_for_edit() {
		
	}

	/**
	 * Update trạng thái hoàn thành lịch hẹn
	 * @param $_POST['data_id'] : id lịch hẹn
	 * @param $_POST['data_type'] : lịch hẹn là appointment hay booking_detail
	 * @return success/error
	 */
	public function update_appointment_status() {
		$user_id = Session::get('user_id');
		$data_id = $_POST['data_id'];
		$data_type = $_POST['data_type'];

		// Trạng thái hoàn thành
		$data = array(
			"appointment_status" => 1
		);
		// foreach ($_POST as $key => $value) {
		// 	if($key == "url") {
		// 		continue;
		// 	}
		// 	$data["$key"] = $value;
		// }

		if($data_type == "appointment") {
			$rs = $this->db->update("appointment", $data, "appointment_id = $data_id");
		}

		if($data_type == "booking_detail") {
			$rs = $this->db->update("booking_detail", $data, "booking_detail_id = $data_id");	
		}

		if($rs) {
			echo "success";
		} else {
			echo "error";
		}
	}

}