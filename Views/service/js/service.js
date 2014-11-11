$(document).ready(function() {
	var map;
	var geocoder;
	var marker;
	loadLocationDetail();
	loadLocationStarRating();
	loadServiceStarRating();
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
					if (key == 'user_long') {
						LNG = value;
					}
					if (key == 'user_lat') {
						LAT = value;
					}
					if (key == 'user_description') {
						$('#user_location_description').html(value);
					}
					if (key == 'user_slide') {
						$('#' + key).attr('src', value);
					}
					if (key == 'user_logo') {
						$('#' + key).attr('src', value);
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
							user_open_hour += '<div class="col-sm-offset-1 col-sm-6">';
							user_open_hour += '<span>' + day + ' :</span>';
							user_open_hour += '</div>';
							// user_open_hour += '<div class="col-sm-1">';
							// user_open_hour += '<span><i>:</i></span>';
							// user_open_hour += '</div>';
							if (hour[0] == 1) {
								user_open_hour += '<div class="col-sm-5">';
								if (hour[1] <= 12) {
									if (hour[1] <= 9) {
										hours_1 = '0' + hour[1] + 'am';
									} else {
										hours_1 = hour[1] + 'am';
									}
								} else {
									hours_1 = hour[1] + 'pm';
								}
								if (hour[2] <= 12) {
									if (hour[2] <= 9) {
										hours_2 = '0' + hour[2] + 'am';
									} else {
										hours_2 = hour[2] + 'am';
									}
								} else {
									hours_2 = hour[2] + 'pm';
								}
								user_open_hour += '<span>' + hours_1 + ' - ' + hours_2 + '</span>';
								user_open_hour += '</div>';
							} else if (hour[0] == 0) {
								user_open_hour += '<div class="col-sm-5">';
								user_open_hour += '<span><b>Nghỉ</b></span>';
								user_open_hour += '</div>';
							}
							user_open_hour += '</div>';
						});
						$('#location_open_hour').html(user_open_hour);
						if (response.array_voucher.appointment == 0) {
							$('#use_appointment').show();
							$('#use_appointment_2').show();
							$('#use_appointment_3').hide();
						}
						if (response.array_voucher.evoucher == 0) {
							$('#use_e_voucher').show();
							$('#use_e_voucher_2').show();
							$('#use_e_voucher_3').hide();
						}
						if (response.array_voucher.gift_voucher == 0) {
							$('#use_gift_voucher').show();
							$('#use_gift_voucher_2').show();
							$('#use_gift_voucher_3').hide();
						}

					}
				});
			}
			var html = '';
			var title = 1;
			$.each(response, function(key, value) {
				if (key != 'user') {
					if (value[0] != null) {
						if (key == 'user_service') {
							key = 'DỊCH VỤ NỔI BẬT';
						}
						html += '<div class="one-service" style="margin-bottom: 20px;">';
						html += '<div style="font-size: 16px;" class="title">' + key + '</div>';
						var index = 0;
						var title_class = 'show_' + title + '_more';
						var title_class_text = 'show_' + title + '_more_text';
						$.each(value, function(i, item) {
							if (index == 3) {
								html += '<div style="display: none;" class=' + title_class + '>';
							}
							html += '<div class="divider"></div>';
							html += '<div class="item clearfix">';
							html += '<div title="' + item.user_service_name + '" style="cursor: help;" class="col-sm-5 item-info-1">' + shorten(item.user_service_name, 36) + '</div>';
							html += '<div class="col-sm-2 item-info-2"><span class="fa-stack"><i></i><i class="fa fa-stack-2x fa-clock-o text-orange"></i></span> ' + item.user_service_duration + ' phút</div>';
							html += '<div class="col-sm-2 item-info-3"><span class="fa-stack"><i class="fa fa-certificate fa-stack-2x text-orange"></i><i class="fa fa-stack-1x text-white"><b>%</b></i></span> ' + Math.floor((item.user_service_full_price - item.user_service_sale_price) / item.user_service_full_price * 100) + '%</div>';
							html += '<div class="col-sm-3 item-info-4">';
							html += '<button data-user-service="' + item.user_service_id + '" type="button" class="btn btn-sm btn-orange btn_location_booking pull-right"><i style="display:none;" class="waiting_booking_detail fa fa-refresh fa-spin"></i> <i class="fa fa-lg fa-dollar text-white"></i> <span style="font-weight: bold;" class="text-white">' + item.user_service_sale_price + ' đ</span></button>';
							html += '</div>';
							html += '</div>';
							index++;
						});
						if (index > 3) {
							html += '</div>';
							html += '<div class="divider"></div>';
							html += '<button class="btn btn-orange" onclick=showMore("' + title_class + '","' + title_class_text + '")><span class=' + title_class_text + '>Xem thêm</span> ' + (index - 3) + ' dịch vụ</button>';
						}
						html += '</div>';
					}
					title++;
				}
			});
			$('#location_service').html(html);
		},
		complete : function() {
			loadPersonReview();
			loadReview();
			// initialize();
			var map;
			initGoogleMap('map-canvas', LAT, LNG);
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

/*LOAD LOCATION RATING*/
function loadLocationStarRating() {
	$('#disallow-star-place').show();
	$('#waiting_for_star_rating').fadeIn();
	$.ajax({
		url : URL + 'service/loadLocationStarRating',
		type : 'post',
		dataType : 'json',
		data : {
			user_id : USER_ID
		},
		success : function(response) {
			if (response.general_info[0] != null) {
				var html = '';
				var rating_value = parseFloat(response.general_info[0].star_review);
				var head = parseInt(rating_value);
				var tail = rating_value - head;
				tail = Math.round(tail * 100) / 100;
				var round_tail = tail * 10;
				// console.log(rating_value);
				// console.log(head);
				// console.log(tail);
				html += '<div class="col-xs-6"><span class="text-orange pull-left rating-point-1">' + head + '.' + round_tail + '</span>';
				html += '</div>';
				html += '<div class="col-xs-6 rating-point-2" align="center">';
				html += '<span>Điểm đánh giá</span>';
				html += '<div class="rating">';
				for (var i = 1; i <= head; i++) {
					html += '<i class="fa fa-star"></i>';
				}
				if (tail != 0) {
					if (tail == 0.9) {
						html += '<i class="fa fa-star"></i>';
					} else if (tail == 0.2 || tail == 0.3 || tail == 0.4 || tail == 0.5 || tail == 0.6 || tail == 0.7 || tail == 0.8) {
						html += '<i class="fa fa-star-half-empty"></i>';
					} else if (tail == 0.1) {
						html += '<i class="fa fa fa-star-o"></i>';
					}
					for (var j = head + 2; j <= 5; j++) {
						html += '<i class="fa fa-star-o"></i>';
					}
				} else {
					for (var j = head + 1; j <= 5; j++) {
						html += '<i class="fa fa-star-o"></i>';
					}
				}
				html += '</div>';
				html += '<span >' + response.general_info[0].client_amount + ' Lượt đánh giá</span>';
				html += '</div>';
				html += '';
				$('#place_star_rating #user_review_overall').html(html);
			}
			if (response.data[0] != null) {
				var html_2 = '';
				// console.log(rating_value);
				// console.log(head);
				// console.log(tail);
				$.each(response.data, function(key, value) {
					var rating_value = parseFloat(value.star_review);
					var head = parseInt(rating_value);
					var tail = rating_value - head;
					tail = Math.round(tail * 100) / 100;
					// console.log(value.star_review);
					html_2 += '<div class="col-xs-6" style="margin-bottom: 10px">';
					html_2 += '<small class="pull-right">' + value.review_name + '</small></div>';
					html_2 += '<div class="col-xs-6">';
					html_2 += '<div class="rating pull-left">';
					for (var i = 1; i <= head; i++) {
						html_2 += '<i class="fa fa-star"></i>';
					}
					if (tail != 0) {
						if (tail == 0.9) {
							html_2 += '<i class="fa fa-star"></i>';
						} else if (tail == 0.2 || tail == 0.3 || tail == 0.4 || tail == 0.5 || tail == 0.6 || tail == 0.7 || tail == 0.8) {
							html_2 += '<i class="fa fa-star-half-empty"></i>';
						} else if (tail == 0.1) {
							html_2 += '<i class="fa fa fa-star-o"></i>';
						}
						for (var j = head + 2; j <= 5; j++) {
							html_2 += '<i class="fa fa-star-o"></i>';
						}
					} else {
						for (var j = head + 1; j <= 5; j++) {
							html_2 += '<i class="fa fa-star-o"></i>';
						}
					}
					html_2 += '</div>';
					html_2 += '</div>';
					html_2 += '<div class="clearfix"></div>';
				});
				//console.log(html_2);
				$('#place_star_rating #user_review_properties').html(html_2);
			}
		},
		complete : function() {
			$('#disallow-star-place').hide();
			$('#waiting_for_star_rating').fadeOut();
		}
	});
}

/*END LOAD LOCATION RATING*/
/*-----------------------*/

/*LOAD SERVICE RATING*/
function loadServiceStarRating() {
	$('#disallow-star-service').show();
	$('#waiting_for_star_rating_service').fadeIn();
	$.ajax({
		url : URL + 'service/loadServiceStarRating',
		type : 'post',
		dataType : 'json',
		data : {
			user_id : USER_ID
		},
		success : function(response) {
			if (response.data[0] != null) {
				var html = '';
				var index = 0;
				$.each(response.data, function(key, value) {
					index++;
					var rating_value = parseFloat(value.star_review);
					var head = parseInt(rating_value);
					var tail = rating_value - head;
					tail = Math.round(tail * 100) / 100;
					// console.log(value.star_review);
					if (index > 4) {
						html += '<div style="display: none;margin-bottom: 10px;" class="col-xs-6 see_more_rating_service">';
					} else {
						html += '<div class="col-xs-6"  style="margin-bottom: 10px">';
					}
					html += '<small style="cursor: help;" title="' + value.user_service_name + '" class="pull-right">' + shorten(value.user_service_name, 18) + '</small></div>';
					if (index > 4) {
						html += '<div style="display: none;" class="col-xs-6 see_more_rating_service">';
					} else {
						html += '<div class="col-xs-6">';
					}
					html += '<div class="rating pull-left">';
					for (var i = 1; i <= head; i++) {
						html += '<i class="fa fa-star"></i>';
					}
					if (tail != 0) {
						if (tail == 0.9) {
							html += '<i class="fa fa-star"></i>';
						} else if (tail == 0.2 || tail == 0.3 || tail == 0.4 || tail == 0.5 || tail == 0.6 || tail == 0.7 || tail == 0.8) {
							html += '<i class="fa fa-star-half-empty"></i>';
						} else if (tail == 0.1) {
							html += '<i class="fa fa fa-star-o"></i>';
						}
						for (var j = head + 2; j <= 5; j++) {
							html += '<i class="fa fa-star-o"></i>';
						}
					} else {
						for (var j = head + 1; j <= 5; j++) {
							html += '<i class="fa fa-star-o"></i>';
						}
					}
					html += '</div>';
					html += '</div>';
					html += '<div class="clearfix"></div>';
				});
				if (index > 4) {
					html += '<div  style="margin-bottom: 8px" class="col-xs-12 text-center"><a onclick=showMore("see_more_rating_service","see_more_text") style="cursor: pointer;"><small><span class="see_more_text">Xem thêm</span> ' + (index - 4) + ' dịch vụ</small><a></div>';
				}
			}
			// console.log(html);
			$('#user_service_review').html(html);
		},
		complete : function() {
			$('#disallow-star-service').hide();
			$('#waiting_for_star_rating_service').fadeOut();
		}
	});
}

/*END LOAD SERVICE RATING*/
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
			if (parseInt(response.number_result) > RESULT_PER_SHOW_MORE) {
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

/*LOAD PERSONAL REVIEW*/
function loadPersonReview() {
	if (USERNAME != '') {
		$.ajax({
			url : URL + 'service/loadPersonReview',
			type : 'post',
			dataType : 'json',
			data : {
				review_user_id : USER_ID
			},
			success : function(response) {
				var html = '';
				var html_2 = '';
				if (response.user_review[0] != null) {
					$.each(response.review_type, function(key, value) {
						html += '<div class="row">';
						html += '<div class="col-md-5">';
						html += '<span class="pull-right">' + shorten(value.review_name, 270) + '</span>';
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
				}
				if (response.user_service_review[0] != null) {
					$.each(response.user_service_review, function(key, value) {
						html_2 += '<div class="row">';
						html_2 += '<div class="col-md-5">';
						html_2 += '<span class="pull-right">' + shorten(value.user_service_name, 35) + '</span>';
						html_2 += '</div>';
						html_2 += '<div class="col-md-offset-1 col-md-6">';
						html_2 += '<span class="rating">';
						var star = parseInt(value.user_service_review_value);
						for (var i = 1; i <= star; i++) {
							html_2 += '<span data-service-id="' + value.user_service_id + '" data-rating="' + i + '" class="fa fa-star choosen rating_service"></span>';
						}
						for (var j = star + 1; j <= 5; j++) {
							html_2 += '<span data-service-id="' + value.user_service_id + '" data-rating="' + j + '" class="fa fa-star-o rating_service"></span>';
						}
						html_2 += '</span>';
						html_2 += '</div>';
						html_2 += '</div>';
					});
					html_2 += '<hr/>';
				}
				$('#review_rating #place_rating').append(html);
				$('#review_rating #service_rating').append(html_2);
				// else {
				// $.each(response.review_type, function(key, value) {
				// html += '<div class="row">';
				// html += '<div class="col-md-5">';
				// html += '<span class="pull-right">' + value.review_name + '</span>';
				// html += '</div>';
				// html += '<div class="col-md-offset-1 col-md-6">';
				// html += '<span class="rating">';
				// for (var j = 1; j <= 5; j++) {
				// html += '<span data-field="' + value.review_field + '" data-rating="' + j + '" class="fa fa-star-o rating_text"></span>';
				// }
				// html += '</span>';
				// html += '</div>';
				// html += '</div>';
				// if (value.review_id == '1') {
				// html += '<hr/>';
				// }
				// });
				// }
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
					// console.log($(this).attr('data-rating'));
					// console.log($(this).attr('data-field'));
					sendRating($(this).attr('data-field'), $(this).attr('data-rating'));
				});
				$('.fa.rating_service').on('mouseover', function() {
					$(this).removeClass('fa-star-o');
					$(this).addClass('fa-star');
					$(this).prevAll().removeClass('fa-star-o');
					$(this).prevAll().addClass('fa-star');

				}).on('mouseout', function() {
					$(this).removeClass('fa-star');
					$(this).addClass('fa-star-o');
					$(this).siblings().removeClass('fa-star');
					$(this).siblings().addClass('fa-star-o');
					$('.fa.rating_service').each(function() {
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
					// console.log($(this).attr('data-service-id'));
					// console.log($(this).attr('data-rating'));
					sendServiceRating($(this).attr('data-service-id'), $(this).attr('data-rating'));
				});
			}
		});
	}
}

/*END LOAD PERSONAL REVIEW*/
/*-----------------------*/

/*SEND RATING*/
function sendRating(field, rating_value) {
	$.ajax({
		url : URL + 'service/sendRating',
		type : 'post',
		dataType : 'json',
		data : {
			review_user_id : USER_ID,
			field : field,
			rating_value : rating_value
		},
		success : function(response) {
			if (response != 200) {
				$('#error_review').fadeIn(function() {
					setTimeout(function() {
						$('#error_review').fadeOut();
					}, 8000);
				});
			}
		}
	});
}

/*END SEND RATING*/
/*-----------------------*/

/*SEND SERVICE RATING*/
function sendServiceRating(service_id, rating_value) {
	$.ajax({
		url : URL + 'service/sendServiceRating',
		type : 'post',
		dataType : 'json',
		data : {
			user_service_id : service_id,
			user_service_review_value : rating_value
		},
		success : function(response) {
			if (response != 200) {
				$('#error_review').fadeIn(function() {
					setTimeout(function() {
						$('#error_review').fadeOut();
					}, 8000);
				});
			}
		}
	});
}

/*END SEND SERVICE RATING*/
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

/*INIT GOOGLE MAP*/
// function initialize() {
	// var directionsDisplay = new google.maps.DirectionsRenderer();
	// geocoder = new google.maps.Geocoder();
	// //default position these function in google map
	// var mapOptions = {
		// zoom : 16,
		// center : new google.maps.LatLng(0, 0),
		// panControl : false,
		// zoomControl : true,
		// zoomControlOptions : {
			// style : google.maps.ZoomControlStyle.SMALL,
			// // position : google.maps.ControlPosition.LEFT_CENTER
		// },
		// mapTypeControl : false,
		// scaleControl : false,
		// streetViewControl : false,
		// overviewMapControl : false,
		// rotateControl : false
	// };
	// // console.log(LAT);
	// map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	// directionsDisplay.setMap(map);
	// initialLocation = new google.maps.LatLng(LAT, LNG);
	// map.setCenter(initialLocation);
	// marker = new google.maps.Marker({
		// position : new google.maps.LatLng(LAT, LNG),
		// map : map,
	// });
// }

/*END INIT GOOGLE MAP*/
/*-----------------------*/