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

	public function loadQuestionDetail($question_id) {
		$sql = <<<SQL
SELECT *
FROM question
WHERE question_id = {$question_id}
AND question_delete_flg = 0
SQL;
		$select = $this -> db -> select($sql);
		if ($select) {
			$sql = <<<SQL
SELECT *
FROM fact
WHERE fact_question_id = {$question_id}
AND fact_delete_flg = 0
SQL;
			$select_detail = $this -> db -> select($sql);
			$select[0]['question_answers'] = $select_detail;
			echo json_encode($select);
		} else {
			echo '[]';
		}
	}

	public function editQuestion($data) {
		$fact_id = explode(',', $data['fact_id']);
		$update_fact_answer = explode(',', $data['update_fact_answer']);
		$insert_fact_answer = explode(',', $data['insert_fact_answer']);
		$sql = <<<SQL
UPDATE question
SET question_content = '{$data['question_content']}'
, question_service_type_id = {$data['question_service_type_id']}
WHERE question_id = {$data['question_id']}
SQL;
		$update_question = $this -> db -> prepare($sql);
		$update_question -> execute();
		foreach ($fact_id as $key => $value) {
			$sql = <<<SQL
UPDATE fact
SET fact_answer = '{$update_fact_answer[$key]}'
WHERE fact_id = {$value}
SQL;
			$update_fact = $this -> db -> prepare($sql);
			$update_fact -> execute();
		}
		if ($data['insert_fact_answer'] != '') {
			foreach ($insert_fact_answer as $key_1 => $value_1) {
				$sql = <<<SQL
INSERT INTO fact(
fact_answer
, fact_question_id
)
values(
'{$value_1}'
, {$data['question_id']}
)
SQL;
				$insert_fact = $this -> db -> prepare($sql);
				$insert_fact -> execute();
			}
		}
		echo 200;
	}

	public function deleteQuestion($question_id) {
		$sql = <<<SQL
UPDATE question
SET question_delete_flg = 1
WHERE question_id = {$question_id}
SQL;
		$update = $this -> db -> prepare($sql);
		$update -> execute();
		if ($update -> rowCount() > 0) {
			echo 200;
		} else {
			echo 0;
		}
	}

}
