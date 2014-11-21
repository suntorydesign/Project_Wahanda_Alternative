<?php

class admincp_consulting_model extends Model {
	function __construct() {
		parent::__construct();
	}

	public function loadRuleList($question_service_type_id) {
		$sql = <<<SQL
SELECT DISTINCT rule_id
, rule_group
, rule_result
, service.service_name
FROM rule,service,question,service_type
WHERE rule.rule_service_id = service.service_id
AND service_type.service_type_id = service.service_service_type_id
AND service_type.service_type_id = question.question_service_type_id
AND rule_delete_flg = 0
AND service_delete_flg = 0
AND service_type_delete_flg = 0
AND question_delete_flg = 0
AND question_service_type_id = {$question_service_type_id}
SQL;
		$select = $this -> db -> select($sql);
		if ($select) {
			// echo json_encode($select);
			$sOutput = '[';
			foreach ($select as $row) {
				$sOutput .= "[";
				$sOutput .= '"' . str_replace('"', '/"', $row['rule_id']) . '",';
				$sOutput .= '"' . str_replace('"', '/"', $row['rule_group']) . '",';
				$sOutput .= '"' . str_replace('"', '/"', $row['rule_result']) . '",';
				$sOutput .= '"' . str_replace('"', '/"', $row['service_name']) . '"';
				$sOutput .= "],";
			}
			$sOutput = substr_replace($sOutput, "", -1);
			$sOutput .= ']';
			echo $sOutput;
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
				sort($fact);
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
		$fact_sec = explode(',', $data['fact'] . ',' . $data['fact_id']);
		sort($fact_sec);
		$fact_sec_result = '';
		foreach ($fact_sec as $key => $value) {
			if ($fact_sec_result == '') {
				$fact_sec_result = $value;
			} else {
				$fact_sec_result .= ',' . $value;
			}
		}
		echo $fact_sec_result;
	}

	public function saveRule($data) {
		$check_rule = self::checkExistRule($data['rule_group']);
		if ($check_rule == 1) {
			echo 0;
		} else {
			$sql = <<<SQL
INSERT INTO rule(
rule_group
, rule_result
, rule_service_id
)
values(
'{$data['rule_group']}'
, '{$data['rule_result']}'
, {$data['rule_service']}
)
SQL;
			$insert = $this -> db -> prepare($sql);
			$insert -> execute();
			if ($insert -> rowCount() > 0) {
				echo 200;
			}else{
				echo 0;
			}
		}
	}

	public function checkExistRule($rule_group) {
		$sql = <<<SQL
SELECT COUNT(*) AS check_rule
FROM rule
WHERE rule_group = '{$rule_group}'
SQL;
		$select = $this -> db -> select($sql);
		return $select[0]['check_rule'];
	}

}
