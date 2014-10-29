<?php

class SpaCMS_Menu_Model {

	///////// Group service -> service
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
					'user_service_id' 			=> $u_service['user_service_id'],
					'user_service_name' 		=> $u_service['user_service_name'],
					'user_service_duration' 	=> $u_service['user_service_duration'],
					'user_service_sale_price' 	=> $u_service['user_service_sale_price'],
					'user_service_full_price' 	=> $u_service['user_service_full_price'],
					'user_service_status' 		=> $u_service['user_service_status'],
					'user_service_is_featured' 	=> $u_service['user_service_is_featured'],
					'user_service_description' 	=> $u_service['user_service_description'],
					'user_service_image' 		=> $u_service['user_service_image'],
					'user_service_service_id' 	=> $u_service['user_service_service_id'],
					'user_service_group_id' 	=> $u_service['user_service_group_id']
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
				us.user_service_sale_price, 
				us.user_service_full_price, 
				us.user_service_service_id,
				us.user_service_status, us.user_service_description, us.user_service_group_id,
				us.user_service_is_featured, us.user_service_image
		FROM user_service us
		WHERE us.user_service_group_id = {$group_service_id}
			AND us.user_service_delete_flg = 0
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

	/////// Service system
	function get_service_system() {
		// get list service type 
		$get_service_type = self::get_service_type();

		$data = array(); // data return
		$index = 0;
		foreach ($get_service_type as $st) {
			$data[$index] = array(
				'service_type_id' => $st['service_type_id'],
				'service_type_name' => $st['service_type_name']
			);

			$get_service = self::get_service($st['service_type_id']);
			foreach ($get_service as $service) {
				$data[$index]['list_service_system'][] = array(
					'service_id' => $service['service_id'],
					'service_name' => $service['service_name'],
					'service_image' => $service['service_image']
				);
			}
			$index++;
		}

		echo json_encode($data);
	}

	function get_service_type() {
		$aQuery = <<<SQL
		SELECT service_type_id, service_type_name
		FROM service_type
SQL;
		$data = $this->db->select($aQuery);

		return $data;
	}

	function get_service( $service_type_id ) {
		$aQuery = <<<SQL
		SELECT service_id, service_name, service_image
		FROM service
		WHERE service_service_type_id = {$service_type_id}
SQL;
		$data = $this->db->select($aQuery);
		
		return $data;
	}

	/////////// Group service
	function update_group_service() {
		$user_id = Session::get('user_id');
		$group_service_id = $_POST["group_service_id"];
		$data = array(
			"group_service_name" => $_POST["group_service_name"]
		);
		$where = "group_service_user_id = $user_id";
		$where .= " AND group_service_id = $group_service_id";

		$result = $this->db->update('group_service', $data, $where);
		
		if($result) {
			echo 'success';
		} else {
			echo 'error';
		}
	}

	function insert_group_service() {
		$user_id = Session::get('user_id');
		$data = array(
			"group_service_name" => $_POST['group_service_name'],
			"group_service_user_id" => $user_id
		);

		if( $this->db->insert('group_service', $data) ){
			echo 'success';
		} else {
			echo 'error';
		}
	}

	function delete_group_service() {
		$user_id = Session::get('user_id');
		$group_service_id = $_POST['group_service_id'];
		$table = 'group_service';
		$where = "group_service_id = $group_service_id AND group_service_user_id = $user_id";
		$result = $this->db->delete($table, $where);
		if($result) {
			echo 'success';
		} else {
			echo 'error';
		}
	}


	/**
	 * Thêm mới 1 dịch vụ
	 * @param data
	 * @return status
	 */
	function insert_user_service() {
		$user_id = Session::get('user_id');

		$data = array();
		if(!isset($_POST['user_service_is_featured'])) {
			$data['user_service_is_featured'] = 0;
		} else {
			$max_usf = self::max_user_service_is_featured(); // Kiểm tra số lượng user featured
			if($max_usf >= 5) {
				echo 'max_us_featured';
				return;
			}

			$_POST['user_service_is_featured'] = 1;
		}
		foreach ($_POST as $key => $value) {
			if($key == "url") {
				continue;
			}
			if($key == "user_service_image"){
				$data["$key"] = implode(',', $value);
				continue;
			}
			$data["$key"] = $value;
		}

		if( $this->db->insert('user_service', $data) ){
			echo 'success';
		} else {
			echo 'error';
		}
	}

