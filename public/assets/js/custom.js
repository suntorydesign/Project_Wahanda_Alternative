$(document).ready(function() {
	$('#user_description_see_more').on('click', function() {
		$('#user_description').css({
			'white-space' : 'normal',
			'overflow' : 'auto'
		});
		$(this).hide();
	});
	$('#service_detail').on('hide.bs.modal', function() {
		CHOOSEN_DATE = '';
		CHOOSEN_DATE_STORE = '';
		CHOOSEN_TIME = '';
		CHOOSEN_PRICE = '';
		WEEK_PAGE = 1;
		$('#user_description').css({
			'white-space' : 'nowrap',
			'overflow' : 'hidden',
		});
		$('#user_description_see_more').show();
	});
});
/*LOAD DISTRICT*/
function loadDistrict() {
	$.ajax({
		url : URL + 'index/loadDistrict',
		type : 'post',
		dataType : 'json',
		success : function(response) {
			if (response[0] != null) {
				var html = '';
				$.each(response, function(key, value) {
					html += '<option value="' + value.district_id + '">' + value.district_name + '</option>';
				});
				$('#district_field').append(html);
			}
		}
	});
}

/*END LOAD DISTRICT*/
/*-----------------------*/

/*LOAD TOP SERVICE LIST*/
function loadTopServiceList() {
	$.ajax({
		url : URL + 'index/loadTopServiceList',
		type : 'post',
		dataType : 'json',
		success : function(response) {
			//console.log(response);
			// console.log(CHOOSEN_DATE);
			// console.log(CHOOSEN_TIME);
			// console.log(CHOOSEN_PRICE);
			// console.log(USER_SERVICE_ID);

			var html = '';
			$.each(response, function(key, value) {
				var rating_value = parseFloat(value.star_review);
				var head = parseInt(rating_value);
				var tail = rating_value - head;
				html += '<div class="col-sm-6 col-md-4 top_service_items" style="display : none;">';
				html += '<div class="item">';
				html += '<input class="user_service_id" name="user_service_id" type="hidden" value="' + value.user_service_id + '"/>';
				html += '<p align="center" class="name">';
				html += value.user_service_name.toUpperCase();
				html += '</p>';
				html += '<div class="clearfix svl-01">';
				html += '<span class="rating pull-left">';
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
				var image_detail = value.user_service_image.split(',');
				html += '</span>';
				html += '<span class="count-rating pull-right">';
				html += value.total_client_amount + ' lượt bình chọn';
				html += '</span>';
				html += '</div>';
				html += '<div class="image" class="clearfix">';
				html += '<img style="width: 100%; min-height: 200px; max-height: 200px" class="img-responsive" alt="Responsive image" src="' + image_detail[0] + '" />';
				html += '</div>';
				html += '<div class="clearfix">';
				html += '<span class="price pull-left">' + value.user_service_sale_price + ' VNĐ</span>';
				html += '<span class="sale-percent pull-right"> <i class="fa fa-arrow-down"></i>' + ' GIẢM ' + Math.floor((value.user_service_full_price - value.user_service_sale_price) / value.user_service_full_price * 100) + '%</span>';
				html += '</div>';
				html += '<p title="' + value.user_service_description + '" class="description">' + value.user_service_description;
				html += '</p>';
				html += '<div class="clearfix">';
				html += '<button class="btn btn-sm btn-orange pull-right book-now-btn">';
				html += '<i style="display:none;" class="waiting_booking_detail fa fa-refresh fa-spin"></i> BOOK NOW';
				html += '</button>';
				html += '<a href="#" class="service-similar pull-left">DỊCH VỤ TƯƠNG TỰ</a>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
			});
			if (response[0] != null) {
				$('#error_top_ser_loading').remove();
				$('#top_service').append(html);
			} else {
				$('#top_service').append('<div id="error_top_ser_loading" style="color : #A1A1A1;display : none" class="text-center"><h4>Xin lỗi quý khách, hiện không có dịch vụ nào cả!</h4></div>');
				setTimeout(function() {
					$('#error_top_ser_loading').fadeIn();
				}, 600);
			}
		},
		complete : function() {
			$('#waiting_for_top_service').fadeOut(function() {
				$('.top_service_items').fadeIn();
			});

			$('.top_service_items').on('click', function(e) {
				if (e.target.className != 'service-similar pull-left') {
					$(this).find('i.waiting_booking_detail').fadeIn();
					USER_SERVICE_ID = $(this).find('.user_service_id').val();
					//console.log(USER_SERVICE_ID);
					loadServiceDetail(USER_SERVICE_ID);
					//$(this).find('i.waiting_booking_detail').fadeOut();
				}
			});
		}
	});
}

/*END LOAD TOP SERVICE LIST*/
/*-----------------------*/

/*LOAD NEW SERVICE LIST*/
function loadNewServiceList() {
	$.ajax({
		url : URL + 'index/loadNewServiceList',
		type : 'post',
		dataType : 'json',
		success : function(response) {
			//console.log(response);
			// console.log(CHOOSEN_DATE);
			// console.log(CHOOSEN_TIME);
			// console.log(CHOOSEN_PRICE);
			// console.log(USER_SERVICE_ID);
			var html = '';
			$.each(response, function(key, value) {
				var rating_value = parseFloat(value.star_review);
				var head = parseInt(rating_value);
				var tail = rating_value - head;
				var image_detail = value.user_service_image.split(',');
				html += '<div class="col-sm-6 col-md-3 col-padding-5px new_service_items" style="display : none;">';
				html += '<div class="item">';
				html += '<input class="user_service_id" name="user_service_id" type="hidden" value="' + value.user_service_id + '"/>';
				html += '<div class="image" class="clearfix">';
				html += '<img style="width: 100%; min-height: 140px; max-height: 140px" class="img-responsive" alt="Responsive image" src="' + image_detail[0] + '" />';
				html += '</div>';
				html += '<div class="col-md-4 remove-padding">';
				html += '<span class="rating">';
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
				html += '</span>';
				html += '<small class="count-rating pull-right">' + value.total_client_amount + ' lượt đánh giá</small>';
				html += '</div>';
				html += '<div class="price col-md-5">';
				html += '<span>' + value.user_service_sale_price + ' VNĐ</span>';
				html += '</div>';
				html += '<div class="sale-percent col-md-3">';
				html += '<span>GIẢM ' + Math.floor((value.user_service_full_price - value.user_service_sale_price) / value.user_service_full_price * 100) + '%</span>';
				html += '</div>';
				html += '<div class="clearfix"></div>';
				html += '<p align="center" class="name">' + value.user_service_name.toUpperCase() + '</p>';
				html += '<p title="' + value.user_service_description + '" class="description">' + value.user_service_description + '</p>';
				html += '<div class="clearfix">';
				html += '<button class="btn btn-xs btn-brown pull-right">';
				html += '<i style="display:none;" class="waiting_booking_detail fa fa-refresh fa-spin"></i> BOOK NOW</button>';
				html += '<a href="#" class="service-similar pull-left">DỊCH VỤ TƯƠNG TỰ</a>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
			});
			if (response[0] != null) {
				$('#error_new_ser_loading').remove();
				$('#new_service').append(html);
			} else {
				$('#new_service').append('<div id="error_new_ser_loading" style="color : #A1A1A1;display : none" class="text-center"><h4>Xin lỗi quý khách, hiện không có dịch vụ nào cả!</h4></div>');
				setTimeout(function() {
					$('#error_new_ser_loading').fadeIn();
				}, 600);
			}
		},
		complete : function() {
			$('#waiting_for_new_service').fadeOut(function() {
				$('.new_service_items').fadeIn();
			});

			$('.new_service_items').on('click', function(e) {
				if (e.target.className != 'service-similar pull-left') {
					$(this).find('i.waiting_booking_detail').fadeIn();
					USER_SERVICE_ID = $(this).find('.user_service_id').val();
					//console.log(USER_SERVICE_ID);
					loadServiceDetail(USER_SERVICE_ID);
					//$(this).find('i.waiting_booking_detail').fadeOut();
				}
			});
		}
	});
}

