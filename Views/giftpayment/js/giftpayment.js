$(document).ready(function() {
	loadGiftPaymentDetail();
	$('#mastercard, #visa, #discover').on('click', function() {
		$(this).siblings().removeClass('payment_type_choosen');
		$(this).addClass('payment_type_choosen');
	});
});

/*PROCESSING ONLINE PAYMENT*/
function processPaypalPayment() {
	var check_input = 0;
	$('.payment_field input').each(function() {
		if ($(this).prop('value') == '') {
			check_input++;
		}
	});
	if (check_input == 0) {
		$('.payment_field input').each(function() {
			$(this).css('border-color', '#ccc');
		});
		var payment_result = 0;
		if (GIFT_PAYMENT_TYPE == 'mastercard' || GIFT_PAYMENT_TYPE == 'visa' || GIFT_PAYMENT_TYPE == 'discover') {
			$('#btn_online_process_payment').attr('disabled', true);
			$('#waiting_for_online_payment').fadeIn(function() {
				$.ajax({
					url : URL + 'giftpayment/processPaypalPayment',
					type : 'post',
					data : {
						payment_type : GIFT_PAYMENT_TYPE,
						card_number : $('#client_card_number').val(),
						secure_code : $('#client_security_code').val(),
						date_expire : $('#month_expire').val() + $('#year_expire').val(),
						first_name : $('#client_card_holder_first').val(),
						last_name : $('#client_card_holder_last').val()
					},
					success : function(response) {
						if (response != '0') {
							var json_encode = JSON.parse(response);
							if (json_encode[0] != null) {
								alert_desc = 'PAYPAL NÓI RẰNG: \n';
								// console.log(JSON.parse(response));
								if (json_encode[0].ACK != 'Failure') {
									payment_result = 1;
								}
								$.each(json_encode[0], function(i, item) {
									alert_desc += i + ': ' + item + '\n';
								});
								alert(alert_desc);
							}
						} else if (response == '0') {
							payment_result = 0;
						}
					},
					complete : function() {
						if (payment_result == 1) {
							$('#waiting_for_online_payment').fadeOut(function() {
								alert('Cám ơn bạn đã thanh toán thành công');
								jumpToOtherPage(URL);
							});
						} else {
							$('#waiting_for_online_payment').fadeOut(function() {
								alert('Thanh toán thất bại, xin vui lòng nhập lại thông tin');
								//jumpToOtherPage(URL);
								$('#btn_online_process_payment').attr('disabled', false);
							});
						}
					}
				});
			});
		} else {
			$('#reminder').fadeIn(function() {
				$('#reminder').fadeOut();
			});
		}
	} else {
		$('.payment_field input').each(function() {
			// console.log($(this).prop('value'));
			if ($(this).prop('value') == '') {
				$(this).css('border-color', 'red');
			} else {
				$(this).css('border-color', '#ccc');
			}
		});
	}
}

/*END PROCESSING ONLINE PAYMENT*/
/*----------------------------------*/

/*LOAD PAYMENT DETAIL*/
function loadGiftPaymentDetail() {
	$.ajax({
		url : URL + 'giftpayment/loadGiftPaymentDetail',
		type : 'post',
		dataType : 'json',
		success : function(response) {
			var html = '';
			html = '<tr>';
			html += '<th  style="border: none">NGƯỜI GỬI</th>';
			html += '<th  style="border: none">ĐẾN EMAIL</th>';
			html += '<th  style="border: none">LOẠI</th>';
			html += '<th  style="border: none">NGÀY</th>';
			html += '<th  style="border: none">THÔNG ĐIỆP</th>';
			html += '<th  style="border: none">GIÁ</th>';
			html += '</tr>';
			if (response.gift_booking != '' || response.client_info != '') {
				var total_money = 0;
				$.each(response.gift_booking, function(index, item) {
					html += '<tr>';
					html += '<td width="20%">' + item.gift_voucher_sender + '</td>';
					html += '<td width="20%">' + item.gift_voucher_email + '</td>';
					if (item.gift_voucher_type == 1) {
						html += '<td width="15%">Gửi qua email</td>';
					} else if (item.gift_voucher_type == 2) {
						html += '<td width="15%">Gửi thiếp</td>';
					}
					html += '<td width="13%">' + item.gift_voucher_date + '<br/>' + '<b class="text-danger">(HSD: ' + formatDate(item.gift_voucher_due_date) + ')</b>' + '</td>';
					html += '<td width="22%">' + item.gift_voucher_mess.replace(/\n/g, "<br/>"); +'</td>';
					html += '<td width="10%">' + item.gift_voucher_price + ' VNĐ</td>';
					html += '</tr>';
				});
				$.each(response.client_info[0], function(key, value) {
					if (key == 'client_join_date') {
						var join_date = value.split(' ');
						$('#' + key + ' p i').text(formatDate(join_date[0]) + ' ' + join_date[1]);
					} else {
						$('#' + key + ' p i').text(value);
					}
				});
				$('table#table_giftpayment_detail').html(html);
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
	GIFT_PAYMENT_TYPE = type;
	// console.log(GIFT_PAYMENT_TYPE);
}

/*END SELECT PAYMENT TYPE*/
/*----------------------------------*/