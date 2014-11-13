$(document).ready(function() {
	loadAdvantageSearch();
	$('#price_range').on('change', function() {
		// console.log($(this).val());
		$('#price_change').text($(this).val() * 50000);
		PRICE_SEARCH = $(this).val() * 50000;
		loadResultSearch(1);
	});
	$('#district_id_advance').on('change', function() {
		DISTRICT_ID = $(this).val();
		SERVICE_TYPE_SEARCH = '';
		SERVICE_SEARCH = '';
		loadResultSearch(1);
		loadAdvantageSearch();
		// jumpToOtherPage(URL + 'servicelocation/searchLocation?s=' + SERVICE_NAME + '&l=' + DISTRICT_ID_SEARCH);
	});
	var count_un = 0;
	$('#date_to_appointment').on('change', function() {
		count_un++;
		var current_date = new Date();
		var today = current_date.getFullYear() + '-' + (parseInt(current_date.getMonth()) + 1) + '-' + current_date.getDate();
		today = formatDate(today);
		var format_date_current = today.split('/');
		format_date_current = format_date_current[1] + '/' + format_date_current[0] + '/' + format_date_current[2];
		var format_date = $(this).val().split('/');
		var format_date_val = format_date[2] + '-' + format_date[1] + '-' + format_date[0];
		format_date = format_date[1] + '/' + format_date[0] + '/' + format_date[2];
		
		var booking_date = new Date(format_date);
		var days = booking_date.getDay();
		if (days == 0) {
			days = 8;
		} else {
			days++;
		}
		BOOKING_DATE = days + '":[1';
		CHOOSEN_DATE_ACTIVE = format_date_val;
		if (count_un == 3) {
			count_un = 0;
			var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
			var firstDate = new Date(format_date_current);
			var secondDate = new Date(format_date);
			USER_LIMIT_BEFORE_BOOKING = 1 + Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));
			loadResultSearch(1);
			loadAdvantageSearch();
			console.log(format_date_current);
			console.log(format_date);
			console.log(CHOOSEN_DATE_ACTIVE);
			console.log(USER_LIMIT_BEFORE_BOOKING);
		}
	});
});
/*LOAD ADVANTAGE SEARCH*/
function loadAdvantageSearch() {
	$('#not_allow_advance_search').show();
	$.ajax({
		url : URL + 'servicelocation/loadAdvantageSearch',
		type : 'post',
		dataType : 'json',
		data : {
			service_name : SERVICE_NAME,
			district_id : DISTRICT_ID,
			sort_by : $('#sort_by').val(),
			user_address_1 : USER_ADDRESS_1,
			user_address_2 : USER_ADDRESS_2,
			service_type_id : SERVICE_TYPE_SEARCH,
			service_id : SERVICE_SEARCH,
			user_open_hour : BOOKING_DATE,
			user_limit_before_booking : USER_LIMIT_BEFORE_BOOKING
		},
		success : function(response) {
			var html = '';
			var html_2 = '';
			var index = 0;
			var index_2 = 0;
			if (response.service_type[0] != null) {
				html += '<div>';
				html += '<input checked id="filter-4-1" value="" type="radio" name="service_type">';
				html += '<label for="filter-4-1">&nbsp;&nbsp;<b>Tất cả</b></label>';
				html += '</div>';
				$.each(response.service_type, function(key, value) {
					index++;
					if (index == 6) {
						html += '<div style="display: none;" class="see_more_service_type">';
					}
					html += '<div>';
					html += '<input id="filter-4-1" value="' + value.service_type_id + '" type="radio" name="service_type">';
					html += '<label for="filter-4-1">&nbsp;&nbsp;' + shorten(value.service_type_name, 30) + '</label>';
					html += '<span class="pull-right badge">' + value.amount + '</span>';
					html += '</div>';
				});
				if (index > 5) {
					html += '</div>';
					html += '<a onclick=showMore("see_more_service_type","see_more_service_type_text") style="cursor: pointer">>>> <span class="see_more_service_type_text">Xem thêm</span> loại dịch vụ khác (' + (index - 5) + ')</a>';
				}
				$('#service_type').html(html);
			} else {
				$('#service_type').html('');
			}
			if (response.service[0] != null) {
				$.each(response.service, function(key, value) {
					index_2++;
					if (index_2 == 6) {
						html_2 += '<div style="display: none;" class="see_more_service">';
					}
					html_2 += '<div>';
					html_2 += '<input id="filter-4-1" value="' + value.service_id + '" type="checkbox" name="service">';
					html_2 += '<label for="filter-4-1">&nbsp;&nbsp;' + shorten(value.service_name, 30) + '</label>';
					html_2 += '<span class="pull-right badge">' + value.amount + '</span>';
					html_2 += '</div>';
				});
				if (index_2 > 5) {
					html_2 += '</div>';
					html_2 += '<a onclick=showMore("see_more_service","see_more_service_text") style="cursor: pointer">>>> <span class="see_more_service_text">Xem thêm</span> loại dịch vụ khác (' + (index_2 - 5) + ')</a>';
				}
				$('#service').html(html_2);
			} else {
				$('#service').html('');
			}
			if (response.evoucher[0] != null) {
				$.each(response.evoucher, function(key, value) {
					if (value.user_service_use_evoucher == '0') {
						$('#appointment_type_booking').siblings('span').text(value.use_evoucher);
					} else if (value.user_service_use_evoucher == '1') {
						$('#voucher_type_booking').siblings('span').text(value.use_evoucher);
					}
				});
			} else {
				$('#appointment_type_booking').siblings('span').text('0');
				$('#voucher_type_booking').siblings('span').text('0');
			}
		},
		complete : function() {
			$('#not_allow_advance_search').hide();
			$('input[name=service]').on('click', function() {
				SERVICE_SEARCH = '';
				$('input[name=service]').each(function() {
					if ($(this).is(':checked') == true) {
						SERVICE_SEARCH += $(this).val() + ',';
					}
				});
				console.log(SERVICE_SEARCH);
				// reloadService();
				reloadTypeBuy();
				loadResultSearch(1);
			});
			$('input[name=service_type]').on('click', function() {
				SERVICE_TYPE_SEARCH = $(this).val();
				SERVICE_SEARCH = '';
				console.log(SERVICE_TYPE_SEARCH);
				reloadService();
				reloadTypeBuy();
				loadResultSearch(1);
			});
			$('input[name=buying_type]').on('click', function() {
				USE_EVOUCHER = $(this).val();
				loadResultSearch(1);
			});
		}
	});
}

