$(document).ready(function() {
	if (IS_INDEX == 1 && IS_ADD == 0 && IS_EDIT == 0) {
		loadRuleServiceType();
		// $('#rule_list').DataTable();
		oTable = $('#rule_list').dataTable();
		$('#rule_service_type').on('change', function() {
			RULE_SERVICE_TYPE_ID = $(this).val();
			loadRuleList();
		});
	}
	if (IS_INDEX == 0 && IS_ADD == 1 && IS_EDIT == 0) {
		loadRuleServiceType();
		$('#refresh_rule').on('click', function() {
			$('#rule_group').val('');
			FACT = '';
		});
	}
});

function addRuleDetail() {
	jumpToOtherPage(URL + 'admincp_consulting/addRuleDetail');
}

function returnToConsulting() {
	jumpToOtherPage(URL + 'admincp_consulting');
}

function loadRuleList() {
	$.ajax({
		url : URL + 'admincp_consulting/loadRuleList',
		type : 'post',
		dataType : 'json',
		data : {
			question_service_type_id : RULE_SERVICE_TYPE_ID
		},
		success : function(response) {
			if (response[0] != null) {
				// var html = '';
				// $.each(response, function(i, item) {
					// html += '<tr>';
					// $.each(item, function(key, value) {
						// html += '<td>';
						// html += value;
						// html += '</td>';
					// });
					// html += '</tr>';
				// });
				// $('#rule_list tbody').html(html);
				oTable.fnClearTable();
				oTable.fnAddData(response);
			} else {
				// $('#rule_list tbody').html('');
				oTable.fnClearTable();
				oTable.fnAddData(response);
			}
		},
		complete : function() {

		}
	});

}

function loadRuleServiceType() {
	$.ajax({
		url : URL + 'admincp_consulting/loadRuleServiceType',
		type : 'post',
		dataType : 'json',
		success : function(response) {
			if (response[0] != null) {
				var html = '';
				$.each(response, function(key, value) {
					html += '<option value="' + value.service_type_id + '">' + value.service_type_name + '</option>';
				});
				$('#rule_service_type').append(html);
			}
		},
		complete : function() {
			if (IS_INDEX == 0 && IS_ADD == 1 && IS_EDIT == 0) {
				$('#rule_service_type').on('change', function() {
					RULE_SERVICE_TYPE_ID = $(this).val();
					// console.log(RULE_SERVICE_TYPE_ID);
					$('#rule_group').val('');
					FACT = '';
					loadRuleService();
					loadQuestionList();
				});
			}
		}
	});
}

function loadRuleService() {
	$.ajax({
		url : URL + 'admincp_consulting/loadRuleService',
		type : 'post',
		dataType : 'json',
		data : {
			service_type_id : RULE_SERVICE_TYPE_ID
		},
		success : function(response) {
			var html = '<option value="">Chọn dịch vụ để gợi ý sau khi tư vấn...</option>';
			if (response[0] != null) {
				$.each(response, function(key, value) {
					html += '<option value="' + value.service_id + '">' + value.service_name + '</option>';
				});
				$('#rule_service').html(html);
			} else {
				$('#rule_service').html(html);
			}
		},
		complete : function() {
		}
	});
}

function loadQuestionList() {
	$.ajax({
		url : URL + 'admincp_consulting/loadQuestionList',
		type : 'post',
		dataType : 'json',
		data : {
			service_type_id : RULE_SERVICE_TYPE_ID
		},
		success : function(response) {
			var html = '';
			if (response[0] != null) {
				$.each(response, function(key, value) {
					html += '<div class="question-field">';
					html += '<p class="question">';
					html += value.question_content;
					html += '</p>';
					$.each(value.fact, function(i, item) {
						html += '<p fact-id="' + item.fact_id + '" question-id="' + value.question_id + '" class="fact_group answer pointer">';
						html += '<b>' + item.fact_answer + '</b></p>';
					});
				});
				$('#question_list').html(html);
			} else {
				$('#question_list').html(html);
			}
		},
		complete : function() {
			$('.answer.fact_group').on('click', function() {
				// console.log($(this).attr('fact-id'));
				// console.log($(this).attr('service-type-id'));
				FACT_ID = $(this).attr('fact-id');
				QUESTION_ID = $(this).attr('question-id');
				if (FACT != '') {
					checkFactExist();
				} else if (FACT == '') {
					FACT = FACT_ID;
					$('#rule_group').val(FACT);
				}
				// console.log(FACT_ID);
				// console.log(FACT);
			});
		}
	});
}

function checkFactExist() {
	$.ajax({
		url : URL + 'admincp_consulting/checkFactExist',
		type : 'post',
		// dataType : 'json',
		data : {
			fact : FACT,
			fact_id : FACT_ID,
			question_id : QUESTION_ID
		},
		success : function(response) {
			FACT = response;
			$('#rule_group').val(FACT);
		},
		complete : function() {
			FACT_ID = '';
			QUESTION_ID = '';
		}
	});
}

function saveRule() {
	$('#error_add_consult').fadeOut();
	$('div.done').fadeOut(function() {
		$('div.s-loading').fadeIn(function() {
			var rule_group = $('#rule_group').val();
			var rule_result = $('#rule_result').val();
			var rule_service = $('#rule_service').val();
			if (rule_group == '' || rule_result == '' || rule_service == '') {
				$('#error_add_consult').text('Nhập đầy đủ các trường có (*)');
				$('#error_add_consult').fadeIn(function() {
					$('div.s-loading').fadeOut(function() {
						$('div.done').fadeIn();
					});
				});
			} else {
				$.ajax({
					url : URL + 'admincp_consulting/saveRule',
					type : 'post',
					// dataType : 'json',
					data : {
						rule_group : rule_group,
						rule_result : rule_result,
						rule_service : rule_service
					},
					success : function(response) {
						if (response == 200) {
							alert('Thêm luật thành công');
							jumpToOtherPage(URL + 'admincp_consulting');
						} else {
							$('#error_add_consult').text('Luật đã tồn tại vui lòng chọn lại!');
							$('#error_add_consult').fadeIn(function() {
								$('div.s-loading').fadeOut(function() {
									$('div.done').fadeIn();
								});
							});
						}
					},
					complete : function() {

					}
				});
			}
		});
	});
}
