
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

    // Ngay mo cua
    var xhrGet_user_open_hour = function() {
        var url = URL + 'spaCMS/settings/xhrGet_user_open_hour';

        $.get(url, function(data){
            console.log(data);
        }, 'json')
        .done(function() {
        });
    }

    return {
        init: function(){
            xhrGet_group_user_service();
            xhrGet_user_open_hour();
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
            hiddenDays: [0, 6], // [2, 4] hide Tuesdays and Thursdays
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
                // Kiểm tra ngày này spa có mở cửa hay không?
                var weekly = convert_num2day(date.format('d'));
                var url = URL + 'spaCMS/calendar/xhrGet_user_open_hour';
                $.get(url, function(data){
                    console.log(data);

                    var isOpen = data[weekly][0];
                    var openHour = data[weekly][1]; // Giờ mở cửa
                    var closeHour = data[weekly][2]; // Giờ đóng cửa

                    // Không đặt lịch hẹn nếu ngày này spa không có lịch mở cửa
                    if(!isOpen) {
                        alert("Không có lịch làm việc vào ngày này!");
                        return false;
                    } 

                    // Điều chỉnh giờ bắt đầu phù hợp với dịch vụ được chọn,
                    // và thông báo giờ kết thúc
                    $('#list_gus').change(function(){
                        var self = $(this);
                        var us_id = self.val(); // user_service_id
                        var select_app_start = $('#appointment_time_start'); // DOM của appointment_time_start 

                        // html cho option chọn thời gian bắt đầu
                        var op_app_start = '<option value=":appointment_time_start">:appointment_time_start</option>';

                        // Lấy thời gian thực hiện dịch vụ được chọn
                        var url = URL + 'spaCMS/calendar/xhrGet_user_service';
                        $.get(url, {'user_service_id':us_id}, function(data){
                            console.log(data);
                            var us_duration = data[0]['user_service_duration']; // Thời gian thực hiện dịch vụ

                            // Tính các khoảng thời gian phù hợp để bắt đầu dịch vụ
                            // openHour <= openHour + duration <= closeHour
                            select_app_start.html(''); // Clear danh sách giờ bắt đầu mặc định

                            // Tạo danh sách giờ bắt đầu mới phù hợp với giờ mở cửa của spa và thời gian thực hiện dịch vụ
                            var timeStart_begin = openHour*60; // Chuyển giờ sang phút để so sánh
                            var timeStart_end   = closeHour*60;
                            var timeStart_value = timeStart_begin;

                            while( timeStart_value <= timeStart_end){
                                timeStart_value += us_duration;

                                timeStart_hourValue = convertToHoursMins(timeStart_value);
                                select_app_start.append(op_app_start.replace(/:appointment_time_start/g, timeStart_hourValue));
                            }
                            

                            $('.user_service_duration', aA_modal).text(us_duration);
                        },'json')
                        .done(function(){
                            alert('Xong rồi!');
                        });
                    });

                }, 'json');

                
                $('input[name=appointment_date]', aA_modal).val(date.format('DD-MM-YYYY'));
                // alert('Clicked on: ' + (date.format('d')));

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
                var us_duration = cA_modal.find('.user_service_duration');
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

    var xhrInsert_appointment = function() {
        $('#addAppointment_form').on('submit', function(){
            var aA_form = $(this);
            var data = aA_form.serialize();
            // console.log(data);
            var loading = aA_form.find('.loading');
            var done = aA_form.find('.done');
            loading.fadeIn();
            done.hide();

            var url = URL + 'spaCMS/calendar/xhrInsert_appointment';
            $.post(url, data, function(result){
                loading.fadeOut();
                done.fadeIn();
                console.log(result);
            })
            .done(function(){
                aA_form.modal("hide");
            })
            return false;
        });
        
    }

    var cancel_Appointment = function() {

    }

    var complete_Appointment = function() {
        
    }

    return {
        init: function() {
            xhrGet_calendar();
            xhrInsert_appointment();
        }
    }
}();


function convert_num2day(num) {
    switch(num) {
        case '1': return 2;
        case '2': return 3;
        case '3': return 4;
        case '4': return 5;
        case '5': return 6;
        case '6': return 7;
        case '0': return 8;
        default: return false;
    }
}

// Convert Minute to Hours
function convertToHoursMins(time, format) {
    if(typeof format == 'undefined') {
        format = "{0}:{1}";
    }
    time = parseInt(time);
    if (time < 1) {
        return;
    }
    hours = Math.floor(time / 60);
    minutes = (time % 60);
    return format.format(hours, minutes);
}

$(document).ready(function(){
    
});

LoadMoreInfo.init();
Calendar.init();