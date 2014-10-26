<?php

class SpaCMS_Calendar_Model {

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
		SELECT a.appointment_id, a.appointment_title,
			a.appointment_date, a.appointment_time_start, a.appointment_time_end,
			a.appointment_client_name 
		FROM appointment a
		WHERE a.appointment_user_id = {$user_id}
			AND a.appointment_date BETWEEN '{$start_date}' AND '{$end_date}'
SQL;
		$data = $this->db->select($aQuery);

		return $data;
	}


	public function get_bookings($user_id, $start_date, $end_date) {
		$aQuery = <<<SQL
		SELECT bd.booking_detail_id, c.client_name,
			bd.booking_detail_date, bd.booking_detail_time_start, bd.booking_detail_time_end,
			b.booking_status
		FROM booking b, booking_detail bd, client c
		WHERE bd.booking_detail_user_id = {$user_id}
			AND bd.booking_detail_date BETWEEN '{$start_date}' AND '{$end_date}'
			AND bd.booking_detail_booking_id = b.booking_id
			AND c.client_id = b.booking_client_id
SQL;
		$data = $this->db->select($aQuery);

		return $data;
	}

	///////////////////////////////////// 
	public function get_appointment() {
		$user_id = Session::get('user_id');
		$appointment_id = $_GET['data_id'];

		$aQuery = <<<SQL
		SELECT 
			a.appointment_id as 'data_id',
		 	a.appointment_date as 'data_date', 
			a.appointment_time_start as 'data_time_start', 
			a.appointment_time_end as 'data_time_end',
			'' as 'data_price',
			us.user_service_name as 'data_us_name', 
			us.user_service_duration as 'data_us_duration', 
			a.appointment_client_name as 'data_client_name',
			a.appointment_client_phone as 'data_client_phone', 
			a.appointment_client_gender as 'data_client_gender', 
			a.appointment_client_email as 'data_client_email', 
			a.appointment_client_birth as 'data_client_birth',
			us.user_service_full_price as 'data_us_full_price', 
			us.user_service_sale_price as 'data_us_sale_price',
			a.appointment_created as 'data_created'
		FROM appointment a, user_service us
		WHERE a.appointment_user_id = {$user_id}
			AND a.appointment_id = {$appointment_id}
			AND a.appointment_user_service_id = us.user_service_id
SQL;
		$data = $this->db->select($aQuery);

		echo json_encode($data);
	}


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
			us.user_service_full_price as 'data_us_full_price', 
			us.user_service_sale_price as 'data_us_sale_price',
			b.booking_date as 'data_created'
		FROM booking b, booking_detail bd, client c, user_service us
		WHERE bd.booking_detail_user_id = {$user_id}
			AND bd.booking_detail_id = {$booking_detail_id}
			AND bd.booking_detail_booking_id = b.booking_id
			AND us.user_service_id = bd.booking_detail_user_service_id
SQL;
		$data = $this->db->select($aQuery);

		echo json_encode($data);
	}

	public function get_client( $appointment_id ){
		
	}

	// Get detail user service
	public function get_user_service() {
		// $user_id = Session::get('user_id');
		$us_id = $_GET['user_service_id'];

		$aQuery = <<<SQL
		SELECT 
			user_service_id,
			user_service_name,
			user_service_duration
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

	function get_user_open_hour() {
		$user_id = Session::get('user_id');
		$query = "SELECT user_open_hour FROM user WHERE user_id = $user_id";
		$result = $this->db->select($query);
		echo $result[0]['user_open_hour'];
	}
	

}