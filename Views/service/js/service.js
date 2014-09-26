$(document).ready(function() {
	loadLocationDetail();
	//$("#comment_form").wysibb();
	$('#write_review').on('click', function() {
		$('#review_input').slideToggle();
	});
});
/*LOAD LOCATION DETAIL*/
function loadLocationDetail() {
	$.ajax({
		url : URL + 'service/loadLocationDetail',
		type : 'post',
		dataType : 'json',
		data : {
			user_id : USER_ID
		},
		success : function(response) {
			if (response.user[0] != null) {
				$.each(response.user[0], function(key, value) {
					$('#' + key).html(value);
					if (key == 'user_open_hour') {
						json_user_open_hour = jQuery.parseJSON(value);
						// console.log(json_user_open_hour);
						user_open_hour = '';
						$.each(json_user_open_hour, function(day, hour) {
							switch(day) {
							case '2':
								day = 'Thứ 2';
								break;
							case '3':
								day = 'Thứ 3';
								break;
							case '4':
								day = 'Thứ 4';
								break;
							case '5':
								day = 'Thứ 5';
								break;
							case '6':
								day = 'Thứ 6';
								break;
							case '7':
								day = 'Thứ 7';
								break;
							case '8':
								day = 'Chủ Nhật';
								break;
							}
							user_open_hour += '<div class="clearfix" style="padding-top: 10px;">';
							user_open_hour += '<div class="col-sm-offset-1 col-sm-5">';
							user_open_hour += '<span><i>' + day + '</i></span>';
							user_open_hour += '</div>';
							user_open_hour += '<div class="col-sm-1">';
							user_open_hour += '<span><i>:</i></span>';
							user_open_hour += '</div>';
							if (hour[0] == 1) {
								user_open_hour += '<div class="col-sm-4">';
								user_open_hour += '<span><i>' + hour[1] + ' h - ' + hour[2] + ' h</i></span>';
								user_open_hour += '</div>';
							} else if (hour[0] == 0) {
								user_open_hour += '<div class="col-sm-4">';
								user_open_hour += '<span><i>Nghỉ</i></span>';
								user_open_hour += '</div>';
							}
							user_open_hour += '</div>';
						});
						$('#location_open_hour').html(user_open_hour);
					}
				});
			}
			var html = '';
			$.each(response, function(key, value) {
				if (key != 'user') {
					if (value[0] != null) {
						if (key == 'user_service') {
							key = 'DỊCH VỤ NỔI BẬT';
						}
						html += '<div class="one-service" style="margin-bottom: 20px;">';
						html += '<div class="title">' + key + '</div>';
						$.each(value, function(key, item) {
							html += '<div class="divider"></div>';
							html += '<div class="item clearfix">';
							html += '<div class="col-sm-5 item-info-1">' + item.user_service_name + '</div>';
							html += '<div class="col-sm-3 item-info-2"><i class="fa fa-clock-o text-orange"></i> ' + item.user_service_duration + ' phút</div>';
							html += '<div class="col-sm-2 item-info-3"><i class="fa fa-arrow-down text-orange"></i> ' + Math.floor((item.user_service_full_price - item.user_service_sale_price) / item.user_service_full_price * 100) + '%</div>';
							html += '<div class="col-sm-2 item-info-4">';
							html += '<button data-user-service="' + item.user_service_id + '" type="button" class="btn btn-sm btn-orange btn_location_booking"><i class="fa fa-dollar text-white"></i> ' + item.user_service_sale_price + ' đ <i style="display:none;" class="waiting_booking_detail fa fa-refresh fa-spin"></i></button>';
							html += '</div>';
							html += '</div>';
						});
						html += '</div>';
					}
				}
			});
			$('#location_service').html(html);
		},
		complete : function() {
			loadPersonReview();
			loadReview();
			$('.btn_location_booking').on('click', function(e) {
				$(this).find('i.waiting_booking_detail').fadeIn();
				USER_SERVICE_ID = $(this).attr('data-user-service');
				// console.log(USER_SERVICE_ID);
				loadServiceDetail(USER_SERVICE_ID);
			});
		}
	});
}

