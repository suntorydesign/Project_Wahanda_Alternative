<?php

/**
 *
 */
class payment_model extends Model {

	function __construct() {
		parent::__construct();
	}

	public function processVenuePayment() {
		/*
		 * status = 0 incompleted
		 * status = 1 completed
		 * status = 2 venue payment
		 */
		$status = 2;
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
			$this -> db -> beginTransaction();
			$sql = <<<SQL

SQL;
			$this -> db -> commit();
		} catch( Exception $e) {
			echo '0';
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

}
?>