/*END LOAD ADVANTAGE SEARCH*/
/*-----------------------*/

/*RELOAD SERVICE*/
function reloadService() {
	$('#not_allow_advance_search').show();
	$.ajax({
		url : URL + 'servicelocation/reloadService',
		type : 'post',
		dataType : 'json',
		data : {
			service_name : SERVICE_NAME,
			district_id : DISTRICT_ID,
			sort_by : $('#sort_by').val(),
			user_address_1 : USER_ADDRESS_1,
			user_address_2 : USER_ADDRESS_2,
			service_type_id : SERVICE_TYPE_SEARCH,
			service_id : SERVICE_SEARCH
		},
		success : function(response) {
			var html_2 = '';
			var index_2 = 0;
			if (response.service[0] != null) {
				$.each(response.service, function(key, value) {
					index_2++;
					if (index_2 == 6) {
						html_2 += '<div style="display: none;" class="see_more_service">';
					}
					html_2 += '<div>';
					html_2 += '<input id="filter-4-1" value="' + value.service_id + '" type="checkbox" name="service">';
					html_2 += '<label for="filter-4-1">&nbsp;&nbsp;' + shorten(value.service_name, 30) + '</label>';
					html_2 += '<span class="pull-right badge">' + value.amount + '</span>';
					html_2 += '</div>';
				});
				if (index_2 > 5) {
					html_2 += '</div>';
					html_2 += '<a onclick=showMore("see_more_service","see_more_service_text") style="cursor: pointer">>>> <span class="see_more_service_text">Xem thêm</span> loại dịch vụ khác (' + (index_2 - 5) + ')</a>';
				}
				$('#service').html(html_2);
			} else {
				$('#service').html('');
			}
		},
		complete : function() {
			$('#not_allow_advance_search').hide();
			$('input[name=service]').on('click', function() {
				SERVICE_SEARCH = '';
				$('input[name=service]').each(function() {
					if ($(this).is(':checked') == true) {
						SERVICE_SEARCH += $(this).val() + ',';
					}
				});
				console.log(SERVICE_SEARCH);
				// reloadService();
				reloadTypeBuy();
				loadResultSearch(1);
			});
		}
	});
}

/*END RELOAD SERVICE*/
/*-----------------------*/

/*RELOAD TYPE BUY*/
function reloadTypeBuy() {
	$('#not_allow_advance_search').show();
	$.ajax({
		url : URL + 'servicelocation/reloadTypeBuy',
		type : 'post',
		dataType : 'json',
		data : {
			service_name : SERVICE_NAME,
			district_id : DISTRICT_ID,
			sort_by : $('#sort_by').val(),
			user_address_1 : USER_ADDRESS_1,
			user_address_2 : USER_ADDRESS_2,
			service_type_id : SERVICE_TYPE_SEARCH,
			service_id : SERVICE_SEARCH
		},
		success : function(response) {
			if (response.evoucher[0] != null) {
				$.each(response.evoucher, function(key, value) {
					if (value.user_service_use_evoucher == '0') {
						$('#appointment_type_booking').siblings('span').text(value.use_evoucher);
					} else if (value.user_service_use_evoucher == '1') {
						$('#voucher_type_booking').siblings('span').text(value.use_evoucher);
					}
				});
			} else {
				$('#appointment_type_booking').siblings('span').text('0');
				$('#voucher_type_booking').siblings('span').text('0');
			}
		},
		complete : function() {
			$('#not_allow_advance_search').hide();
		}
	});
}

/*END RELOAD TYPE BUY*/
/*-----------------------*/