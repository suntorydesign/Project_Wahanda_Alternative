$(document).ready(function() {
	
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay',
		},
		hiddenDays: [], // [2, 4] hide Tuesdays and Thursdays
		defaultDate: moment(),
		editable: true,
		eventLimit: true, // allow "more" link when too many events
		events: {
			// url: URL + 'Views/spaCMS/calendar/php/get-events.php?URL=' + URL,
			url: URL + 'spaCMS/calendar/xhrGet_calendar',
			error: function() {
				$('#script-warning').show();
			}
		},
		loading: function(bool) {
			$('#loading').toggle(bool);
		},
		dayClick: function(date, jsEvent, view) {

	        alert('Clicked on: ' + date.format());

	        alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

	        alert('Current view: ' + view.name);

	        // change the day's background color just for fun
	        $(this).css('background-color', 'red');
      
	    },
	    eventClick: function(e) {
            var cA_modal = $("#confirmedAppointment_modal");

            var weekday = cA_modal.find('.weekday');
            var day 	= cA_modal.find('.day');
            var month 	= cA_modal.find('.month');
            var year 	= cA_modal.find('.year');
            var time 	= cA_modal.find('.time');

            var us_name 	= cA_modal.find('.user_service_name');
            var us_duration   = cA_modal.find('.user_service_duration');
            var us_price 	= cA_modal.find('.user_service_price');
            var client_name   = cA_modal.find('.client_name');
            var client_phone  = cA_modal.find('.client_phone');
            var client_email  = cA_modal.find('.client_email');
            var client_note   = cA_modal.find('.client_note');
            // var us_duration = cA_modal.find('.user_service_duration');
            // var us_duration = cA_modal.find('.user_service_duration');
            // var us_duration = cA_modal.find('.user_service_duration');

            var url 	= null;
            var data_id = null;
            if (e.a_id) {
            	data_id = e.a_id;
            	url = URL + 'spaCMS/calendar/xhrGet_appointment';
            }

            if (e.b_id) {
            	data_id = e.b_id;
            	url = URL + 'spaCMS/calendar/xhrGet_booking';
            }

            $.get(url, {'data_id':data_id}, function(data) {
            	console.log(data);
                  var date = new Date(data[0]['data_date']);

                  weekday.text("Thứ " + (date.getDay() + 1) );
                  day.text(date.getDate());
                  month.text(date.getMonth() + 1);
                  year.text(date.getFullYear());
                  time.text(data[0]['data_time_start']);

            	us_name.text(data[0]['data_us_name']);
            	us_duration.text(data[0]['data_us_duration'] + " phút");
            	us_price.text(data[0]['data_price'] + " đ");
            	client_name.text(data[0]['data_client_name']);
            	client_phone.text(data[0]['data_client_phone']);
            	client_email.text(data[0]['data_client_email']);
            }, 'json');

            cA_modal.modal("show");

            return false;
        }

	});
	
});