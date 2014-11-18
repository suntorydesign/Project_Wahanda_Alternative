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

		$aQuery = <<<SQL
		SELECT 
			COUNT(*) as total_count,
			SUM(booking_detail_price) as total_value
		FROM 
			booking_detail
		WHERE 
				booking_detail_user_id = {$user_id}
			AND ( booking_detail_date BETWEEN '{$this_month_from}' AND '{$this_month_to}' )
SQL;
		$data = $this->db->select($aQuery);

		echo json_encode($data[0]);
	}

	/**
	 * Danh sách dịch vụ tốt nhất tháng này và kèm theo thông tin booking của tháng trước đó (tính theo lượt booking)
	 * @param $user_id
	 * @return success/error
	 */
	public function get_top_services() {
		$user_id = Session::get('user_id');
		$this_month_from = $_GET['this_month_from'];
		$this_month_to = $_GET['this_month_to'];

		$pre_month_from = $_GET['pre_month_from'];
		$pre_month_to = $_GET['pre_month_to'];

		$aQuery = <<<SQL
		SELECT 
			us.user_service_id,
			us.user_service_name,
			COUNT(*) as total_count_this_month,
			COUNT(A.*) as total_count_pre_month
		FROM 
			booking_detail bd, user_service us,
			(SELECT
				*
			FROM 

			WHERE 
				
			) A
		WHERE 
				bd.booking_detail_user_id = {$user_id}
			AND bd.booking_detail_user_service_id = us.user_service_id
			AND ( bd.booking_detail_date BETWEEN '{$this_month_from}' AND '{$this_month_to}' )
			-- AND ( bd.booking_detail_date BETWEEN '{$pre_month_from}' AND '{$pre_month_to}' )
		GROUP BY ( us.user_service_id )
		ORDER BY ( total_count_this_month ) DESC
		LIMIT 10
SQL;
		$data = $this->db->select($aQuery);

		echo json_encode($data);
	}

	public function get_top_services_pre_month() {

	}
}