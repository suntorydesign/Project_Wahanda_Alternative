<?php

class SpaCMS_Menu_Model {

	function get_group_user_service() {
		$user_id = Session::get('user_id');
		
		// get list group 
		$get_group_service = self::get_group_service($user_id);

		$data = array(); // data return
		$index = 0;
		foreach ($get_group_service as $group) {
			$data[$index] = array(
				'group_service_id' => $group['group_service_id'],
				'group_service_name' => $group['group_service_name']
			);

			$get_user_service = self::get_user_service($group['group_service_id']);
			foreach ($get_user_service as $u_service) {
				$data[$index]['list_user_service'][] = array(
					'user_service_id' => $u_service['user_service_id'],
					'user_service_name' => $u_service['user_service_name'],
					'user_service_duration' => $u_service['user_service_duration'],
					'user_service_sale_price' => $u_service['user_service_sale_price'],
					'user_service_full_price' => $u_service['user_service_full_price']
				);
			}
			$index++;
		}
		// $data = array(
		// 	array(
		// 		'group_id' => ,
		// 		'group_name' => ,
		// 		'list_user_service' => array(
		// 			array(
		// 				'user_service_id' => 1,
		// 				'user_service_name' => 'abc',
		// 				'user_service_duration' =>
		// 				'user_service_sale_price' => 
		// 				'user_service_full_price' =>
		// 			),
		// 			//...
		// 		)
		//		//....
		// 	),
		// );

		echo json_encode($data);
	}

	function get_group_service( $user_id ) {
		$aQuery = <<<SQL
		SELECT gs.group_service_id, gs.group_service_name
		FROM group_service gs
		WHERE gs.group_service_user_id = {$user_id}
SQL;
		$data = $this->db->select($aQuery);

		return $data;
	}

	function get_user_service( $group_service_id ) {
		$user_id = Session::get('user_id');
		$aQuery = <<<SQL
		SELECT us.user_service_id, us.user_service_name, us.user_service_duration,
				us.user_service_sale_price, us.user_service_full_price
		FROM user_service us
		WHERE us.user_service_group_id = {$group_service_id}
SQL;
		$data = $this->db->select($aQuery);
		
		return $data;
	}

// 	function get_user_service_featured() {
// 		$user_id = Session::get('user_id');
// 		$aQuery = <<<SQL 
// 		SELECT 
// 		FROM group_service gs, user_service us,
// 		WHERE gs.group_service_user_id = {$user_id}
// 			AND gs.group_service_id = us.user_service_group_id
// 			AND us.user_service_is_featured = 1 -- Is featured
// SQL;
// 		$data = $this->db->select($aQuery);

// 		// $data = array(
// 		// 	array(
// 		// 		'user_service_id' 
// 		// 		'user_service_name' 
// 		// 		'user_service_image' 
// 		// 	)
// 		// 	//...
// 		// );

// 		echo json_encode($data);
// 	}

// 	function get_service() {
// 		$user_id = Session::get('user_id');
// 		$aQuery = <<<SQL 
// 		SELECT 
// 		FROM 
// 		WHERE 
// SQL;
// 		$data = $this->db->select($aQuery);
// 		echo json_encode($data);
// 	}

}