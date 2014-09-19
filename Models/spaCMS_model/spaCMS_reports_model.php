<?php

class SpaCMS_Reports_Model {

	public function get_list_booking() {
		$user_id = Session::get('user_id');
		$aQuery = <<<SQL
SELECT us.user_service_name, bd.booking_detail_id, b.booking_date, 
c.client_name, bd.booking_detail_price, b.booking_status
FROM user_service as us, booking_detail as bd, booking as b, client as c
WHERE bd.user_id = {$user_id} 
	AND bd.user_service_id = us.user_service_id
	AND bd.booking_id = b.booking_id
	AND b.client_id = c.client_id
SQL;

		$data = $this->db->select($aQuery);
		// echo json_encode($data);
		
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
			array("Complete" => "primary"),
			array("Delete" 	=> "danger"),
			array("Confirmed" => "warning")
		);

		$data = array(
			[0] => array(
				'booking_detail_id' => 1,
				'booking_date' => '12/12/2014',
				'client_name' => 'Jonh Xon',
				'user_service_name' => 'Dịch vụ ABC',
				'booking_detail_price' => '40',
				'booking_status' => 'Complete'
			)
		);

		for($i = $start; $i < $end; $i++) {
			$aOutput["aaData"][] = array(
			  	$data[$i]['booking_detail_id'],
				$data[$i]['booking_date'],
				$data[$i]['client_name'],
				$data[$i]['user_service_name'],
				$data[$i]['booking_detail_price'],
				'<span class="label label-sm label-'.$status[$data[$i]['booking_status']].'">'.$data[$i]["booking_status"].'</span>',
				'<a href="javascript:;" data-toggle="modal" data-target="#confirmedAppointment_modal" class="btn btn-xs default"><i class="fa fa-search"></i> Xem chi tiết</a>',
			);
		}

		$aOutput["sEcho"] = $sEcho;
		$aOutput["iTotalRecords"] = $iTotalRecords;
		$aOutput["iTotalDisplayRecords"] = $iTotalRecords;

		echo json_encode($aOutput);
	}



}