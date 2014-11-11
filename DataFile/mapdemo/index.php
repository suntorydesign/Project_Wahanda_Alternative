<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
		  html, body, #map-canvas { height: 100%; margin: 0; padding: 0;}
		</style>
		<script type="text/javascript"
		  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUxUNFuJ09fVcA24HZcEq0gwxs37ESDo4&language=vi-VI">
		</script>
		<script type="text/javascript">
		var map;
		var geocoder;
		var xCurr;
		var yCurr;
		var marker;
		function initialize() {
			directionsDisplay = new google.maps.DirectionsRenderer();
			geocoder = new google.maps.Geocoder();
			//default position these function in google map
			var mapOptions = {
				zoom: 18,
				center: new google.maps.LatLng(0, 0),

				panControl: false,
				panControlOptions: {
					position: google.maps.ControlPosition.RIGHT_CENTER
				},
				zoomControl: true,
				zoomControlOptions: {
					style: google.maps.ZoomControlStyle.SMALL,
					position: google.maps.ControlPosition.LEFT_CENTER
				},
				mapTypeControl: true,
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
					position: google.maps.ControlPosition.RIGHT_CENTER
				}
			};
			var map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
			directionsDisplay.setMap(map);
			var LNG = '';
			var LAT = '';
			if(LNG == '' && LAT == ''){
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(function (position) {
						initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
						map.setCenter(initialLocation);

						marker = new google.maps.Marker({
							position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
							map : map,
						});
						marker.setAnimation(google.maps.Animation.BOUNCE);
						//Get address name based on coordinate
						var lat = position.coords.latitude;
						var lng = position.coords.longitude;
						var latlng = new google.maps.LatLng(lat, lng);
						geocoder.geocode({ 'latLng': latlng }, function (results, status) {
							console.log(results);
							if (status == google.maps.GeocoderStatus.OK) {
								//document.getElementById("streetName").innerHTML = (results[1].formatted_address);
								for(i = 0;i<7;i++){
									alert(results[i].formatted_address);
								}
								//.substring(0,34) + '...'
							} else {
								alert('Geocoder failed due to: ' + status);
							}
						});
						xCurr = position.coords.latitude;
						yCurr = position.coords.longitude;
						//alert(xCurr +', '+ yCurr);
						marker.setMap(map);
					});
				}
			}else{
				initialLocation = new google.maps.LatLng(LAT, LNG);
				map.setCenter(initialLocation);
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(LAT, LNG),
					map : map,
				});
				marker.setAnimation(google.maps.Animation.BOUNCE);
			}
			
			google.maps.event.addListener(map, 'click', function (event) {
				// marker.setVisible(true);
				//alert(Math.sqrt(Math.abs(Math.pow(xCurr, 2) - Math.pow(event.latLng.lat(), 2))) + Math.sqrt(Math.abs(Math.pow(yCurr, 2) - Math.pow(event.latLng.lng(), 2))));
				//if (Math.abs(event.latLng.lat() - xCurr) < 200 && Math.abs(event.latLng.lng()) < 200)
				// if (Math.sqrt(Math.abs(Math.pow(xCurr, 2) - Math.pow(event.latLng.lat(), 2))) + Math.sqrt(Math.abs(Math.pow(yCurr, 2) - Math.pow(event.latLng.lng(), 2))) < 0.5) {
				// console.log(event);
				placeMarker(event.latLng);
				marker.setAnimation(google.maps.Animation.BOUNCE);
				// setTimeout(function () { document.getElementById('report').submit(); }, 1000);
				// }
			});
		}
		function placeMarker(location) {
			if (marker) {
				marker.setPosition(location);

			} else {
				marker = new google.maps.Marker({
					position: location,
					map: map,
				});
			}
			console.log(location.lat());
			console.log(location.lng());
			// document.getElementById('lat').value = location.lat();
			// document.getElementById('lng').value = location.lng();
		}
		google.maps.event.addDomListener(window, 'load', initialize);
		</script>
	</head>
	<body>
		<div id="map-canvas" style="margin-top: 10px; max-width: 250px; height: 250px; box-shadow: 0.5px 1px 2.6px"></div>
	</body>
</html>