/*END LOAD NEW SERVICE LIST*/
/*-----------------------*/

/*LOAD LOCATION*/
function loadLocation() {
	$.ajax({
		url : URL + 'index/loadLocation',
		type : 'post',
		dataType : 'json',
		success : function(response) {
			if (response[0] != null) {
				var html = '';
				$.each(response, function(key, value) {
					html += '<div class="col-sm-6 col-md-3 remove-padding new_location_items" style="display : none;">';
					html += '<img class="image img-responsive" alt="Responsive image" src="' + value.user_logo + '" >';
					html += '<div class="info">';
					html += '<div class="info-content clearfix">';
					html += '<div class="name">';
					html += value.user_business_name + '</div>';
					html += '<div><p class="description">';
					html += value.user_description + '</p></div>';
					html += '<a class="readmore pull-right" href="' + URL + 'service/servicePlace/' + value.user_id + '">Xem thêm chi tiết >></a>';
					html += '</div>';
					html += '</div>';
					html += '</img>';
					html += '</div>';
				});
				$('#error_new_loc_loading').remove();
				$('#new_location').append(html);
			} else {
				$('#new_location').append('<div id="error_new_loc_loading" style="color : #A1A1A1;display : none" class="text-center"><h4>Xin lỗi quý khách, hiện không có dịch vụ nào cả!</h4></div>');
				setTimeout(function() {
					$('#error_new_loc_loading').fadeIn();
				}, 600);
			}
		},
		complete : function() {
			$('#waiting_for_new_location').fadeOut(function() {
				$('.new_location_items').fadeIn();
			});
		}
	});
}

/*END LOAD LOCATION*/
/*-----------------------*/

