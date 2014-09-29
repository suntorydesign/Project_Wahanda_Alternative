$(document).ready(function() {
	loadLocationDetail();
	//$("#comment_form").wysibb();
	$('#write_review').on('click', function() {
		$('#review_input').slideToggle(function() {
			if ($('#review_input').is(":visible")) {
				$('#write_review').text('Đóng');
			} else {
				$('#write_review').text('Viết đánh giá');
			}
		});
	});
	$('textarea#review_form').focusout(function() {
		setTimeIdle();
	});
	$('textarea#review_form').focusin(function() {
		setTimeIdle();
	});
	$('textarea#review_form').keydown(function(event) {
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '32') {
			setTimeIdle();
		}
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
					if (key == 'user_description') {
						$('#user_location_description').html(value);
					}
					if (key == 'user_open_hour') {
						json_user_open_hour = jQuery.parseJSON(value);
						// console.log(json_user_open_hour);
						user_open_hour = '';
						$.each(json_user_open_hour, function(day, hour) {
							switch(day) {
							case '2':
								day = 'Thứ 2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								break;
							case '3':
								day = 'Thứ 3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								break;
							case '4':
								day = 'Thứ 4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								break;
							case '5':
								day = 'Thứ 5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								break;
							case '6':
								day = 'Thứ 6&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								break;
							case '7':
								day = 'Thứ 7&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								break;
							case '8':
								day = 'Chủ Nhật';
								break;
							}
							user_open_hour += '<div class="clearfix" style="padding-top: 10px;">';
							user_open_hour += '<div class="col-lg-offset-1 col-sm-6">';
							user_open_hour += '<span><i>' + day + ' :</i></span>';
							user_open_hour += '</div>';
							// user_open_hour += '<div class="col-sm-1">';
							// user_open_hour += '<span><i>:</i></span>';
							// user_open_hour += '</div>';
							if (hour[0] == 1) {
								user_open_hour += '<div class="col-lg-4">';
								user_open_hour += '<span><i>' + hour[1] + 'h - ' + hour[2] + 'h</i></span>';
								user_open_hour += '</div>';
							} else if (hour[0] == 0) {
								user_open_hour += '<div class="col-lg-4">';
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
	$('div#disallow').show();
	$('#waiting_for_review_load').fadeIn();
	$.ajax({
		url : URL + 'service/loadReview',
		type : 'post',
		dataType : 'json',
		data : {
			review_user_id : USER_ID,
			review_result : REVIEW_RESULT
		},
		beforeSend : function() {

		},
		success : function(response) {
			var html = '<div style="display : none;" id="disallow"></div>';
			html += '<div style="display : none;" id="waiting_for_review_load" class="text-center">' + '<i style="color: #FDBD0E" class="fa fa-2x fa-spin fa-refresh"></i>' + '</div>';
			if (response.data[0] != null) {
				$.each(response.data, function(key, value) {
					html += '<div class="media review_count" >';
					html += '<a class="pull-left" href="#"> <img width="55" height="55" class="media-object" src="' + URL + 'public/assets/img/tp-hcm-thanh-dai-cong-truong-thi-cong-metro-1408499845_490x294.jpg" alt="avatar"> </a>';
					html += '<div class="media-body">';
					var client_join_date = value.client_join_date.substring(0, 10);
					html += '<h5 class="media-heading"><strong>' + value.client_username + '</strong><small class="pull-right"><i>tham gia ' + formatDate(client_join_date) + '&nbsp</i></small></h5>';
					var date_review = new Date(value.user_review_date);
					var current_date = new Date(value.review_current_date);
					var user_date_review;
					if (date_review.getDate() == (current_date.getDate() - 1) && date_review.getMonth() == current_date.getMonth() && date_review.getFullYear() == current_date.getFullYear()) {
						user_date_review = 'Hôm qua';
					} else {
						user_date_review = formatDate(value.user_review_date);
					}
					if (value.user_review_date == value.review_current_date) {
						user_date_review = 'Hôm nay';
					}
					html += '<small style="font-size: 75%;color: #999"><i>Đăng lúc ' + value.user_review_time + ' - ' + user_date_review + '</i></small>';
					if (value.user_review_content.length > 270) {
						html += '<p class="text_after">' + shorten(value.user_review_content, 270) + ' <span><a class="see_more_review" style="cursor : pointer;"> Xem thêm >>></a></span></p>';
						html += '<p style="display : none;" class="text_before">' + value.user_review_content + '</p>';
					} else {
						html += '<p class="text_after">' + value.user_review_content + '</p>';
					}
					html += '</div>';
					html += '</div>';
				});
			}
			if (response.number_result > RESULT_PER_SHOW_MORE) {
				html += '<div onclick="showMoreReview()" id="see_more_review_all" align="center"><span style="display : none;" class="fa fa-spin fa-refresh" id="waiting_for_show_review"></span><span id="text_show_review"> Xem các đánh giá cũ hơn >>></span></div>';
			}
			$('#waiting_for_review_load').fadeOut(function() {
				$('#review_field').html(html);
			});
		},
		complete : function() {
			// setTimeout(function(){
			// loadReview();
			// },60000*2);
			$('#review_field').delegate('.see_more_review', 'click', function() {
				$(this).parent().parent().hide();
				$(this).parent().parent().siblings('.text_before').show();
			});
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
			var html = '';
			if (response.user_review[0] != null) {
				$.each(response.review_type, function(key, value) {
					html += '<div class="row">';
					html += '<div class="col-md-5">';
					html += '<span class="pull-right">' + value.review_name + '</span>';
					html += '</div>';
					html += '<div class="col-md-offset-1 col-md-6">';
					html += '<span class="rating">';
					var star = 0;
					$.each(response.user_review[0], function(key, item) {
						if (key == value.review_field) {
							star = parseInt(item);
							return false;
						}
					});
					for (var i = 1; i <= star; i++) {
						html += '<span data-field="' + value.review_field + '" data-rating="' + i + '" class="fa fa-star choosen rating_text"></span>';
					}
					for (var j = star + 1; j <= 5; j++) {
						html += '<span data-field="' + value.review_field + '" data-rating="' + j + '" class="fa fa-star-o rating_text"></span>';
					}
					html += '</span>';
					html += '</div>';
					html += '</div>';
					if (value.review_id == '1') {
						html += '<hr/>';
					}
				});
				$('#review_form').text(response.user_review[0].user_review_content);
			} else {
				$.each(response.review_type, function(key, value) {
					html += '<div class="row">';
					html += '<div class="col-md-5">';
					html += '<span class="pull-right">' + value.review_name + '</span>';
					html += '</div>';
					html += '<div class="col-md-offset-1 col-md-6">';
					html += '<span class="rating">';
					for (var j = 1; j <= 5; j++) {
						html += '<span data-field="' + value.review_field + '" data-rating="' + j + '" class="fa fa-star-o rating_text"></span>';
					}
					html += '</span>';
					html += '</div>';
					html += '</div>';
					if (value.review_id == '1') {
						html += '<hr/>';
					}
				});
			}
			// html += '<div id="over_all_rating">';
			// html += '<div class="row">';
			// html += '<div class="col-md-5">';
			// html += '<span class="rating_text pull-right">Tổng thể</span>';
			// html += '</div>';
			// html += '<div class="col-md-offset-1 col-md-6">';
			// html += '<span class="rating">';
			// if (response[0].user_review_overall) {
			// for (var i = 0; i < response[0].user_review_overall; i++) {
			// html += '<span class="fa fa-star choosen rating_text"></span>';
			// }
			// for (var j = 0; j < 5 - response[0].user_review_overall; j++) {
			// html += '<span class="fa fa-star-o rating_text"></span>';
			// }
			// } else {
			//
			// }
			// html += '</span>';
			// html += '</div>';
			// html += '</div>';
			// html += '</div>';
			// html += '<hr />';
			// html += '<div id="venue_rating">';
			// html += '<div class="row">';
			// html += '<div class="col-md-5">';
			// html += '<span class="rating_text pull-right">Đánh giá địa điểm</span>';
			// html += '</div>';
			// html += '<div class="col-md-offset-1 col-md-6">&nbsp;</div>';
			// html += '</div>';
			// html += '<br />';
			// $.each(response[0], function(key, value) {
			// if (key != 'user_review_overall' && key != 'user_review_content') {
			// html += '<div class="row">';
			// html += '<div class="col-md-5">';
			// html += '<span class="pull-right">' + key + '</span>';
			// html += '</div>';
			// html += '<div class="col-md-offset-1 col-md-6">';
			// html += '<span class="rating">';
			// for (var i = 0; i < value; i++) {
			// html += '<span class="fa fa-star choosen rating_text"></span>';
			//
			// }
			// for (var j = 0; j < 5 - value; j++) {
			// html += '<span class="fa fa-star-o rating_text"></span>';
			// }
			// html += '</span>';
			// html += '</div>';
			// html += '</div>';
			// }
			// });
			// html += '</div>';
			html += '<hr />';
			$('#review_rating #place_rating').append(html);
		},
		complete : function() {
			$('.fa.rating_text').on('mouseover', function() {
				$(this).removeClass('fa-star-o');
				$(this).addClass('fa-star');
				$(this).prevAll().removeClass('fa-star-o');
				$(this).prevAll().addClass('fa-star');

			}).on('mouseout', function() {
				$(this).removeClass('fa-star');
				$(this).addClass('fa-star-o');
				$(this).siblings().removeClass('fa-star');
				$(this).siblings().addClass('fa-star-o');
				$('.fa.rating_text').each(function() {
					if ($(this).hasClass('choosen')) {
						$(this).removeClass('fa-star-o');
						$(this).addClass('fa-star');
					} else {
						$(this).removeClass('fa-star');
						$(this).addClass('fa-star-o');
					}
				});
			}).on('click', function() {
				$(this).prevAll().removeClass('fa-star-o');
				$(this).prevAll().addClass('fa-star');
				$(this).addClass('fa-star');
				$(this).removeClass('fa-star-o');
				$(this).nextAll().removeClass('fa-star');
				$(this).nextAll().addClass('fa-star-o');
				$(this).siblings().removeClass('choosen');
				$(this).prevAll().addClass('choosen');
				$(this).addClass('choosen');
			});
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
			url : URL + 'service/sendReview',
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
						$('#write_review').text('Viết đánh giá');
						$('#success_review').fadeIn(function() {
							loadReview();
						});
						setTimeout(function() {
							$('#success_review').fadeOut();
						}, 3000);
					});
				} else if ( response = -1) {
					$('#waiting_for_review').fadeOut(function() {
						$('#write_review').text('Viết đánh giá');
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

/*SHOW MORE REVIEW*/
function showMoreReview() {
	$('#text_show_review').fadeOut(function() {
		$('#waiting_for_show_review').fadeIn(function() {
			REVIEW_RESULT++;
			var html = '';
			var number_result;
			$.ajax({
				url : URL + 'service/loadReview',
				type : 'post',
				dataType : 'json',
				data : {
					review_user_id : USER_ID,
					review_result : REVIEW_RESULT
				},
				success : function(response) {
					number_result = response.number_result;
					if (response.data[0] != null) {
						$.each(response.data, function(key, value) {
							html += '<div class="media review_count" >';
							html += '<a class="pull-left" href="#"> <img width="55" height="55" class="media-object" src="' + URL + 'public/assets/img/tp-hcm-thanh-dai-cong-truong-thi-cong-metro-1408499845_490x294.jpg" alt="avatar"> </a>';
							html += '<div class="media-body">';
							var client_join_date = value.client_join_date.substring(0, 10);
							html += '<h5 class="media-heading"><strong>' + value.client_username + '</strong><small class="pull-right"><i>tham gia ' + formatDate(client_join_date) + '&nbsp</i></small></h5>';
							var date_review = new Date(value.user_review_date);
							var current_date = new Date(value.review_current_date);
							var user_date_review;
							if (date_review.getDate() == (current_date.getDate() - 1) && date_review.getMonth() == current_date.getMonth() && date_review.getFullYear() == current_date.getFullYear()) {
								user_date_review = 'Hôm qua';
							} else {
								user_date_review = formatDate(value.user_review_date);
							}
							if (value.user_review_date == value.review_current_date) {
								user_date_review = 'Hôm nay';
							}
							html += '<small style="font-size: 75%;color: #999"><i>Đăng lúc ' + value.user_review_time + ' - ' + user_date_review + '</i></small>';
							if (value.user_review_content.length > 270) {
								html += '<p class="text_after">' + shorten(value.user_review_content, 270) + ' <span><a class="see_more_review" style="cursor : pointer;"> Xem thêm >>></a></span></p>';
								html += '<p style="display : none;" class="text_before">' + value.user_review_content + '</p>';
							} else {
								html += '<p class="text_after">' + value.user_review_content + '</p>';
							}
							html += '</div>';
							html += '</div>';
						});
					}

				},
				complete : function() {
					$('#waiting_for_show_review').fadeOut(function() {
						$('#text_show_review').show();
						$('#review_field .media:last').after(html);
						if ($('.review_count').length == number_result) {
							$('#see_more_review_all').hide();
						}
					});
				}
			});
		});
	});
}

/*END SHOW MORE REVIEW*/
/*-----------------------*/