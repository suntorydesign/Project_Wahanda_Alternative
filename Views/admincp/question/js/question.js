$(document).ready(function() {
	if (IS_INDEX == 1 && IS_ADD == 0 && IS_EDIT == 0) {
		oTable = $('#question_list').dataTable();
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
