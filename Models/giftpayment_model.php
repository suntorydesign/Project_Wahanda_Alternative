<?php

/**
 *
 */
class giftpayment_model extends Model {

	function __construct() {
		parent::__construct();
	}
	
	public function processPaypalPayment($data) {
		/*
		 * status = 0 pending
		 */
		Session::initIdle();
		$status = 0;
		$client_id = $_SESSION['client_id'];
		$payment_type = $data['payment_type'];
		$card_number = $data['card_number'];
		$secure_code = $data['secure_code'];
		$date_expire = $data['date_expire'];
		$first_name = $data['first_name'];
		$last_name = $data['last_name'];
		//transfer to dollar
		$total_money_vnd = $_SESSION['gift_voucher_price'];
		$total_money = round($total_money_vnd/TRAN_CURRENCY);
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
		$result_array[0] = $parsed;
		if(empty($parsed)){
			echo '[]';
		}else{
			if($parsed['ACK'] == 'Failure'){
				echo json_encode($result_array);
			}else{
				try {
					$bytes = openssl_random_pseudo_bytes(5);
					$hex = bin2hex($bytes);
					$gift_voucher_code = 'G-' . $hex;
					for ($i = 0; ; $i++) {
						$check_gift_voucher_code = $this -> checkExistGiftVoucher($gift_voucher_code);
						if ($check_gift_voucher_code == 0) {
							break;
						} else {
							$bytes = openssl_random_pseudo_bytes(5);
							$hex = bin2hex($bytes);
							$gift_voucher_code = 'G-' . $hex;
						}
					}
					$this -> db -> beginTransaction();
					$date = explode('/', $_SESSION['gift_voucher_date']);
					$date = $date[2] . '-' . $date[1] . '-' . $date[0];
					$sql = <<<SQL
INSERT INTO gift_voucher(
gift_voucher_code
, gift_voucher_due_date
, gift_voucher_message
, gift_voucher_price
, gift_voucher_name
, gift_voucher_email
, gift_voucher_type
, gift_voucher_date
, gift_voucher_client_id
)
VALUES(
'{$gift_voucher_code}'
, '{$_SESSION['gift_voucher_due_date']}'
, '{$_SESSION['gift_voucher_mess']}'
, '{$_SESSION['gift_voucher_price']}'
, '{$_SESSION['gift_voucher_sender']}'
, '{$_SESSION['gift_voucher_email']}'
, '{$_SESSION['gift_voucher_type']}'
, '{$date}'
, {$_SESSION['client_id']}
)
SQL;
					$insert = $this -> db -> prepare($sql);
					$insert -> execute();				
					if ($insert -> rowCount() > 0) {
						$this -> db -> commit();
						$due_date = explode('-', $_SESSION['gift_voucher_due_date']);
						$due_date = $due_date[2] . '/' . $due_date[1] . '/' . $due_date[0];
						$body = '<h1>BELEZA Xác Nhận</h1>';
						$body .= '<p>Bạn vừa nhận được gift voucher từ một người bạn trên BELEZA có nội dung : </p>';
						$body .= '<p>' . str_replace("\n", '<br/>', $_SESSION['gift_voucher_mess']) . '</p>';
						$body .= '<p>Mã gift voucher của bạn là: <b>' . $gift_voucher_code . '</b></p>';
						$body .= '<p>Ngày nhận gift voucher: ' . $_SESSION['gift_voucher_date'] . '</p>';
						$body .= '<p>Ngày hết hạn: ' . $due_date . '</p>';
						if($_SESSION['gift_voucher_type'] == 1){
							$body .= '<p>Hình thức nhận: Nhận bằng Email</p>';
						}else if($_SESSION['gift_voucher_type'] == 2){
							$body .= '<p>Hình thức nhận: Nhận bằng Thiếp</p>';
						}
						// $body .= '<div align="right"><h3><b>TỔNG CỘNG: </b> '.$total_money_vnd.' VNĐ</h3></div>';			$body .= '<p>Chúc một bạn ngày mới tốt lành</p>';
						$body .= '<p>Chúc bạn ngày mới tốt lành</p>';
						$body .= '<div align="right"><small><i><b>Ban quản trị BELEZA</b></i></small></div>';
			
						//Gửi mail local
						$mail = new PHPMailer(TRUE);
						$mail -> CharSet = "UTF-8";
						// create a new object
						$mail -> IsSMTP();
						// enable SMTP
						$mail -> SMTPDebug = 1;
						// debugging: 1 = errors and messages, 2 = messages only
						$mail -> SMTPAuth = true;
						// authentication enabled
						$mail -> SMTPSecure = 'ssl';
						// secure transfer enabled REQUIRED for GMail
						$mail -> Host = SMTP_MAIL;
						$mail -> Port = 465;
						// or 587
						$mail -> IsHTML(true);
						$mail -> Username = INFO_MAIL;
						$mail -> Password = PASS_MAIL;
						$mail -> SetFrom(INFO_MAIL, 'BELEZA VIETNAM');
						$mail -> Subject = "Thông tin gift voucher Beleza!";
						$mail -> Body = $body;
						$mail -> AddAddress($_SESSION['gift_voucher_email']);
						if (!$mail -> Send()) {
							echo 0;
						} else {
							echo json_encode($result_array);
							unset($_SESSION['gift_voucher_due_date']);
							unset($_SESSION['gift_voucher_mess']);
							unset($_SESSION['gift_voucher_price']);
							unset($_SESSION['gift_voucher_sender']);
							unset($_SESSION['gift_voucher_email']);
							unset($_SESSION['gift_voucher_type']);
						}
					}else{
						echo 0;
						exit;
					}					
				} catch( Exception $e) {
					$this -> db -> rollBack();
					echo 0;
				}	
			}
		}
	}
	public function checkExistGiftVoucher($gift_voucher_code) {
		$sql = <<<SQL
SELECT COUNT(*) AS check_gift_voucher_code
FROM gift_voucher
WHERE gift_voucher_code = '{$gift_voucher_code}'
SQL;
		$select = $this -> db -> select($sql);
		return $select[0]['check_gift_voucher_code'];
	}
}