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


	public function get_monthly_sales() {
		$user_id = Session::get('user_id');
		$aQuery = <<<SQL
		SELECT 
			COUNT(*) as total_count,
			SUM(booking_detail_price) as total_value
		FROM 
			booking_detail
		WHERE 
				booking_detail_user_id = {$user_id}
			AND ( booking_detail_date BETWEEN '2014-09-09' AND '2015-12-09' )
SQL;
		$data = $this->db->select($aQuery);

		echo json_encode($data[0]);
	}
}