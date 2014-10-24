<?php

/**
 *
 */
class payment_model extends Model {

	function __construct() {
		parent::__construct();
	}

	public function processPaypalPayment($data) {
		/*
		 * status = 0 venue payment
		 * status = 1 completed
		 * status = 2 online paid but not do the appointment
		 */
		Session::initIdle();
		$status = 2;
		$client_id = $_SESSION['client_id'];
		$payment_type = $data['payment_type'];
		$card_number = $data['card_number'];
		$secure_code = $data['secure_code'];
		$date_expire = $data['date_expire'];
		$first_name = $data['first_name'];
		$last_name = $data['last_name'];
		$total_money = 0;
		if (isset($_SESSION['booking_detail'])) {
			foreach ($_SESSION['booking_detail'] as $key => $value) {
				$total_money += $value['choosen_price'] * $value['booking_quantity'];
			}
		}
		if (isset($_SESSION['eVoucher_detail'])) {
			foreach ($_SESSION['eVoucher_detail'] as $key => $value) {
				$total_money += $value['choosen_price'] * $value['booking_quantity'];
			}
		}
		//transfer to dollar
		$total_money = round($total_money/21000);
		$request_params = array('METHOD' => 'DoDirectPayment', 
								'USER' => API_USERNAME, 
								'PWD' => API_PASSWORD, 
								'SIGNATURE' => API_SIGNATURE, 
								'VERSION' => API_VERSION, 
								'PAYMENTACTION' => 'Sale', 
								'IPADDRESS' => $_SERVER['REMOTE_ADDR'], 
								'CREDITCARDTYPE' => $payment_type, 
								'ACCT' => $card_number, 
								'EXPDATE' => $date_expire, 
								'CVV2' => $secure_code, 
								'FIRSTNAME' => $first_name, 
								'LASTNAME' => $last_name, 
								'STREET' => '', 
								'CITY' => '', 
								'STATE' => '', 
								'COUNTRYCODE' => COUNTRYCODE, 
								'ZIP' => '70000', 
								'AMT' => $total_money, 
								'CURRENCYCODE' => CURRENCYCODE, 
								'DESC' => 'Chuyển tiền thanh toán Beleza'
								);
		// Loop through $request_params array to generate the NVP string.
		$nvp_string = '';
		foreach ($request_params as $var => $val) {
			$nvp_string .= '&' . $var . '=' . urlencode($val);
		}
		// Send NVP string to PayPal and store response
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_VERBOSE, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_URL, API_END_POINT);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);

		$result = curl_exec($curl);
		curl_close($curl);

		$parsed = array();
		parse_str($result, $parsed);
		echo '<pre/>';
		print_r($parsed);
	}

	public function processVenuePayment() {
		/*
		 * status = 0 venue payment
		 * status = 1 completed
		 * status = 2 online paid but not do the appointment
		 */
		Session::initIdle();
		$status = 0;
		$client_id = $_SESSION['client_id'];
		$total_money = 0;
		if (isset($_SESSION['booking_detail'])) {
			foreach ($_SESSION['booking_detail'] as $key => $value) {
				$total_money += $value['choosen_price'] * $value['booking_quantity'];
			}
		}
		if (isset($_SESSION['eVoucher_detail'])) {
			foreach ($_SESSION['eVoucher_detail'] as $key => $value) {
				$total_money += $value['choosen_price'] * $value['booking_quantity'];
			}
		}
		try {
			$bytes = openssl_random_pseudo_bytes(5);
			$hex = bin2hex($bytes);
			$booking_id = 'BK' . $hex;
			for ($i = 0; ; $i++) {
				$check_booking_id = $this -> checkExistBookingId($booking_id);
				if ($check_booking_id == 0) {
					break;
				} else {
					$bytes = openssl_random_pseudo_bytes(5);
					$hex = bin2hex($bytes);
					$booking_id = 'BK' . $hex;
				}
			}
			// echo "<pre/>";
			// print_r($_SESSION['eVoucher_detail']);exit;
			$this -> db -> beginTransaction();
			$sql = <<<SQL
INSERT INTO booking
VALUES(
'{$booking_id}'
, CURRENT_DATE()
, {$status}
, {$total_money}
, {$client_id}
)
SQL;
			$insert_1 = $this -> db -> prepare($sql);
			$insert_1 -> execute();
			if ($insert_1 -> rowCount() > 0) {
				// insert booking detail
				if (isset($_SESSION['booking_detail'])) {
					foreach ($_SESSION['booking_detail'] as $key => $value) {
						$query = <<<SQL
INSERT INTO booking_detail(
`booking_detail_price`
,`booking_detail_quantity`
,`booking_detail_date`
,`booking_detail_time_start`
,`booking_detail_time_end`
,`booking_detail_user_id`
,`booking_detail_user_service_id`
,`booking_detail_booking_id`
)
VALUES(
'{$value['choosen_price']}'
, '{$value['booking_quantity']}'
, '{$value['booking_detail_date']}'
, '{$value['booking_detail_time']}'
, '{$value['booking_detail_time']}'
, '{$value['user_id']}'
, '{$value['user_service_id']}'
, '{$booking_id}'
)
SQL;
						$insert_2 = $this -> db -> prepare($query);
						$insert_2 -> execute();
					}
				}
				if (isset($_SESSION['eVoucher_detail'])) {
					foreach ($_SESSION['eVoucher_detail'] as $key => $value) {
						$bytes = openssl_random_pseudo_bytes(8);
						$hex = bin2hex($bytes);
						$e_voucher_id = 'E-' . $hex;
						for ($i = 0; ; $i++) {
							$check_e_voucher_id = $this -> checkExisteVoucherId($e_voucher_id);
							if ($check_e_voucher_id == 0) {
								break;
							} else {
								$bytes = openssl_random_pseudo_bytes(8);
								$hex = bin2hex($bytes);
								$e_voucher_id = 'E-' . $hex;
							}
						}
						$query = <<<SQL
INSERT INTO e_voucher(
`e_voucher_id`
,`e_voucher_due_date`
,`e_voucher_price`
,`e_voucher_quantity`
,`e_voucher_user_service_id`
,`e_voucher_booking_id`
,`e_voucher_user_id`
)
VALUES(
'{$e_voucher_id}'
,'{$value['eVoucher_due_date']}'
, '{$value['choosen_price']}'
, '{$value['booking_quantity']}'
, '{$value['user_service_id']}'
, '{$booking_id}'
, '{$value['user_id']}'
)
SQL;
						$insert_3 = $this -> db -> prepare($query);
						$insert_3 -> execute();
					}
				}
			} else {
				echo 0;
				exit ;
			}
			echo 200;
			unset($_SESSION['booking_detail']);
			unset($_SESSION['eVoucher_detail']);
			$this -> db -> commit();
		} catch( Exception $e) {
			echo 0;
		}
	}

	public function checkExistBookingId($booking_id) {
		$sql = <<<SQL
SELECT COUNT(*) AS check_booking_id
FROM booking
WHERE booking_id = '{$booking_id}'
SQL;
		$select = $this -> db -> select($sql);
		return $select[0]['check_booking_id'];
	}

	public function checkExisteVoucherId($e_voucher_id) {
		$sql = <<<SQL
SELECT COUNT(*) AS check_eVoucher_id
FROM e_voucher
WHERE e_voucher_id = '{$e_voucher_id}'
SQL;
		$select = $this -> db -> select($sql);
		return $select[0]['check_eVoucher_id'];
	}

}
?>