/*END LOAD LOCATION DETAIL*/
/*-----------------------*/

/*LOAD REVIEW*/
function loadReview() {
	$.ajax({
		url : URL + 'service/loadReview',
		type : 'post',
		dataType : 'json',
		data : {
			review_user_id : USER_ID
		},
		success : function(response) {
			var html = '';
			if (response[0] != null) {
				$.each(response, function(key, value) {
					html += '<div class="media" >';
					html += '<a class="pull-left" href="#"> <img width="55" height="55" class="media-object" src="' + URL + 'public/assets/img/tp-hcm-thanh-dai-cong-truong-thi-cong-metro-1408499845_490x294.jpg" alt="avatar"> </a>';
					html += '<div class="media-body">';
					html += '<h5 class="media-heading"><strong>' + value.client_username + '</strong><small class="pull-right"><i>tham gia ' + value.client_join_date + '&nbsp</i></small></h5>';
					html += '<small style="font-size: 75%;color: #999"><i>Đăng lúc ' + value.user_review_time + ' - ' + value.user_review_date + '</i></small>';
					if(value.user_review_content.length > 170){
						html += '<p id="text_after">' + shorten(value.user_review_content, 170) + ' <span><a id="see_more_review" style="cursor : pointer;"> Xem thêm >>></a></span></p>';
					}else{
						html += '<p id="text_after">' + value.user_review_content + '</p>';
					}			
					html += '<p style="display : none;" id="text_before">' + value.user_review_content + '</p>';
					html += '</div>';
					html += '</div>';
				});
			}
			$('#waiting_for_review_load').fadeOut(function(){
				$('#review_field').html(html);
			});
		},
		complete : function() {
			
		}
	});
}

/*END LOAD REVIEW*/
/*-----------------------*/

/*LOAD REVIEW*/
function loadPersonReview() {
	$.ajax({
		url : URL + 'service/loadPersonReview',
		type : 'post',
		dataType : 'json',
		data : {
			review_user_id : USER_ID
		},
		success : function(response) {
			if (response[0] != null) {
				$('#review_form').text(response[0].user_review_content);
			}
		},
		complete : function() {

		}
	});
}

/*END LOAD REVIEW*/
/*-----------------------*/

/*SEND REVIEW*/
function sendReview() {
	if (($('#review_form').val()).length < 10) {
		$('#review_form').css('border', '#C10000 solid 2px');
		setTimeout(function() {
			$('#review_form').css('border', '#CCC solid 1px');
			setTimeout(function() {
				$('#review_form').css('border', '#C10000 solid 2px');
				setTimeout(function() {
					$('#review_form').css('border', '#CCC solid 1px');
					setTimeout(function() {
						$('#review_form').css('border', '#C10000 solid 2px');
						setTimeout(function() {
							$('#review_form').css('border', '#CCC solid 1px');
						}, 100);
					}, 100);
				}, 100);
			}, 100);
		}, 100);
	} else {
		$('#waiting_for_review').fadeIn();
		$.ajax({
			url : URL + 'service/sendreview',
			type : 'post',
			dataType : 'json',
			data : {
				review_content : $('#review_form').val(),
				review_user_id : USER_ID
			},
			success : function(response) {
				if (response == 200) {
					$('#waiting_for_review').fadeOut(function() {
						$('#review_input').slideUp();
						$('#success_review').fadeIn();
						setTimeout(function() {
							$('#success_review').fadeOut();
						}, 1000);
					});
				} else if ( response = -1) {
					$('#waiting_for_review').fadeOut(function() {
						$('#error_review').fadeIn();
					});
					setTimeout(function() {
						$('#error_review').fadeOut();
					}, 8000);
				}
			},
			complete : function() {
				$('#waiting_for_review').fadeOut();
			}
		});
	}
}

/*END SEND REVIEW*/
/*-----------------------*/