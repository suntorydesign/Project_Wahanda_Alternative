<?php

class SpaCMS_Reports_Model {

	public function get_booking_detail() {
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


	public function update_booking_detail() {
		$user_id = Session::get('user_id');
		$data = array();
		foreach ($_POST as $key => $value) {
			if($key == "url") {
				continue;
			}
			$data["$key"] = $value;
		}

		$result = $this->db->update('booking_detail', $data, "booking_detail_id = $booking_detail_id");
		
	}


	public function get_client() {
		$user_id = Session::get('user_id');
		$client_id = $_GET['client_id'];
		$aQuery = <<<SQL
		SELECT client_name, client_phone, client_email, 
			client_sex, client_is_sendMail, client_birth, client_note
		FROM client
		WHERE client_id = {$client_id}
SQL;
		$data = $this->db->select($aQuery);
		echo json_encode($data);
	}

	public function update_client() {
		$user_id = Session::get('user_id');
		$data = array();
		foreach ($_POST as $key => $value) {
			if($key == "url") {
				continue;
			}
			$data["$key"] = $value;
		}

		$result = $this->db->update('client', $data, "client_id = $client_id");
	}


	public function get_sales_report() {
		$user_id = Session::get('user_id');
		$from 	= $_GET['from'];
		$to 	= $_GET['to'];

		// Result
		$data_sales_report = array();

		// Lọc hóa đơn theo thời gian
		$where 	= ' user_id = {$user_id} ';
		if($from == $to) {
			$where .= ' AND booking_detail.booking_detail_date = {$from} ';
		} else {
			$where .= ' AND booking_detail.booking_detail_date BETWEEN {$from} AND {$to} ';
		}

		// Total price and count for Summary
		// Câu query lấy tổng tất cả trong thời gian trên
		$aQuery_summary = <<<SQL
		SELECT SUM(booking_detail.booking_detail_price) as 'total_summary',
			COUNT(*) as 'count_summary'
		FROM booking_detail
		WHERE {$where}
SQL;
		$data_summary = $this->db->select($aQuery_summary);
	
		$data_sales_report['summary'] = array(
			'name' => 'summary',
			'total' => $data_summary['total_summary'],
			'count' => $data_summary['count_summary']
		);
		
		// Total price and count for By service group
		$aQuery_group_service = <<<SQL
		SELECT group_service.group_service_name, 
			SUM(booking_detail.booking_detail_price) as 'total_group_service',
			COUNT(*) as 'count_group_service'
		FROM group_service, user_service, booking_detail
		WHERE {$where}
			AND group_service.group_service_id = user_service.group_service_id
			AND user_service.user_service_id = booking_detail.user_service_id
		GROUP BY (group_service.group_service_id)
SQL;
		$data_group_service = $this->db->select($aQuery_group_service);

		foreach ($data_group_service as $key => $group) {
			$name = $group['group_service_name'];
			$total_group_service = $group['total_group_service'];
			$count_group_service = $group['count_group_service'];

			$data_sales_report['group_service'][] = array(
				'name' => $name,
				'total' => $total_group_service,
				'count' => $count_group_service
			);
		}


		// Total price and Count for Top service
		$aQuery_top_service = <<<SQL
		SELECT user_service.user_service_name, 
			SUM(booking_detail.booking_detail_price) as 'total_top_service',
			COUNT(*) as 'count_top_service'
		FROM user_service, booking_detail
		WHERE {$where}
			AND user_service.user_service_id = booking_detail.user_service_id
		GROUP BY (booking_detail.user_service_id)
SQL;
		$data_top_service = $this->db->select($aQuery_top_service);

		foreach ($data_top_service as $key => $service) {
			$name = $service['user_service_name'];
			$total_top_service = $service['total_top_service'];
			$count_top_service = $service['count_top_service'];

			$data_sales_report['top_service'][] = array(
				'name' => $name,
				'total' => $total_top_service,
				'count' => $count_top_service
			);
		}

		echo json_encode($data_sales_report);
	}


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
			bd.booking_detail_status
		FROM 
			booking b, booking_detail bd, client c, user_service us
		WHERE 
				bd.booking_detail_user_id = {$user_id}
			AND	bd.booking_detail_booking_id = b.booking_id
			AND b.booking_client_id = c.client_id
			AND bd.booking_detail_user_service_id = us.user_service_id
SQL;
		$data = $this->db->select($aQuery);

		echo json_encode($data);
	}

}