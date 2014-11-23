<?php

class SpaCMS_Reports_Model {
	/**
	 * Báo cáo danh sách booking_detail
	 * @param user_id
	 * @return json
	 */
	public function get_booking_report() {
		$user_id = Session::get('user_id');

		$aQuery = <<<SQL
		SELECT 
			b.booking_id,
			bd.booking_detail_id,
			c.client_name,
			us.user_service_name,
			b.booking_date,
			bd.booking_detail_price,
			bd.booking_detail_is_confirm,
			bd.booking_detail_status
		FROM 
			booking b, 
			booking_detail bd, 
			client c, 
			user_service us
		WHERE 
				bd.booking_detail_user_id = {$user_id}
			-- AND bd.booking_detail_is_confirm = 1 -- đã được xác thực
			AND	bd.booking_detail_booking_id = b.booking_id
			AND b.booking_client_id = c.client_id
			AND bd.booking_detail_user_service_id = us.user_service_id
SQL;
		$data = $this->db->select($aQuery);

		echo json_encode($data);
	}

	/**
	 * Báo cáo danh sách evoucher
	 * @param user_id
	 * @return json
	 */
	public function get_evoucher_report() {
		$user_id = Session::get('user_id');
		
		$aQuery = <<<SQL
		SELECT 
			b.booking_id,
			-- e.booking_detail_id,
			c.client_name,
			us.user_service_name,
			b.booking_date,
			e.e_voucher_price,
			e.e_voucher_due_date,
			e.e_voucher_status
		FROM 
			booking b, 
			e_voucher e, 
			client c, 
			user_service us
		WHERE 
				e.e_voucher_user_id = {$user_id}
			AND	e.e_voucher_booking_id = b.booking_id
			AND b.booking_client_id = c.client_id
			AND e.e_voucher_user_service_id = us.user_service_id
SQL;
		$data = $this->db->select($aQuery);



		echo json_encode($data);
	}


	/**
	 * Báo cáo doanh thu từ ngày <from> cho đến ngày <to>
	 * @param user_id
	 * @param $_GET['from'] 
	 * @param $_GET['to'] 
	 * @return json
	 */
	public function get_sale_report() {
		$user_id = Session::get('user_id');
		$from 	= $_GET['from'];
		$to 	= $_GET['to'];
		$limit 	= 5;

		// Result
		$data_sales_report = array();
		
		// Tổng doanh thu
		$data_totalSale = self::get_total_sale($user_id, $from, $to);
		$data_sales_report['totalSale'] = array(
			'name' => 'totalSale',
			'value' => number_format($data_totalSale['totalSale_value']),
			'count' => $data_totalSale['totalSale_count']
		);

		// Doanh thu của Nhóm dịch vụ tốt nhất
		$data_groupServiceSale = self::get_group_service_sale($user_id, $from, $to, $limit);
		foreach ($data_groupServiceSale as $key => $group_service) {
			$data_sales_report['groupServiceSale'][] = array(
				'name' => $group_service['group_service_name'],
				'value' => number_format($group_service['groupServiceSale_value']),
				'count' => $group_service['groupServiceSale_count']
			);
		}

		// Doanh thu của dịch vụ tốt nhất
		$data_topServiceSale = self::get_top_service_sale($user_id, $from, $to, $limit);
		foreach ($data_topServiceSale as $key => $service) {
			$data_sales_report['topServiceSale'][] = array(
				'name' => $service['user_service_name'],
				'value' => number_format($service['topServiceSale_value']),
				'count' => $service['topServiceSale_count']
			);
		}

		
		echo json_encode($data_sales_report);		
	}

	// Tổng doanh thu
	public function get_total_sale($user_id, $from, $to) {
		$aQuery_bookings = <<<SQL
		SELECT 
			SUM(bd.booking_detail_price) as totalSale_value,
			COUNT(*) as totalSale_count
		FROM 
			booking b,
			booking_detail bd
		WHERE 
				bd.booking_detail_user_id = {$user_id}
			AND bd.booking_detail_booking_id = b.booking_id
			AND ( b.booking_date BETWEEN '{$from}' AND '{$to}' )
			-- AND booking_detail_status = 1
SQL;
		$data_booking = $this->db->select($aQuery_bookings);

		$aQuery_evoucher = <<<SQL
		SELECT 
			SUM(e.e_voucher_price) as totalSale_value,
			COUNT(*) as totalSale_count
		FROM 
			booking b,
			e_voucher e
		WHERE 
				e.e_voucher_user_id = {$user_id}
			AND e.e_voucher_booking_id = b.booking_id
			AND ( b.booking_date BETWEEN '{$from}' AND '{$to}' )
			-- AND booking_detail_status = 1
SQL;
		$data_evoucher = $this->db->select($aQuery_evoucher);
		
		$data = array(
			"totalSale_value" => ($data_booking[0]["totalSale_value"] + $data_evoucher[0]["totalSale_value"]),
			"totalSale_count" => ($data_booking[0]["totalSale_count"] + $data_evoucher[0]["totalSale_count"])
		);

		return $data;
	}

	// Doanh thu của những Nhóm dịch vụ tốt nhất
	public function get_group_service_sale( $user_id, $from, $to, $limit = 1 ) {
		$aQuery = <<<SQL
		SELECT 
			gs.group_service_name, 
			SUM(bd.booking_detail_price) as groupServiceSale_value,
			COUNT(*) as groupServiceSale_count
		FROM 
			group_service gs, 
			user_service us, 
			booking_detail bd
		WHERE 
				bd.booking_detail_user_id = {$user_id}
			AND ( bd.booking_detail_date BETWEEN '{$from}' AND '{$to}' )
			AND bd.booking_detail_status = 1
			AND gs.group_service_id = us.user_service_group_id
			AND us.user_service_id = bd.booking_detail_user_service_id
		GROUP BY (gs.group_service_id)
		ORDER BY (groupServiceSale_value) DESC
		LIMIT {$limit}
SQL;
		$data = $this->db->select($aQuery);

		return $data;
	}