/*LOAD SERVICE DETAIL*/
function loadServiceDetail(user_service_id) {
	// console.log(CHOOSEN_DATE);
	// console.log(CHOOSEN_TIME);
	// console.log(CHOOSEN_PRICE);
	// console.log(USER_SERVICE_ID);
	resetTab('online_booking_zone');
	$.ajax({
		url : URL + 'index/loadServiceDetail',
		type : 'post',
		dataType : 'json',
		data : {
			user_service_id : user_service_id
		},
		success : function(response) {
			if (response[0] != null) {
				$('#service_detail_modal_body').show();
				$('#error_service_detail_modal_body').hide();
				//console.log(response);
				USER_ID_2 = parseInt(response[0].user_id);
				//console.log(USER_ID);
				var user_open_hour_1 = '';
				var user_open_hour_2 = '';
				var separate_count = 0;
				LIMIT_TIME_BEFORE_SERVICE = parseInt(response[0].user_limit_before_service);
				var user_limit_before_booking = parseInt(response[0].user_limit_before_booking);
				var day = '';
				var date = '';
				var month_year = '';
				var this_month_year = '';
				var day_of_week = parseInt(response[0].day_of_week);
				TODAY_OF_WEEK = parseInt(response[0].day_of_week);
				var day_of_month = parseInt(response[0].day_of_month);
				TODAY_OF_MONTH = parseInt(response[0].day_of_month);
				var total_days_current_month = '';
				var year = parseInt(response[0].year);
				TODAY_YEAR = parseInt(response[0].year);
				TODAY_HOUR = parseInt(response[0].hour);
				TODAY_MINUTE = parseInt(response[0].minute);
				//console.log(TODAY_MINUTE);
				var this_month;
				var month = parseInt(response[0].month);
				TODAY_MONTH = parseInt(response[0].month);
				var month_in_year = [];
				month_in_year[1] = 31;
				month_in_year[2] = 28;
				month_in_year[3] = 31;
				month_in_year[4] = 30;
				month_in_year[5] = 31;
				month_in_year[6] = 30;
				month_in_year[7] = 31;
				month_in_year[8] = 31;
				month_in_year[9] = 30;
				month_in_year[10] = 31;
				month_in_year[11] = 30;
				month_in_year[12] = 31;
				var month_in_sp_year = [];
				month_in_sp_year[1] = 31;
				month_in_sp_year[2] = 29;
				month_in_sp_year[3] = 31;
				month_in_sp_year[4] = 30;
				month_in_sp_year[5] = 31;
				month_in_sp_year[6] = 30;
				month_in_sp_year[7] = 31;
				month_in_sp_year[8] = 31;
				month_in_sp_year[9] = 30;
				month_in_sp_year[10] = 31;
				month_in_sp_year[11] = 30;
				month_in_sp_year[12] = 31;
				var evou_html = '';
				EVOUCHER_DUE_DATE = (response[0].evoucher_due_date);
				USER_SERVICE_USE_EVOUCHER = parseInt(response[0].user_service_use_evoucher);
				//console.log(month_in_sp_year);
				for ( mon = 1; mon <= 12; mon++) {
					if (mon == month) {
						this_month = 'Tháng ' + mon;
					}
				}
				var week = 1;
				// month_year += '<span style="display:none" class="week_' + week + '"> ' + this_month.toUpperCase() + ', ';
				// month_year += ' ' + year + ' </span>';
				TOTAL_WEEK = week;
				var days_order = 1;
				for ( i = 1; i <= user_limit_before_booking; i++) {
					if (day_of_month < 10) {
						days_of_month = '0' + day_of_month;
					} else {
						days_of_month = day_of_month;
					}
					if (day_of_week == 8) {
						day_of_week = 1;
					}
					if (days_order > 7) {
						date += '<span day-data="' + day_of_week + '" value="' + year + '-' + month + '-' + day_of_month + '" class="week_' + week + '" style="display:none">' + days_of_month + '</span>';
						if (day_of_week == 1) {
							day += '<span class="week_' + week + '" style="display:none"><b>CN</b></span>';

							month_year += '<span style="display:none" class="week_' + week + '"> ' + this_month.toUpperCase() + ', ';
							month_year += ' ' + year + ' </span>';
							week++;
							TOTAL_WEEK = week;
						} else if (day_of_week == 2) {
							day += '<span class="week_' + week + '" style="display:none"><b>T2</b></span>';
						} else if (day_of_week == 3) {
							day += '<span class="week_' + week + '" style="display:none"><b>T3</b></span>';
						} else if (day_of_week == 4) {
							day += '<span class="week_' + week + '" style="display:none"><b>T4</b></span>';
						} else if (day_of_week == 5) {
							day += '<span class="week_' + week + '" style="display:none"><b>T5</b></span>';
						} else if (day_of_week == 6) {
							day += '<span class="week_' + week + '" style="display:none"><b>T6</b></span>';
						} else if (day_of_week == 7) {
							day += '<span class="week_' + week + '" style="display:none"><b>T7</b></span>';
						}
					} else {
						if (week == 1) {
							date += '<span day-data="' + day_of_week + '" value="' + year + '-' + month + '-' + day_of_month + '" class="week_' + week + '">' + days_of_month + '</span>';
							if (day_of_week == 1) {
								day += '<span class="week_' + week + '"><b>CN</b></span>';

								month_year += '<span class="week_' + week + '"> ' + this_month.toUpperCase() + ', ';
								month_year += ' ' + year + ' </span>';
								week++;
								TOTAL_WEEK = week;
							} else if (day_of_week == 2) {
								day += '<span class="week_' + week + '"><b>T2</span>';
							} else if (day_of_week == 3) {
								day += '<span class="week_' + week + '"><b>T3</span>';
							} else if (day_of_week == 4) {
								day += '<span class="week_' + week + '"><b>T4</span>';
							} else if (day_of_week == 5) {
								day += '<span class="week_' + week + '"><b>T5</span>';
							} else if (day_of_week == 6) {
								day += '<span class="week_' + week + '"><b>T6</span>';
							} else if (day_of_week == 7) {
								day += '<span class="week_' + week + '"><b>T7</span>';
							}
						} else if (week == 2) {
							date += '<span day-data="' + day_of_week + '" value="' + year + '-' + month + '-' + day_of_month + '" class="week_1 week_' + week + '">' + days_of_month + '</span>';
							if (day_of_week == 1) {
								day += '<span class="week_1 week_' + week + '"><b>CN</b></span>';

								month_year += '<span style="display:none" class="week_' + week + '"> ' + this_month.toUpperCase() + ', ';
								month_year += ' ' + year + ' </span>';
								week++;
								TOTAL_WEEK = week;
							} else if (day_of_week == 2) {
								day += '<span class="week_1 week_' + week + '"><b>T2</b></span>';
							} else if (day_of_week == 3) {
								day += '<span class="week_1 week_' + week + '"><b>T3</b></span>';
							} else if (day_of_week == 4) {
								day += '<span class="week_1 week_' + week + '"><b>T4</b></span>';
							} else if (day_of_week == 5) {
								day += '<span class="week_1 week_' + week + '"><b>T5</b></span>';
							} else if (day_of_week == 6) {
								day += '<span class="week_1 week_' + week + '"><b>T6</b></span>';
							} else if (day_of_week == 7) {
								day += '<span class="week_1 week_' + week + '"><b>T7</b></span>';
							}
						}
					}
					day_of_week++;
					days_order++;
					day_of_month++;
					if ((year % 400 == 0) || (year % 4 == 0 && year % 100 != 0)) {
						if (day_of_month > month_in_sp_year[month]) {
							day_of_month = 1;
							month++;
							if (month > 12) {
								month = 1;
								year++;
							}
							for ( mon = 1; mon <= 12; mon++) {
								if (mon == month) {
									this_month = 'Tháng ' + mon;
								}
							}
						}
					} else {
						if (day_of_month > month_in_year[month]) {
							day_of_month = 1;
							month++;
							if (month > 12) {
								month = 1;
								year++;
							}
							for ( mon = 1; mon <= 12; mon++) {
								if (mon == month) {
									this_month = 'Tháng ' + mon;
								}
							}
						}
					}
				}
				month_year += '<span style="display:none" class="week_' + week + '"> ' + this_month.toUpperCase() + ', ';
				month_year += ' ' + year + ' </span>';
				$('#days_booking').children().html(day);
				$('#date_booking').children().html(date);
				$('#month_and_year').children().html('<span onclick="clickLastWeek()" id="last_week" class="glyphicon glyphicon-chevron-left pull-left dis-arm"></span>' + month_year + '<span onclick="clickNextWeek()" id="next_week" class="glyphicon glyphicon-chevron-right pull-right"></span>');
				$.each(response[0], function(key, value) {
					if (key == 'user_service_sale_price') {
						USER_SERVICE_SALE_PRICE = value;
					}
					if (key == 'user_service_duration') {
						USER_SERVICE_DURATION = value;
					}
					if (key == 'user_business_name') {
						USER_BUSINESS_NAME = value;
					}
					if (key == 'user_service_name') {
						USER_SERVICE_NAME = value;
					}
					if (key == 'user_logo') {
						$('img#user_logo').attr('src', value);
					}
					$('#' + key).val(value);
					$('#' + key + ', .' + key).text(value);
					if (key == 'user_open_hour') {
						json_user_open_hour = jQuery.parseJSON(value);
						//console.log(json_user_open_hour);
						$.each(json_user_open_hour, function(day, hour) {
							separate_count++;
							if (separate_count == '1') {
								MON_OPEN_CLOSE['status'] = hour[0];
								MON_OPEN_CLOSE['open'] = hour[1];
								MON_OPEN_CLOSE['close'] = hour[2];
								//console.log(MON_OPEN_CLOSE);
							} else if (separate_count == '2') {
								TUE_OPEN_CLOSE['status'] = hour[0];
								TUE_OPEN_CLOSE['open'] = hour[1];
								TUE_OPEN_CLOSE['close'] = hour[2];
								//console.log(TUE_OPEN_CLOSE);
							} else if (separate_count == '3') {
								WED_OPEN_CLOSE['status'] = hour[0];
								WED_OPEN_CLOSE['open'] = hour[1];
								WED_OPEN_CLOSE['close'] = hour[2];
								//console.log(WED_OPEN_CLOSE);
							} else if (separate_count == '4') {
								THU_OPEN_CLOSE['status'] = hour[0];
								THU_OPEN_CLOSE['open'] = hour[1];
								THU_OPEN_CLOSE['close'] = hour[2];
								//console.log(THU_OPEN_CLOSE);
							} else if (separate_count == '5') {
								FRI_OPEN_CLOSE['status'] = hour[0];
								FRI_OPEN_CLOSE['open'] = hour[1];
								FRI_OPEN_CLOSE['close'] = hour[2];
								//console.log(FRI_OPEN_CLOSE);
							} else if (separate_count == '6') {
								SAT_OPEN_CLOSE['status'] = hour[0];
								SAT_OPEN_CLOSE['open'] = hour[1];
								SAT_OPEN_CLOSE['close'] = hour[2];
								//console.log(SAT_OPEN_CLOSE);
							} else if (separate_count == '7') {
								SUN_OPEN_CLOSE['status'] = hour[0];
								SUN_OPEN_CLOSE['open'] = hour[1];
								SUN_OPEN_CLOSE['close'] = hour[2];
								//console.log(SUN_OPEN_CLOSE);
							}
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
							if (separate_count > 3) {
								if (hour[0] == 1) {
									user_open_hour_2 += '<p><i>' + day + ' : từ ' + hour[1] + ' h - ' + hour[2] + ' h</i></p>';
								} else if (hour[0] == 0) {
									user_open_hour_2 += '<p><i>' + day + ' : Nghỉ</i></p>';
								}
							} else {
								if (hour[0] == 1) {
									user_open_hour_1 += '<p><i>' + day + ' : từ ' + hour[1] + ' h - ' + hour[2] + ' h</i></p>';
								} else if (hour[0] == 0) {
									user_open_hour_1 += '<p><i>' + day + ' : Nghỉ</i></p>';
								}
							}
							if (hour[0] == 1) {
								evou_html += '<span class="fa fa-check"></span>';

							} else if (hour[0] == 0) {
								evou_html += '<span class="fa fa-times"></span>';
							}
						});
					}
				});
				//console.log(evou_html);
				if (USER_SERVICE_USE_EVOUCHER == 0) {
					$('#btn_evoucher_booking_zone').attr('disabled', true);
				} else {
					$('#btn_evoucher_booking_zone').attr('disabled', false);
					var date = new Date(EVOUCHER_DUE_DATE);
					var due_month = date.getMonth();
					var due_date = date.getDate();
					if (date.getMonth() < 10) {
						due_month = '0' + date.getMonth();
					}
					if (date.getDate() < 10) {
						due_date = '0' + date.getDate();
					}
					$('#evoucher_expire div #evoucher_due_date').html('<strong>Ngày hết hạn eVoucher : </strong>' + due_date + '-' + due_month + '-' + date.getFullYear());
					var evoucher_quantity = '';
					for ( i = 1; i <= parseInt(MAX_QUANTITY_EVOUCHER); i++) {
						evoucher_quantity += '<option value="' + i + '">' + i + '</option>';
					}
					$('#e_quantity').html(evoucher_quantity);
					$('#use_eVoucher').children().html(evou_html);
				}
				//response[0].user_open_hour;
				$('#user_open_hour_1').html(user_open_hour_1);
				$('#user_open_hour_2').html(user_open_hour_2);
				////////////REVIEW/////////////////
				loadLocationStarRatingDetail();
				loadServiceStarRatingDetail();
				loadReviewDetail();
				///////////////////////////////////
			}
			else {
				$('#error_service_detail_modal_body').show();
				$('#service_detail_modal_body').hide();
			}
		},
		complete : function() {
			$('i.waiting_booking_detail').fadeOut();
			$('#service_detail').modal('show');
			$('#user_service_name').text(shorten($('#user_service_name').text(), 22));
			$('#btn_user_service_price_b').text(USER_SERVICE_SALE_PRICE);
			$('#btn_user_service_price_e').text(USER_SERVICE_SALE_PRICE);
			var time_html = '';
			$('#date_booking span').on('click', function() {
				var time_html = '';
				var service_remain = false;
				$(this).addClass('active');
				$(this).siblings().removeClass('active');
				$('#time_booking').children().remove();
				CHOOSEN_DATE = $(this).attr('value');
				var temp_1_array = [];
				switch($(this).attr('day-data')) {
				case '2' :
					temp_1_array = MON_OPEN_CLOSE;
					break;
				case '3' :
					temp_1_array = TUE_OPEN_CLOSE;
					break;
				case '4' :
					temp_1_array = WED_OPEN_CLOSE;
					break;
				case '5' :
					temp_1_array = THU_OPEN_CLOSE;
					break;
				case '6' :
					temp_1_array = FRI_OPEN_CLOSE;
					break;
				case '7' :
					temp_1_array = SAT_OPEN_CLOSE;
					break;
				case '1' :
					temp_1_array = SUN_OPEN_CLOSE;
					break;
				}
				//console.log(temp_1_array['status']);
				if (temp_1_array['status'] == '1') {
					var current_hour_in_min = (TODAY_HOUR * 60) + TODAY_MINUTE;
					var open_hour_in_min = parseInt(temp_1_array['open']) * 60;
					if ($(this).attr('value') == TODAY_YEAR + '-' + TODAY_MONTH + '-' + TODAY_OF_MONTH) {
						while (current_hour_in_min > open_hour_in_min) {
							open_hour_in_min = open_hour_in_min + parseInt(USER_SERVICE_DURATION);
						}
						open_hour_in_min = open_hour_in_min + LIMIT_TIME_BEFORE_SERVICE;
					}
					var close_hour_in_min = parseInt(temp_1_array['close']) * 60;
					var am_pm = '';
					var minute;
					var hour;
					//console.log(close_hour_in_min);
					//console.log(LIMIT_TIME_BEFORE_SERVICE);
					while (close_hour_in_min > open_hour_in_min) {
						service_remain = true;
						if (open_hour_in_min <= 720) {
							am_pm = 'am';
						} else {
							am_pm = 'pm';
						}
						if (open_hour_in_min % 60 < 10) {
							minute = '0' + (open_hour_in_min % 60);
						} else {
							minute = open_hour_in_min % 60;
						}
						if ((open_hour_in_min - open_hour_in_min % 60) / 60 < 10) {
							hour = '0' + ((open_hour_in_min - open_hour_in_min % 60) / 60);
						} else {
							hour = (open_hour_in_min - open_hour_in_min % 60) / 60;
						}
						time_html += '<hr/>';
						time_html += '<div class="row" price-data="' + USER_SERVICE_SALE_PRICE + '" date-time-data="' + hour + ':' + minute + '">';
						time_html += '<div class="col-md-offset-1 col-md-6"><strong>' + hour + ':' + minute + am_pm + '</strong></div>';
						time_html += '<div class="col-md-5">' + USER_SERVICE_SALE_PRICE + ' VNĐ</div>';
						time_html += '</div>';
						open_hour_in_min = open_hour_in_min + parseInt(USER_SERVICE_DURATION);
						$('#btn_user_service_price').text(USER_SERVICE_SALE_PRICE);
					}
				} else if (temp_1_array['status'] == '0') {
					service_remain = true;
					time_html += '<hr/>';
					time_html += '<div class="row can_not_book">';
					time_html += '<div class="col-md-offset-1 col-md-11 text-center"><strong>Dịch vụ không mở trong ngày này!<strong></div>';
					time_html += '</div>';
					time_html += '<hr/>';
					$('#btn_user_service_price').text('');
				}
				if (time_html == '' && service_remain == false) {
					time_html += '<hr/>';
					time_html += '<div class="row can_not_book">';
					time_html += '<div class="col-md-offset-1 col-md-11 text-center"><strong>Hết lịch hẹn trong ngày!<strong></div>';
					time_html += '</div>';
					time_html += '<hr/>';
					$('#btn_user_service_price').text('');
				}
				$('#time_booking').html(time_html);

				$('#time_booking div.row:not(.can_not_book)').on('click', function() {
					$(this).addClass('active');
					$(this).siblings().removeClass('active');
					CHOOSEN_TIME = $(this).attr('date-time-data');
					CHOOSEN_PRICE = $(this).attr('price-data');
					CHOOSEN_DATE_STORE = CHOOSEN_DATE;
					console.log(CHOOSEN_DATE);
					console.log(CHOOSEN_TIME);
					console.log(CHOOSEN_PRICE);
					console.log(USER_SERVICE_ID);
				});
				$('#time_booking div.row:not(.can_not_book)').each(function(index) {
					if ($(this).attr('date-time-data') == CHOOSEN_TIME && CHOOSEN_DATE == CHOOSEN_DATE_STORE) {
						$(this).addClass('active');
						$(this).siblings().removeClass('active');
					}
				});
			});

			$('#date_booking span').each(function(index) {
				if ($(this).attr('value') == TODAY_YEAR + '-' + TODAY_MONTH + '-' + TODAY_OF_MONTH) {
					CHOOSEN_DATE = $(this).attr('value');
					var service_remain_default = false;
					$(this).addClass('active');
					$('#btn_online_booking_zone').addClass('btn-choose').removeClass('btn-orange');
					var time_html = '';
					if ($(this).attr('day-data') == TODAY_OF_WEEK) {
						var temp_2_array = [];
						if ($(this).attr('day-data') == '1') {
							temp_2_array = SUN_OPEN_CLOSE;
						} else if ($(this).attr('day-data') == '2') {
							temp_2_array = MON_OPEN_CLOSE;
						} else if ($(this).attr('day-data') == '3') {
							temp_2_array = TUE_OPEN_CLOSE;
						} else if ($(this).attr('day-data') == '4') {
							temp_2_array = WED_OPEN_CLOSE;
						} else if ($(this).attr('day-data') == '5') {
							temp_2_array = THU_OPEN_CLOSE;
						} else if ($(this).attr('day-data') == '6') {
							temp_2_array = FRI_OPEN_CLOSE;
						} else if ($(this).attr('day-data') == '7') {
							temp_2_array = SAT_OPEN_CLOSE;
						}
						if (temp_2_array['status'] == '1') {
							var open_hour_in_min = parseInt(temp_2_array['open']) * 60;
							var current_hour_in_min = (TODAY_HOUR * 60) + TODAY_MINUTE;
							while (current_hour_in_min > open_hour_in_min) {
								open_hour_in_min = open_hour_in_min + parseInt(USER_SERVICE_DURATION);
							}
							var close_hour_in_min = parseInt(temp_2_array['close']) * 60;
							open_hour_in_min = open_hour_in_min + LIMIT_TIME_BEFORE_SERVICE;
							var am_pm = '';
							var minute;
							var hour;
							while (close_hour_in_min > open_hour_in_min) {
								service_remain_default = true;
								if (open_hour_in_min <= 720) {
									am_pm = 'am';
								} else {
									am_pm = 'pm';
								}
								if (open_hour_in_min % 60 < 10) {
									minute = '0' + (open_hour_in_min % 60);
								} else {
									minute = open_hour_in_min % 60;
								}
								if ((open_hour_in_min - open_hour_in_min % 60) / 60 < 10) {
									hour = '0' + ((open_hour_in_min - open_hour_in_min % 60) / 60);
								} else {
									hour = (open_hour_in_min - open_hour_in_min % 60) / 60;
								}
								time_html += '<hr/>';
								time_html += '<div class="row" price-data="' + USER_SERVICE_SALE_PRICE + '" date-time-data="' + hour + ':' + minute + '">';
								time_html += '<div class="col-md-offset-1 col-md-6"><strong>' + hour + ':' + minute + am_pm + '</strong></div>';
								time_html += '<div class="col-md-5">' + USER_SERVICE_SALE_PRICE + ' VNĐ</div>';
								time_html += '</div>';
								open_hour_in_min = open_hour_in_min + parseInt(USER_SERVICE_DURATION);
								$('#btn_user_service_price').text(USER_SERVICE_SALE_PRICE);
							}
						} else if (temp_2_array['status'] == '0') {
							service_remain_default = true;
							time_html += '<hr/>';
							time_html += '<div class="row can_not_book">';
							time_html += '<div class="col-md-offset-1 col-md-11 text-center"><strong>Dịch vụ không mở trong ngày này!<strong></div>';
							time_html += '</div>';
							time_html += '<hr/>';
							$('#btn_user_service_price').text('');
						}
					}
					if (time_html == '' && service_remain_default == false) {
						time_html += '<hr/>';
						time_html += '<div class="row can_not_book">';
						time_html += '<div class="col-md-offset-1 col-md-11 text-center"><strong>Hết lịch hẹn trong ngày!<strong></div>';
						time_html += '</div>';
						time_html += '<hr/>';
						$('#btn_user_service_price').text('');
					}
					$('#time_booking').html(time_html);
					$('#time_booking div.row:not(.can_not_book)').on('click', function() {
						$(this).addClass('active');
						$(this).siblings().removeClass('active');
						CHOOSEN_TIME = $(this).attr('date-time-data');
						CHOOSEN_PRICE = $(this).attr('price-data');
						CHOOSEN_DATE_STORE = CHOOSEN_DATE;
						console.log(CHOOSEN_DATE);
						console.log(CHOOSEN_TIME);
						console.log(CHOOSEN_PRICE);
						console.log(USER_SERVICE_ID);
					});
				}
			});
		}
	});
}

