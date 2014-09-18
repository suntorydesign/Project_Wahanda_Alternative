/*LOAD SHOPPING CART*/
function shoppingCartDetail(){
	$('#waiting_cart_detail').fadeIn();
	$.ajax({
		url : URL + 'index/shoppingCartDetail',
		type: 'post',
		dataType : 'json',
		success : function(response){
			var html = '';
			if(response.booking != '' || response.eVoucher != ''){
				html = '<tr>';
				html += '<th  style="border: none">DỊCH VỤ</th>';
				html += '<th  style="border: none">NGÀY - GIỜ</th>';
				html += '<th  style="border: none">GIÁ</th>';
				html += '<th  style="border: none">SỐ LƯỢNG</th>';
				html += '<th  style="border: none">TỔNG TIỀN</th>';
				html += '</tr>';
				$('#update_cart').attr('disabled',false);
				$('#confirm_cart').attr('disabled',false);
				$('#cart_amount').text(response.booking.length + response.eVoucher.length);
				var total_money = 0;
				$.each(response.booking, function(index, item){
					html += '<tr>';
					html += '<td width="30%">' + item.user_service_name.toUpperCase() + ' - <b>' + item.user_business_name + '</b></td>';
					html += '<td width="20%">' + item.booking_detail_date + ' - ' + item.booking_detail_time + '</td>'; 
					html += '<td width="19%">' + item.choosen_price + ' VNĐ</td>';
					html += '<td width="12%"><input onkeypress="inputNumbers(event)" maxlength="1" type="text" class="form-control appointment_quantity" value="' + item.booking_quantity + '"/></td>';
					html += '<td width="19%">' + parseInt(item.choosen_price) * parseInt(item.booking_quantity) + ' VNĐ</td>';
					html += '</tr>';
					total_money = total_money + parseInt(item.choosen_price) * parseInt(item.booking_quantity);
				});
				$.each(response.eVoucher, function(index, item){
					html += '<tr>';
					html += '<td width="30%">' + item.user_service_name.toUpperCase() + ' - <b>' + item.user_business_name + '</b></td>';
					html += '<td width="20%"><i class="text-success">e-Voucher</i> - Ngày hết hạn : ' + item.eVoucher_due_date + '</td>'; 
					html += '<td width="19%">' + item.choosen_price + ' VNĐ</td>';
					html += '<td width="12%"><input onkeypress="inputNumbers(event)" maxlength="1" type="text" class="form-control eVoucher_quantity" value="' + item.booking_quantity + '"/></td>';
					html += '<td width="19%">' + parseInt(item.choosen_price) * parseInt(item.booking_quantity) + ' VNĐ</td>';
					html += '</tr>';
					total_money = total_money + parseInt(item.choosen_price) * parseInt(item.booking_quantity);
				});
				$('#total_cart').text(total_money);	
			}else{	
				$('#update_cart').attr('disabled',true);
				$('#confirm_cart').attr('disabled',true);
				$('#total_cart').text('0');	
				$('#cart_amount').text('0');	
				html = '<tr>';
				html += '<th  style="border: none">DỊCH VỤ</th>';
				html += '<th  style="border: none">NGÀY - GIỜ</th>';
				html += '<th  style="border: none">GIÁ</th>';
				html += '<th  style="border: none">SỐ LƯỢNG</th>';
				html += '<th  style="border: none">TỔNG TIỀN</th>';
				html += '</tr>';
				html += '<tr><td class="text-center" colspan="5"><h3><i class="fa fa-exclamation-circle"></i> Giỏ hàng của bạn đang rỗng! <i class="fa fa-frown-o"></i></h3></td></tr>';
			}
			$('table#table_shopping_cart').html(html); 
		},
		complete : function(){
			$('#waiting_cart_detail').fadeOut(function(){
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
function getQuantityNumber(cls){
	var quantity_list = '';
	$('.' + cls).each(function(index){
		if($(this).val() == ''){
			quantity_list += '0,';
		}else{
			quantity_list += $(this).val()+',';
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
	if(APPOINTMENT_QUANTITY_LIST_BEFORE != appointment_quantity_list_after || EVOUCHER_QUANTITY_LIST_BEFORE != eVoucher_quantity_list_after){
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
			complete : function(){
				$('#waiting_for_update_cart').fadeOut(function(){
					shoppingCartDetail();
				});
			}
		});
	}
}
/*END SAVE QUANTITY*/
/*-----------------------*/