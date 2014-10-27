$(document).ready(function() {
	loadResultSearch(1);
	$('#sort_by').on('change', function(){
		loadResultSearch(1);
	});
});

/*LOAD RESULT SEARCH*/
function loadResultSearch(page) {
	$.ajax({
		url : URL + 'servicelocation/loadResultSearch',
		type : 'post',
		dataType : 'json',
		data : {
			service_name : SERVICE_NAME,
			page : page,
			district_id : DISTRICT_ID,
			sort_by : $('#sort_by').val()
		},
		success : function(response) {
			var total_row = response.total_row;
			$('#count_result').text(response.total_row);
			TOTAL_PAGE = (total_row - total_row % MAX_PAGINATION_ITEM) / MAX_PAGINATION_ITEM;
			if (total_row % MAX_PAGINATION_ITEM != 0) {
				TOTAL_PAGE = TOTAL_PAGE + 1;
			}
			var pagination = '';
			if (TOTAL_PAGE != 0) {
				if (page == 1) {
					pagination += '<li class="pre_page disabled"><a href="javascript:void(0);"><b>&laquo;</b></a></li>';
				} else {
					pagination += '<li class="pre_page"><a href="javascript:loadResultSearch(' + (page - 1) + ');"><b>&laquo;</b></a></li>';
				}

				for ( i = 1; i <= TOTAL_PAGE; i++) {
					if (page == i)
						pagination += '<li style="display:none" class="active page_number item_' + i + '"><a href="javascript:void(0);"><b>' + i + '</b></a></li>';
					else
						pagination += '<li style="display:none" class="page_number item_' + i + '"><a href="javascript:loadResultSearch(' + i + ');"><b>' + i + '</b></a></li>';
				}

				if (page == TOTAL_PAGE) {
					pagination += '<li class="next_page disabled"><a href="javascript:void(0);"><b>&raquo;</b></a></li>';
				} else {
					pagination += '<li class="next_page"><a href="javascript:loadResultSearch(' + (page + 1) + ');"><b>&raquo;</b></a></li>';
				}
				$('#result-pagination ul').html(pagination);
			}
			var html = '';
			if (response.data[0] != null) {
				$.each(response.data, function(key, value) {
					var rating_value = parseFloat(value.star_review);
					var head = parseInt(rating_value);
					var tail = rating_value - head;
					tail = Math.round(tail * 100) / 100;
					html += '<div class="item clearfix">';
					html += '<div class="col-md-6 clearfix">';
					html += '<a href="' + URL + 'service/servicePlace/' + value.user_id + '" style="white-space: normal" class="name">' + value.user_business_name.toUpperCase() + '</a>';
					html += '<div class="rating clearfix">';
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
					html += '<div class="address clearfix">';
					html += '<span style="cursor: help" title="' + value.user_address + '" class="pull-left">' + shorten(value.user_address,38) + '</span>';
					html += '<a class="pull-right" href="#">Show map >>></a>';
					html += '</div>';
					html += '<div class="description clearfix">' + shorten(value.user_description, 250) + '</div>';
					html += '<div class="services row">';
					html += '<div class="col-md-2"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-smile-o fa-stack-1x text-white"></i></span><p class="sv_loc_text">MẶT</p></div>';
					html += '<div class="col-md-2"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-child fa-stack-1x text-white"></i></span><p class="sv_loc_text">BODY</p></div>';
					html += '<div class="col-md-2"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-cut fa-stack-1x text-white"></i></span><p class="sv_loc_text">TÓC</p></div>';
					html += '<div class="col-md-2"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-hand-o-up fa-stack-1x text-white"></i></span><p class="sv_loc_text">MÓNG</p></div>';
					html += '<div class="col-md-2"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-heart fa-stack-1x text-white"></i></span><p class="sv_loc_text">FITNESS</p></div>';
					html += '<div class="col-md-2 pointer"><span class="fa-stack">>>></span><p class="sv_loc_text">Khác</p></div>';
					html += '</div>';
					//can not imagine
					html += '</div>';
					html += '<div class="col-md-6 clearfix image">';
					html += '<span class="fa-stack fa-lg new-item">';
					html += '<i class="fa fa-circle fa-stack-2x text-orange"></i>';
					html += '<i class="fa fa-stack-1x fa-inverse"><b>new</b></i>';
					html += '</span>';
					html += '<a href="' + URL + 'service/servicePlace/' + value.user_id + '"><img href="' + URL + 'service/servicePlace/' + value.user_id + '" width="100%" class="img-responsive" src="' + value.user_logo + '"></a>';
					html += '</div>';

					$.each(value.user_service, function(key, item) {
						html += '<div class="col-md-12 clearfix">';
						html += '<div class="price clearfix">';
						html += '<div class="col-sm-5 text-orange price-info-1">';
						html += '<strong>' + shorten(item.user_service_name, 30) + '</strong>';
						html += '</div>';
						html += '<div class="col-sm-2 price-info-2">';
						html += '<span class="fa-stack"><i></i><i class="fa fa-stack-2x fa-clock-o text-orange"></i></span> ' + item.user_service_duration + 'phút';
						html += '</div>';
						html += '<div class="col-sm-3 price-info-3">';
						html += '<span class="fa-stack"><i class="fa fa-certificate fa-stack-2x text-orange"></i><i class="fa fa-stack-1x text-white"><b>%</b></i></span> Giảm ' + Math.floor((item.user_service_full_price - item.user_service_sale_price) / item.user_service_full_price * 100) + '%';
						html += '</div>';
						html += '<div class="col-sm-2 price-info-4" >';
						html += '<button data-user-service="' + item.user_service_id + '" type="button" class="btn btn-sm btn-orange pull-right btn_location_booking">';
						html += '<i style="display : none;" class="fa fa-refresh fa-spin waiting_booking_detail"></i>';
						html += ' <i class="fa fa-lg fa-dollar text-white"></i> <span class="text-white">' + item.user_service_sale_price + ' đ</span>';
						html += '</button>';
						html += '</div>';
						html += '</div>';
						html += '</div>';
					});
					html += '</div>';
				});
				$('#result-list').html(html);
			} else {
				$('#result-list').html('<h4>Không có địa điểm nào được tìm thấy...</h4>');
			}
		},
		complete : function() {
			$('#waiting_for_result_list').fadeOut(function(){
				$('.processing_loading').hide();
			});
			if (CURRENT_PAGE == 1 || CURRENT_PAGE == 2) {
				$('ul.pagination li.item_1').show();
				$('ul.pagination li.item_2').show();
				$('ul.pagination li.item_3').show();
				$('ul.pagination li.item_4').show();
				$('ul.pagination li.item_5').show();
			}
			if (CURRENT_PAGE > 2 && CURRENT_PAGE < (TOTAL_PAGE - 1)) {
				$('ul.pagination li.item_' + (current_page - 2)).show();
				$('ul.pagination li.item_' + (current_page - 1)).show();
				$('ul.pagination li.item_' + (current_page)).show();
				$('ul.pagination li.item_' + (current_page + 1)).show();
				$('ul.pagination li.item_' + (current_page + 2)).show();
			}
			if (CURRENT_PAGE == TOTAL_PAGE || CURRENT_PAGE == (TOTAL_PAGE - 1)) {
				$('ul.pagination li.item_' + (TOTAL_PAGE)).show();
				$('ul.pagination li.item_' + (TOTAL_PAGE - 1)).show();
				$('ul.pagination li.item_' + (TOTAL_PAGE - 2)).show();
				$('ul.pagination li.item_' + (TOTAL_PAGE - 3)).show();
				$('ul.pagination li.item_' + (TOTAL_PAGE - 4)).show();
			}
			$('ul.pagination li.page_number').on('click', function() {
				CURRENT_PAGE = parseInt($(this).find('a b').text());
			});
			$('ul.pagination li.pre_page').on('click', function() {
				CURRENT_PAGE--;
			});
			$('ul.pagination li.next_page').on('click', function() {
				CURRENT_PAGE++;
			});
			$('.btn_location_booking').on('click', function(e) {
				$(this).find('i.waiting_booking_detail').fadeIn();
				USER_SERVICE_ID = $(this).attr('data-user-service');
				// console.log(USER_SERVICE_ID);
				loadServiceDetail(USER_SERVICE_ID);
			});
		}
	});
}
/*END LOAD RESULT SEARCH*/
/*-----------------------*/