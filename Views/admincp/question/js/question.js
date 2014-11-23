$(document).ready(function() {
	if (IS_INDEX == 1 && IS_ADD == 0 && IS_EDIT == 0) {
		oTable = $('#question_list').dataTable({
			"oLanguage" : {
				"sZeroRecords" : "Không có dữ liệu nào cả.",
				"sSearch" : "Tìm kiếm: ",
				"sLengthMenu" : "Hiển thị &nbsp;&nbsp; _MENU_ &nbsp;&nbsp; dòng.",
				"sInfo" : "Hiển thị _START_ đến _END_ của _TOTAL_ dòng.",
				"sInfoEmpty" : "Hiển thị 0 đến 0 của 0 dòng."
			}
		});
		loadServiceTypeList();
	}
	if (IS_INDEX == 0 && IS_ADD == 1 && IS_EDIT == 0) {
		loadServiceTypeList();
	}
});

function loadServiceTypeList() {
	$.ajax({
		url : URL + 'admincp_question/loadServiceTypeList',
		type : 'post',
		dataType : 'json',
		success : function(response) {
			if (response[0] != null) {
				var html = '';
				$.each(response, function(key, value) {
					html += '<option value="' + value.service_type_id + '">' + value.service_type_name + '</option>';
				});
				$('#question_service_type_id').append(html);
			}
		},
		complete : function() {
			if (IS_INDEX == 1 && IS_ADD == 0 && IS_EDIT == 0) {
				$('#question_service_type_id').on('change', function() {
					SERVICE_TYPE_ID = $(this).val();
					loadQuestionList();
				});
			}
		}
	});
}

function loadQuestionList() {
	$.ajax({
		url : URL + 'admincp_question/loadQuestionList',
		type : 'post',
		dataType : 'json',
		data : {
			service_type_id : SERVICE_TYPE_ID,
		},
		success : function(response) {
			if (response[0] != null) {
				oTable.fnClearTable();
				oTable.fnAddData(response);
			} else {
				oTable.fnClearTable();
				oTable.fnAddData(response);
			}
		},
		complete : function() {
		}
	});
}

function addQuestionDetail() {
	jumpToOtherPage(URL + 'admincp_question/addQuestionDetail');
}

function returnToQuestion() {
	jumpToOtherPage(URL + 'admincp_question');
}

function addMoreAnswer() {
	var html = '<div class="form-group">';
	html += '<label class="control-label col-md-4">Câu trả lời</label>';
	html += '<div class="col-md-8">';
	html += '<input placeholder="Nhập câu trả lời..." class="form-control question_answer"  name="" type="text"/>';
	html += '</div>';
	html += '</div>';
	$('#answer_field').append(html);
}

function addQuestion() {
	$('div.done').fadeOut(function() {
		$('div.s-loading').fadeIn(function() {
			var count_answer = 0;
			var question_answer = '';
			$('.question_answer').each(function() {
				if ($(this).val() != '') {
					if (question_answer == '') {
						question_answer = $(this).val();
					} else {
						question_answer += ',' + $(this).val();
					}
					count_answer++;
				}
			});
			var question_service_type_id = $('#question_service_type_id').val();
			var question_content = $('#question_content').val();
			if (question_service_type_id == '' || question_content == '') {
				$('#error_add_question').text('Nhập đầy đủ các trường có (*).');
				$('#error_add_question').fadeIn(function() {
					$('div.s-loading').fadeOut(function() {
						$('div.done').fadeIn();
					});
				});
			} else {
				if (count_answer < 2) {
					$('#error_add_question').text('Phải có ít nhất 2 câu trả lời.');
					$('#error_add_question').fadeIn(function() {
						$('div.s-loading').fadeOut(function() {
							$('div.done').fadeIn();
						});
					});
				} else {
					$('#error_add_question').fadeOut(function() {
						$('div.s-loading').fadeOut(function() {
							$('div.done').fadeIn(function() {
								$.ajax({
									url : URL + 'admincp_question/addQuestion',
									type : 'post',
									// dataType : 'json',
									data : {
										question_answer : question_answer,
										question_service_type_id : question_service_type_id,
										question_content : question_content
									},
									success : function(response){
										if(response == 200){
											alert('Thêm thành công !');
											jumpToOtherPage(URL + 'admincp_question');
										}else{
											alert('Thêm thất bại !');
										}
									},
									complete : function(){
										
									}
								});
							});
						});
					});
				}
			}
		});
	});

}
