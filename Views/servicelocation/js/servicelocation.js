$(document).ready(function() {
	loadResultSearch();
});

function loadResultSearch() {
	$.ajax({
		url : URL + 'servicelocation/loadResultSearch',
		type : 'post',
		dataType : 'json',
		data : {
			service_name : SERVICE_NAME,
			// district_id : DISTRICT_ID
		},
		success : function(response) {
			$('#count_result').text(response.total_row);
			var html = '';
			if (response.data[0] != null) {
				$.each(response.data, function(key, value) {
					html += '<div class="item clearfix">';
					html += '<div class="col-md-6 clearfix">';
					html += '<p style="white-space: normal" class="name">' + value.user_business_name.toUpperCase() + '</p>';
					html += '<div class="rating clearfix">';
					html += '<i class="fa fa-star"></i>' + 
							'<i class="fa fa-star"></i>' + 
							'<i class="fa fa-star"></i>' + 
							'<i class="fa fa-star"></i>' + 
							'<i class="fa fa-star-o"></i>';
					html += '</div>';
					html += '<div class="address clearfix">';
					html += '<span class="pull-left">' + value.user_address + '</span>';
					html += '<a class="pull-right" href="#">Show map >>></a>';
					html += '</div>';
					html += '<div class="description clearfix">' + shorten(value.user_description, 250) + '</div>';
					html += '<div class="services">HAIR	NAIL FACE</div>';
					//can not imagine
					html += '</div>';
					html += '<div class="col-md-6 clearfix image">';
					html += '<span class="fa-stack fa-lg new-item">';
					html += '<i class="fa fa-circle fa-stack-2x text-orange"></i>';
					html += '<i class="fa fa-stack-1x fa-inverse"><b>new</b></i>';
					html += '</span>';
					html += '<img width="100%" height="auto" class="img-responsive" src="' + value.user_logo + '">';
					html += '</div>';

					$.each(value.user_service, function(key, item) {
						html += '<div class="col-md-12 clearfix">';
						html += '<div class="price clearfix">';
						html += '<div class="col-sm-5 text-orange price-info-1">';
						html += '<strong>' + shorten(item.user_service_name, 35) + '</strong>';
						html += '</div>';
						html += '<div class="col-sm-3 price-info-2">';
						html += '<i class="fa fa-clock-o text-orange"></i> ' + item.user_service_duration + 'phút';
						html += '</div>';
						html += '<div class="col-sm-2 price-info-3">';
						html += '<i class="fa fa-arrow-down text-orange"></i> Giảm ' + Math.floor((item.user_service_full_price - item.user_service_sale_price) / item.user_service_full_price * 100) + '%';
						html += '</div>';
						html += '<div class="col-sm-2 price-info-4" >';
						html += '<button data-user-service="' + item.user_service_id + '" type="button" class="btn btn-sm btn-orange pull-right btn_location_booking">';
						html += '<i style="display : none;" class="fa fa-refresh fa-spin waiting_booking_detail"></i>';
						html += ' <i class="fa fa-dollar text-white"></i> ' + item.user_service_sale_price + ' đ';
						html += '</button>';
						html += '</div>';
						html += '</div>';
						html += '</div>';
					});
					html += '</div>';
				});
				$('#result-list').html(html);
			}else{
				$('#result-list').html('<h3>Không có dịch vụ nào được tìm thấy...</h3>');
			}
		},
		complete : function() {
			$('.btn_location_booking').on('click', function(e) {
				$(this).find('i.waiting_booking_detail').fadeIn();
				USER_SERVICE_ID = $(this).attr('data-user-service');
				// console.log(USER_SERVICE_ID);
				loadServiceDetail(USER_SERVICE_ID);
			});
		}
	});
}


