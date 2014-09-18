<?php
/**
 * 
 */
class service_model extends Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function loadLocationDetail($user_id)
	{
		$select = $this -> db -> select('SELECT *
										 FROM user
										 WHERE user_id = ' . $user_id);
		if($select){
			echo json_encode($select);
		}else{
			echo '[]';
		}	
		
	}
}

?>