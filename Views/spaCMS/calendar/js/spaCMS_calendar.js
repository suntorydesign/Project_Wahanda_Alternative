
var LoadMoreInfo = function() {
    var xhrGet_group_user_service = function() {
        var optgroup = '<optgroup data-id=":group_service_id" label=":group_service_name">';
            optgroup += ':list_user_service';
            optgroup += '</optgroup>';

        var option_s = '<option value=":user_service_id">:user_service_name</option>';
            option_s += ':list_user_service';

        var url = URL + 'spaCMS/menu/xhrGet_group_user_service';
        var out = '';
        $.get(url, function(data){
            // console.log(data);
            $.each(data, function(index, group_us){
                out = optgroup.replace(':group_service_id', group_us['group_service_id']);
                out = out.replace(':group_service_name', group_us['group_service_name']);

                if( typeof group_us['list_user_service'] !== 'undefined' ){
                    $.each(group_us['list_user_service'], function(index, us){
                        out = out.replace(':list_user_service', option_s);
                        out = out.replace(':user_service_id', us['user_service_id']);
                        out = out.replace(':user_service_name', us['user_service_name']);
                    });
                }

                // remove final element 
                out = out.replace(':list_user_service', '');

                $('#list_gus').append(out);
            });
        }, 'json');
    }

    return {
        init: function(){
            xhrGet_group_user_service();
        }
    }
}();


var Calendar = function(){

    var xhrGet_calendar = function() {
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
                var aA_modal = $('#addAppointment_modal');

                $('input[name=appointment_created]', aA_modal).val(date.format());
                // alert('Clicked on: ' + date.format());

                // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

                // alert('Current view: ' + view.name);



                $('#addAppointment_modal').modal('show');

                // change the day's background color just for fun
                // $(this).css('background-color', 'red');
          
            },
            eventClick: function(e) {
                var cA_modal = $("#confirmedAppointment_modal");

                var weekday = cA_modal.find('.weekday');
                var day     = cA_modal.find('.day');
                var month   = cA_modal.find('.month');
                var year    = cA_modal.find('.year');
                var time    = cA_modal.find('.time');

                var us_name     = cA_modal.find('.user_service_name');
                var us_duration   = cA_modal.find('.user_service_duration');
                var us_price    = cA_modal.find('.user_service_price');
                var client_name   = cA_modal.find('.client_name');
                var client_phone  = cA_modal.find('.client_phone');
                var client_email  = cA_modal.find('.client_email');
                var client_note   = cA_modal.find('.client_note');

                var btn_edit_appointment = cA_modal.find('.edit-appointment');
                // var us_duration = cA_modal.find('.user_service_duration');
                // var us_duration = cA_modal.find('.user_service_duration');

                var url     = null;
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
                    if(data[0]['data_client_phone'] !== '') {
                        client_phone.text(data[0]['data_client_phone']);
                    } else {
                        client_phone.html('<i>Chưa có số điện thoại</i>');
                    }
                    client_name.text(data[0]['data_client_name']);
                    client_phone.text(data[0]['data_client_phone']);
                    client_email.text(data[0]['data_client_email']);

                    btn_edit_appointment.attr("onClick", "editConfirmedAppointment_modal("+data[0]['data_id']+","+"'appointment'"+")");


                }, 'json').done(function() {
                    cA_modal.modal("show");
                });

                return false;
            }
        });
    }

    return {
        init: function() {
            xhrGet_calendar();
        }
    }
}();

$(document).ready(function(){
    $('#list_gus').change(function(){
        var self = $(this);
        var us_id = self.val();

        var url = URL + 'spaCMS/calendar/xhrGet_user_service';
        $.get(url, {'user_service_id':us_id}, function(data){
            console.log(data);
            $('.user_service_duration').text(data[0]['user_service_duration']);
        },'json');
    });
});

LoadMoreInfo.init();
Calendar.init();