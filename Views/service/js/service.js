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
					if(key == 'user_open_hour'){
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
			$.each(response, function(key, value){
				if(key != 'user'){
					if(value[0] != null){
						if(key == 'user_service'){
							key = 'DỊCH VỤ NỔI BẬT';
						}
						html += '<div class="one-service" style="margin-bottom: 20px;">';
						html += '<div class="title">' + key + '</div>';
						$.each(value, function(key, item){
							html += '<div class="divider"></div>';
							html += '<div class="item clearfix">';
							html += '<div class="col-sm-5 item-info-1">' + item.user_service_name + '</div>';
							html += '<div class="col-sm-3 item-info-2"><i class="fa fa-clock-o text-orange"></i> ' + item.user_service_duration + ' phút</div>';
							html += '<div class="col-sm-2 item-info-3"><i class="fa fa-arrow-down text-orange"></i> ' + Math.floor((item.user_service_full_price - item.user_service_sale_price) / item.user_service_full_price * 100) + '%</div>';
							html += '<div class="col-sm-2 item-info-4">';
							html += '<button type="button" class="btn btn-sm btn-orange"><i class="fa fa-dollar text-white"></i> ' + item.user_service_sale_price + ' đ</button>';
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

		}
	});
}

/*END LOAD LOCATION DETAIL*/
/*-----------------------*/