/*END LOAD SERVICE DETAIL*/
/*-----------------------*/

/*WEEK PAGE*/
function clickNextWeek() {
	if (WEEK_PAGE == (TOTAL_WEEK - 1)) {
		$('#next_week').addClass('dis-arm');
	}
	if (WEEK_PAGE == TOTAL_WEEK) {
		return false;
	} else {
		$('#last_week').removeClass('dis-arm');
		WEEK_PAGE++;
		for ( i = 1; i <= TOTAL_WEEK; i++) {
			$('.week_' + i).hide();
		}
		$('.week_' + WEEK_PAGE).fadeIn();
	}
}

function clickLastWeek() {
	if (WEEK_PAGE == 2) {
		$('#last_week').addClass('dis-arm');
	}
	if (WEEK_PAGE == 1) {
		return false;
	} else {
		$('#next_week').removeClass('dis-arm');
		WEEK_PAGE--;
		for ( i = 1; i <= TOTAL_WEEK; i++) {
			$('.week_' + i).hide();
		}
		$('.week_' + WEEK_PAGE).fadeIn();
	}
}

/*END WEEK PAGE*/
/*-----------------------*/

/*LOAD LOCATION RATING*/
function loadLocationStarRatingDetail() {
	$.ajax({
		url : URL + 'service/loadLocationStarRating',
		type : 'post',
		dataType : 'json',
		data : {
			user_id : USER_ID_2
		},
		success : function(response) {
			if (response.general_info[0] != null) {
				var html = '';
				var general_html = '';
				var rating_value = parseFloat(response.general_info[0].star_review);
				var head = parseInt(rating_value);
				var tail = rating_value - head;
				tail = Math.round(tail * 100) / 100;
				var round_tail = tail * 10;
				// console.log(rating_value);
				// console.log(head);
				// console.log(tail);
				html += '<div class="col-md-3">';
				html += '<span style="color: #FFCC00; font-size: 40px;">' + head + '.' + round_tail + '</span>';
				html += '</div>';
				html += '<div class="col-md-7">';
				html += '<span><small>điểm đánh giá</small></span><br/>';
				html += '<span style="color: #FFCC00"> ';
				general_html += '<span style="color: #FFCC00">';
				for (var i = 1; i <= head; i++) {
					html += '<i class="fa fa-star"></i>';
					general_html += '<i class="fa fa-star"></i>';
				}
				if (tail != 0) {
					if (tail == 0.9) {
						html += '<i class="fa fa-star"></i>';
						general_html += '<i class="fa fa-star"></i>';
					} else if (tail == 0.2 || tail == 0.3 || tail == 0.4 || tail == 0.5 || tail == 0.6 || tail == 0.7 || tail == 0.8) {
						html += '<i class="fa fa-star-half-empty"></i>';
						general_html += '<i class="fa fa-star-half-empty"></i>';
					} else if (tail == 0.1) {
						html += '<i class="fa fa fa-star-o"></i>';
						general_html += '<i class="fa fa fa-star-o"></i>';
					}
					for (var j = head + 2; j <= 5; j++) {
						html += '<i class="fa fa-star-o"></i>';
						general_html += '<i class="fa fa-star-o"></i>';
					}
				} else {
					for (var j = head + 1; j <= 5; j++) {
						html += '<i class="fa fa-star-o"></i>';
						general_html += '<i class="fa fa-star-o"></i>';
					}
				}
				html += '</span><br />';
				general_html += '</span>';
				html += '<span ><small>' + response.general_info[0].client_amount + ' Lượt đánh giá</small></span>';
				general_html += '<span style="color: #FFFFFF;"> ' + response.general_info[0].client_amount + ' Lượt bình chọn</span>';
				html += '</div>';
				$('#user_review_overall_detail').html(html);
				$('#general_rating_detail').html(general_html);
			}
			if (response.chart_info[0] != null) {
				if (response.chart_info[0].client_amount == '0') {
					$('#five_stars').attr('style', 'width: 0%');
					$('#four_stars').attr('style', 'width: 0%');
					$('#three_stars').attr('style', 'width: 0%');
					$('#two_stars').attr('style', 'width: 0%');
					$('#one_star').attr('style', 'width: 0%');
				} else {
					$('#five_stars').attr('style', 'width: ' + (parseInt(response.chart_info[0].five_stars) / parseInt(response.chart_info[0].client_amount) * 100) + '%');
					$('#four_stars').attr('style', 'width: ' + (parseInt(response.chart_info[0].four_stars) / parseInt(response.chart_info[0].client_amount) * 100) + '%');
					$('#three_stars').attr('style', 'width: ' + (parseInt(response.chart_info[0].three_stars) / parseInt(response.chart_info[0].client_amount) * 100) + '%');
					$('#two_stars').attr('style', 'width: ' + (parseInt(response.chart_info[0].two_stars) / parseInt(response.chart_info[0].client_amount) * 100) + '%');
					$('#one_star').attr('style', 'width: ' + (parseInt(response.chart_info[0].one_star) / parseInt(response.chart_info[0].client_amount) * 100) + '%');
				}
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
					html_2 += '<div class="row">';
					html_2 += '<div class="col-md-6">';
					html_2 += '<small class="pull-right">' + value.review_name + '</small></div>';
					html_2 += '<div class="col-md-6">';
					html_2 += '<span class="pull-right" style="color: #FFCC00"> ';
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
					html_2 += '</span>';
					html_2 += '</div>';
					html_2 += '</div>';
				});
				//console.log(html_2);
				$('#user_review_properties_detail').html(html_2);
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
function loadServiceStarRatingDetail() {
	$.ajax({
		url : URL + 'service/loadServiceStarRating',
		type : 'post',
		dataType : 'json',
		data : {
			user_id : USER_ID_2
		},
		success : function(response) {
			var html = '';
			var count_hidden = 0;
			if (response.group_data[0] != null) {
				$.each(response.group_data[0], function(key, value) {
					count_hidden++;
					if (count_hidden > 10) {
						html += '<div style="display: none" class="col-md-12 see_more_rating_service">';
					} else {
						html += '<div class="col-md-12">';
					}
					html += '<span><b>' + key + '</b></span>';
					$.each(value, function(i, item) {
						count_hidden++;
						var rating_value = parseFloat(item.star_review);
						var head = parseInt(rating_value);
						var tail = rating_value - head;
						if (count_hidden > 10) {
							html += '<div style="display: none" class="row see_more_rating_service">';
						} else {
							html += '<div class="row">';
						}
						html += '<div class="col-md-6">';
						html += '<small style="cursor: help" title="' + item.user_service_name + '">' + shorten(item.user_service_name, 30) + '</small>';
						html += '</div>';
						html += '<div class="col-md-6">';
						html += '<span style="color: #FFCC00">';
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
						html += '</span>';
						html += '</div>';
						html += '</div>';
					});
					html += '<br />';
					html += '</div>';
				});
				if (count_hidden > 10) {
					html += '<div class="col-md-12">';
					html += '<span><a onclick=showMore("see_more_rating_service","see_more_text_detail") style="cursor: pointer;"><span class="see_more_text_detail">Xem thêm</span> >>></a></span>';
					html += '</div>';
				}
				$('#group_service_rating').html(html);
			}
		}
	});
}

/*END LOAD SERVICE RATING*/
/*-----------------------*/

/*LOAD REVIEW*/
function loadReviewDetail() {
	$('div#disallow_detail').show();
	$('#waiting_for_review_load_detail').fadeIn();
	$.ajax({
		url : URL + 'service/loadReview',
		type : 'post',
		dataType : 'json',
		data : {
			review_user_id : USER_ID_2,
			review_result : REVIEW_RESULT
		},
		beforeSend : function() {

		},
		success : function(response) {
			var html = '<div style="display : none;" id="disallow_detail"></div>';
			html += '<div style="display : none;" id="waiting_for_review_load_detail" class="text-center">' + '<i style="color: #FDBD0E" class="fa fa-2x fa-spin fa-refresh"></i>' + '</div>';
			if (response.data[0] != null) {
				$.each(response.data, function(key, value) {
					html += '<div class="media review_count_detail" >';
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
					if (value.user_review_content.length > 90) {
						html += '<p class="text_after">' + shorten(value.user_review_content, 90) + ' <span><a class="see_more_review" style="cursor : pointer;"> Xem thêm >>></a></span></p>';
						html += '<p style="display : none;" class="text_before">' + value.user_review_content + '</p>';
					} else {
						html += '<p class="text_after">' + value.user_review_content + '</p>';
					}
					html += '</div>';
					html += '</div>';
				});
			}
			if (parseInt(response.number_result) > RESULT_PER_SHOW_MORE) {
				html += '<div onclick="showMoreReviewDetail()" id="see_more_review_all_detail" align="center"><span style="display : none;" class="fa fa-spin fa-refresh" id="waiting_for_show_review_detail"></span><span id="text_show_review_detail"> Xem các đánh giá cũ hơn >>></span></div>';
			}
			$('#waiting_for_review_load_detail').fadeOut(function() {
				$('#review_field_detail').html(html);
			});
		},
		complete : function() {
			// setTimeout(function(){
			// loadReview();
			// },60000*2);
			$('#review_field_detail').delegate('.see_more_review', 'click', function() {
				$(this).parent().parent().hide();
				$(this).parent().parent().siblings('.text_before').show();
			});
		}
	});
}

/*END LOAD REVIEW*/
/*-----------------------*/

/*SHOW MORE REVIEW*/
function showMoreReviewDetail() {
	$('#text_show_review_detail').fadeOut(function() {
		$('#waiting_for_show_review_detail').fadeIn(function() {
			REVIEW_RESULT++;
			var html = '';
			var number_result;
			$.ajax({
				url : URL + 'service/loadReview',
				type : 'post',
				dataType : 'json',
				data : {
					review_user_id : USER_ID_2,
					review_result : REVIEW_RESULT
				},
				success : function(response) {
					number_result = response.number_result;
					if (response.data[0] != null) {
						$.each(response.data, function(key, value) {
							html += '<div class="media review_count_detail" >';
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
					$('#waiting_for_show_review_detail').fadeOut(function() {
						$('#text_show_review_detail').show();
						$('#review_field_detail .media:last').after(html);
						if ($('.review_count_detail').length == number_result) {
							$('#see_more_review_all_detail').hide();
						}
					});
				}
			});
		});
	});
}

/*END SHOW MORE REVIEW*/
/*-----------------------*/

/*LOGIN*/
function enterEvent(event) {
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if (keycode == '13') {
		login();
	}
}

function login() {
	var email_login = $('#email_login').val();
	var pass_login = $('#pass_login').val();
	var login_flg;
	var user_name;
	if (email_login != '' && pass_login != '') {
		$('#footer_login').children('span').remove();
		$('#footer_login').prepend('<i class="fa fa-refresh fa-spin"></i>');
		$.ajax({
			url : URL + 'clientlogin/clientLogin',
			type : 'post',
			dataType : 'json',
			data : {
				email : email_login,
				pass : pass_login
			},
			success : function(response) {
				if (response[0] == null) {
					login_flg = 0;
				} else {
					login_flg = 1;
					user_name = response[0].client_username;
				}
			},
			complete : function() {
				if (login_flg == 0) {
					$('#footer_login').children('i').remove();
					$('#footer_login').prepend('<span class="text-danger"><small><i> Đăng nhập thất bại!</small></i></span>');
				} else if (login_flg == 1) {
					$('#footer_login').children('i').remove();
					$('#login_modal').modal('hide');
					//window.location = URL;
					$('#login_group').children().remove();
					// $('#login_group').append('<div class="col-sm-12 remove-padding" style="margin-bottom: 10px;">' + '<div class="dropdown">' + '<a id="dropdown_profile" data-toggle="dropdown" class="btn btn-warning btn-block dropdown-toggle" style="border-radius: 4px;">' + 'Xin chào bạn: <i class="fa fa-user"></i> ' + user_name + ' <span class="caret"></span>' + '</a>' + '<ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdown_profile">' + '<li role="presentation"><a role="menuitem" tabindex="-1" href="' + URL + 'clientsetting"><i class="fa fa-wrench"></i> Quản lý tài khoản</a></li>' + '<li role="presentation" class="divider"></li>' + '<li role="presentation"><a role="menuitem" tabindex="-1" onclick="javascript:logout()" style="cursor: pointer;"><i class="fa fa-power-off"></i> Thoát</a></li>' + '</ul>' + '</div>' + '</div>');
					// var http_path = window.location.href.replace('http:', '');
					// var https_path = window.location.href.replace('https:', '');
					// if (http_path != URL && https_path != URL) {
					// window.location = URL;
					// }
					window.location.reload();
				}
			}
		});
	} else {
		$('#footer_login').children('span').remove();
		$('#footer_login').prepend('<span class="text-danger"><small><i> Hãy nhập email và mật khẩu!</small></i></span>');
	}
}

function logout() {
	$.ajax({
		url : URL + 'clientlogin/clientLogout',
		complete : function() {
			$('#booking_amount').text('0');
			$('#login_group').children().remove();
			$('#login_group').append('<div class="col-sm-5 remove-padding">' + '<button id="login_btn" class="btn btn-block login-btn" data-toggle="modal" data-target="#login_modal" type="button">Đăng nhập</button>' + '</div>' + '<div class="col-sm-2"></div>' + '<div class="col-sm-5 remove-padding">' + '<button class="btn btn-block login-face-btn" type="button">Login Face</button>' + '</div>');
			// var http_path = window.location.href.replace('http:', '');
			// var https_path = window.location.href.replace('https:', '');
			// if (http_path != URL && https_path != URL) {
			// window.location = URL;
			// }
			window.location.reload();
		}
	});
}

/*END LOGIN*/
/*-----------------------*/

/*JUMP TO TAB*/
function jumbToTab(tab) {
	$('#' + tab).siblings().hide();
	$('#' + tab).fadeIn();
	$('#btn_' + tab).addClass('btn-choose').removeClass('btn-orange');
	$('#btn_' + tab).parent().siblings().children().addClass('btn-orange').removeClass('btn-choose');
}

/*END JUMP TO TAB*/
/*-----------------------*/

/*RESET TAB*/
function resetTab(tab) {
	$('#' + tab).siblings().hide();
	$('#' + tab).fadeIn();
	$('#btn_' + tab).addClass('btn-choose').removeClass('btn-orange');
	$('#btn_' + tab).parent().siblings().children().addClass('btn-orange').removeClass('btn-choose');
}

/*END JRESET TAB*/
/*-----------------------*/

/*GET ONLINE BOOKING OR EVOUCHER INFOMATION*/
function getBookingInfo() {
	if (USER_SERVICE_ID == '' || CHOOSEN_DATE == '' || CHOOSEN_DATE_STORE == '' || CHOOSEN_TIME == '' || CHOOSEN_PRICE == '') {
		alert('Bạn chưa chọn dịch vụ, vui lòng chọn!');
	} else {
		$('#waiting_for_booking_save_b').fadeIn();
		// console.log(CHOOSEN_DATE);
		// console.log(CHOOSEN_TIME);
		// console.log(CHOOSEN_PRICE);
		// console.log(USER_SERVICE_ID);
		$('button.booking_button').attr('disabled', true);
		$.ajax({
			url : URL + 'index/getBookingInfo',
			type : 'post',
			//dataType : 'json',
			data : {
				user_service_id : USER_SERVICE_ID,
				user_id : USER_ID_2,
				booking_detail_date : CHOOSEN_DATE,
				booking_detail_time : CHOOSEN_TIME,
				choosen_price : CHOOSEN_PRICE,
				user_business_name : USER_BUSINESS_NAME,
				user_service_name : USER_SERVICE_NAME,
				booking_quantity : 1
			},
			success : function(response) {
				//console.log(response);
				$('#booking_amount').text(response);
			},
			complete : function() {
				$('#waiting_for_booking_save_b').fadeOut(function() {
					$('#service_detail').modal('hide');
					$('button.booking_button').attr('disabled', false);
				});
			}
		});

	}
}

function geteVoucherInfo() {
	if (USER_SERVICE_ID == '' || EVOUCHER_DUE_DATE == '' || USER_SERVICE_SALE_PRICE == '') {
		alert('Có sự cố với dịch vụ, vui lòng chọn lại!');
	} else {
		$('#waiting_for_booking_save_e').fadeIn();
		$('button.booking_button').attr('disabled', true);
		$.ajax({
			url : URL + 'index/geteVoucherInfo',
			type : 'post',
			//dataType : 'json',
			data : {
				user_service_id : USER_SERVICE_ID,
				user_id : USER_ID_2,
				eVoucher_due_date : EVOUCHER_DUE_DATE,
				choosen_price : USER_SERVICE_SALE_PRICE,
				user_business_name : USER_BUSINESS_NAME,
				user_service_name : USER_SERVICE_NAME,
				booking_quantity : $('#e_quantity').val()
			},
			success : function(response) {
				//console.log(response);
				$('#booking_amount').text(response);
			},
			complete : function() {
				$('#waiting_for_booking_save_e').fadeOut(function() {
					$('#service_detail').modal('hide');
					$('button.booking_button').attr('disabled', false);
				});
			}
		});
	}
}

/*END GET ONLINE BOOKING INFOMATION*/
/*-----------------------*/

/*LOAD SHOPPING CART*/
function shoppingCartDetail() {
	$('#waiting_cart_detail').fadeIn();
	$.ajax({
		url : URL + 'index/shoppingCartDetail',
		type : 'post',
		dataType : 'json',
		success : function(response) {
			var html = '';
			if (response.booking != '' || response.eVoucher != '') {
				html = '<tr>';
				html += '<th  style="border: none">DỊCH VỤ</th>';
				html += '<th  style="border: none">NGÀY - GIỜ</th>';
				html += '<th  style="border: none">GIÁ</th>';
				html += '<th  style="border: none">SỐ LƯỢNG</th>';
				html += '<th  style="border: none">TỔNG TIỀN</th>';
				html += '</tr>';
				$('#update_cart').attr('disabled', false);
				$('#confirm_cart').attr('disabled', false);
				$('#cart_amount').text(response.booking.length + response.eVoucher.length);
				var total_money = 0;
				$.each(response.booking, function(index, item) {
					var time_booking = item.booking_detail_time.split(':');
					var total_minutes = parseInt(time_booking[0]) * 60 + parseInt(time_booking[1]);
					var setAMPM = 'AM';
					if (total_minutes > (12 * 60)) {
						setAMPM = 'PM';
					}
					html += '<tr>';
					html += '<td width="30%">' + item.user_service_name.toUpperCase() + ' - <b>' + item.user_business_name + '</b></td>';
					html += '<td width="20%">' + formatDate(item.booking_detail_date) + ' - ' + item.booking_detail_time + setAMPM + '</td>';
					html += '<td width="19%">' + item.choosen_price + ' VNĐ</td>';
					html += '<td width="12%"><input onkeypress="inputNumbers(event)" maxlength="1" type="text" class="form-control appointment_quantity" value="' + item.booking_quantity + '"/></td>';
					html += '<td width="19%">' + parseInt(item.choosen_price) * parseInt(item.booking_quantity) + ' VNĐ</td>';
					html += '</tr>';
					total_money = total_money + parseInt(item.choosen_price) * parseInt(item.booking_quantity);
				});
				$.each(response.eVoucher, function(index, item) {
					html += '<tr>';
					html += '<td width="30%">' + item.user_service_name.toUpperCase() + ' - <b>' + item.user_business_name + '</b></td>';
					html += '<td width="20%"><i class="text-success">e-Voucher</i> - Ngày hết hạn : ' + formatDate(item.eVoucher_due_date) + '</td>';
					html += '<td width="19%">' + item.choosen_price + ' VNĐ</td>';
					html += '<td width="12%"><input onkeypress="inputNumbers(event)" maxlength="1" type="text" class="form-control eVoucher_quantity" value="' + item.booking_quantity + '"/></td>';
					html += '<td width="19%">' + parseInt(item.choosen_price) * parseInt(item.booking_quantity) + ' VNĐ</td>';
					html += '</tr>';
					total_money = total_money + parseInt(item.choosen_price) * parseInt(item.booking_quantity);
				});
				$('#total_cart').text(total_money);
			} else {
				$('#update_cart').attr('disabled', true);
				$('#confirm_cart').attr('disabled', true);
				$('#total_cart').text('0');
				$('#cart_amount').text('0');
				html = '<tr>';
				html += '<th  style="border: none">DỊCH VỤ</th>';
				html += '<th  style="border: none">NGÀY - GIỜ</th>';
				html += '<th  style="border: none">GIÁ</th>';
				html += '<th  style="border: none">SỐ LƯỢNG</th>';
				html += '<th  style="border: none">TỔNG TIỀN</th>';
				html += '</tr>';
				html += '<tr><td class="text-center" colspan="5"><h4><i class="fa fa-exclamation-circle"></i> Giỏ hàng của bạn đang rỗng! <i class="fa fa-frown-o"></i></h4></td></tr>';
			}
			$('table#table_shopping_cart').html(html);
		},
		complete : function() {
			$('#waiting_cart_detail').fadeOut(function() {
				APPOINTMENT_QUANTITY_LIST_BEFORE = getQuantityNumber('appointment_quantity');
				EVOUCHER_QUANTITY_LIST_BEFORE = getQuantityNumber('eVoucher_quantity');
				$('#Shopping_cart_info').modal('show');
			});
		}
	});
}

/*END LOAD SHOPPING CART*/
/*-----------------------*/

/*GET QUANTITY*/
function getQuantityNumber(cls) {
	var quantity_list = '';
	$('.' + cls).each(function(index) {
		if ($(this).val() == '') {
			quantity_list += '0,';
		} else {
			quantity_list += $(this).val() + ',';
		}
	});
	return quantity_list;
}

/*END GET QUANTITY*/
/*-----------------------*/

/*SAVE QUANTITY*/
function saveQuantityNumber() {
	var appointment_quantity_list_after = getQuantityNumber('appointment_quantity');
	var eVoucher_quantity_list_after = getQuantityNumber('eVoucher_quantity');
	// console.log(QUANTITY_LIST_BEFORE);
	// console.log(quantity_list_after);
	if (APPOINTMENT_QUANTITY_LIST_BEFORE != appointment_quantity_list_after || EVOUCHER_QUANTITY_LIST_BEFORE != eVoucher_quantity_list_after) {
		$('#waiting_for_update_cart').fadeIn();
		$.ajax({
			url : URL + 'index/updateShoppingCart',
			type : 'post',
			data : {
				appointment_quantity_list : appointment_quantity_list_after,
				eVoucher_quantity_list : eVoucher_quantity_list_after,
			},
			success : function(response) {
				//console.log(response);
				$('#booking_amount').text(response);
			},
			complete : function() {
				$('#waiting_for_update_cart').fadeOut(function() {
					shoppingCartDetail();
				});
			}
		});
	}
}

/*END SAVE QUANTITY*/
/*-----------------------*/

/*CHECK LOGIN PROCESSING PAYMENT*/
function checkIsLoginPayment() {
	$.ajax({
		url : URL + 'payment/checkIsLoginPayment',
		type : 'post',
		success : function(response) {
			if(response == 200){
				jumpToOtherPage(URL + 'payment');
			}else{
				$('#login_modal').modal('show');
			}
		}
	});

}

/*END CHECK LOGIN PROCESSING PAYMENT*/
/*----------------------------------*/

/*SET TIME IDLE*/
function setTimeIdle() {
	$.ajax({
		url : URL + 'index/setTimeIdle',
		type : 'get'
	});
}

/*END SET TIME IDLE*/
/*-----------------------*/