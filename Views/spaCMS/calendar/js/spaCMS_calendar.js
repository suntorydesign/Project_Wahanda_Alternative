
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
            disableDragging: true,
            // hiddenDays: [0, 6], // [2, 4] hide Tuesdays and Thursdays
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
                var weekly = convert_num2dayval(date.format('d'));
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
                        var select_app_start = $('#appointment_time_start'); // DOM của appointment_time_start 

                        var us_id           = self.val(); // user_service_id
                        var us_duration     = null; // user_service_duration
                        var app_time_end    = null; // appointment_time_end
                        var app_time_start  = null; // appointment_time_start

                        // html cho option chọn thời gian bắt đầu
                        var op_app_start = '<option value=":appointment_time_start">:appointment_time_start</option>';
                        var out_op_app_start = '';

                        // Lấy thời gian thực hiện của dịch vụ được chọn
                            // Nếu không có dịch vụ được chọn thì dừng
                        if(us_id === '') 
                            return false;
                        var url = URL + 'spaCMS/calendar/xhrGet_user_service';
                        $.get(url, {'user_service_id':us_id}, function(data){

                            us_duration = data[0]['user_service_duration']; // Thời gian thực hiện dịch vụ
                            us_duration = parseInt(us_duration);

                            // Tính các khoảng thời gian phù hợp để bắt đầu dịch vụ
                            // openHour <= openHour + duration <= closeHour
                            select_app_start.html(''); // Clear danh sách giờ bắt đầu mặc định

                            // Tạo danh sách giờ bắt đầu mới phù hợp với giờ mở cửa của spa và thời gian thực hiện dịch vụ
                            var timeStart_begin = openHour*60; // Chuyển giờ sang phút để so sánh
                            var timeStart_end   = closeHour*60;
                            var timeStart_value = timeStart_begin;

                            while( timeStart_value < timeStart_end )
                            {
                                // Chuyển từ phút sang kiểu hour:minute
                                timeStart_hourValue = convert_Min2Hour(timeStart_value);
                                out_op_app_start += op_app_start.replace(/:appointment_time_start/g, timeStart_hourValue);

                                timeStart_value += us_duration; // Thời gian tiếp theo
                            }

                            // Khởi tạo thời gian kết thúc dịch vụ
                                // thời gian bắt đầu (timeStart_begin) + duration 
                            app_time_start  = timeStart_begin;
                            app_time_end    = convert_Min2Hour(app_time_start + us_duration);

                        },'json')
                        .done(function(){
                            // Hiển thị danh sách thời gian bắt đầu phù hợp với ngày và dịch vụ này
                            select_app_start.html(out_op_app_start);
                            // Thông báo thời gian phục vụ của dịch vụ này
                            $('.user_service_duration', aA_modal).text(us_duration);
                            // Thông báo khởi tạo thời gian kết thúc dịch vụ
                            $('#appointment_time_end', aA_modal).text(app_time_end);
                            $('input[name=appointment_time_end]').val(app_time_end);
                        });
                    });

                }, 'json')
                .done(function(){
                    // Thông báo ngày đặt hẹn (appointment_date)
                    $('input[name=appointment_date]', aA_modal).val(date.format());
                    $('input[name=appointment_created]', aA_modal).val(date.format());
                    $('#appointment_date', aA_modal).val(date.format('DD/MM/YYYY'));

                    // Hiển thị modal
                    $('#addAppointment_modal').modal('show');
                });

                // alert('Clicked on: ' + (date.format('d')));

                // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

                // alert('Current view: ' + view.name);
                
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
            var aA_modal = $("#addAppointment_modal");

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

                // re-draw calendar
                $('#calendar').fullCalendar('refetchEvents');
            })
            .done(function(){
                aA_modal.modal("hide");
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


function convert_num2dayval(num) {
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
function convert_Min2Hour(time) {
    time = parseInt(time);
    if (time < 1) {
        return;
    }
    var hours = Math.floor(time / 60);
    var minutes = (time % 60);

    if(hours < 10)
        hours = "0" + hours;
    if(minutes < 10)
        minutes = "0" + minutes;

    var format = hours +":"+minutes;
    return format;
}

// Convert Time to Minutes
function convert_Hour2Min(time) {
    var data    = null;
    var hour    = null;
    var minute  = null;
    var minutes = null;

    data = time.split(":");
    hour = parseInt(data[0]);
    minute = parseInt(data[1]);

    minutes = hour*60 + minute;
    return minutes;
}


$(document).ready(function(){
    // 
    $('#appointment_time_start').change(function(){
        var self = $(this);
        var app_time_start_choice   = self.val();
        var app_time_end_choice     = null;
        var us_duration = $('#addAppointment_form .user_service_duration').text();
        us_duration = parseInt(us_duration);
        
        app_time_start_choice   = convert_Hour2Min(app_time_start_choice);
        app_time_end_choice     = app_time_start_choice + us_duration;
        app_time_end_choice     = convert_Min2Hour(app_time_end_choice);

        $('#appointment_time_end').text(app_time_end_choice);
        $('input[name=appointment_time_end]').val(app_time_end_choice);
    });
});

LoadMoreInfo.init();
Calendar.init();