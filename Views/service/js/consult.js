$(document).ready(function(){
	$('#consulting_btn').on('click', function() {
		setTimeIdle();
		loadFirstConsultingQuestion();
	});
	$('#consulting_info').on('hide.bs.modal', function() {
		CONSULT_ANSWER = '';
		CONSULT_RESULT = '';
		CONSULT_SUPPOSE = '';
		CONSULT_SERVICE_TYPE = '';
	});
});

/*CONSULTING*/
function loadFirstConsultingQuestion() {
	$.ajax({
		url : URL + 'service/loadFirstConsultingQuestion',
		type : 'post',
		dataType : 'json',
		data : {
			user_id : USER_ID
		},
		success : function(response) {
			var html = '';
			html += '<div class="row">';
			html += '<div class="col-md-12">';
			html += '<span>Hãy chọn dịch vụ của <b>' + response[0].user_business_name + '</b> chúng tôi</span>';
			html += '</div>';
			html += '</div>';
			html += '<br />';
			html += '<div class="row">';
			html += '<div class="col-md-12">';
			$.each(response, function(key, value) {
				html += '<div class="radio">';
				html += '<label>';
				html += '<input type="radio" name="service_type_consult" value="' + value.service_type_id + '">';
				html += value.service_type_name;
				html += '</label>';
				html += '</div>';
			});
			html += '</div>';
			html += '</div>';
			html += '<br />';
			html += '<div class="row">';
			html += '<div class="col-md-12 text-right">';
			html += '<small id="error_answer_consult" style="display: none;color: red"><b>Bạn chưa trả lời! </b></small>';
			html += '<button id="btn_next_step" class="btn btn-orange-black">Tiếp tục <span class="fa fa-arrow-right"></span></button>';
			html += '</div>';
			html += '</div>';
			$('#consulting_info_question').html(html);
		},
		complete : function() {
			$('#consulting_info').modal('show');
			$('input[name="service_type_consult"]').on('click', function() {
				CONSULT_SERVICE_TYPE = $(this).val();
			});
			$('#btn_next_step').on('click', function() {
				if (CONSULT_SERVICE_TYPE == '') {
					$('#error_answer_consult').fadeIn(function() {
						setTimeout(function() {
							$('#error_answer_consult').fadeOut();
						}, 800);
					});
				} else {
					console.log(CONSULT_SERVICE_TYPE);
					loadConsultingQuestion();
				}
			});
		}
	});
}
function loadConsultingQuestion(){
	$.ajax({
		url : URL + 'service/loadConsultingQuestion',
		type : 'post',
		dataType : 'json',
		data : {
			question_service_type_id : CONSULT_SERVICE_TYPE
		},
		success : function(response){
			var count = 0;
			var html = '';
			$.each(response, function(key, value){
				count++;
				if(count == 1){
					html += '<div id="question_' + count + '">';
				}else{
					html += '<div style="display : none;" id="question_' + count + '">';
				}
				html += '<div class="row">';
				html += '<div class="col-md-12">';
				html += '<span>' + key + '</span>';
				html += '</div>';
				html += '</div>';
				html += '<br />';
				html += '<div class="row">';
				html += '<div class="col-md-12">';
				$.each(value, function(i, item){
					html += '<div class="radio">';
					html += '<label>';
					html += '<input type="radio" name="consult_answer" value="' + item.fact_id + '">';
					html += item.fact_answer;
					html += '</label>';
					html += '</div>';
				});
				html += '</div>';
				html += '</div>';
				html += '<br />';
				html += '<div class="row">';
				html += '<div class="col-md-12 text-right">';
				html += '<small id="error_answer_consult" style="display: none;color: red"><b>Bạn chưa trả lời! </b></small>';
				html += '<button class="btn_next_step_question" class="btn btn-orange-black">Tiếp tục <span class="fa fa-arrow-right"></span></button>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
			});
			if(count == 0){
				$('#consulting_info_question').html('<span>Hiện tại chúng tôi chưa có câu hỏi tư vấn cho mục này xin quay lại sau, cám ơn bạn !<span>');
			}else{
				$('#consulting_info_question').html(html);
			}
		},
		complete : function(){
			
		}
	});
}

/*END CONSULTING*/
/*--------------------------*/