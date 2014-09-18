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
			
		},
		complete : function() {

		}
	});
}

/*END LOAD LOCATION DETAIL*/
/*-----------------------*/