	// Doanh thu của những dịch vụ tốt nhất
	public function get_top_service_sale( $user_id, $from, $to, $limit = 1) {
		$aQuery = <<<SQL
		SELECT 
			us.user_service_name, 
			SUM(bd.booking_detail_price) as topServiceSale_value,
			COUNT(*) as topServiceSale_count
		FROM 
			user_service us, 
			booking_detail bd
		WHERE 
				bd.booking_detail_user_id = {$user_id}
			AND ( bd.booking_detail_date BETWEEN '{$from}' AND '{$to}' )
			AND bd.booking_detail_status = 1
			AND us.user_service_id = bd.booking_detail_user_service_id
		GROUP BY (bd.booking_detail_user_service_id)
		ORDER BY (topServiceSale_value) DESC
		LIMIT {$limit}
SQL;
		$data = $this->db->select($aQuery);

		return $data;
	}






	////////// SERVICE SIDE /////////

	public function get_booking_detail_xxxxx() {
		$user_id = Session::get('user_id');

		// $where = '';

		// $arrColumn = array(
  //           '0' => array('type' => 'number', 'col_nm' => 'virtTable.booking_detail_id'),
  //           '1' => array('type' => 'string', 'col_nm' => 'virtTable.booking_date_from'),
  //           '2' => array('type' => 'date', 'col_nm' => 'virtTable.client_name'),
  //           '3' => array('type' => 'date', 'col_nm' => 'virtTable.user_sevice_name'),
  //           '4' => array('type' => 'string', 'col_nm' => 'virtTable.booking_detail_price'),
  //           '5' => array('type' => 'string', 'col_nm' => 'virtTable.booking_detail_status')
  //       );

		// Search columns
		// $column_search = array();
		// if(isset($_GET['sAction']) && $_GET['sAction'] == 'filter'){
		// 	$column_search = array(
		// 		'booking_detail_id' 		=> $_GET['booking_detail_id'],
		// 		'booking_date_from' 		=> $_GET['booking_date_from'],
		// 		'booking_date_to' 			=> $_GET['booking_date_to'],
		// 		'booking_client_name' 		=> $_GET['booking_client_name'],
		// 		'booking_sevice_name' 		=> $_GET['booking_sevice_name'],
		// 		'booking_detail_price_from' => $_GET['booking_detail_price_from'],
		// 		'booking_detail_price_to' 	=> $_GET['booking_detail_price_to'],
		// 		'booking_detail_status' 	=> $_GET['booking_detail_status']
		// 	);

		// 	foreach ($column_search as $key => $value) {
		// 		if($value != '') {
		// 			$where .= " AND $key = ";
		// 		}
		// 	}

		// 	$where = '';
		// }

// 		// 

// 		$aQuery = <<<SQL
// 		SELECT us.user_service_name, bd.booking_detail_id, b.booking_date, 
// 			c.client_name, bd.booking_detail_price, b.booking_status
// 		FROM user_service as us, booking_detail as bd, booking as b, client as c
// 		WHERE bd.booking_detail_user_id = {$user_id} 
// 			AND bd.booking_detail_user_service_id = us.user_service_id
// 			AND bd.booking_detail_booking_id = b.booking_id
// 			AND b.booking_client_id = c.client_id
// SQL;

// 		$data = $this->db->select($aQuery);
		// echo json_encode($data);
		
		$data = array();
		for ($i=0; $i < 100; $i++) { 
			$data[] = array(
				'booking_detail_id' => $i,
				'booking_date' => '12/12/2014',
				'client_name' => 'Jonh Xon',
				'user_service_name' => 'Dịch vụ ABC',
				'booking_detail_price' => (40 + $i) . '.000 VND',
				'booking_status' => 'Deleted'
			);
		}

		$iTotalRecords = count($data);
		$iDisplayLength = intval($_REQUEST['iDisplayLength']);
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
		$iDisplayStart = intval($_REQUEST['iDisplayStart']);
		$sEcho = intval($_REQUEST['sEcho']);

		// Pagination
		$start 	= $iDisplayStart;
		$end 	= $iDisplayStart + $iDisplayLength;
		$end 	= $end > $iTotalRecords ? $iTotalRecords : $end;

		// Output
		$aOutput = array();
		$aOutput["aaData"] = array(); 

		$status = array(
			"Completed" => "primary",
			"Deleted" 	=> "danger",
			"Confirmed" => "warning"
		);
		

		for($i = $start; $i < $end; $i++) {
			$aOutput["aaData"][] = array(
			  	$data[$i]['booking_detail_id'],
				$data[$i]['booking_date'],
				$data[$i]['client_name'],
				$data[$i]['user_service_name'],
				$data[$i]['booking_detail_price'],
				'<span class="label label-sm label-'.$status[$data[$i]['booking_status']].'">'.$data[$i]["booking_status"].'</span>',
				'<a href="javascript:;" data-toggle="modal" data-target="#confirmedAppointment_modal" class="btn btn-xs default"><i class="fa fa-search"></i> Xem chi tiết</a>'
			);
		}

		$aOutput["sEcho"] = $sEcho;
		$aOutput["iTotalRecords"] = $iTotalRecords;
		$aOutput["iTotalDisplayRecords"] = $iTotalRecords;

		echo json_encode($aOutput);
	}



}