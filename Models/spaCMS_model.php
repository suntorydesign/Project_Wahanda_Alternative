<?php
require (dirname(__FILE__).'/spaCMS_model/spaCMS_home_model.php');
require (dirname(__FILE__).'/spaCMS_model/spaCMS_calendar_model.php');
require (dirname(__FILE__).'/spaCMS_model/spaCMS_menu_model.php');
require (dirname(__FILE__).'/spaCMS_model/spaCMS_reports_model.php');
require (dirname(__FILE__).'/spaCMS_model/spaCMS_settings_model.php');

class SpaCMS_Model extends Model {
	function __construct(){
		parent::__construct();
	}

	function index() {
		
	}

	function login(){
		$user_email 	= $_POST['user_email'];
		$user_password 	= $_POST['user_password'];
		$sql = "SELECT user_id, user_business_name FROM user WHERE user_email = :user_email AND user_password = :user_password AND user_delete_flg = 0 AND user_status_approve = 1";

		$user = array(
				':user_email' 		=> $user_email,
				':user_password' 	=> Hash::create('md5', $user_password, HASH_PASSWORD_KEY)
			);

		$sth = $this->db->prepare($sql);
		$sth->execute($user);
		$count = $sth->rowCount();

		if($count > 0){
			$result = $sth->fetch(PDO::FETCH_ASSOC);
			Session::init();
			Session::set('spaCMS', true);
			Session::set('user_id', $result['user_id']);
			Session::set('user_email', $user_email);
			Session::set('user_business_name', $result['user_business_name']);
			header('location:'.URL.'spaCMS/home');
		} else {
			header('location:'.URL.'spaCMS');
			return false;
		}

	}

	function logout() {
		Session::init();
		Session::destroy();
		header('location:'.URL.'spaCMS');
		exit;
	}

	///////////////////////////// HOME //////////////////////////
	function get_redeem_voucher() {
		SpaCMS_Home_Model::get_redeem_voucher();
	}

	function update_e_voucher() {
		SpaCMS_Home_Model::update_e_voucher();
	}

	///////////////////////////// CALENDAR //////////////////////////
	function get_calendar() {
		SpaCMS_Calendar_Model::get_calendar();
	}

	function get_appointment() {
		SpaCMS_Calendar_Model::get_appointment();
	}

	function get_booking() {
		SpaCMS_Calendar_Model::get_booking();
	}

	function get_user_service() {
		SpaCMS_Calendar_Model::get_user_service();
	}

	function insert_appointment() {
		SpaCMS_Calendar_Model::insert_appointment();
	}

	function get_appointment_confirmed() {
		SpaCMS_Calendar_Model::get_appointment_confirmed();
	}

	function get_appointment_for_edit() {
		SpaCMS_Calendar_Model::get_appointment_for_edit();
	}

	function delete_appointment() {
		SpaCMS_Calendar_Model::delete_appointment();
	}

	function update_appointment_status() {
		SpaCMS_Calendar_Model::update_appointment_status();
	}

	function update_appointment_client() {
		SpaCMS_Calendar_Model::update_appointment_client();
	}

	function update_appointment() {
		SpaCMS_Calendar_Model::update_appointment();
	}

	function update_appointment_is_confirm() {
		SpaCMS_Calendar_Model::update_appointment_is_confirm();
	}

	function check_appointment_is_confirmed() {
		SpaCMS_Calendar_Model::check_appointment_is_confirmed();
	}

	///////////////////////////// MENU //////////////////////////
	function get_group_user_service() {
		SpaCMS_Menu_Model::get_group_user_service();
	}

	function getOM_add_group() {
		SpaCMS_Menu_Model::getOM_add_group();
	}

	function insert_user_service() {
		SpaCMS_Menu_Model::insert_user_service();
	}

	function update_user_service() {
		SpaCMS_Menu_Model::update_user_service();
	}

	function delete_user_service() {
		SpaCMS_Menu_Model::delete_user_service();
	}

	function get_user_service_featured() {
		SpaCMS_Menu_Model::get_user_service_featured();
	}

	function delete_user_service_featured() {
		SpaCMS_Menu_Model::delete_user_service_featured();
	}
	
	function get_service_system() {
		SpaCMS_Menu_Model::get_service_system();
	}
	
	function insert_group_service() {
		SpaCMS_Menu_Model::insert_group_service();
	}
	
	function update_group_service() {
		SpaCMS_Menu_Model::update_group_service();
	}
	
	function delete_group_service() {
		SpaCMS_Menu_Model::delete_group_service();
	}



	///////////////////////////// REPORTS //////////////////////////
	// function get_booking_detail() {
	// 	SpaCMS_Reports_Model::get_booking_detail();
	// }

	function get_sale_report() {
		SpaCMS_Reports_Model::get_sale_report();
	}

	function get_booking_report() {
		SpaCMS_Reports_Model::get_booking_report();
	}

	///////////////////////////// SETTING //////////////////////////
	function get_type_business() {
		SpaCMS_Settings_Model::get_type_business();
	}

	function get_country() {
		SpaCMS_Settings_Model::get_country();
	}

	function get_district() {
		SpaCMS_Settings_Model::get_district();
	}

	function get_user_detail() {
		SpaCMS_Settings_Model::get_user_detail();
	}

	function update_user_detail() {
		SpaCMS_Settings_Model::update_user_detail();
	}


	function get_user_open_hour() {
		SpaCMS_Settings_Model::get_user_open_hour();
	}

	function update_user_open_hour() {
		SpaCMS_Settings_Model::update_user_open_hour();
		
	}

	function get_user_is_use_voucher() {
		SpaCMS_Settings_Model::get_user_is_use_voucher();
	}

	function update_user_is_use_voucher() {
		SpaCMS_Settings_Model::update_user_is_use_voucher();
	}

	function get_user_company() {
		SpaCMS_Settings_Model::get_user_company();
	}

	function update_user_company() {
		SpaCMS_Settings_Model::update_user_company();
	}


	function get_user_bank_acc() {
		SpaCMS_Settings_Model::get_user_bank_acc();
	}

	function update_user_bank_acc() {
		SpaCMS_Settings_Model::update_user_bank_acc();
	}


	function get_user_slide() {
		SpaCMS_Settings_Model::get_user_slide();
	}
	
	function update_user_notification() {
		SpaCMS_Settings_Model::update_user_notification();
	}
	
	function get_user_notification_email() {
		SpaCMS_Settings_Model::get_user_notification_email();
	}
	
	function update_user_is_use_gvoucher() {
		SpaCMS_Settings_Model::update_user_is_use_gvoucher();
	}
	
	function update_user_is_use_evoucher() {
		SpaCMS_Settings_Model::update_user_is_use_evoucher();
	}
	
	function update_user_is_use_appointment() {
		SpaCMS_Settings_Model::update_user_is_use_appointment();
	}
	
	function update_user_password() {
		SpaCMS_Settings_Model::update_user_password();
	}
	
	function update_user_limit_before_booking() {
		SpaCMS_Settings_Model::update_user_limit_before_booking();
	}
	
	function get_user_limit_before_booking() {
		SpaCMS_Settings_Model::get_user_limit_before_booking();
	}
	
	function get_user_is_use_gvoucher() {
		SpaCMS_Settings_Model::get_user_is_use_gvoucher();
	}
	
	function get_user_is_use_evoucher() {
		SpaCMS_Settings_Model::get_user_is_use_evoucher();
	}
	
	function get_user_is_use_appointment() {
		SpaCMS_Settings_Model::get_user_is_use_appointment();
	}

}