<?php

class SpaCMS_Home_Model {

	public function get_redeem_voucher() {
		$user_id = Session::get('user_id');
		$e_voucher_id = $_POST['e_voucher_id'];

		$aQuery = <<<SQL
		SELECT 
			e_voucher_booking_id, 
			e_voucher_due_date, 
			e_voucher_quantity
		FROM e_voucher
		WHERE e_voucher_user_id = {$user_id}
			AND e_voucher_id = {$e_voucher_id}
SQL;
		$data = $this->db->select($aQuery);

		echo json_encode($data);
	}

}