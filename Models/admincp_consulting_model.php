<?php

class admincp_consulting_model extends Model {
	function __construct() {
		parent::__construct();
	}

	public function loadRuleList() {
		$sql = <<<SQL
SELECT rule_id
, rule_group
, rule_result
, service.service_name
FROM rule,service
WHERE rule.rule_service_id = service.service_id
AND rule_delete_flg = 0
AND service_delete_flg = 0
SQL;
		$select = $this -> db -> select($sql);
		if ($select) {
			echo json_encode($select);
		} else {
			echo "[]";
		}
	}

	public function loadRuleServiceType() {
		$sql = <<<SQL
SELECT service_type_id
, service_type_name
FROM service_type
WHERE service_type_delete_flg = 0
SQL;
		$select = $this -> db -> select($sql);
		if ($select) {
			echo json_encode($select);
		} else {
			echo "[]";
		}
	}

	public function loadRuleService($service_type_id) {
		$sql = <<<SQL
SELECT service_id
, service_name
FROM service
, service_type
WHERE service.service_service_type_id = service_type.service_type_id 
AND service_type_delete_flg = 0
AND service_delete_flg = 0
AND service_type_id = {$service_type_id}
SQL;
		$select = $this -> db -> select($sql);
		if ($select) {
			echo json_encode($select);
		} else {
			echo "[]";
		}
	}

	public function loadQuestionList($service_type_id) {
		$sql = <<<SQL
SELECT question_id
, question_content
FROM question
WHERE question_delete_flg = 0
AND question_service_type_id = {$service_type_id}
SQL;
		$select = $this -> db -> select($sql);
		$result_array = array();
		if ($select) {
			foreach ($select as $key => $value) {
				$sql = <<<SQL
SELECT fact_id
, fact_answer
FROM fact
WHERE fact_delete_flg = 0
AND fact_question_id = {$value['question_id']}
SQL;
				$select = $this -> db -> select($sql);
				$result_array[$key]['question_id'] = $value['question_id'];
				$result_array[$key]['question_content'] = $value['question_content'];
				$result_array[$key]['fact'] = $select;
			}
			echo json_encode($result_array);
		} else {
			echo "[]";
		}
		// print_r($result_array);
	}

	public function checkFactExist($data) {
		$fact = explode(',', $data['fact']);
		foreach ($fact as $key => $value) {
			$sql = <<<SQL
SELECT COUNT(*) AS check_fact_id
FROM fact
WHERE fact_id = {$value}
AND fact_question_id = {$data['question_id']}
SQL;
			$select = $this -> db -> select($sql);
			if ($select[0]['check_fact_id'] != 0) {
				$fact[$key] = $data['fact_id'];
				$fact_result = '';
				foreach ($fact as $i => $item) {
					if ($fact_result == '') {
						$fact_result = $item;
					} else {
						$fact_result .= ',' . $item;
					}
				}
				echo $fact_result;
				exit ;
			}
		}

		echo $data['fact'] . ',' . $data['fact_id'];
	}

}
