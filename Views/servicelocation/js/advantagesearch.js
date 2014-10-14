$(document).ready(function() {
	loadAdvantageSearch();
});
/*LOAD ADVANTAGE SEARCH*/
function loadAdvantageSearch() {
	$.ajax({
		url : URL + 'servicelocation/loadAdvantageSearch',
		type : 'post',
		dataType : 'json',
		data : {
			service_name : SERVICE_NAME,
			district_id : DISTRICT_ID
		},
		success : function(response) {
			var html = '';
			var html_2 = '';
			var index = 0;
			var index_2 = 0;
			if (response.service_type[0] != null) {
				html += '<div>';
				html += '<input checked id="filter-4-1" value="0" type="radio" name="service_type">';
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
				if(index > 5){
					html += '</div>';
					html += '<a onclick=showMore("see_more_service_type","see_more_service_type_text") style="cursor: pointer">>>> <span class="see_more_service_type_text">Xem thêm</span> loại dịch vụ khác (' + (index - 5) + ')</a>';
				}
				$('#service_type').html(html);
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
				if(index_2 > 5){
					html_2 += '</div>';
					html_2 += '<a onclick=showMore("see_more_service","see_more_service_text") style="cursor: pointer">>>> <span class="see_more_service_text">Xem thêm</span> loại dịch vụ khác (' + (index_2 - 5) + ')</a>';
				}
				$('#service').html(html_2);
			}
		},
		complete : function() {

		}
	});
}
/*END LOAD ADVANTAGE SEARCH*/
/*-----------------------*/