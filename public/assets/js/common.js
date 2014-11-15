/*JUMP TO OTHER PAGE*/
function jumpToOtherPage(page) {
	window.location = page;
}

/*JUMP TO OTHER PAGE*/
/*-----------------------*/

/*CAN ONLY INPUT NUMBER*/
function inputNumbers(evt) {
	var e = evt || window.event;

	if ((e.charCode >= 48 && e.charCode <= 57) || e.charCode == 0) {
		return;
	} else {
		e.preventDefault();
	}
}

/*END CAN ONLY INPUT NUMBER*/
/*-----------------------*/

/*INPUT NOTHING*/
function inputNothing(evt) {
	var e = evt || window.event;
	e.preventDefault();
}

/*END INPUT NOTHING*/
/*-----------------------*/

/*SHORTEN THE TEXT WITH ...*/
function shorten(text, maxLength) {
	var ret = text;
	if (ret.length > maxLength) {
		ret = ret.substr(0, maxLength - 3) + "...";
	}
	return ret;
}

/*END SHORTEN THE TEXT WITH ...*/
/*-----------------------*/

/*FORMAT DATE*/
function formatDate(date) {
	var date_array = date.split('-');
	var dt = parseInt(date_array[2]);
	var mth = parseInt(date_array[1]);
	if (dt < 10) {
		dt = '0' + dt;
	}
	if (mth < 10) {
		mth = '0' + mth;
	}
	var full_date = date_array[0] + '-' + mth + '-' + dt;
	// console.log(full_date);
	var date_format = new Date(full_date);
	re_date = date_format.getDate();
	re_month = parseInt(date_format.getMonth()) + 1;
	if (re_month < 10) {
		re_month = '0' + re_month;
	}
	if (date_format.getDate() < 10) {
		re_date = '0' + date_format.getDate();
	}
	re_year = date_format.getFullYear();
	return re_date + '/' + re_month + '/' + re_year;
}

/*END FORMAT DATE*/
/*-----------------------*/

/*CHECK SESSION IDLE*/
function checkSessionIdle() {
	$.ajax({
		url : URL + 'index/checkSessionIdle',
		type : 'post',
		//dataType : 'json',
		success : function(response) {
			if (response == 200) {
				alert('Bạn đã bị kick out vì không hoạt động quá lâu,bạn còn đó không, quay lại với chúng tôi nào!');
				location.reload();
			} else if (response == 0) {

			}
		},
		complete : function() {
			setTimeout(function() {
				checkSessionIdle();
			}, IDLE_CHECK);
		}
	});
}

/*END CHECK SESSION IDLE*/
/*-----------------------*/

/*END SHOW MORE*/
function showMore(cls, txt) {
	$('.' + cls).slideToggle(200, function() {
		if ($('.' + cls).is(":visible")) {
			$('.' + txt).text('Ẩn đi');
		} else {
			$('.' + txt).text('Xem thêm');
		}
	});
}

/*END SHOW MORE*/
/*-----------------------*/

/*INIT GOOGLE MAP*/
function initGoogleMap(map_id, lat, long, has_directions_service){
	var directionsDisplay = new google.maps.DirectionsRenderer();
	// var geocoder = new google.maps.Geocoder();
	//default position these function in google map
	var mapOptions = {
		zoom : 16,
		center : new google.maps.LatLng(0, 0),
		panControl : false,
		zoomControl : true,
		zoomControlOptions : {
			style : google.maps.ZoomControlStyle.SMALL,
			// position : google.maps.ControlPosition.LEFT_CENTER
		},
		mapTypeControl : false,
		scaleControl : false,
		streetViewControl : false,
		overviewMapControl : false,
		rotateControl : false
	};
	// console.log(LAT);
	map = new google.maps.Map(document.getElementById(map_id), mapOptions);
	directionsDisplay.setMap(map);
	google.maps.event.trigger(map, 'resize');
	var initialLocation = new google.maps.LatLng(lat, long);
	map.setCenter(initialLocation);
	if(has_directions_service == 1 && (XCURR != '' && YCURR != '') && (XCURR != undefined && YCURR != undefined)){
		var start = new google.maps.LatLng(XCURR, YCURR);
		var end = new google.maps.LatLng(XLOC, YLOC);
		var directionsService = new google.maps.DirectionsService();
		var request = {
            origin: start,
            destination: end,
            travelMode: google.maps.TravelMode.DRIVING
            //travelMode: google.maps.TravelMode[type]
        };
        var infoWindow_1 = new google.maps.InfoWindow();
        var curr_pos = new google.maps.LatLng(XCURR, YCURR);
	    infoWindow_1.setOptions({
	        content: "<div align='center' style='width: 130px'><small><b>Vị trí hiện tại của bạn</b></small></div>",
	        position: curr_pos,
	    });
	    infoWindow_1.open(map);
	    var infoWindow_2 = new google.maps.InfoWindow();
        var curr_pos = new google.maps.LatLng(XLOC, YLOC);
	    infoWindow_2.setOptions({
	        content: "<div align='center' style='width: 130px'><small><b>" + USER_BUSINESS_NAME + "</b></small></div>",
	        position: curr_pos,
	    });
	    infoWindow_2.open(map); 
        directionsService.route(request, function (response, status) {         
            if (status == google.maps.DirectionsStatus.OK) {  	
                directionsDisplay.setDirections(response);
            }
        });
        var service = new google.maps.DistanceMatrixService();
		service.getDistanceMatrix({
		      origins: [start],
		      destinations: [end],
		      travelMode: google.maps.TravelMode.DRIVING,
		      unitSystem: google.maps.UnitSystem.METRIC,
		      avoidHighways: false,
		      avoidTolls: false
		}, callback);
	}else{
		var marker = new google.maps.Marker({
			position : new google.maps.LatLng(lat, long),
			map : map,
		});
		$('#distance_map').text('...');
		$('#duration_map').text('...');
	}
}
/*END INIT GOOGLE MAP*/
/*-----------------------*/
function callback(response, status) {
    if (status != google.maps.DistanceMatrixStatus.OK) {
        alert('Error was: ' + status);
    } else {
        var results = response.rows[0].elements;
        $('#distance_map').text(results[0].distance.text);
		$('#duration_map').text(results[0].duration.text);
    }
}