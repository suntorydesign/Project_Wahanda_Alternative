<?php
/**
 *
 */
class giftvoucher_model extends Model {

	function __construct() {
		parent::__construct();
	}

	public function saveGiftvoucher($data) {
		$gift_voucher_due_date = EVOUCHER_DUE_DATE;
		$bytes = openssl_random_pseudo_bytes(8);
		$hex = bin2hex($bytes);
		$gift_voucher_code = 'G-' . $hex;
		for ($i = 0; ; $i++) {
			$check_gift_voucher = $this -> checkExistGiftvoucher($gift_voucher_code);
			if ($check_gift_voucher == 0) {
				break;
			} else {
				$bytes = openssl_random_pseudo_bytes(8);
				$hex = bin2hex($bytes);
				$gift_voucher_code = 'G-' . $hex;
			}
		}
		//Nội dung email
		$body = '<h1>BELEZA xin chào bạn</h1>';
		$body .= '<p>Xin chào bạn: <strong>' . $data['gift_voucher_email'] . '</strong></p>';
		$body .= '<p>Bạn vừa nhận được gift voucher từ một người bạn trên BELEZA có nội dung : </p>';
		$body .= '<p>' . $data['gift_voucher_mess'] . '</p>';
		$body .= '<p>Mã voucher của bạn là: ' . $gift_voucher_code . '</p>';
		$body .= '<p>Chúc một ngày mới tốt lành</p>';
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
		$mail -> Subject = "Xác nhận chuyển gift voucher từ Beleza!";
		$mail -> Body = $body;
		$mail -> AddAddress($data['gift_voucher_email']);
		if (!$mail -> Send()) {
			echo "Mailer Error: " . $mail -> ErrorInfo;
		} else {
			//save
			$query = <<<SQL
INSERT INTO `gift_voucher`(
`gift_voucher_email`
, `gift_voucher_code`
, `gift_voucher_due_date`
, `gift_voucher_price`) 
VALUES (
'{$data['gift_voucher_email']}'
,'{$gift_voucher_code}'
,DATE_ADD(CURRENT_DATE, INTERVAL {$gift_voucher_due_date} MONTH)
,'{$data['gift_voucher_price']}'
)
SQL;
			$insert = $this -> db -> prepare($query);
			$insert -> execute();
			if ($insert -> rowCount() > 0) {
				echo 200;
			} else {
				echo 0;
			}
		}
	}

	function checkExistGiftvoucher($gift_voucher_code) {
		$sql = <<<SQL
SELECT COUNT(*) AS check_gift
FROM gift_voucher
WHERE gift_voucher_code = '{$gift_voucher_code}'
SQL;
		$select = $this -> db -> select($sql);
		return $select[0]['check_gift'];
	}

	function getDueDate($date) {
		$gift_voucher_due_date = EVOUCHER_DUE_DATE;
		$date = explode('/', $date);
		$date = $date[2] . '-' . $date[1] . '-' . $date[0];
		$sql = <<<SQL
SELECT
DATE_ADD('{$date}', INTERVAL {$gift_voucher_due_date} MONTH) as gift_voucher_due_date
SQL;
		$select = $this -> db -> select($sql);
		return $select[0]['gift_voucher_due_date'];
	}

}
