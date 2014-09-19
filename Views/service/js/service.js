$(document).ready(function() {
	loadLocationDetail();
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
			if(response.user[0] != null){
				$.each(response.user[0], function(key, value){
					$('#' + key).html(value);
				});
			}
			var html = '';
			if(response.user_service[0] != null){
				$.each(response.user_service, function(key, value){
					html += '<div class="divider"></div>';
					html += '<div class="item clearfix">';
					html += '<div class="col-sm-5 item-info-1">' + value.user_service_name + '</div>';
					html += '<div class="col-sm-3 item-info-2"><i class="fa fa-circle text-orange"></i> ' + value.user_service_duration + ' phút</div>';
					html += '<div class="col-sm-2 item-info-3"><i class="fa fa-circle text-orange"></i> ' + Math.floor((value.user_service_full_price - value.user_service_sale_price) / value.user_service_full_price * 100) + '%</div>';
					html += '<div class="col-sm-2 item-info-4">';
					html += '<button type="button" class="btn btn-sm btn-orange"><i class="fa fa-circle text-white"></i> ' + value.user_service_sale_price + ' đ</button>';
					html += '</div>';
					html += '</div>';
				});
				$('#location_service').html(html);
			}
		},
		complete : function() {

		}
	});
}

/*END LOAD LOCATION DETAIL*/
/*-----------------------*/

