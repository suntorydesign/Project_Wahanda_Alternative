$(document).ready(function() {
	$('button.voucher-card-btn').on('click', function() {
		// console.log($(this).attr('gift-price-data'));
		$('#gift_email').val('');
		$('#gift_message').val('');
		$('#error_message_gift').hide();
		GIFT_PRICE = $(this).attr('gift-price-data');
		if (GIFT_PRICE != '') {
			$('#gift_value').text(GIFT_PRICE + ' VNĐ');
			$('#gift_modal').modal('show');
		}
	});
});

function saveGiftvoucher() {
	$('#error_message_gift').hide();
	$('#waiting_for_gift').fadeIn(function() {
		var e_mail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var gift_email = $('#gift_email').val();
		var check = e_mail.test(gift_email);
		if (check == true) {
			$.ajax({
				url : URL + 'giftvoucher/saveGiftvoucher',
				type : 'post',
				data : {
					gift_voucher_email : $('#gift_email').val(),
					gift_voucher_price : GIFT_PRICE,
					gift_voucher_mess : $('#gift_message').val()
				},
				success : function(response) {
					if (response == 200) {
						$('#waiting_for_gift').fadeOut(function() {
							alert('Gửi gift voucher thành công');
							$('#gift_modal').modal('hide');
						});
					} else {
						alert('Gửi gift voucher thất bại');
					}
				},
				complete : function() {

				}
			});
		} else {
			$('#error_message_gift').fadeIn(function() {
				$('#waiting_for_gift').fadeOut();
			});
		}
	});
}
