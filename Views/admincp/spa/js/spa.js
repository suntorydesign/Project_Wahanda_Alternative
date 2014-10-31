$(document).ready(function() {
	loadSpaList();
});

function loadSpaList() {
	$.ajax({
		url : URL + 'admincp_spa/loadSpaList',
		type : 'post',
		dataType : 'json',
		success : function(response) {
			if (response[0] != null) {
				var html = '';
				$.each(response, function(i, item) {
					html += '<tr>';
					$.each(item, function(key, value) {
						html += '<td>';
						html += value;
						html += '</td>';
					});
					html += '</tr>';
				});
				$('#spa_list tbody').html(html);
			}
		},
		complete : function() {
			$('#spa_list').DataTable();
		}
	});
}

function addSpaDetail() {
	jumpToOtherPage(URL + 'admincp_spa/addSpaDetail');
}

function returnToSpa() {
	jumpToOtherPage(URL + 'admincp_spa');
}
