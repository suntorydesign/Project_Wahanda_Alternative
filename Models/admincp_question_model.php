<?php

class admincp_question_model extends Model {
	function __construct() {
		parent::__construct();
	}

	public function loadServiceTypeList() {
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

	public function loadQuestionList($question_service_type_id) {
		$sql = <<<SQL
SELECT question_id
, question_content
, service_type_name
FROM question,service_type
WHERE 
service_type.service_type_id = question.question_service_type_id
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
				$sOutput .= '"' . str_replace('"', '/"', $row['question_id']) . '",';
				$sOutput .= '"' . str_replace('"', '/"', $row['question_content']) . '",';
				$sOutput .= '"' . str_replace('"', '/"', $row['service_type_name']) . '"';
				$sOutput .= "],";
			}
			$sOutput = substr_replace($sOutput, "", -1);
			$sOutput .= ']';
			echo $sOutput;
		} else {
			echo "[]";
		}
	}

	public function addQuestion($data) {
		$question_id = ($this -> getQuestionID()) + 1;
		$sql = <<<SQL
INSERT INTO question(
question_id
, question_content
, question_service_type_id
)
values(
$question_id
, '{$data['question_content']}'
, '{$data['question_service_type_id']}'
)
SQL;
		$insert = $this -> db -> prepare($sql);
		$insert -> execute();
		if ($insert -> rowCount() > 0) {
			$answer = explode(',', $data['question_answer']);
			foreach ($answer as $key => $value) {
				$sql = <<<SQL
INSERT INTO fact(
fact_answer
, fact_question_id
)
values(
'{$value}'
, {$question_id}
)
SQL;
				$insert = $this -> db -> prepare($sql);
				$insert -> execute();
			}
			echo 200;
		} else {
			echo 0;
		}

	}

	public function getQuestionID() {
		$sql = <<<SQL
SELECT question_id
FROM question
ORDER BY question_id DESC
LIMIT 1
SQL;
		$select = $this -> db -> select($sql);
		return $select[0]['question_id'];
	}

}
