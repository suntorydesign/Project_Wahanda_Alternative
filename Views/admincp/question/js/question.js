$(document).ready(function() {
	if (IS_INDEX == 1 && IS_ADD == 0 && IS_EDIT == 0) {
		oTable = $('#question_list').dataTable({
			"oLanguage" : {
				"sZeroRecords" : "Không có dữ liệu nào cả.",
				"sSearch": "Tìm kiếm: ",
				"sLengthMenu": "Hiển thị &nbsp;&nbsp; _MENU_ &nbsp;&nbsp; dòng.",
				"sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ dòng.",
				"sInfoEmpty": "Hiển thị 0 đến 0 của 0 dòng."
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

function loadQuestionList(){
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

function returnToQuestion(){
	jumpToOtherPage(URL + 'admincp_question');
}

function addMoreAnswer(){
	var html = '<div class="form-group">';
	html += '<label class="control-label col-md-4">Câu trả lời (*)</label>';
	html += '<div class="col-md-8">';
	html += '<input placeholder="Nhập câu trả lời (*)..." class="form-control question_answer"  name="" type="text"/>';
	html += '</div>';
	html += '</div>';
	$('#answer_field').append(html);
}

function addQuestion(){
	$('.question_answer').each(function(){
		if($(this).val() != ''){
			alert($(this).val());
		}		
	});
}