	/**
	 * Sửa chi tiết dịch vụ
	 * @param data
	 * @return json
	 */
	public function update_user_service() {
		$user_id = Session::get('user_id');
		$user_service_id = $_POST['user_service_id'];
		$data = array();
		if(!isset($_POST['user_service_is_featured'])) {
			$data['user_service_is_featured'] = 0;
		} else {
			$max_usf = self::max_user_service_is_featured($user_service_id); // Kiểm tra số lượng user featured
			if($max_usf >= 5) {
				echo 'max_us_featured';
				return;
			}

			$_POST['user_service_is_featured'] = 1;
		}

		foreach ($_POST as $key => $value) {
			if($key == "url" || $key == "user_service_id") {
				continue;
			}
			if($key == "user_service_image"){
				$data["$key"] = implode(',', $value);
				continue;
			}
			$data["$key"] = $value;
		}

		// print_r($data); exit();
		$where = "user_service_id = $user_service_id";
		$result = $this->db->update('user_service', $data, $where);

		if($result) {
			echo 'success';
		} else {
			echo 'error';
		}
	}

	public function delete_user_service() {
		$user_id = Session::get('user_id');
		$user_service_id = $_POST['user_service_id'];
		$data = array(
			'user_service_delete_flg' => 1
		);
		
		$where = "user_service_id = $user_service_id";

		$result = $this->db->update('user_service', $data, $where);

		if($result) {
			echo 'success';
		} else {
			echo 'error';
		}
	}

	/**
	 * Kiểm tra số lượng dịch vụ nổi bật 
	 * và dịch vụ (user_service_id) nếu là dv nổi bật rồi thì không tính
	 * @param data
	 * @return json
	 */
	function max_user_service_is_featured($user_service_id = false) {
		$user_id = Session::get('user_id');
		$decrease_where = "";

		// Kiểm tra user_service_id này có phải 
		if($user_service_id) {
			$aQuery_ck = <<<SQL
			SELECT 
				count(*) as 'isFeatured'
			FROM 
				user_service us, 
				group_service gs
			WHERE
					gs.group_service_user_id = {$user_id}
				AND us.user_service_delete_flg = 1
				AND us.user_service_group_id = gs.group_service_id
				AND us.user_service_id = {$user_service_id}
SQL;
			
			$isFeatured = $this->db->select($aQuery_ck);
			if($isFeatured > 0){
				$decrease_where = " AND NOT us.user_service_id = {$user_service_id} ";
			}
		}
		

		$aQuery = <<<SQL
		SELECT 
			count(*) as 'max_usf'
		FROM 
			user_service us, 
			group_service gs
		WHERE 
				us.user_service_is_featured = 1
			AND us.user_service_group_id = gs.group_service_id
			AND gs.group_service_user_id = {$user_id}
			AND us.user_service_delete_flg = 0
			{$decrease_where}
SQL;
		$data = $this->db->select($aQuery);

		$max_usf = $data[0]['max_usf'];

		return $max_usf;
	}

	/////////// Service featured
	function get_user_service_featured() {
		$user_id = Session::get('user_id');

		$aQuery = <<<SQL
		SELECT us.user_service_name, us.user_service_id, us.user_service_image
		FROM user_service us, group_service gs
		WHERE gs.group_service_user_id = {$user_id}
			AND us.user_service_group_id = gs.group_service_id
			AND us.user_service_is_featured = 1
			AND us.user_service_delete_flg = 0
SQL;
		$data = $this->db->select($aQuery);

		echo json_encode($data);
	}

	function set_user_service_is_featured($user_service_id) {
		$user_id = Session::get('user_id');
		// Count service featured
		$aQuery_1 = <<<SQL
		SELECT COUNT(*) as 'sum_featured'
		FROM user_service us, group_service gs
		WHERE gs.group_service_user_id = {$user_id}
			AND us.user_service_is_featured = 1
SQL;
		$data = $this->db->select($aQuery_1);
		
		
	}

	function delete_user_service_featured() {
		$user_id = Session::get('user_id');
		$user_service_id = $_POST['user_service_id'];
		$data = array(
			'user_service_is_featured' => 0
		);
		$where = "user_service_id = $user_service_id";

		$result = $this->db->update('user_service', $data, $where);

		if($result) {
			echo 'success';
		} else {
			echo 'error';
		}
	}


	/**
	 * Danh sách tất cả nhóm loại dịch vụ cho xhrGetOM_add_group
	 * @return json
	 */
	public function getOM_add_group() {
		$aQuery = <<<SQL
		SELECT 
			service_type_id,
			service_type_name,
			service_type_icon
		FROM 
			service_type
SQL;
		$data = $this->db->select($aQuery);
		echo json_encode($data);
	}
}