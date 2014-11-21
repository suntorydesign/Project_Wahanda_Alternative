$(document).ready(function() {
	$('#consulting_btn').on('click', function() {
		setTimeIdle();
		loadFirstConsultingQuestion();
	});
	$('#consulting_info').on('hide.bs.modal', function() {
		CONSULT_ANSWER = '';
		CONSULT_RESULT = '';
		CONSULT_SUPPOSE = '';
		CONSULT_SERVICE_TYPE = '';
		QUESTION_NUMBER = 1;
		CONSULT_SERVICE_TYPE_NAME = '';
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
				CONSULT_SERVICE_TYPE_NAME = $(this).parent().text();
			});
			$('#btn_next_step').on('click', function() {
				if (CONSULT_SERVICE_TYPE == '') {
					$('#error_answer_consult').fadeIn(function() {
						setTimeout(function() {
							$('#error_answer_consult').fadeOut();
						}, 800);
					});
				} else {
					// console.log(CONSULT_SERVICE_TYPE);
					loadConsultingQuestion();
				}
			});
		}
	});
}

function loadConsultingQuestion() {
	$.ajax({
		url : URL + 'service/loadConsultingQuestion',
		type : 'post',
		dataType : 'json',
		data : {
			question_service_type_id : CONSULT_SERVICE_TYPE
		},
		success : function(response) {
			var count = 0;
			var html = '';
			$.each(response, function(key, value) {
				count++;
				if (count == 1) {
					html += '<div id="question_' + count + '">';
				} else {
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
				$.each(value, function(i, item) {
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
				html += '<small class="error_answer_consult_cls" style="display: none;color: red"><b>Bạn chưa trả lời! </b></small>';
				html += '<button class="btn_next_step_question btn btn-orange-black">Tiếp tục <span class="fa fa-arrow-right"></span></button>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
			});
			if (count == 0) {
				$('#consulting_info_question').html('<span>Hiện tại chúng tôi chưa có câu hỏi tư vấn cho mục này xin quay lại sau, cám ơn bạn !<span>');
			} else {
				$('#consulting_info_question').html(html);
			}
		},
		complete : function() {
			$('input[name="consult_answer"]').on('click', function() {
				CONSULT_ANSWER = $(this).val();
			});
			$('.btn_next_step_question').on('click', function() {
				if (CONSULT_ANSWER == '') {
					$('.error_answer_consult_cls').fadeIn(function() {
						setTimeout(function() {
							$('.error_answer_consult_cls').fadeOut();
						}, 800);
					});
				} else {
					// console.log(CONSULT_ANSWER);
					consulting();
				}
			});
		}
	});
}

function consulting() {
	$.ajax({
		url : URL + 'service/consulting',
		type : 'post',
		dataType : 'json',
		data : {
			fact_id : CONSULT_ANSWER
		},
		success : function(response) {
			if (response[0] == null) {
				QUESTION_NUMBER++;
				// console.log(response);
				$('#question_' + QUESTION_NUMBER).siblings().hide();
				$('#question_' + QUESTION_NUMBER).show();
				if ($('#question_' + QUESTION_NUMBER).length == 0) {
					var error_html = '<h4><b><u>Kết Quả</u></b></h4><span style="color: #777">Xin lỗi chúng tôi không thể tư vấn cho bạn được, bạn hãy sử dụng dịch vụ và sẽ được tư vấn bởi các các chuyên gia về <b><i>' + CONSULT_SERVICE_TYPE_NAME + '</i></b>&nbsp;&nbsp;tại địa điểm của chúng tôi</span>';
					$('#consulting_info_question').html(error_html);
				}
			} else {
				RULE_SERVICE_ID = response[0].rule_service_id;
				var result_html = '<h4><b><u>Kết Quả</u></b></h4><span class="text-center" style="color: #3c763d;"><i>' + response[0].rule_result + '</i></span>';
				$('#consulting_info_question').html(result_html);
				loadAdviseService();
			}
		},
		complete : function() {
			CONSULT_ANSWER = '';
		}
	});
}

function loadAdviseService() {
	var html = '<h4 class="text-center"><b><u>Các Dịch Vụ Gợi Ý Cho Bạn</u></b></h4>';
	$.ajax({
		url : URL + 'service/loadAdviseService',
		type : 'post',
		dataType : 'json',
		data : {
			user_id : USER_ID,
			service_id : RULE_SERVICE_ID
		},
		success : function(response) {
			if(response[0] == null){
				html += '<span class="text-center" style="color: #912323;"><i>Xin lỗi chúng tôi không có dịch vụ gợi ý cho bạn.</i></span>';
			}else{
				$.each(response, function(i, item) {
					html += '<div class="price-consult clearfix">';
					html += '<div title="' + item.user_service_name + '" style="cursor: help;" class="col-sm-5 item-info-1 text-orange"><b>' + shorten(item.user_service_name, 40) + '</b></div>';
					html += '<div class="col-sm-2 item-info-2"><span class="fa-stack"><i></i><i class="fa fa-stack-2x fa-clock-o text-orange"></i></span> <b>' + item.user_service_duration + ' phút</b></div>';
					html += '<div class="col-sm-2 item-info-3"><span class="fa-stack"><i class="fa fa-certificate fa-stack-2x text-orange"></i><i class="fa fa-stack-1x text-white"><b>%</b></i></span><b> ' + Math.floor((item.user_service_full_price - item.user_service_sale_price) / item.user_service_full_price * 100) + '%</b></div>';
					html += '<div class="col-sm-3 item-info-4">';
					html += '<button data-user-service="' + item.user_service_id + '" type="button" class="btn btn-sm btn-orange btn_location_booking pull-right"><i style="display:none;" class="waiting_booking_detail fa fa-refresh fa-spin"></i> <i class="fa fa-lg fa-dollar text-white"></i> <span style="font-weight: bold; color: white" class="text-white">' + item.user_service_sale_price + ' đ</span></button>';
					html += '</div>';
					html += '</div>';
				});
			}
			$('#consulting_info_question').append(html);		
		},
		complete : function() {
			$('.btn_location_booking').on('click', function(e) {
				$(this).find('i.waiting_booking_detail').fadeIn();
				USER_SERVICE_ID = $(this).attr('data-user-service');
				// console.log(USER_SERVICE_ID);
				loadServiceDetail(USER_SERVICE_ID);
			});
		}
	});
}

/*END CONSULTING*/
/*--------------------------*/