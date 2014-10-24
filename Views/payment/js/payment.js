$(document).ready(function() {
	loadPaymentDetail();
	$('#mastercard, #visa, #discover').on('click', function() {
		$(this).siblings().removeClass('payment_type_choosen');
		$(this).addClass('payment_type_choosen');
	});
});
/*PROCESSING ONLINE PAYMENT*/
function processPaypalPayment() {
	if (PAYMENT_TYPE == 'mastercard' || PAYMENT_TYPE == 'visa' || PAYMENT_TYPE == 'discover') {
		$('#btn_online_process_payment').attr('disabled', true);
		$('#waiting_for_online_payment').fadeIn(function() {
			$.ajax({
				url : URL + 'payment/processPaypalPayment',
				type : 'post',
				data : {
					payment_type : PAYMENT_TYPE,
					card_number : $('#client_card_number').val(),
					secure_code : $('#client_security_code').val(),
					date_expire : $('#month_expire').val() + $('#year_expire').val(),
					first_name : $('#client_card_holder_first').val(),
					last_name : $('#client_card_holder_last').val()
				},
				success : function(response) {

				},
				complete : function() {
					$('#waiting_for_online_payment').fadeOut(function() {
						alert('Cám ơn bạn đã thanh toán thành công');
						jumpToOtherPage(URL);
					});
				}
			});
		});
	}else{
		$('#reminder').fadeIn(function(){
			$('#reminder').fadeOut();
		});
	}
}

/*END PROCESSING ONLINE PAYMENT*/
/*----------------------------------*/

/*PROCESSING VENUE PAYMENT*/
function processVenuePayment() {
	$('#btn_venue_process_payment').attr('disabled', true);
	$('#waiting_for_venue_payment').fadeIn(function() {
		$.ajax({
			url : URL + 'payment/processVenuePayment',
			type : 'post',
			success : function(response) {

			},
			complete : function() {
				$('#waiting_for_venue_payment').fadeOut(function() {
					alert('Cám ơn bạn đã thanh toán thành công');
					jumpToOtherPage(URL);
				});
			}
		});
	});
}

/*END PROCESSING VENUE PAYMENT*/
/*----------------------------------*/

/*LOAD PAYMENT DETAIL*/
function loadPaymentDetail() {
	$.ajax({
		url : URL + 'payment/loadPaymentDetail',
		type : 'post',
		dataType : 'json',
		success : function(response) {
			var html = '';
			html = '<tr>';
			html += '<th  style="border: none">DỊCH VỤ</th>';
			html += '<th  style="border: none">NGÀY - GIỜ</th>';
			html += '<th  style="border: none">GIÁ</th>';
			html += '<th  style="border: none">SỐ LƯỢNG</th>';
			html += '<th  style="border: none">TỔNG TIỀN</th>';
			html += '</tr>';
			if (response.booking != '' || response.eVoucher != '' || response.client_info != '') {
				var total_money = 0;
				$.each(response.booking, function(index, item) {
					var time_booking = item.booking_detail_time.split(':');
					var total_minutes = parseInt(time_booking[0]) * 60 + parseInt(time_booking[1]);
					var setAMPM = 'AM';
					if (total_minutes > (12 * 60)) {
						setAMPM = 'PM';
					}
					html += '<tr>';
					html += '<td width="38%">' + item.user_service_name.toUpperCase() + ' - <b>' + item.user_business_name + '</b></td>';
					html += '<td width="27%">' + formatDate(item.booking_detail_date) + ' - <b class="text-danger"><i>' + item.booking_detail_time + setAMPM + '</i></b></td>';
					html += '<td width="12%">' + item.choosen_price + ' VNĐ</td>';
					html += '<td width="10%" align="center">' + item.booking_quantity + '</td>';
					html += '<td width="13%">' + parseInt(item.choosen_price) * parseInt(item.booking_quantity) + ' VNĐ</td>';
					html += '</tr>';
					total_money = total_money + parseInt(item.choosen_price) * parseInt(item.booking_quantity);
				});
				$.each(response.eVoucher, function(index, item) {
					html += '<tr>';
					html += '<td width="38%">' + item.user_service_name.toUpperCase() + ' - <b>' + item.user_business_name + '</b></td>';
					html += '<td width="27%"><i class="text-danger"><b>e-Voucher</b></i> - Ngày hết hạn : ' + formatDate(item.eVoucher_due_date) + '</td>';
					html += '<td width="12%">' + item.choosen_price + ' VNĐ</td>';
					html += '<td width="10%" align="center">' + item.booking_quantity + '</td>';
					html += '<td width="13%">' + parseInt(item.choosen_price) * parseInt(item.booking_quantity) + ' VNĐ</td>';
					html += '</tr>';
					total_money = total_money + parseInt(item.choosen_price) * parseInt(item.booking_quantity);
				});
				$.each(response.client_info[0], function(key, value) {
					if (key == 'client_join_date') {
						var join_date = value.split(' ');
						$('#' + key + ' p i').text(formatDate(join_date[0]) + ' ' + join_date[1]);
					} else {
						$('#' + key + ' p i').text(value);
					}
				});
				$('table#table_payment_detail').html(html);
			}
		}
	});

}

/*END LOAD PAYMENT DETAIL*/
/*----------------------------------*/

/*JUMP TO PAYMENT TAB*/
function jumbToPaymentTab(tab) {
	checkSessionIdle();
	$('#' + tab).siblings().hide();
	$('#' + tab).fadeIn();
	$('#btn_' + tab).addClass('btn-choose').removeClass('btn-orange');
	$('#btn_' + tab).siblings().addClass('btn-orange').removeClass('btn-choose');
}

/*END JUMP TO PAYMENT TAB*/

/*SELECT PAYMENT TYPE*/
function selectPaymentType(type) {
	PAYMENT_TYPE = type;
	console.log(PAYMENT_TYPE);
}

/*END SELECT PAYMENT TYPE*/
/*----------------------------------*/